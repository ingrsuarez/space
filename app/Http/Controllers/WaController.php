<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Appointment;
use App\Models\Paciente;
use App\Models\Institution;
use App\Models\Insurance;
use App\Models\User;
use App\Models\Agenda;

class WaController extends Controller
{
    
    public function send(Request $request)
    {
        $appointment = Appointment::where('id',$request->event_id)->first();
        $professional = User::where('id',$appointment->user_id)->first();
        $institution = Institution::where('id',$appointment->institution_id)->first();
        $patient = Paciente::where('codPaciente',$appointment->paciente_id)->first();

        $cellphone = $patient->celularPaciente;

        $phone_number = preg_replace('/[^0-9]/', '', $cellphone);
        $date = explode(" ", $appointment->start);

        $message = "%20Hola!,%20le%20recordamos%20que%20su%20turno%20es%20el%20día%20".$date[0]."%20a%20las%20".$date[1]."%20con%20".ucwords($professional->lastName)."%20".ucwords($professional->name)."%20en%20"
        .strtoupper($institution->name)."%20en%20caso%20de%20no%20poder%20asistir%20le%20pedimos%20nos%20avise. Gracias";
        $url = "https://wa.me/".$phone_number."?text=";
        
        return redirect()->away($url.$message)->with('_blank');
        
       
        // try{
        //     $token = 'EAAR2ODaEY5YBO9gnt6cubmzz3PZABNB8ZBlaEaEJKtWhVt3SWHfg3iFcrzFvYK0AJQQSzVSPVZApF5fiRcME7kZCZB0BmzZCkZC0tZALTiCDzP5rHdSx1pwugQaGBHoAVCDq3oPZAjB0xbZBweeQSsZAb4Mz4LtktEYCSZBfxgwVddusTqbYbcKKWeIU4IOK2s0qOVjHUpMPodK5DhrNduL0';
        //     $phoneId = '114738798380353';
        //     $version = 'v17.0';
            
        //     $headers = [
        //         'Content-Type' => 'application/json',
        //         'Authorization' => 'Bearer EAAR2ODaEY5YBOygUTTlNmu2GeJcZALdd5b1PWIa8OpO7pQUAkZBWuJfL3CKhTc5qQyO905GiwHPuG2jY7FPwwBCh9ohgogdvsZAtm6XdbWkuYHCmmb8ASeCk3U68CNBGo64fFPGh2ylS2L7LRueiDQZBlDDZBoKnLGpa97LeHXawtcd6sHUx1reIp8rj7LfZABdp4fgy5x95anseC8'
        //       ];

        //     $body = [
        //         "messaging_product" => "whatsapp",
        //         "to"=> "54299156319835",
        //         "type"=> "template",
        //         "template"=> [
        //             "name" => "turno",
        //             "language" => [
        //                 "code" => "es"
        //             ],
        //             "components" => [
        //                 [
        //                     "type" => "body",
        //                     "parameters"=> [
        //                         [
        //                             "type"=> "text",
        //                             "text"=> "el ".$date[0]." a las ".$date[1]."hs con ".ucwords($professional->lastName)." ".ucwords($professional->name)
        //                         ]
        //                     ]
        //                 ]
        //             ]
                       
        //         ]
                
        //     ];

           
        //     $message = Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneId.'/messages',$body)->throw()->json();
            
        //     return response()->json([
        //         'success' => true,
        //         'data' => $message,
        //     ],200);
            
            

        // }
        // catch(Exception $e){
        //     return response()->json([
        //         'success' => false,
        //         'error' => $e->getMessage(),
        //     ],200);
        // }
     
        // return $response;
    }

}
