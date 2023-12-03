<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Insurance;
use App\Models\ClinicalSheet;
use App\Models\Sheet;
use Barryvdh\DomPDF\Facade\Pdf;

class SheetController extends Controller
{

    public function index()
    {   
        $sheets = Sheet::all();
        return view('sheets.index',compact('sheets'));
    }

    public function store(Request $request)
    {   
        $sheet = new Sheet;
        $sheet->name = $request->name;
        $sheet->route = $request->route;
        $sheet->table_name = $request->table_name;
        $sheet->model = $request->model;
        $sheet->save();
        
        $sheets = Sheet::all();
        return view('sheets.index',compact('sheets'));
    }
    
    public function nutrition(Paciente $paciente)
    {
        $insurances = Insurance::all();
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
        return view('nutrition.new',compact('paciente','edad','insurances'));
    }


    public function clinical(Paciente $paciente)
    {
        $insurances = Insurance::all();
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
        $clinical_sheets = clinicalSheet::where('paciente_id',$paciente->codPaciente)->with('user')->orderBy('created_at','desc')->get();
        return view('clinical.new',compact('paciente','edad','insurances','clinical_sheets'));
    }

    public function clinicalSave(Request $request)
    {
        $clinical_sheet = new ClinicalSheet; 

        $clinical_sheet->user_id = Auth::user()->id;
        $clinical_sheet->institution_id = Auth::user()->institution_id;
        $clinical_sheet->paciente_id = $request->codPaciente;
        $clinical_sheet->fibroscan = $request->fibroscan;
        $clinical_sheet->efca = $request->efca;
        $clinical_sheet->cx_bariatrica = $request->cx_bariatrica;
        $clinical_sheet->hta = $request->hta;
        $clinical_sheet->dbt = $request->dbt;
        $clinical_sheet->cx = $request->cx;
        $clinical_sheet->otros = $request->otros;
        $clinical_sheet->oam = $request->oam;
        $clinical_sheet->ginecologo = $request->ginecologo;
        $clinical_sheet->vacunas = $request->vacunas;
        $clinical_sheet->obesidad = $request->obesidad;
        $clinical_sheet->internacion = $request->internacion;
        $clinical_sheet->ta = $request->ta;
        $clinical_sheet->peso = $request->peso;
        $clinical_sheet->altura = $request->altura;
        $clinical_sheet->imc = $request->imc;
        $clinical_sheet->cintura = $request->cintura;
        $clinical_sheet->cuello = $request->cuello;
        $clinical_sheet->resp = $request->resp;
        $clinical_sheet->cv = $request->cv;
        $clinical_sheet->abdomen = $request->abdomen;
        $clinical_sheet->mmii = $request->mmii;
        $clinical_sheet->actividad_fisica = $request->actividad_fisica;
        $clinical_sheet->oh = $request->oh;
        $clinical_sheet->tbq = $request->tbq;
        $clinical_sheet->drogas = $request->drogas;
        $clinical_sheet->alergias = $request->alergias;
        $clinical_sheet->sueño = $request->sueño;
        $clinical_sheet->catarsis = $request->catarsis;
        $clinical_sheet->diuresis = $request->diuresis;
        $clinical_sheet->gpca = $request->gpca;
        $clinical_sheet->fum = $request->fum;
        $clinical_sheet->aco = $request->aco;
        $clinical_sheet->ant_familiares = $request->ant_familiares;
        $clinical_sheet->vive_con = $request->vive_con;
        $clinical_sheet->farmacos = $request->farmacos;
        $clinical_sheet->plan = $request->plan;
        $clinical_sheet->problemas = $request->problemas;

        $clinical_sheet->save();
        return redirect()->back();

    }

    public function clinicalEdit(ClinicalSheet $clinicalSheet)
    {
        $paciente = Paciente::find($clinicalSheet->paciente_id);
        return view('clinical.edit',compact('clinicalSheet','paciente'));
    }

    public function clinicalUpdate(Paciente $paciente, ClinicalSheet $clinicalSheet, Request $request)
    {

        $clinicalSheet->user_id = Auth::user()->id;
        $clinicalSheet->institution_id = Auth::user()->institution_id;
        $clinicalSheet->paciente_id = $request->codPaciente;
        $clinicalSheet->fibroscan = $request->fibroscan;
        $clinicalSheet->efca = $request->efca;
        $clinicalSheet->cx_bariatrica = $request->cx_bariatrica;
        $clinicalSheet->hta = $request->hta;
        $clinicalSheet->dbt = $request->dbt;
        $clinicalSheet->cx = $request->cx;
        $clinicalSheet->otros = $request->otros;
        $clinicalSheet->oam = $request->oam;
        $clinicalSheet->ginecologo = $request->ginecologo;
        $clinicalSheet->vacunas = $request->vacunas;
        $clinicalSheet->obesidad = $request->obesidad;
        $clinicalSheet->internacion = $request->internacion;
        $clinicalSheet->ta = $request->ta;
        $clinicalSheet->peso = $request->peso;
        $clinicalSheet->altura = $request->altura;
        $clinicalSheet->imc = $request->imc;
        $clinicalSheet->cintura = $request->cintura;
        $clinicalSheet->cuello = $request->cuello;
        $clinicalSheet->resp = $request->resp;
        $clinicalSheet->cv = $request->cv;
        $clinicalSheet->abdomen = $request->abdomen;
        $clinicalSheet->mmii = $request->mmii;
        $clinicalSheet->actividad_fisica = $request->actividad_fisica;
        $clinicalSheet->oh = $request->oh;
        $clinicalSheet->tbq = $request->tbq;
        $clinicalSheet->drogas = $request->drogas;
        $clinicalSheet->alergias = $request->alergias;
        $clinicalSheet->sueño = $request->sueño;
        $clinicalSheet->catarsis = $request->catarsis;
        $clinicalSheet->diuresis = $request->diuresis;
        $clinicalSheet->gpca = $request->gpca;
        $clinicalSheet->fum = $request->fum;
        $clinicalSheet->aco = $request->aco;
        $clinicalSheet->ant_familiares = $request->ant_familiares;
        $clinicalSheet->vive_con = $request->vive_con;
        $clinicalSheet->farmacos = $request->farmacos;
        $clinicalSheet->plan = $request->plan;
        $clinicalSheet->problemas = $request->problemas;


        $clinicalSheet->save();
        return redirect()->action([SheetController::class, 'clinical'], ['paciente' => $request->codPaciente]);

    }

    public function clinicalPDF(ClinicalSheet $clinicalSheet)
    {
        

        $paciente = Paciente::where('codPaciente',$clinicalSheet->paciente_id)->first();
        // return view('clinical.pdf',compact('paciente','clinicalSheet'));
        $pdf = Pdf::loadView('clinical.pdf',compact('paciente','clinicalSheet'));
        return $pdf->stream(); 
    }
}
