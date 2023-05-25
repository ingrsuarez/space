<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        $user = new User;
        
        $user->fechaNacimiento = $request->fechaNacimiento;
        $user->name = strtolower($request->name);
        $user->lastName = strtolower($request->lastName);
        $user->password = $request->password;
        $user->tipo = $request->tipo;
        $user->telefono = $request->telefono;
        $user->email = strtolower($request->email);
        $user->localidad = strtolower($request->localidad);
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
        return view('user.edit',compact('user','roles'));

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
    public function destroy($id)
    {
        
    }
}
