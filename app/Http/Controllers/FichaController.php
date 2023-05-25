<?php

namespace App\Http\Controllers;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use App\Models\EspecialidadesMedicas;
use App\Models\Profession;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class FichaController extends Controller
{
    //


    public function index($idPaciente)
    {
       
        $paciente = Paciente::where('idPaciente',$idPaciente)->first();
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $data['edad'] = $fecha_nacimiento->diffInYears($today);
        $data['paciente'] = $paciente;
        
        //Historial clínico del paciente
        $codPaciente = $paciente->codPaciente;
        $data['historiales'] = HistorialClinico::where('codPacienteHC',$codPaciente)->join('users', 'codUsuarioHC', '=', 'users.id')->orderBy('fechaHC', 'desc')->select('historialClinico.*', 'users.name','users.lastName')->get();
        
        return view('pacientes.nueva_atencion',$data);
    }

    
    public function store(Request $request)
    {
        

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

        
        // $paciente = Paciente::where('idPaciente',$idPaciente)->get();
        $historial = new HistorialClinico;
        $historial->codPacienteHC = $request->codPaciente;
        $historial->codUsuarioHC = Auth::user()->id;
        $historial->fechaHC = Carbon::parse($request->fechaAtencion)->toDateTimeString();
        $historial->codInstitucionHC = '1000';
        $historial->entrada = $request->entrada;
        $historial->esPublico = $esPublico;
        $historial->especialidad = $strEspecialidades;
        $historial->save();

        return redirect('ficha/'.$request->idPaciente);

        
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
