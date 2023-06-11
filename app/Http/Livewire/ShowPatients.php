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

    public function mount()
    {
       $today = Carbon::now();
       $this->ultimosPacientes = HistorialClinico::where('codUsuarioHc',Auth::user()->id)->whereBetween('fechaHC',['2022-01-28 17:36:03',$today])->count();
       $this->userInstitutions = Auth::user()->institutions; 
       $this->institution = Auth::user()->currentInstitution;
    }

    

    public function render()
    {

        if($this->name <> ''){    
            $pacientes = Paciente::whereRaw('lower(nombrePaciente) LIKE "'.strtolower($this->name).'%"')->paginate(5); 
            return view('livewire.show-patients',compact('pacientes'));
        }elseif($this->lastName <> ''){
            $pacientes = Paciente::whereRaw('lower(apellidoPaciente) LIKE "'.strtolower($this->lastName).'%"')->paginate(7); 
            return view('livewire.show-patients',compact('pacientes'));

        }elseif($this->dni <> ''){
            $pacientes = Paciente::where('idPaciente','LIKE',$this->dni.'%')->paginate(5); 
            return view('livewire.show-patients',compact('pacientes'));

        }else
        {
            
        
            $pacientes = DB::table('pacientes')
            ->join('historialClinico', 'codPacienteHC', '=', 'pacientes.codPaciente')
            ->join('users', 'users.id', '=', 'historialClinico.codUsuarioHC')
            ->where('historialClinico.codUsuarioHC','=',Auth::user()->id)
            ->orderBy('historialClinico.fechaHC','DESC')
            ->paginate(10);

            return view('livewire.show-patients',compact('pacientes'));
        
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
