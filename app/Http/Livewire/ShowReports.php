<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Insurance;

class ShowReports extends Component
{
    public $user;
    public $institution;
    public $professionals;
    public $report;
    public $currentProfessional;
    public $month;

    public function mount()
    {
        $this->currentProfessional = $this->user;
        $this->month = 3;
    }

    public function render()
    {
        return view('livewire.show-reports');
    }

    public function changeEvent($professional_id)
    {
        $this->currentProfessional = User::where('id',$professional_id)->first();
        $this->report = Appointment::where('user_id',$professional_id)
            ->where('institution_id',$this->institution->id)
            ->where('status','<>','cancelled')
            ->whereRaw('MONTH(start) = '.$this->month)
            ->orderBy('insurance_id')
            ->orderBy('start')
            ->with('insurance')
            ->with('paciente')
            ->get();
        // $this->report = $appointment;
        
    }

    public function changeMonth($month)
    {
        $this->month = $month;
        $this->report = Appointment::where('user_id',$this->currentProfessional->id)
            ->where('institution_id',$this->institution->id)
            ->where('status','<>','cancelled')
            ->whereRaw('MONTH(start) = '.$this->month)
            ->orderBy('insurance_id')
            ->orderBy('start')
            ->with('insurance')
            ->with('paciente')
            ->get();
        // $this->report = $appointment;
        
    }
}
