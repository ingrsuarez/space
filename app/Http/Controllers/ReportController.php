<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Profession;
use App\Models\Institution;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use App\Models\Insurance;
use App\Models\Appointment;


class ReportController extends Controller
{
    public function index()
    {
        $month = 12;
        $user = Auth::user();
        $institution = $user->currentInstitution;
        $professionals = $institution->users;
        
        return view('reports.index',compact('user','institution','professionals'));
    }


}
