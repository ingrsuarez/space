<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Registration;

class RegistrationController extends Controller
{
    //
    public function delete(Registration $registration)
    {
        $registration->delete();
        return back()->with('message', 'Matricula eliminada!');

    }

    public function list()
    {
        $registrations = Auth::user()->registrations;
        
        return view('registration.list',compact('registrations'));
    }
}
