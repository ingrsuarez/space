<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Paciente;
use App\Models\User;

class RegisterUser extends Component
{
    public $user;
    public $dni;
    public $paciente;
    public $insurances;

    public function mount()
    {

    }
    
    public function render()
    {
        if($this->dni <> '')
        {
            $this->paciente = Paciente::where('idPaciente','=',$this->dni)->first();
            return view('livewire.register-user');   
        }
        return view('livewire.register-user');
    }
}
