<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wating_list;
use App\Models\Institution;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Appointment;
use App\Models\Insurance;
use App\Models\Cash;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    // public function __construct()
    // {
    //     Auth::setDefaultDriver('pacientes');
    //     config(['auth.defaults.passwords' => 'pacientes']); 
    // }



    public function home(Request $request)
    {
        $paciente = Auth::user();
        
        return view('pacientes.index',compact('paciente'));
    }

    public function index(Request $request)
    {
        if(isset($request->dni)){
            $data['search'] = ['dni'=>$request->dni];
            $data['pacientes'] = Paciente::where('idPaciente','LIKE',$request->dni.'%')->orderBy('apellidoPaciente')->paginate(10);

        }elseif(isset($request->nombre)){
            $data['search'] = ['nombre'=>$request->nombre];
            $data['pacientes'] = Paciente::whereRaw('lower(nombrePaciente) LIKE "'.strtolower($request->nombre).'%"')->orderBy('nombrePaciente')->paginate(10);

        }elseif(isset($request->apellido)){
            $data['search'] = ['apellido'=>$request->apellido];
            $data['pacientes'] = Paciente::whereRaw('lower(apellidoPaciente) LIKE "'.strtolower($request->apellido).'%"')->orderBy('apellidoPaciente')->paginate(10);
        }else{
            $data['pacientes'] = Paciente::orderBy('apellidoPaciente')->paginate(10);
        }
        
       // return 'paciente.index'; 
        return view('pacientes.listado_pacientes',$data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $insurances = Insurance::all();
        return view('pacientes.nuevo_paciente',compact('insurances'));
    }

    public function createWithAppointment(Request $request)
    {
        $insurances = Insurance::all();
        $professional = User::find($request->user_id);
        $institution = Institution::find($request->institution_id);
        $appointment = new Appointment;
        $appointment->room_id = $request->room_id;
        $appointment->start = $request->startDate;
        $appointment->end = $request->endDate;
        $appointment->medicare = 'issn';
        $appointment->obs = $request->obs;
        $appointment->status = 'active';
        $appointment->overturn = 0;
        
        return view('pacientes.nuevo_turno',compact('institution','professional','appointment','insurances'));
    }

    public function store(Request $request)
    {
        //
        $paciente = new Paciente;
        $paciente->idPaciente = $request->dni;
        $paciente->fechaNacimientoPaciente = $request->fechaNacimiento;
        $paciente->nombrePaciente = strtolower($request->nombre);
        $paciente->apellidoPaciente = strtolower($request->apellido);
        $paciente->celularPaciente = $request->celular;
        $paciente->telefonoPaciente = $request->telefono;
        $paciente->emailPaciente = strtolower($request->email);
        $paciente->CoberturaPaciente = strtolower($request->cobertura);
        $paciente->ocupacionPaciente = strtolower($request->ocupacion);
        $paciente->sexoPaciente = strtolower($request->sexo);
        $paciente->numeroAfiliadoPaciente = $request->numeroAfiliado;
        $paciente->domicilioPaciente = strtolower($request->domicilio);
        $paciente->localidadPaciente = strtolower($request->localidad);
        try 
        {
            $paciente->save();
            return back()->with('message', 'Paciente guardado correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Paciente ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return back();

    }

    public function edit($id)
    {
        //
    }

    public function update($id,Request $request)
    {
        //
        $paciente = Paciente::where('idPaciente',$id)->first();
        
        $paciente->fechaNacimientoPaciente = $request->fechaNacimiento;
        $paciente->nombrePaciente = strtolower($request->nombre);
        $paciente->apellidoPaciente = strtolower($request->apellido);
        $paciente->celularPaciente = $request->celular;
        $paciente->telefonoPaciente = $request->telefono;
        $paciente->emailPaciente = strtolower($request->email);
        $paciente->insurance_id = strtolower($request->insurance_id);
        $paciente->numeroAfiliadoPaciente = $request->numeroAfiliado;
        $paciente->ocupacionPaciente = strtolower($request->ocupacion);
        $paciente->sexoPaciente = strtolower($request->sexo);
        $paciente->domicilioPaciente = strtolower($request->domicilio);
        $paciente->localidadPaciente = strtolower($request->localidad);
        $paciente->observations = strtolower($request->observations);
        try 
        {
            $paciente->save();
            return back()->with('message', 'Paciente guardado correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Paciente ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    }

    public function updateAppointment(Paciente $paciente, Request $request)
    {
        dd($request);
    }


    public function wating_attach(Paciente $paciente, $institution, Request $request)
    {
       
        $user = Auth::user();
        $institution = $user->currentInstitution;
        if($request->payment == 'cash'  && $request->amount != null)
        {
            $cash = new Cash;
            $cash->user_id = $user->id;
            $cash->owner_id = $request->user_id;
            $cash->institution_id = $institution->id;
            $cash->paciente_id = $paciente->codPaciente;
            $cash->description = 'Cobro';
            $cash->debit = $request->amount;
            $cash->save();
        }
        $user = User::find($request->user_id);
        

        $wating = new Wating_list;
        $wating->user_id = $request->user_id;
        $wating->institution_id = $institution->id;
        $wating->paciente_id = $paciente->codPaciente;
        $wating->insurance_id = $request->insurance_id;
        if(Wating_list::where('paciente_id',$paciente->codPaciente)->exists())
        {
            return redirect('home/')->with('message', 'El paciente ya esta en lista de espera!');
             
        }else
        {
            $wating->save();
            return redirect('home/')->with('message', 'Paciente enviado a lista de espera!');
        }  
        
    }


    public function wating_detach(Paciente $paciente, $institution)
    {
        
        $paciente->watingFor()->detach();
        return redirect('home/')->with('message', 'Paciente eliminado de lista de espera!');

        
    }


    public function authenticate(Request $request)
    {
        $request->validate([
            'emailPaciente' => 'required|email',
            'password' => 'required'
        ]);
        $check = $request->only('emailPaciente','password');
        // dd($check);
        if(Auth::guard('pacientes')->attempt($check))
        {
            return redirect()->route('pacientes.index');
        }else{
            return redirect()->back()->with('message','Alguno de los datos ingresados es incorrecto!');
        }
        
        return 'fallo';
    }

    public function logoutPaciente(Request $request)
    {
        Auth::guard('pacientes')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

}
