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
            return "No existe";
        }
        return $request;
    }
}
