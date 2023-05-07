<?php

namespace App\Http\Controllers;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FichaController extends Controller
{
    //
    public function index($idPaciente)
    {
        DB::enableQueryLog();
        
        $paciente = Paciente::where('idPaciente',$idPaciente)->first();
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $data['edad'] = $fecha_nacimiento->diffInYears($today);
        $data['paciente'] = $paciente;
        //Historial clínico del paciente
        $codPaciente = $paciente->codPaciente;
        $data['historiales'] = HistorialClinico::where('codPacienteHC',$codPaciente)->get();


        return view('pacientes.nueva_atencion',$data);
    }

    public function store($idPaciente)
    {
        // return view('pacientes.nueva_atencion');
        $paciente = Paciente::where('idPaciente',$idPaciente)->get();
        
        return $edad;
    }
}
