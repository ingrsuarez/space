<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class InstitutionController extends Controller
{
    //
    public function index()
    {
        $institutions = Institution::paginate(5);

        return view('institutions.index',compact('institutions'));

    }

    public function create()
    {

        return view('institutions.create');
    }

    public function store(Request $request)
    {
        $institution = new Institution;
        $institution->tax_id = $request->tax_id;
        $institution->name = strtolower($request->name);
        $institution->email = strtolower($request->email);
        $institution->phone = $request->phone;
        $institution->address = $request->address;
        $institution->city = strtolower($request->city);
        $institution->country = strtolower($request->country);
        $institution->state = strtolower($request->state);
        
        try 
        {
            $institution->save();
            return back()->with('message', 'Institución guardado correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'institution ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }

    }

    public function edit(Institution $institution)
    {

        $users = $institution->users;
        
        return view('institutions.edit',compact('institution','users'));
    }

    public function update(Request $request, Institution $institution)
    {
        

        $institution->tax_id = $request->tax_id;
        $institution->name = strtolower($request->name);
        $institution->email = strtolower($request->email);
        $institution->phone = $request->phone;
        $institution->address = $request->address;
        $institution->city = strtolower($request->city);
        $institution->country = strtolower($request->country);
        $institution->state = strtolower($request->state);
        $institution->status = strtolower($request->status);
        try 
        {
            $institution->save();
            return redirect()->route('institution.index')->with('message', 'Institución actualizada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'institution ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    }

    public function show(Request $request)
    {

        
        $user = User::find(Auth::user()->id);
        $institution = $user->currentInstitution;
        if(empty($institution))
        {
            return back()->with('error', 'Debe seleccionar una institución!');    
        }else
        {
            $userInstitutions = $user->institutions;
            $search = '';
            if($user->adminsInstitution($institution->id))
            {
                if(isset($request->name)){
                $search = ['name'=>$request->name];

                $users = User::where('name','LIKE','%'.$request->name.'%')->paginate(5);
            }elseif(isset($request->lastName)){
                $search = ['lastName'=>$request->lastName];

                $users = User::where('lastName','LIKE','%'.$request->lastName.'%')->paginate(5);
                
            }elseif(isset($request->email)){
                $search = ['email'=>$request->email];

                $users = User::where('email','LIKE','%'.$request->email.'%')->paginate(5);
                
            }else{
                $users = $institution->users()->paginate(5);
            }
            
           
             return view('institutions.show',compact('institution','search','users','userInstitutions'));
            }else
            {
                return back(); 
            }
            
        }
        
        
    }

    public function attach(Institution $institution)
    {
        $user = Auth::user();
        $user->institutions()->attach($institution->id);
        try 
        {
            $institution->save();
            return redirect()->route('institution.show')->with('message', 'Institución agregada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Especialidad ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    }

    public function detach(Institution $institution)
    {
        $user = Auth::user();
        $user->institutions()->detach($institution->id);
        try 
        {
            $institution->save();
            return redirect()->route('institution.show')->with('message', 'Institución eliminada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Especialidad ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    }

    public function attachUser(Institution $institution,User $user)
    {

        $user->institutions()->attach($institution->id);
        return back()->with('message', 'Usuario agregado correctamente!');
        
    }

    public function detachUser(Institution $institution,User $user)
    {

        
        $user->institutions()->detach($institution->id);
        return back()->with('message', 'Usuario eliminado correctamente!');
        
    }

    public function attachAdmin(Institution $institution,User $user)
    {


        $user->adminInstitutions()->attach($institution->id,['status'=>'activo']);
        return back()->with('message', 'Administrador agregado correctamente!');
        
    }

    public function detachAdmin(Institution $institution,User $user)
    {


        $user->adminInstitutions()->detach($institution->id);
        return back()->with('message', 'Administrador eliminado correctamente!');
        
    }
    
    
}
