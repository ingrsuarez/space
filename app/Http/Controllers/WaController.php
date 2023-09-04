<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class WaController extends Controller
{
    
    public function send()
    {
    //     $token = '';

    //     $phone = '';

    //     $url = ' https://graph.facebook.com/v17.0/114738798380353/messages';

    //     $message = ''
    //             .'{'
    //             .'"messaging_product": "whatsapp",'
    //             .'"to":"'.$phone.'",'
    //             .'"type" : "template",'
    //             .'"template":,'
    //             .'{'
    //                 .'"name" : "Hola SPACE",'
    //                 .'"language":{"code":"en_US"'
    //             .'}'
    //             .'}';

    //     curl -i -X POST `
    //     https://graph.facebook.com/v17.0/114738798380353/messages `
    //     -H 'Authorization: Bearer EAAR2ODaEY5YBO6CWwpCb7qFoZCoXq5P22yyHV8ip9beRtpIdvsnb71RoRoxIuxnlsMzwC02lGvjNPNYF0mZCAXHfQZCGDJWurUjRK5bZArBP1gXxkY7sn20Ys7MPBlyN2eFnJ1K20IZCWzkpF6D6PZBOiCGVrxIveoT1EmhpVSxmjCKqG362ZBXwDTiiyWGuRXnAXBJp6nhAk7fZAAPJ' `
    //     -H 'Content-Type: application/json' `
    //     -d '{ \"messaging_product\": \"whatsapp\", \"to\": \"54299156319835\", \"type\": \"template\", \"template\": { \"name\": \"hello_world\", \"language\": { \"code\": \"en_US\" } } }'
    // }
        try{
            $token = 'EAAR2ODaEY5YBOwVzbFGzxZBsXj3pp7fxfsjo8XxWaZBPLcmd4Ml0o25dxa3IkSscLjdsLZApT5LxXuGzA2uuVZB7SpCzoVYa0xdMfObroBZC8OpUpsqA2g8frBg21aqwYWuQY33ZAJCYihkkTSRSVj8j4Vg4HOrhjnkwRf9FFo4Nwb1Qp4pGtfvXYEBAFUbt5IvbJi6I1dpom5ND17';
            $phoneId = '114738798380353';
            $version = 'v17.0';
            
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer EAAR2ODaEY5YBOygUTTlNmu2GeJcZALdd5b1PWIa8OpO7pQUAkZBWuJfL3CKhTc5qQyO905GiwHPuG2jY7FPwwBCh9ohgogdvsZAtm6XdbWkuYHCmmb8ASeCk3U68CNBGo64fFPGh2ylS2L7LRueiDQZBlDDZBoKnLGpa97LeHXawtcd6sHUx1reIp8rj7LfZABdp4fgy5x95anseC8'
              ];

            $body = [
                "messaging_product" => "whatsapp",
                "to"=> "54299156227547",
                "type"=> "template",
                "template"=> [
                    "name" => "confirmar",
                    "language" => [
                        "code" => "en_US"
                    ]
                ]
            ];
            $message = Http::withToken($token)->post('https://graph.facebook.com/'.$version.'/'.$phoneId.'/messages',$body)->throw()->json();
            return response()->json([
                'success' => true,
                'data' => $message,
            ],200);
            
            // $client = new Client();
            // $headers = [
            // 'Content-Type' => 'application/json',
            // 'Authorization' => 'Bearer EAAR2ODaEY5YBOygUTTlNmu2GeJcZALdd5b1PWIa8OpO7pQUAkZBWuJfL3CKhTc5qQyO905GiwHPuG2jY7FPwwBCh9ohgogdvsZAtm6XdbWkuYHCmmb8ASeCk3U68CNBGo64fFPGh2ylS2L7LRueiDQZBlDDZBoKnLGpa97LeHXawtcd6sHUx1reIp8rj7LfZABdp4fgy5x95anseC8'
            // ];
            // $body = '{
            // "messaging_product": "whatsapp",
            // "to": "54299156319835",
            // "type": "template",
            // "template": {
            //     "name": "hello_world",
            //     "language": {
            //     "code": "en_US"
            //     }
            // }
            // }';
            // $request = new Request($_POST, ['https://graph.facebook.com/v17.0/114738798380353/messages'], $headers, $body,['']);
            // $res = $client->sendAsync($request)->wait();
            // echo $res->getBody();

        }
        catch(Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ],200);
        }
        
        // $request = new Request('POST', 'https://graph.facebook.com/v17.0/114738798380353/messages', $headers, $body);
        // $res = $client->sendAsync($request)->wait();
        // echo $res->getBody();
    

     
        // return $response;
    }

}
