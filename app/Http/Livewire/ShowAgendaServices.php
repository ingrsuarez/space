<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Institution;
use App\Models\AgendaService;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Service;

class ShowAgendaServices extends Component
{
    public $institution;
    public $professionals;
    public $professional;
    public $agenda;
    public $rooms;
    public $user;
    public $services;
    public $service;

    public function mount()
    {
        // $this->service = Service::where('id',$service_id)->first();
        $this->institution = $this->user->currentInstitution;
        if (count($this->institution->services) > 0)
        {
            $this->service = $this->institution->services[0];
            $this->agenda = AgendaService::where('service_id',$this->service->id)->where('institution_id',$this->institution->id)->orderBy('day')->get();
        }else{
            $service = null;
        }
        
        $this->rooms = Room::where('institution_id',$this->institution->id)->get();
        
        
    }

    public function render()
    {
        return view('livewire.show-agenda-services');
    }

    public function changeEvent($service_id)
    {
        $this->service = Service::where('id',$service_id)->first();
        $agenda = AgendaService::where('service_id',$service_id)->where('institution_id',$this->institution->id)->orderBy('day')->get();
        $this->agenda = $agenda;
        
    }
}
