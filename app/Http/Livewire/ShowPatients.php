<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShowPatients extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $name;
    public $dni;
    public $lastName;
    public $ultimosPacientes;
    public $userInstitutions;
    public $institution;
    public $wating;
    public $user;
    public $professionals;
    

    public function mount()
    {
       $today = Carbon::now();
       $this->ultimosPacientes = HistorialClinico::where('codUsuarioHc',Auth::user()->id)->whereBetween('fechaHC',['2022-01-28 17:36:03',$today])->count();
       $this->userInstitutions = Auth::user()->institutions; 
       $this->institution = Auth::user()->currentInstitution;
       $this->user = Auth::user();
       if(!empty($this->institution))
        {
            $this->professionals = $this->institution->users;
        }else
        {
            $this->professionals = null;
        }
       
    }

    

    public function render()
    {
        $watingMe = Paciente::select('pacientes.idPaciente','pacientes.nombrePaciente','pacientes.apellidoPaciente','insurances.name AS insurance','wating_list.institution_id')
            ->join('wating_list', 'wating_list.paciente_id', '=', 'pacientes.codPaciente')
            ->leftJoin('insurances', 'insurances.id', '=', 'wating_list.insurance_id')
            ->where('wating_list.user_id','=',Auth::user()->id)
            ->orderBy('wating_list.created_at','ASC')
            ->get();


        if($this->name <> ''){    
            $pacientes = Paciente::whereRaw('lower(nombrePaciente) LIKE "'.strtolower($this->name).'%"')->paginate(5); 
            return view('livewire.show-patients',compact('pacientes','watingMe'));
        }elseif($this->lastName <> ''){
            $pacientes = Paciente::whereRaw('lower(apellidoPaciente) LIKE "'.strtolower($this->lastName).'%"')->paginate(7); 
            return view('livewire.show-patients',compact('pacientes','watingMe'));

        }elseif($this->dni <> ''){
            $pacientes = Paciente::where('idPaciente','LIKE',$this->dni.'%')->paginate(5); 
            return view('livewire.show-patients',compact('pacientes','watingMe'));

        }else
        {
            
        
            // $pacientes = DB::table('pacientes')
            // ->join('historialClinico', 'codPacienteHC', '=', 'pacientes.codPaciente')
            // ->join('users', 'users.id', '=', 'historialClinico.codUsuarioHC')
            // ->join('insurances', 'insurances.id', '=', 'pacientes.insurance_id')
            // ->where('historialClinico.codUsuarioHC','=',Auth::user()->id)
            // ->orderBy('historialClinico.fechaHC','DESC')
            // ->paginate(10);
            $pacientes = Paciente::select('pacientes.idPaciente','pacientes.nombrePaciente','pacientes.apellidoPaciente','pacientes.celularPaciente','pacientes.numeroAfiliadoPaciente','insurances.name AS cobertura')
            ->join('historialClinico', 'codPacienteHC', '=', 'pacientes.codPaciente')
            ->join('users', 'users.id', '=', 'historialClinico.codUsuarioHC')
            ->leftJoin('insurances', 'insurances.id', '=', 'pacientes.insurance_id')
            ->where('historialClinico.codUsuarioHC','=',Auth::user()->id)
            ->orderBy('historialClinico.fechaHC','DESC')
            ->paginate(10);
            
            // $watingMe = Paciente::select('pacientes.idPaciente','pacientes.nombrePaciente','pacientes.apellidoPaciente','insurances.name AS insurance','wating_list.institution_id')
            // ->join('wating_list', 'wating_list.paciente_id', '=', 'pacientes.codPaciente')
            // ->leftJoin('insurances', 'insurances.id', '=', 'wating_list.insurance_id')
            // ->where('wating_list.user_id','=',Auth::user()->id)
            // ->orderBy('wating_list.created_at','ASC')
            // ->get();

           
            return view('livewire.show-patients',compact('pacientes','watingMe'));
        
        }

    }


    public function changeEvent($value)
    {

        $user = Auth::user();
        $user->institution_id = $value;
        try 
        {
            
            $user->save();
            return redirect()->route('home')->with('message', 'Institución actualizada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Especialidad ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    }



}
