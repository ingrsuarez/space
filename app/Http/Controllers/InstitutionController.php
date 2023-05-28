<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Institution;

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

        return view('institutions.edit',compact('institution'));
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
}
