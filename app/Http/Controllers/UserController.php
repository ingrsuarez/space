<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Service;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('lastName','asc')->paginate(5);
        // return $users;
        return view('user.listado_usuarios',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('user.nuevo_usuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);


        $user = new User;
        

        $user->name = strtolower($validated['name']);
        $user->lastName = strtolower($validated['lastName']);
        $user->password = Hash::make($validated['password']);
        $user->tipo = 0;
        $user->email_verified_at = date("Y-m-d H:i:s");
        $user->email = strtolower($validated['email']);

        try 
        {
            $user->save();
            return redirect('user')->with('message', 'usuario guardado correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Usuario ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show()
    // {

    //    // return view('home',['id'=>$id]);
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $services = Service::all();
        return view('user.edit',compact('user','roles','services'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        
        $user = User::find($id);

        $user->fechaNacimiento = $request->fechaNacimiento;
        $user->name = strtolower($request->name);
        $user->lastName = strtolower($request->lastName);
        $user->tipo = $request->tipo;
        $user->estado = $request->estado;
        $user->telefono = $request->telefono;
        $user->email = strtolower($request->email);
        $user->localidad = strtolower($request->localidad);
        
        $user->roles()->sync($request->roles);
        $user->services()->sync($request->services);
        try 
        {
            $user->save();
            return redirect('user')->with('message', 'usuario guardado correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Usuario ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = User::find($id);
        try 
        {
            $user->delete();
           
            return redirect('user?page='.$request->page)->with('message', 'usuario eliminado correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Usuario ya existente!');
            }elseif($errorCode == '1451'){
               return back()->with('error', 'Este usuario tiene Historiales Clínicos asociados y no puede ser eliminado.');
            }
            else{
             return back()->with('error', $errorCode);
            }
            // $e->getMessage()
        } 
        
    }
}
