<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use App\Models\Appointment;
use App\Models\Paciente;
use App\Models\Institution;
use App\Models\Insurance;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Confirmation;


class WaController extends Controller
{
    private function fechaEs($fecha) 
    {
        $hora = strftime("%H:%M",strtotime($fecha));
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        
        return $nombredia." ".$numeroDia." de ".$nombreMes." a las ".$hora;
        
    }



    public function send(Request $request)
    {
        $appointment = Appointment::where('id',$request->event_id)->first();
        $professional = User::where('id',$appointment->user_id)->first();
        $institution = Institution::where('id',$appointment->institution_id)->first();
        $patient = Paciente::where('codPaciente',$appointment->paciente_id)->first();
        $patientName = explode(' ', ucfirst($patient->nombrePaciente));
        $cellphone = $patient->celularPaciente;
        $fecha = $this->fechaEs($appointment->start);
        $phone_number = preg_replace('/[^0-9]/', '', $cellphone);
        $user = Auth::user();
        $token = urlencode(Hash::make($appointment->id.$patient->nombrePaciente.$fecha));
        if (Confirmation::where('appointment_id', '=', $appointment->id)->first()) 
        {
            return redirect()->route('appointment.show', [
                'institution_id' => $appointment->institution_id,
                'user_id' => $appointment->user_id
            ]);

        }else
        {
            $confirmation = new Confirmation;
            $confirmation->token = $token;
            $confirmation->appointment_id = $appointment->id;
            $confirmation->user_id = $user->id;
    
            try 
            {
                
                $confirmation->save();
            
            } catch(\Illuminate\Database\QueryException $e)
            {
                $errorCode = $e->errorInfo[1];
                
                return back()->with('error', $e->getMessage());
                
            }

        }
       

        $message = "*Recordatorio de turno* %f0%9f%97%93%0A%0AHola ".$patientName[0]."!,%20le%20recordamos%20que%20su%20turno%20es%20el%20".$fecha
        ."%0Acon%20".ucwords($professional->lastName)."%20".ucwords($professional->name)."%20en%20"
        .strtoupper($institution->name).".%0A"
        ."%f0%9f%93%8d ".$institution->address
        ."%0A%0A%e2%9c%85 *Click para confirmar asistencia:*%0A"
        ."https://space4clinic.com/confirm/".$token;
        $url = "https://api.whatsapp.com/send/?phone=".$phone_number."&text=";
        
        return redirect()->away($url.$message)->with('_blank');
        
    }

}
