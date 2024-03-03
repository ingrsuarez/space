<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use App\Models\Appointment;
use App\Models\AppointmentService;
use App\Models\Paciente;
use App\Models\Institution;
use App\Models\Insurance;
use App\Models\User;
use App\Models\Service;
use App\Models\Agenda;
use App\Models\Confirmation;
use App\Models\ConfirmationService;


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
        $token = preg_replace('/[^A-Za-z0-9\-]/', '', Hash::make($appointment->id.$patient->nombrePaciente.$fecha));
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
        ."%f0%9f%93%8d ".$institution->location." "
        ."%0A%0A%e2%9c%85 *Click para confirmar asistencia:*%0A"
        ."https://space4clinic.com/confirm/".$token."%0A*Agende este número para poder acceder al link de confirmación!*";
        $url = "https://api.whatsapp.com/send/?phone=".$phone_number."&text=";
        
        // return view('wa.confirmation',compact('url','message'));
        return redirect()->away($url.$message);
        
    }

    public function sendService(Request $request)
    {
        $appointment = AppointmentService::where('id',$request->event_id)->first();
        $service = Service::where('id',$appointment->service_id)->first();
        $institution = Institution::where('id',$appointment->institution_id)->first();
        $patient = Paciente::where('codPaciente',$appointment->paciente_id)->first();
        $patientName = explode(' ', ucfirst($patient->nombrePaciente));
        $cellphone = $patient->celularPaciente;
        $fecha = $this->fechaEs($appointment->start);
        $phone_number = preg_replace('/[^0-9]/', '', $cellphone);
        $user = Auth::user();
        $token = preg_replace('/[^A-Za-z0-9\-]/', '', Hash::make($appointment->id.$patient->nombrePaciente.$fecha));
        if (ConfirmationService::where('appointment_id', '=', $appointment->id)->first()) 
        {
            return redirect()->route('appointment.service', [
                'institution_id' => $appointment->institution_id,
                'service_id' => $appointment->service_id
            ]);

        }else
        {
            $confirmation = new ConfirmationService;
            $confirmation->token = $token;
            $confirmation->appointment_id = $appointment->id;
            $confirmation->service_id = $service->id;
    
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
        ."%0Apara%20".ucwords($service->name)."%20en%20"
        .strtoupper($institution->name).".%0A"
        ."%f0%9f%93%8d ".$institution->location." "
        ."%0A%0A%e2%9c%85 *Click para confirmar asistencia:*%0A"
        ."https://space4clinic.com/confirmService/".$token."%0A*Agende este número para poder acceder al link de confirmación!*";
        $url = "https://api.whatsapp.com/send/?phone=".$phone_number."&text=";
        
        // return view('wa.confirmation',compact('url','message'));
        return redirect()->away($url.$message);
        
    }

    public function automatedSend(Request $request)
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


        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://graph.facebook.com/v18.0/114738798380353/messages',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS =>'{
            "messaging_product": "whatsapp",
            "to": "54299156319835",
            "type": "template",
            "template": {
                "name": "turno",
                "language": {
                    "code": "es"
                },
                "components": [
                    {
                        "type": "body",
                        "parameters": [{
                            "type": "text",
                            "text":"17-02-2024 con el Dr mote"
                        }]
                    }
                ],
            }
        }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Bearer EAADbmpQSIVsBOw1VG4no1E7wgciCRyMyFJtYUK4yHh74LksxwfOUkFBFdU1jjhFVfgzmZBaK3ZBD8UmiEagQQ9i5RxOkMvxPZCIv8J0z1DGs3CwXhfk8E0L0S9MSj42zsIsC3TxjK9fZBwDvnOWgRooZBYK92zu0mvz7JvWqOYbO3Mh3edjY1G7iybbAZBhD49oRsfuThQXYZAMkvkH5wZDZD'
        ),
        ));
        
        $response = json_decode(curl_exec($curl),true);
        //print response
        print_r($response);

        //get curl response code
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        print_r($status_code);
        //close curl
        curl_close($curl);
    }

}
