<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cash;
use App\Models\Paciente;
use App\Models\Institution;
use App\Models\User;
use Carbon\Carbon;

class AccountsController extends Controller
{
    //
    public function show(Request $request)
    {

        $user = Auth::user();
        $institution = $user->currentInstitution;
        if($user->hasRole('administrativo'))
        {
            return view('accounts.show',compact('user','institution'));
        }elseif($user->hasRole('profesional'))
        {
            $today = Carbon::now()->format('Y-m-d');
            $professional = $user;
            $query = "SELECT `cash`.`id`,
            `cash`.`created_at`,
            `cash`.`description`,
            `cash`.`paciente_id`,
            `cash`.`user_id`,
            `cash`.`debit`,
            `cash`.`credit`,
            @Balance := @Balance + `cash`.`debit` - `cash`.`credit` AS `Balance`
            FROM `cash` , (SELECT @Balance := 0) AS variableInit
            WHERE cash.owner_id= '$request->user_id'
            AND cash.institution_id = '$institution->id'
            AND `cash`.`created_at` >= '$today'
            ORDER BY `cash`.`id` ASC"; //raw query goes here
            $balance = Cash::fromQuery($query);
            $balance->load('pacientes');
            $balance->load('users');
            
            return view('accounts.balance',compact('balance','institution','professional'));  
        }

        
        
    }

    public function balance(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');
        $professional = User::find($request->user_id);
        $institution = Institution::find($request->institution_id);
        $query = "SELECT `cash`.`id`,
        `cash`.`created_at`,
        `cash`.`description`,
        `cash`.`paciente_id`,
        `cash`.`user_id`,
        `cash`.`debit`,
        `cash`.`credit`,
        @Balance := @Balance + `cash`.`debit` - `cash`.`credit` AS `Balance`
        FROM `cash` , (SELECT @Balance := 0) AS variableInit
        WHERE cash.owner_id= '$request->user_id'
        AND cash.institution_id = '$institution->id'
        AND `cash`.`created_at` >= '$today'
        ORDER BY `cash`.`id` ASC"; //raw query goes here
        $balance = Cash::fromQuery($query);
        $balance->load('pacientes');
        $balance->load('users');
        // return $balance;
        

        return view('accounts.balance',compact('balance','institution','professional'));     
        
    }

    public function spend(Request $request)
    {
        $cash = new Cash;
        $cash->user_id = Auth::user()->id;
        $cash->owner_id = $request->professional_id;
        $cash->institution_id = $request->institution_id;
        $cash->paciente_id = $request->patient_id;
        $cash->description = $request->description;
        $cash->debit = $request->amount;
        $cash->save();
    }

}
