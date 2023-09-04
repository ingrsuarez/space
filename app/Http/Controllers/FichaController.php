<?php

namespace App\Http\Controllers;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use App\Models\EspecialidadesMedicas;
use App\Models\Profession;
use App\Models\Institution;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use App\Models\Insurance;

class FichaController extends Controller
{
    //


    public function index($idPaciente)
    {
        $insurances = Insurance::all();
        $paciente = Paciente::where('idPaciente',$idPaciente)->first();
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
        $user = Auth::user();
        $institution = $user->currentInstitution;
        $user->watingMe()->detach($paciente->codPaciente);
        
        
        //Historial clínico del paciente
        $codPaciente = $paciente->codPaciente;
        $historiales = HistorialClinico::where('codPacienteHC',$codPaciente)->join('users', 'codUsuarioHC', '=', 'users.id')->orderBy('fechaHC', 'desc')->select('historialClinico.*', 'users.name','users.lastName')->get();
        
        return view('pacientes.nueva_atencion',compact('edad','paciente','historiales','institution','insurances'));
    }

    
    public function store(Request $request)
    {
        
        $paciente = Paciente::find($request->codPaciente);
        $user = Auth::user();
        


        if ($request->esPublico){
            $esPublico = 1;
        }else{
            $esPublico = 0;
        }
        $especialidades = Auth::user()->professions;

        $strEspecialidades = "";
        foreach ($especialidades as $especialidad)
        {
            $strEspecialidades .= $especialidad->name." - "; 
            
        }

        $time = date("h:i:s");
        $date = date($request->fechaAtencion.' '.$time); //Combine given date with current time
        $user =  User::find(Auth::user()->id);

        
        $historial = new HistorialClinico;
        $historial->codPacienteHC = $request->codPaciente;
        $historial->codUsuarioHC = Auth::user()->id;
        $historial->fechaHC = Carbon::parse($date)->toDateTimeString();
        $historial->codInstitucionHC = ($user->currentInstitution)->id;
        $historial->entrada = $request->entrada;
        $historial->esPublico = $esPublico;
        $historial->especialidad = $strEspecialidades;
        $historial->save();

        
        return redirect('home/');
        
    }

    public function update(Request $request)
    {
        
        // $paciente = Paciente::where('idPaciente',$idPaciente)->get();
        $historial = HistorialClinico::find($request->codPosteo);

        $historial->entrada = $request->entrada;
                
        $historial->save();

        return redirect('ficha/'.$request->idPaciente);
        
    }
}
