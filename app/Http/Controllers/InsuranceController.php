<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insurance;

class InsuranceController extends Controller
{
    public function create()
    {
        return view('insurances.create');

    }

    public function store(Request $request)
    {
        $insurance = new Insurance;
        $insurance->name = $request->name;
        $insurance->tax_id = $request->tax_id;
        $insurance->email = $request->email;
        $insurance->phone = $request->phone;
        $insurance->address = $request->address;
        $insurance->country = $request->country;
        $insurance->status = 'active';
        $insurance->weight = 1;
        $insurance->state = $request->state;

        try 
        {
            $insurance->save();
            return back()->with('message', 'Obrasocial guardada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Obrasocial existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
        return $request;
    }

    public function show()
    {
        $insurances = Insurance::all();
        return view('insurances.show',compact('insurances'));
    }

    public function active()
    {
        $insurances = Insurance::all();
        return view('insurances.show',compact('insurances'));
    }

    public function edit(Insurance $insurance)
    {
        return 'edit'.$insurance->name;
    }

    public function delete()
    {
        return 'delete';
    }
}
