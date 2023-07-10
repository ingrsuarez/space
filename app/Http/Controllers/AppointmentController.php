<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Paciente;
use App\Models\Institution;
use App\Models\User;
use App\Models\Agenda;

class AppointmentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    

    public function index()
    {
        $user = Auth::user();
        $institution = $user->currentInstitution;

        return view('calendar.index',compact('institution'));
    }

    public function show(Request $request)
    {
        $institution = Institution::find($request->institution_id);
        $professional = User::find($request->user_id);
        $appointments = Appointment::where('institution_id',$institution->id)->where('user_id',$professional->id)->where('status','!=','cancelled')->get();
        $events = array();
        $agendas = Agenda::where('user_id',$professional->id)->where('institution_id',$institution->id)->get();
        $frequency = 60;
        foreach ($appointments as $appointment){
            $events[] = [
            'id'=> $appointment->id,
            'romm' => $appointment->room_id,
            'title' => ucfirst($appointment->paciente->nombrePaciente).' '.ucfirst($appointment->paciente->apellidoPaciente).' - '.ucfirst($appointment->obs),
            'start' => $appointment->start,
            'end' => $appointment->end,
            'editable' => false,
            'backgroundColor' => '#f35a17'
            ];  
            
        }
        if(empty($agendas[0]))
        {
            return back()->with('error', 'Este Profesional no tiene una agenda abierta!');
        }else
        {
            foreach ($agendas as $agenda)
            {
                $availableAgenda[] = [
                    'id' => $agenda->room_id,
                    'groupId' => 'available',
                    'daysOfWeek' => [$agenda->day],
                    'startTime' => $agenda->start,
                    'endTime' => $agenda->end,
                    'display' => 'inverse-background',
                    'color' => '#ccc'
                ];
                $availableAgenda[] = [
                    'id' => $agenda->room_id,
                    'groupId' => 'room',
                    'daysOfWeek' => [$agenda->day],
                    'title' => $agenda->room->name,
                ];

                if($frequency > $agenda->frequency)
                {
                    $frequency = $agenda->frequency;   
                }
            }
            $frequency = '00:'.$frequency.':00';
            
            return view('calendar.show',compact('events','institution','professional','availableAgenda','frequency'));  

        }
        
    }

    public function store(Request $request)
    {

        $appointment = new Appointment;

        $appointment->institution_id = $request->institution_id;
        $appointment->user_id = $request->user_id;
        $appointment->paciente_id = $request->patient_id;
        $appointment->room_id = $request->room_id;
        $appointment->start = $request->startDate;
        $appointment->end = $request->endDate;
        $appointment->medicare = 'issn';
        $appointment->obs = $request->obs;
        $appointment->status = 'active';
        $appointment->overturn = 0;

   
        try 
        {
            $appointment->save();
            return back()->with('message', 'Turno agendado correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            
             return back()->with('error', $e->getMessage());
            
        }
        
    }

    public function cancel(Request $request)
    {
        $appointment = Appointment::find($request->event_id);
        $appointment->status = 'cancelled';
        try 
        {
            $appointment->save();
            return 'Turno cancelado!';
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            
             return 'error';
            
        }

    }


}
