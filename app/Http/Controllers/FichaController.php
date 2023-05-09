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
use Illuminate\Database\QueryException;

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
        $data['historiales'] = HistorialClinico::where('codPacienteHC',$codPaciente)->join('users', 'codUsuarioHC', '=', 'users.id')->orderBy('fechaHC', 'desc')->select('historialClinico.*', 'users.name')->get();

        return view('pacientes.nueva_atencion',$data);
    }
    public function updateFicha(Request $request)
    {
        try {
            $paciente = Paciente::find($request->codPaciente);

            $paciente->idPaciente = $request->idPaciente;
            $paciente->celularPaciente = $request->telefono; 
            $paciente->emailPaciente = $request->email;
            $paciente->CoberturaPaciente = $request->cobertura;
            $paciente->numeroAfiliadoPaciente = $request->numeroAfiliado;
            $paciente->domicilioPaciente = $request->domicilio;
            $paciente->localidadPaciente = $request->localidad;
            $paciente->fechaNacimientoPaciente = $request->fechaNacimiento;   
        // Validate the value...
            $paciente->save();
        } catch (QueryException $exception) {
               

            return back()->withError('No puede dejar un campo en blanco')->withInput();
        }   
        
        return redirect('ficha/'.$request->idPaciente);
    }
    public function store(Request $request)
    {
        

        if ($request->esPublico){
            $esPublico = 1;
        }else{
            $esPublico = 0;
        }

        // $paciente = Paciente::where('idPaciente',$idPaciente)->get();
        $historial = new HistorialClinico;
        $historial->codPacienteHC = $request->codPaciente;
        $historial->codUsuarioHC = Auth::user()->id;
        $historial->fechaHC = Carbon::now();
        $historial->codInstitucionHC = '1000';
        $historial->entrada = $request->entrada;
        $historial->esPublico = $esPublico;
        
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
