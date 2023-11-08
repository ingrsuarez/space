<?php

namespace App\Http\Livewire;


use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\HistorialClinico;
use App\Models\LastAppointment;
use App\Models\Paciente;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FindPatients extends Component
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
    public $professional;

    public function mount()
    {

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
        if($this->name <> ''){    
            $pacientes = LastAppointment::whereRaw('lower(nombrePaciente) LIKE "'.strtolower($this->name).'%"')
            ->where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id',$this->professional->id);
            })
            ->paginate(3);
            return view('livewire.find-patients',compact('pacientes'));
        }elseif($this->lastName <> ''){
            $pacientes = LastAppointment::whereRaw('lower(apellidoPaciente) LIKE "'.strtolower($this->lastName).'%"')
                ->where(function ($query) {
                    $query->whereNull('user_id')
                        ->orWhere('user_id',$this->professional->id);
                })
                ->paginate(3); 
            return view('livewire.find-patients',compact('pacientes'));

        }elseif($this->dni <> ''){
            $pacientes = LastAppointment::where('idPaciente','LIKE',$this->dni.'%')
                ->where(function ($query) {
                    $query->whereNull('user_id')
                        ->orWhere('user_id',$this->professional->id);
                })
                ->paginate(3); 
            return view('livewire.find-patients',compact('pacientes'));

        }else
        {
            
            $pacientes = LastAppointment::where(function ($query) {
                $query->whereNull('user_id')
                    ->orWhere('user_id',$this->professional->id);
            })->paginate(10);
            // $pacientes = DB::table('pacientes')
            // ->join('historialClinico', 'codPacienteHC', '=', 'pacientes.codPaciente')
            // ->join('users', 'users.id', '=', 'historialClinico.codUsuarioHC')
            // ->where('historialClinico.codUsuarioHC','=',Auth::user()->id)
            // ->orderBy('historialClinico.fechaHC','DESC')
            // ->paginate(3);
            // dd($pacientes);
            return view('livewire.find-patients',compact('pacientes'));
        
        }
        return view('livewire.find-patients');
    }
}
