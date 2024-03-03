<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Appointment;
use App\Models\AppointmentService;
use App\Models\Confirmation;
use App\Models\ConfirmationService;


class GuestController extends Controller
{
    public function confirm($token)
    {
        $confirmation = Confirmation::where('token', '=', $token)->first();
        if (!empty($confirmation))
        {
            $appointment = Appointment::where('id',$confirmation->appointment_id)->first();
            return view('wa.confirmation',compact('confirmation','appointment'));
        }else{
            return redirect('/');
        }
    }

    public function confirmed(Appointment $appointment, Confirmation $confirmation)
    {
        
        
        if (!empty($confirmation))
        {
            $appointment = Appointment::where('id',$confirmation->appointment_id)->first();
            $appointment->status = 'confirmed';
            try 
            {
                $appointment->save();
                $confirmation->delete();
                return redirect('/')->with('message', 'Su turno fue confirmado!');
            
            } catch(\Illuminate\Database\QueryException $e)
            {
                $errorCode = $e->errorInfo[1];
                
                return redirect('/');
                
            }

        }else
        {
            return redirect('/');
        }
    }

    public function confirmService($token)
    {
        $confirmation = ConfirmationService::where('token', '=', $token)->first();
        if (!empty($confirmation))
        {
            $appointment = AppointmentService::where('id',$confirmation->appointment_id)->first();
            return view('wa.confirmationService',compact('confirmation','appointment'));
        }else{
            return redirect('/');
        }
    }

    public function confirmedService(Appointment $appointment, ConfirmationService $confirmation)
    {
        
        
        if (!empty($confirmation))
        {
            $appointment = AppointmentService::where('id',$confirmation->appointment_id)->first();
            $appointment->status = 'confirmed';
            try 
            {
                $appointment->save();
                $confirmation->delete();
                return redirect('/')->with('message', 'Su turno fue confirmado!');
            
            } catch(\Illuminate\Database\QueryException $e)
            {
                $errorCode = $e->errorInfo[1];
                
                return redirect('/');
                
            }

        }else
        {
            return redirect('/');
        }
    }
}
