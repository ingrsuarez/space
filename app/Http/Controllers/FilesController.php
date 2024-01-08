<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Upload_file;
use App\Models\User;
use App\Models\Paciente;

class FilesController extends Controller
{
    //

    public function store(Request $request)
    {
        $user = Auth::user();
        $institution = $user->currentInstitution;
        $paciente = Paciente::where('idPaciente','=',$request->idPaciente)->first();
        $request->validate([
            'laboratory' => 'max:2000|mimes:pdf',
        ]);
      
        $file = $request->file('laboratory');
        
        $file->storeAs('','patients/'.$request->idPaciente.'/lab/lab-'.$request->idPaciente.'-'. $request->file_date.'.'.$file->extension(),'');
        
        $uploaded_file = new Upload_file;
        $uploaded_file->institution_id = $institution->id;
        $uploaded_file->user_id = $user->id;
        $uploaded_file->paciente_id = $paciente->codPaciente;
        $uploaded_file->name = $file;
        $uploaded_file->path = 'patient/';
        $uploaded_file->type = $file->extension();
        $uploaded_file->save();
        return redirect()->back()->withInput();
    }

    public function download($file, Request $request)
    {
       
 
        $file_path = Storage::path('patients/'.$request->idPaciente.'/lab/'.$file);

        return response()->file($file_path,['content-type'=>'application/pdf']);
    }


    //FIBROSCAN

    public function storeFibroscan(Request $request)
    {
        
        $user = Auth::user();
        $institution = $user->currentInstitution;
        $paciente = Paciente::where('idPaciente','=',$request->idPaciente)->first();
        $request->validate([
            'fibroscan' => 'max:2000|mimes:pdf',
        ]);
      
        $file = $request->file('fibroscan');
        
        $file->storeAs('','patients/'.$request->idPaciente.'/fibroscan/fibroscan-'.$request->idPaciente.'-'. $request->file_date.'.'.$file->extension(),'');
        
        $uploaded_file = new Upload_file;
        $uploaded_file->institution_id = $institution->id;
        $uploaded_file->user_id = $user->id;
        $uploaded_file->paciente_id = $paciente->codPaciente;
        $uploaded_file->name = $file;
        $uploaded_file->path = 'patient/';
        $uploaded_file->type = $file->extension();
        $uploaded_file->save();
        return redirect()->back()->withInput();
    }

    public function downloadFibroscan($file, Request $request)
    {
       
 
        $file_path = Storage::path('patients/'.$request->idPaciente.'/fibroscan/'.$file);

        return response()->file($file_path,['content-type'=>'application/pdf']);
    }

    public function storeEcografia(Request $request)
    {
        
        $user = Auth::user();
        $institution = $user->currentInstitution;
        $paciente = Paciente::where('idPaciente','=',$request->idPaciente)->first();
        $request->validate([
            'ecografia' => 'max:2000|mimes:pdf',
        ]);
      
        $file = $request->file('ecografia');
        
        $file->storeAs('','patients/'.$request->idPaciente.'/ecografia/ecografia-'.$request->idPaciente.'-'. $request->file_date.'.'.$file->extension(),'');
        
        $uploaded_file = new Upload_file;
        $uploaded_file->institution_id = $institution->id;
        $uploaded_file->user_id = $user->id;
        $uploaded_file->paciente_id = $paciente->codPaciente;
        $uploaded_file->name = $file;
        $uploaded_file->path = 'patient/';
        $uploaded_file->type = $file->extension();
        $uploaded_file->save();
        return redirect()->back()->withInput();
    }

    public function downloadEcografia($file, Request $request)
    {
       
 
        $file_path = Storage::path('patients/'.$request->idPaciente.'/ecografia/'.$file);

        return response()->file($file_path,['content-type'=>'application/pdf']);
    }
}
