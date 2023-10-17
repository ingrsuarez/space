<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Appointment;
use App\Models\Confirmation;


class GuestController extends Controller
{
    public function confirm($token)
    {
        $confirmation = Confirmation::where('token', '=', $token)->first();
        if (!empty($confirmation))
        {
            $appointment = Appointment::where('id',$confirmation->appointment_id)->first();
            $appointment->status = 'confirmed';
            try 
            {
                $appointment->save();
                $confirmation->delete();
                // return $appointment;
                // return redirect()->away('https://www.space4clinic.com');
                return redirect()->route('landing');
            
            } catch(\Illuminate\Database\QueryException $e)
            {
                $errorCode = $e->errorInfo[1];
                
                return redirect()->route('landing');
                
            }

        }else
        {
            return redirect()->route('landing');
        }
        
     
    }
}
