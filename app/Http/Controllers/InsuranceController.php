<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Insurance;
use App\Models\User;

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
        $user = Auth::user();
        $insurances = Insurance::all();
        
        return view('insurances.active',compact('insurances','user'));
    }

    public function attach(Insurance $insurance, User $user)
    {
        
        $user->insurances()->attach($insurance->id);
        
        return back()->with('success', 'Cobertura agregada correctamente!');
    }

    public function detach(Insurance $insurance, User $user)
    {
        $user->insurances()->detach($insurance);
         return back()->with('success', 'Cobertura eliminada correctamente!');
    }

    public function patient_charge(Request $request)
    {

        $user = Auth::user();
        $user->insurances()->updateExistingPivot( $request->myInsurance, ['patient_charge' => $request->patient_charge] );
        return back()->with('success', 'Coseguro Paciente actualizado correctamente!');
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
