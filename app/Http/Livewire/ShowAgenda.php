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
    public $agenda;
    public $rooms;
    public $user;

    public function mount()
    {
        $this->institution = User::find(Auth::user()->id)->currentInstitution;
        $this->rooms = Room::where('institution_id',$this->institution->id)->get();
        $this->professionals = $this->institution->users;
        $this->user = $this->professionals[0];
    }

    public function render()
    {

        return view('livewire.show-agenda');
    }

    public function changeEvent($user_id)
    {
        $this->user = User::where('id',$user_id)->first();
        $agenda = Agenda::where('user_id',$user_id)->where('institution_id',$this->institution->id)->orderBy('day')->get();
        $this->agenda = $agenda;
        
    }


}
