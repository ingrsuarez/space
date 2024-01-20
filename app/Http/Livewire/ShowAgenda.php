<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Institution;
use App\Models\Agenda;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShowAgenda extends Component
{

    public $institution;
    public $professionals;
    public $professional;
    public $agenda;
    public $rooms;
    public $user;

    public function mount()
    {
        $this->institution = User::find(Auth::user()->id)->currentInstitution;
        $this->rooms = Room::where('institution_id',$this->institution->id)->get();
        // $this->professionals = $this->institution->users;
        $this->user = Auth::user();
        $this->professional = $this->professionals[0];
        $agenda = Agenda::where('user_id',$this->professional->id)->where('institution_id',$this->institution->id)->orderBy('day')->get();
        $this->agenda = $agenda;
    }

    public function render()
    {
        if($this->user->hasRole('profesional'))
        {
            $this->professional = $this->user;
        }
        $agenda = Agenda::where('user_id',$this->professional->id)->where('institution_id',$this->institution->id)->orderBy('day')->get();
        $this->agenda = $agenda;
        return view('livewire.show-agenda');
    }

    public function changeEvent($professional_id)
    {
        $this->professional = User::where('id',$professional_id)->first();
        $agenda = Agenda::where('user_id',$professional_id)->where('institution_id',$this->institution->id)->orderBy('day')->get();
        $this->agenda = $agenda;
        
    }


}
