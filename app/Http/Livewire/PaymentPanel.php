<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Institution;

class PaymentPanel extends Component
{
    public $institution;
    public $paciente;

    public function mount()
    {
        
    }

    public function render()
    {
        return view('livewire.payment-panel');
    }
}
