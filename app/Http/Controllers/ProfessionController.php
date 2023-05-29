<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\Entity;
use App\Models\Registration;


class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::orderBy('name','asc')->paginate(5);
        $user = User::find(Auth::user()->id);

        return view('profession.index',compact('professions','user'));
    }
    public function create()
    {
        $professions = Profession::orderBy('name','asc')->paginate(5);


        return view('profession.create',compact('professions'));
    }

    public function list()
    {
        $professions = Profession::orderBy('name','asc')->paginate(10);


        return view('profession.list',compact('professions'));
    }

    public function store(Request $request)
    {

        

        $profession = new Profession;
        $profession->name = $request->name;

        
        
        try 
        {
            $profession->save();
            return back()->with('message', 'Especialidad guardada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Paciente ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    }

    public function edit($id)
    {
        $profession = Profession::find($id);
        return view('profession.edit',compact('profession'));
    }

    public function update(Request $request, Profession $profession)
    {
        
        $profession->name = $request->name;

        try 
        {
            $profession->save();
            return redirect()->route('profession.create')->with('message', 'Especialidad guardada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Paciente ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    }

    public function add(Profession $profession)
    {
        $entities = Entity::all();
        $registrations = Auth::user()->registrations;
        return view('profession.add',compact('profession','entities','registrations'));
    }

    public function attach(Profession $profession, Request $request)
    {

        $user = Auth::user();
        $registration = new Registration;
        $registration->user_id = Auth::user()->id;
        $registration->number = $request->number;
        $registration->entity_id = $request->entity;
        $registration->profession_id = $profession->id;
        $registration->expedition = $request->expedition;
        $registration->expiration = $request->expiration;

        
        $user->professions()->attach($profession->id);
        try 
        {
            $registration->save();
            $profession->save();
            return redirect()->route('profession.index')->with('message', 'Especialidad guardada correctamente!');
        
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

    public function detach(Profession $profession)
    {
        $user = Auth::user();
        $user->professions()->detach($profession->id);
        try 
        {
            $profession->save();
            return redirect()->route('profession.index')->with('message', 'Especialidad eliminada correctamente!');
        
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

    public function user(Request $request)
    {

        return 'profession.add';
    }
}
