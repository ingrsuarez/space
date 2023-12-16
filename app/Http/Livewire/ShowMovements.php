<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Cash;
use App\Models\Institution;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ShowMovements extends Component
{
    public $institution;
    public $balance;
    public $professional;
    public $from;
    public $credit;
    public $description;

    public function mount()
    {
        $today = Carbon::now()->format('Y-m-d');
        $this->from = $today;
    }

    public function render()
    {
        $date = $this->from;
        $institutionId = $this->institution->id;
        if (isset($date))
        {
            $professionalId = $this->professional->id;
            $query = "SELECT `cash`.`id`,
            `cash`.`created_at`,
            `cash`.`description`,
            `cash`.`paciente_id`,
            `cash`.`user_id`,
            `cash`.`debit`,
            `cash`.`credit`,
            @Balance := @Balance + `cash`.`debit` - `cash`.`credit` AS `Balance`
            FROM `cash` , (SELECT @Balance := 0) AS variableInit
            WHERE cash.owner_id= '$professionalId'
            AND cash.institution_id = '$institutionId'
            AND `cash`.`created_at` >= '$date'
            ORDER BY `cash`.`id` ASC"; //raw query goes here AND `cash`.`created_at` >= $date
            $this->balance = Cash::fromQuery($query);
            $this->balance->load('pacientes');
            $this->balance->load('users');
        }else{
            
        }
        return view('livewire.show-movements');
    }

    public function spend()
    {
        $date = $today = Carbon::now()->format('Y-m-d');
        $cash = new Cash;
        $cash->user_id = Auth::user()->id;
        $cash->owner_id = $this->professional->id;
        $cash->institution_id = $this->institution->id;
        $cash->description = $this->description;
        $cash->credit = $this->credit;
        $cash->save();
        $this->description = "";
        $this->credit ="";
        $professionalId = $this->professional->id;
        $query = "SELECT `cash`.`id`,
        `cash`.`created_at`,
        `cash`.`description`,
        `cash`.`paciente_id`,
        `cash`.`user_id`,
        `cash`.`debit`,
        `cash`.`credit`,
        @Balance := @Balance + `cash`.`debit` - `cash`.`credit` AS `Balance`
        FROM `cash` , (SELECT @Balance := 0) AS variableInit
        WHERE cash.owner_id= '$professionalId'
        AND `cash`.`created_at` >= '$date'
        ORDER BY `cash`.`id` ASC"; //raw query goes here AND `cash`.`created_at` >= $date
        $this->balance = Cash::fromQuery($query);
        $this->balance->load('pacientes');
        $this->balance->load('users');
    }
}
