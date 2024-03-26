<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Insurance;
use App\Models\Paciente;
use App\Models\Institution;
use Illuminate\Support\Facades\Storage;

class UserPatientController extends Controller
{
    public function home()
    {
        $user = Auth::user();
        
        $insurances = Insurance::all(); 
        if(count($user->paciente))
        {
            // Estudios de Laboratorios
            $directory = "patients/".$user->paciente[0]->idPaciente."/lab";
            $files = [];
                
            foreach(Storage::disk('local')->files($directory) as $file){
                $name = str_replace($directory.'/',"",$file);
                $path = asset(Storage::disk('local')->url($file));
                $link = Storage::path($file);
                $files[] = [
                    'path' => $path,
                    'name' => $name,
                    'idPaciente' => $user->paciente[0]->idPaciente,
                    'link' => $link,
                    'size' => Storage::disk('local')->size($file)
                ];
                
            }
            // Order the array to get the last files uploaded
            $files = array_reverse(array_slice($files,-10));
            return view('userPatient.home',compact('user','insurances','files'));
        }else
        {
            return view('userPatient.new',compact('user','insurances'));
        }
        
        
    }

    public function store(Request $request)
    {   
        $user = Auth::user();
        if(count($user->paciente))
        {
            $pacientes = $user->paciente[0];
            return $pacientes;
        }
        if(isset($request->codPaciente))
        {
            
            $user->paciente()->attach($request->codPaciente,['relation'=>'self']);
            $paciente = Paciente::find($request->codPaciente);
            $paciente->nombrePaciente = $request->nombre;
            $paciente->apellidoPaciente = $request->apellido;
            $paciente->fechaNacimientoPaciente = $request->fechaNacimiento;
            $paciente->sexoPaciente = $request->sexo;
            $paciente->domicilioPaciente = $request->domicilio;
            $paciente->localidadPaciente = $request->localidad;
            $paciente->celularPaciente = $request->celular;
            $paciente->emailPaciente = $request->email;
            $paciente->telefonoPaciente = $request->telefono;
            $paciente->save();
            return view('userPatient.home',compact('user'));
        }else
        {
            $paciente = new Paciente;
            $paciente->idPaciente = $request->idPaciente;
            $paciente->nombrePaciente = $request->nombre;
            $paciente->apellidoPaciente = $request->apellido;
            $paciente->insurance_id = $request->insurance_id;
            $paciente->coberturaPaciente = $request->insurance_id;
            $paciente->fechaNacimientoPaciente = $request->fechaNacimiento;
            $paciente->sexoPaciente = $request->sexo;
            $paciente->domicilioPaciente = $request->domicilio;
            $paciente->localidadPaciente = $request->localidad;
            $paciente->celularPaciente = $request->celular;
            $paciente->emailPaciente = $request->email;
            $paciente->telefonoPaciente = $request->telefono;
            $paciente->save();
            $user->paciente()->attach($paciente->codPaciente,['relation'=>'self']);
            return view('userPatient.home',compact('user'));
        }
        return $request;
    }

    public function studies()
    {
        $user = Auth::user();
        if(count($user->paciente))
        {
            // Estudios de Laboratorios
            $idPaciente = $user->paciente[0]->idPaciente;
            $directory = "patients/".$idPaciente."/lab";
            $labs = [];
                
            foreach(Storage::disk('local')->files($directory) as $file){
                $name = str_replace($directory.'/',"",$file);
                $path = asset(Storage::disk('local')->url($file));
                $link = Storage::path($file);
                $labs[] = [
                    'path' => $path,
                    'name' => $name,
                    'idPaciente' => $user->paciente[0]->idPaciente,
                    'link' => $link,
                    'size' => Storage::disk('local')->size($file)
                ];
                
            }
            // Order the array to get the last files uploaded
            $labs = array_reverse(array_slice($labs,-10));

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

            return view('userPatient.studies',compact('user','labs','fibroscans','ecografias','endoscopias','cardiologias'));
        }else
        {
            return view('userPatient.new',compact('user'));
        }
    }
}
