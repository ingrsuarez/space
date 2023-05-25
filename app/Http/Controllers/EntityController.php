<?php

namespace App\Http\Controllers;
use App\Models\Entity;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    //


    public function create()
    {
        $entities = Entity::orderBy('name','asc')->paginate(5);


        return view('entities.create',compact('entities'));
    }

    public function store(Request $request)
    {

        
        $entity = new Entity;
        $entity->name = $request->name;
        $entity->country = $request->country;
        $entity->state = $request->state;

        try 
        {
            $entity->save();
            return back()->with('message', 'Entidad guardada correctamente!');
        
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



}
