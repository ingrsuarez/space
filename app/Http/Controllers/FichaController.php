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
use App\Models\Wating_list;
use App\Models\Appointment;
use Illuminate\Support\Facades\Storage;

class FichaController extends Controller
{
    //


    public function index($idPaciente)
    {
        $user = Auth::user();
        $insurances = Insurance::all();
        $institution = $user->currentInstitution;
        $paciente = Paciente::where('idPaciente',$idPaciente)->first();
        $appoinments = Appointment::where('paciente_id',$paciente->codPaciente)
            ->where('institution_id',$institution->id)
            ->orderBy('created_at', 'desc')->get();
        
        
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
        
        
        $wating = Wating_list::where('paciente_id',$paciente->codPaciente)->first();
        
        if (!empty($wating))
        {
            $watingInsurance = $wating->insurance_id;
        }else
        {
            $watingInsurance = null;
        }
        
        $user->watingMe()->detach($paciente->codPaciente);
        // Estudios de Laboratorios
        $directory = "patients/".$idPaciente."/lab";
        $files = [];
            
        foreach(Storage::disk('local')->files($directory) as $file){
            $name = str_replace($directory.'/',"",$file);
            $path = asset(Storage::disk('local')->url($file));
            $link = Storage::path($file);
            $files[] = [
                'path' => $path,
                'name' => $name,
                'idPaciente' => $idPaciente,
                'link' => $link,
                'size' => Storage::disk('local')->size($file)
            ];
            
        }
        // Order the array to get the last files uploaded
        $files = array_reverse(array_slice($files,-10));

        // Estudios de Fibroscan
        $directoryFibroscans = "patients/".$idPaciente."/fibroscan";
        $fibroscans = [];
            
        foreach(Storage::disk('local')->files($directoryFibroscans) as $fibroscan){
            $name = str_replace($directoryFibroscans.'/',"",$fibroscan);
            $path = asset(Storage::disk('local')->url($fibroscan));
            $link = Storage::path($fibroscan);
            $fibroscans[] = [
                'path' => $path,
                'name' => $name,
                'idPaciente' => $idPaciente,
                'link' => $link,
                'size' => Storage::disk('local')->size($fibroscan)
            ];
            
        }
        // Order the array to get the last files uploaded
        $fibroscans = array_reverse(array_slice($fibroscans,-10));
        //Historial clínico del paciente

        // Estudios de ecografia
        $directoryecografias = "patients/".$idPaciente."/ecografia";
        $ecografias = [];
            
        foreach(Storage::disk('local')->files($directoryecografias) as $ecografia){
            $name = str_replace($directoryecografias.'/',"",$ecografia);
            $path = asset(Storage::disk('local')->url($ecografia));
            $link = Storage::path($ecografia);
            $ecografias[] = [
                'path' => $path,
                'name' => $name,
                'idPaciente' => $idPaciente,
                'link' => $link,
                'size' => Storage::disk('local')->size($ecografia)
            ];
            
        }
        // Order the array to get the last files uploaded
        $ecografias = array_reverse(array_slice($ecografias,-10));

        // Estudios de endoscopia
        $directoryendoscopias = "patients/".$idPaciente."/endoscopia";
        $endoscopias = [];
            
        foreach(Storage::disk('local')->files($directoryendoscopias) as $endoscopia){
            $name = str_replace($directoryendoscopias.'/',"",$endoscopia);
            $path = asset(Storage::disk('local')->url($endoscopia));
            $link = Storage::path($endoscopia);
            $endoscopias[] = [
                'path' => $path,
                'name' => $name,
                'idPaciente' => $idPaciente,
                'link' => $link,
                'size' => Storage::disk('local')->size($endoscopia)
            ];
            
        }
        // Order the array to get the last files uploaded
        $endoscopias = array_reverse(array_slice($endoscopias,-10));

        // Estudios de cardiologia
        $directorycardiologias = "patients/".$idPaciente."/cardiologia";
        $cardiologias = [];
            
        foreach(Storage::disk('local')->files($directorycardiologias) as $cardiologia){
            $name = str_replace($directorycardiologias.'/',"",$cardiologia);
            $path = asset(Storage::disk('local')->url($cardiologia));
            $link = Storage::path($cardiologia);
            $cardiologias[] = [
                'path' => $path,
                'name' => $name,
                'idPaciente' => $idPaciente,
                'link' => $link,
                'size' => Storage::disk('local')->size($cardiologia)
            ];
            
        }
        // Order the array to get the last files uploaded
        $cardiologias = array_reverse(array_slice($cardiologias,-10));

        //Historial clínico del paciente

        $codPaciente = $paciente->codPaciente;
        $historiales = HistorialClinico::where('codPacienteHC',$codPaciente)->join('users', 'codUsuarioHC', '=', 'users.id')->orderBy('fechaHC', 'desc')->select('historialClinico.*', 'users.name','users.lastName')->get();
        
        return view('pacientes.nueva_atencion',compact('edad','paciente','historiales','institution','insurances','watingInsurance','appoinments','files','fibroscans','ecografias','endoscopias','cardiologias'));
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
        

        $historial = new HistorialClinico;
        $historial->codPacienteHC = $request->codPaciente;
        $historial->codUsuarioHC = Auth::user()->id;
        $historial->fechaHC = Carbon::parse($date)->toDateTimeString();
        $historial->codInstitucionHC = ($user->currentInstitution)->id;
        $historial->entrada = $request->entrada;
        $historial->esPublico = $esPublico;
        $historial->insurance_id = $request->insurance_id;
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
