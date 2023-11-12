<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Validator;

class FilesController extends Controller
{
    //

    public function store(Request $request)
    {

        $request->validate([
            'laboratory' => 'max:2000|mimes:pdf',
        ]);

        
        $date = now();      
        $file = $request->file('laboratory');
        
        $file->storeAs('','patients/'.$request->idPaciente.'/lab-'.$request->idPaciente.'-'. $date->toDateString().'.'.$file->extension(),'');
        
        // $directory = "patients/".$request->idPaciente;

        // foreach(Storage::disk('local')->files($directory) as $file){
        //     $name = str_replace($directory.'/',"",$file);
        //     $path = asset(Storage::disk('local')->url($file));
        //     $link = Storage::path($file);
        //     $files[] = [
        //         'path' => $path,
        //         'name' => $name,
        //         'idPaciente' => $request->idPaciente,
        //         'link' => $link,
        //         'size' => Storage::disk('local')->size($file)
        //     ];
                
        // }
        
        // $files = array_reverse($files);
        return redirect()->back()->withInput();
    }

    public function download($file, Request $request)
    {
       
 
        $file_path = Storage::path('patients\\'.$request->idPaciente.'\\'.$file);

        return response()->file($file_path,['content-type'=>'application/pdf']);
    }
}
