<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Insurance;
use App\Models\ClinicalSheet;
use App\Models\NutritionSheet;
use App\Models\PsychologicalSheet;
use App\Models\KinesiologySheet;
use App\Models\Sheet;
use App\Models\HistorialClinico;
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

    public function clinical(Paciente $paciente, Insurance $insurance)
    {
        
        $insurances = Insurance::all();
        
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
        $clinical_sheets = clinicalSheet::where('paciente_id',$paciente->codPaciente)->with('user')->orderBy('created_at','desc')->get();
        return view('clinical.new',compact('paciente','edad','insurances','clinical_sheets','insurance'));
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


        $paciente = Paciente::find($request->codPaciente);
        $user = Auth::user();
        
        $especialidades = Auth::user()->professions;

        $strEspecialidades = "";
        foreach ($especialidades as $especialidad)
        {
            $strEspecialidades .= $especialidad->name." - "; 
            
        }

        $historial = new HistorialClinico;
        $historial->codPacienteHC = $request->codPaciente;
        $historial->codUsuarioHC = $user->id;
        $historial->fechaHC = Carbon::now()->toDateTimeString();
        $historial->codInstitucionHC = $user->institution_id;
        $historial->entrada = 'Carga de planilla clínica';
        $historial->esPublico = '0';
        $historial->insurance_id = $request->insurance_id;
        $historial->especialidad = $strEspecialidades;
        $historial->save();

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

    public function nutrition(Paciente $paciente, Insurance $insurance)
    {
        $insurances = Insurance::all();
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
        $nutrition_sheets = NutritionSheet::where('paciente_id',$paciente->codPaciente)->with('user')->orderBy('created_at','desc')->get();
        return view('nutrition.new',compact('paciente','edad','insurances','nutrition_sheets','insurance'));
    }

    public function nutritionSave(Paciente $paciente, Request $request)
    {

        $nutrition_sheet = new NutritionSheet; 
        $nutrition_sheet->user_id = Auth::user()->id;
        $nutrition_sheet->institution_id = Auth::user()->institution_id;
        $nutrition_sheet->paciente_id = $paciente->codPaciente;
        $nutrition_sheet->edad = $request->edad;
        $nutrition_sheet->control = $request->control;
        $nutrition_sheet->fuma = $request->fuma;
        $nutrition_sheet->actividad = $request->actividad;
        $nutrition_sheet->tipo_actividad = $request->tipoActividad;
        $nutrition_sheet->frecuencia_actividad = $request->frecuenciaActividad;
        $nutrition_sheet->duracion_actividad = $request->duracionActividad;
        $nutrition_sheet->peso = $request->peso;
        $nutrition_sheet->altura = $request->altura;
        $nutrition_sheet->peso_ideal = $request->pesoIdeal;
        $nutrition_sheet->imc = $request->imc;
        $nutrition_sheet->horas_suenio = $request->hora_sueño;
        $nutrition_sheet->ocupacion = $request->ocupacion;
        $nutrition_sheet->jornada = $request->jornada;
        $nutrition_sheet->bariatrica = $request->bariatrica;
        $nutrition_sheet->cuello = $request->cuello;
        $nutrition_sheet->cintura = $request->cintura;
        $nutrition_sheet->desayuno = $request->desayuno;
        $nutrition_sheet->almuerzo = $request->almuerzo;
        $nutrition_sheet->merienda = $request->merienda;
        $nutrition_sheet->cena = $request->cena;
        $nutrition_sheet->colaciones = $request->colaciones;
        $nutrition_sheet->no_ingiere = $request->no_ingiere;
        $nutrition_sheet->predilectos = $request->predilectos;
        $nutrition_sheet->intolerancias_alergias = $request->intolerancias_alergias;
        $nutrition_sheet->alcohol = $request->alcohol;
        $nutrition_sheet->observaciones = $request->observaciones;
        $nutrition_sheet->diagnostico_nutricional = $request->diagnostico_nutricional;
        $nutrition_sheet->indicacion_nutricional = $request->indicacion_nutricional;
        $nutrition_sheet->meta_uno = $request->meta_uno;
        $nutrition_sheet->meta_dos = $request->meta_dos;
        $nutrition_sheet->meta_tres = $request->meta_tres;
        $nutrition_sheet->gr_hdc = $request->gr_hdc;
        $nutrition_sheet->gr_prot = $request->gr_prot;
        $nutrition_sheet->gr_grasas = $request->gr_grasas;
        $nutrition_sheet->pauta_cualitativo = $request->pauta_cualitativo;
        $nutrition_sheet->pauta_cuantitativo = $request->pauta_cuantitativo;
        $nutrition_sheet->pauta_observaciones = $request->pauta_observaciones;
        $nutrition_sheet->peso_inicial = $request->peso_inicial;
        $nutrition_sheet->peso_ajustado = $request->peso_ajustado;
        $nutrition_sheet->imc_inicial = $request->imc_inicial;
        $nutrition_sheet->imc_perdido = $request->imc_perdido;
        $nutrition_sheet->peso_perdido = $request->peso_perdido;
        $nutrition_sheet->exceso_imc_perdido = $request->exceso_imc_perdido;
        $nutrition_sheet->masa_grasa = $request->masa_grasa;


        $nutrition_sheet->save();

        $paciente = Paciente::find($paciente->codPaciente);
        $user = Auth::user();
        
        $especialidades = Auth::user()->professions;

        $strEspecialidades = "";
        foreach ($especialidades as $especialidad)
        {
            $strEspecialidades .= $especialidad->name." - "; 
            
        }
        
        $historial = new HistorialClinico;
        $historial->codPacienteHC = $paciente->codPaciente;
        $historial->codUsuarioHC = $user->id;
        $historial->fechaHC = Carbon::now()->toDateTimeString();
        $historial->codInstitucionHC = $user->institution_id;
        $historial->entrada = 'Carga de planilla nutricional';
        $historial->esPublico = '0';
        $historial->insurance_id = $request->insurance_id;
        $historial->especialidad = $strEspecialidades;
        $historial->save();

        return redirect()->action([SheetController::class, 'nutrition'], ['paciente' => $paciente->codPaciente]);
    }

    public function nutritionEdit(NutritionSheet $nutritionSheet)
    {
        $paciente = Paciente::find($nutritionSheet->paciente_id);
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
       
        return view('nutrition.edit',compact('nutritionSheet','paciente','edad'));
    }

    public function nutritionUpdate(Paciente $paciente, NutritionSheet $nutritionSheet, Request $request)
    {
        
        $nutritionSheet->user_id = Auth::user()->id;
        $nutritionSheet->institution_id = Auth::user()->institution_id;
        $nutritionSheet->paciente_id = $paciente->codPaciente;
        $nutritionSheet->edad = $request->edad;
        $nutritionSheet->control = $request->control;
        $nutritionSheet->fuma = $request->fuma;
        $nutritionSheet->actividad = $request->actividad;
        $nutritionSheet->tipo_actividad = $request->tipoActividad;
        $nutritionSheet->frecuencia_actividad = $request->frecuenciaActividad;
        $nutritionSheet->duracion_actividad = $request->duracionActividad;
        $nutritionSheet->peso = $request->peso;
        $nutritionSheet->altura = $request->altura;
        $nutritionSheet->peso_ideal = $request->pesoIdeal;
        $nutritionSheet->imc = $request->imc;
        $nutritionSheet->horas_suenio = $request->hora_sueño;
        $nutritionSheet->ocupacion = $request->ocupacion;
        $nutritionSheet->jornada = $request->jornada;
        $nutritionSheet->bariatrica = $request->bariatrica;
        $nutritionSheet->cuello = $request->cuello;
        $nutritionSheet->cintura = $request->cintura;
        $nutritionSheet->desayuno = $request->desayuno;
        $nutritionSheet->almuerzo = $request->almuerzo;
        $nutritionSheet->merienda = $request->merienda;
        $nutritionSheet->cena = $request->cena;
        $nutritionSheet->colaciones = $request->colaciones;
        $nutritionSheet->no_ingiere = $request->no_ingiere;
        $nutritionSheet->predilectos = $request->predilectos;
        $nutritionSheet->intolerancias_alergias = $request->intolerancias_alergias;
        $nutritionSheet->alcohol = $request->alcohol;
        $nutritionSheet->observaciones = $request->observaciones;
        $nutritionSheet->diagnostico_nutricional = $request->diagnostico_nutricional;
        $nutritionSheet->indicacion_nutricional = $request->indicacion_nutricional;
        $nutritionSheet->meta_uno = $request->meta_uno;
        $nutritionSheet->meta_dos = $request->meta_dos;
        $nutritionSheet->meta_tres = $request->meta_tres;
        $nutritionSheet->gr_hdc = $request->gr_hdc;
        $nutritionSheet->gr_prot = $request->gr_prot;
        $nutritionSheet->gr_grasas = $request->gr_grasas;
        $nutritionSheet->pauta_cualitativo = $request->pauta_cualitativo;
        $nutritionSheet->pauta_cuantitativo = $request->pauta_cuantitativo;
        $nutritionSheet->pauta_observaciones = $request->pauta_observaciones;
        $nutritionSheet->peso_inicial = $request->peso_inicial;
        $nutritionSheet->peso_ajustado = $request->peso_ajustado;
        $nutritionSheet->imc_inicial = $request->imc_inicial;
        $nutritionSheet->imc_perdido = $request->imc_perdido;
        $nutritionSheet->peso_perdido = $request->peso_perdido;
        $nutritionSheet->exceso_imc_perdido = $request->exceso_imc_perdido;
        $nutritionSheet->masa_grasa = $request->masa_grasa;

        $nutritionSheet->save();
        return redirect()->action([SheetController::class, 'nutrition'], ['paciente' => $paciente->codPaciente]);
    }

    public function nutritionPDF(NutritionSheet $nutritionSheet)
    {
        $paciente = Paciente::where('codPaciente',$nutritionSheet->paciente_id)->first();
        // return view('clinical.pdf',compact('paciente','clinicalSheet'));
        $pdf = Pdf::loadView('nutrition.pdf',compact('paciente','nutritionSheet'));
        return $pdf->stream(); 
    }


    public function psychological(Paciente $paciente)
    {
        $insurances = Insurance::all();
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
        $psychological_sheets = psychologicalSheet::where('paciente_id',$paciente->codPaciente)->with('user')->orderBy('created_at','desc')->get();
        return view('psychological.new',compact('paciente','edad','insurances','psychological_sheets'));
    }

    public function psychologicalSave(Paciente $paciente, Request $request)
    {
        $psychological_sheet = new PsychologicalSheet; 

        $psychological_sheet->user_id = Auth::user()->id;
        $psychological_sheet->institution_id = Auth::user()->institution_id;
        $psychological_sheet->paciente_id = $paciente->codPaciente;
        $psychological_sheet->edad = $request->edad;
        $psychological_sheet->peso = $request->peso;
        $psychological_sheet->peso_maximo = $request->peso_maximo;
        $psychological_sheet->intencion_cirugia = $request->intencion_cirugia;
        $psychological_sheet->antecedentes = $request->antecedentes;
        $psychological_sheet->tto_psicologico = $request->tto_psicologico;
        $psychological_sheet->tto_psiquiatrico = $request->tto_psiquiatrico;
        $psychological_sheet->conducta_alimentaria = $request->conducta_alimentaria;
        $psychological_sheet->atracon = $request->atracon;
        $psychological_sheet->comedor_nocturno = $request->comedor_nocturno;
        $psychological_sheet->actividad_física = $request->actividad_física;
        $psychological_sheet->trabajo = $request->trabajo;
        $psychological_sheet->familia = $request->familia;
        $psychological_sheet->perdidas = $request->perdidas;
        $psychological_sheet->tto_anteriores = $request->tto_anteriores;
        $psychological_sheet->limitaciones = $request->limitaciones;
        $psychological_sheet->evolucion = $request->evolucion;

        $psychological_sheet->save();

        $paciente = Paciente::find($paciente->codPaciente);
        $user = Auth::user();
        
        $especialidades = Auth::user()->professions;

        $strEspecialidades = "";
        foreach ($especialidades as $especialidad)
        {
            $strEspecialidades .= $especialidad->name." - "; 
            
        }
        
        $historial = new HistorialClinico;
        $historial->codPacienteHC = $paciente->codPaciente;
        $historial->codUsuarioHC = $user->id;
        $historial->fechaHC = Carbon::now()->toDateTimeString();
        $historial->codInstitucionHC = $user->institution_id;
        $historial->entrada = 'Carga de planilla psicológica';
        $historial->esPublico = '0';
        $historial->insurance_id = null;
        $historial->especialidad = $strEspecialidades;
        $historial->save();

        return redirect()->back();

    }

    public function psychologicalEdit(PsychologicalSheet $psychologicalSheet)
    {
        $user = Auth::user();
        if( $psychologicalSheet->user_id == $user->id)
        {
            $paciente = Paciente::find($psychologicalSheet->paciente_id);
            $today = Carbon::now();
            $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
            $edad = $fecha_nacimiento->diffInYears($today);
            
            return view('psychological.edit',compact('psychologicalSheet','paciente','edad'));
        }else
        {
            return redirect()->back();
        }
        
    }

    public function psychologicalPDF(PsychologicalSheet $psychologicalSheet)
    {
        $paciente = Paciente::where('codPaciente',$psychologicalSheet->paciente_id)->first();
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
        $pdf = Pdf::loadView('psychological.pdf',compact('paciente','psychologicalSheet','edad'));
        return $pdf->stream(); 
    }

    public function psychologicalUpdate(Paciente $paciente, PsychologicalSheet $psychologicalSheet, Request $request)
    {

        $psychologicalSheet->user_id = Auth::user()->id;
        $psychologicalSheet->institution_id = Auth::user()->institution_id;
        $psychologicalSheet->paciente_id = $paciente->codPaciente;
        $psychologicalSheet->edad = $request->edad;
        $psychologicalSheet->peso = $request->peso;
        $psychologicalSheet->peso_maximo = $request->peso_maximo;
        $psychologicalSheet->intencion_cirugia = $request->intencion_cirugia;
        $psychologicalSheet->antecedentes = $request->antecedentes;
        $psychologicalSheet->tto_psicologico = $request->tto_psicologico;
        $psychologicalSheet->tto_psiquiatrico = $request->tto_psiquiatrico;
        $psychologicalSheet->conducta_alimentaria = $request->conducta_alimentaria;
        $psychologicalSheet->atracon = $request->atracon;
        $psychologicalSheet->comedor_nocturno = $request->comedor_nocturno;
        $psychologicalSheet->actividad_fisica = $request->actividad_fisica;
        $psychologicalSheet->trabajo = $request->trabajo;
        $psychologicalSheet->familia = $request->familia;
        $psychologicalSheet->perdidas = $request->perdidas;
        $psychologicalSheet->tto_anteriores = $request->tto_anteriores;
        $psychologicalSheet->limitaciones = $request->limitaciones;
        $psychologicalSheet->evolucion = $request->evolucion;

        $psychologicalSheet->save();


        return redirect()->action([SheetController::class, 'psychological'], ['paciente' => $paciente->codPaciente]);

    }





    public function kinesiology(Paciente $paciente,  Insurance $insurance)
    {
        $insurances = Insurance::all();
        //Edad del paciente
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
        $kinesiology_sheets = KinesiologySheet::where('paciente_id',$paciente->codPaciente)->with('user')->orderBy('created_at','desc')->get();
        return view('kinesiology.new',compact('paciente','edad','insurances','kinesiology_sheets','insurance'));
    }

    public function kinesiologySave(Paciente $paciente, Request $request)
    {
        // $evolution = $request->validate([
        //     'evolution' => 'required|max:512']);

        $kinesiology_sheet = new KinesiologySheet; 
        $kinesiology_sheet->user_id = Auth::user()->id;
        $kinesiology_sheet->institution_id = Auth::user()->institution_id;
        $kinesiology_sheet->paciente_id = $paciente->codPaciente;
        $kinesiology_sheet->evolution = $request->evolution;


        $kinesiology_sheet->save();

        $paciente = Paciente::find($paciente->codPaciente);
        $user = Auth::user();
        
        $especialidades = Auth::user()->professions;

        $strEspecialidades = "";
        foreach ($especialidades as $especialidad)
        {
            $strEspecialidades .= $especialidad->name." - "; 
            
        }
        
        $historial = new HistorialClinico;
        $historial->codPacienteHC = $paciente->codPaciente;
        $historial->codUsuarioHC = $user->id;
        $historial->fechaHC = Carbon::now()->toDateTimeString();
        $historial->codInstitucionHC = $user->institution_id;
        $historial->entrada = 'Carga de planilla de Kinesiología,'.ucfirst(strtolower($request->evolution));
        $historial->esPublico = '0';
        $historial->insurance_id = $request->insurance_id;
        $historial->especialidad = $strEspecialidades;
        $historial->save();

        return redirect()->action([SheetController::class, 'kinesiology'], ['paciente' => $paciente->codPaciente]);
    }

    public function kinesiologyEdit(KinesiologySheet $kinesiologySheet)
    {
        $paciente = Paciente::find($kinesiologySheet->paciente_id);
        $today = Carbon::now();
        $fecha_nacimiento = Carbon::parse($paciente->fechaNacimientoPaciente);
        $edad = $fecha_nacimiento->diffInYears($today);
       
        return view('kinesiology.edit',compact('kinesiologySheet','paciente','edad'));
    }

    public function kinesiologyUpdate(Paciente $paciente, KinesiologySheet $kinesiologySheet, Request $request)
    {
        
        $kinesiologySheet->user_id = Auth::user()->id;
        $kinesiologySheet->institution_id = Auth::user()->institution_id;
        $kinesiologySheet->paciente_id = $paciente->codPaciente;
        $kinesiologySheet->edad = $request->edad;
        $kinesiologySheet->control = $request->control;
       

        $kinesiologySheet->save();
        return redirect()->action([SheetController::class, 'kinesiology'], ['paciente' => $paciente->codPaciente]);
    }

    public function kinesiologyPDF(KinesiologySheet $kinesiologySheet)
    {
        $paciente = Paciente::where('codPaciente',$kinesiologySheet->paciente_id)->first();
        $kinesiology_sheet = kinesiologySheet::where('paciente_id',$paciente->codPaciente)
            ->orderBy('created_at','desc')
            ->get();
        
        $pdf = Pdf::loadView('kinesiology.pdf',compact('paciente','kinesiology_sheet'));
        return $pdf->stream(); 
    }
}
