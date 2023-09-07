<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Lock;
use App\Models\Paciente;
use App\Models\Institution;
use App\Models\Insurance;
use App\Models\User;
use App\Models\Agenda;
use App\Models\Wating_list;

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
    

    public function index(Request $request)
    {
        if(empty($request->user_id)){
            $user = Auth::user();
            $institution = $user->currentInstitution;
            if($user->hasRole('profesional'))
            {
                $professional = $user;
                $appointments = Appointment::where('institution_id',$institution->id)->where('user_id',$professional->id)->where('status','!=','cancelled')->get();
                $locks = Lock::where('institution_id',$institution->id)->where('user_id',$professional->id)->get();
                $events = array();
                $agendas = Agenda::where('user_id',$professional->id)->where('institution_id',$institution->id)->get();
                $frequency = 60;
                foreach ($appointments as $appointment){
                    $events[] = [
                    'id'=> $appointment->id,
                    'room' => $appointment->room_id,
                    'title' => ucfirst($appointment->paciente->nombrePaciente).' '.ucfirst($appointment->paciente->apellidoPaciente).' - '.ucfirst($appointment->obs),
                    'start' => $appointment->start,
                    'end' => $appointment->end,
                    'editable' => false,
                    'backgroundColor' => '#4040a1'
                    ];  
                    
                }
                foreach ($locks as $lock){
                    $events[] = [
                        'groupId' => 'unAvailable',
                        'id'=> $lock->id,
                        'title' => 'Bloqueado por: '.ucfirst($lock->creator->name).' '.ucfirst($lock->creator->lastName),
                        'start' => $lock->start,
                        'end' => $lock->end,
                        'editable' => 'false',
                        'overlap' => 'false',
                        'display' => 'background',
                        'color' => '#ff4021'
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
                            'color' => '#ccc',
                            'backgroundColor' => '#ffcc5c'
                            
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


            }else{
                return view('calendar.index',compact('institution','user'));
            }
            
        }else{
            $institution = Institution::find($request->institution_id);
            $professional = User::find($request->user_id);
            $appointments = Appointment::where('institution_id',$institution->id)->where('user_id',$professional->id)->where('status','!=','cancelled')->get();
            $locks = Lock::where('institution_id',$institution->id)->where('user_id',$professional->id)->get();
            $events = array();
            $agendas = Agenda::where('user_id',$professional->id)->where('institution_id',$institution->id)->get();
            $frequency = 60;
            foreach ($appointments as $appointment){
                $events[] = [
                'id'=> $appointment->id,
                'room' => $appointment->room_id,
                'title' => ucfirst($appointment->paciente->nombrePaciente).' '.ucfirst($appointment->paciente->apellidoPaciente).' - '.ucfirst($appointment->obs),
                'start' => $appointment->start,
                'end' => $appointment->end,
                'editable' => false,
                'backgroundColor' => '#4040a1'
                ];  
                
            }
            foreach ($locks as $lock){
                $events[] = [
                    'groupId' => 'unAvailable',
                    'id'=> $lock->id,
                    'title' => 'Bloqueado por: '.ucfirst($lock->creator->name).' '.ucfirst($lock->creator->lastName),
                    'start' => $lock->start,
                    'end' => $lock->end,
                    'editable' => 'false',
                    'overlap' => 'false',
                    'display' => 'background',
                    'color' => '#ff4021'
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
                        'color' => '#ccc',
                        'backgroundColor' => '#ffcc5c'
                        
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
    }

    public function show(Request $request)
    {
        if(empty($request->institution_id))
        {
            return redirect()->route('appointment.index');
        }else{
            $insurances = Insurance::all();
            $institution = Institution::find($request->institution_id);
            $professional = User::find($request->user_id);

            $appointments = Appointment::where('institution_id',$institution->id)->where('user_id',$professional->id)->where('status','!=','cancelled')->get();
            
            
            $locks = Lock::where('institution_id',$institution->id)->where('user_id',$professional->id)->get();
            $events = array();
            $agendas = Agenda::where('user_id',$professional->id)->where('institution_id',$institution->id)->get();
            $frequency = 60;
            foreach ($appointments as $appointment){
                if(!empty($appointment->paciente->insurance_id))
                {    
                    $insurance = Insurance::find($appointment->paciente->insurance_id)->first();
                }else
                {
                    $insurance = Insurance::where('name','LIKE','Particular')->first();
                }
                $events[] = [
                'id'=> $appointment->id,
                'room' => $appointment->room_id,
                'paciente' => $appointment->paciente_id,
                'nombrePaciente' => ucfirst($appointment->paciente->apellidoPaciente).' '.ucfirst($appointment->paciente->nombrePaciente),
                'title' => ucfirst($appointment->paciente->nombrePaciente).
                    ' '.ucfirst($appointment->paciente->apellidoPaciente).
                    ' - '.ucfirst($appointment->obs).' - '.$appointment->paciente->celularPaciente.' '.$insurance->name,
                'start' => $appointment->start,
                'end' => $appointment->end,
                'editable' => false,
                'backgroundColor' => '#4040a1'
                ];  
                
            }
            foreach ($locks as $lock){
                $events[] = [
                    'groupId' => 'unAvailable',
                    'id'=> $lock->id,
                    'title' => 'Bloqueado por: '.ucfirst($lock->creator->name).' '.ucfirst($lock->creator->lastName),
                    'start' => $lock->start,
                    'end' => $lock->end,
                    'editable' => 'false',
                    'overlap' => 'false',
                    'display' => 'background',
                    'color' => '#ff4021'
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
                        'color' => '#ccc',
                        'backgroundColor' => '#ffcc5c'
                        
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
                
                return view('calendar.show',compact('events','institution','professional','availableAgenda','frequency','insurances'));  

            }


            
        }
                
    }

    public function store(Request $request)
    {
        if (!empty($request->patient_id))
        {

            $appointment = new Appointment;

            $appointment->institution_id = $request->institution_id;
            $appointment->user_id = $request->user_id;
            $appointment->paciente_id = $request->patient_id;
            $appointment->room_id = $request->room_id;
            $appointment->start = $request->startDate;
            $appointment->end = $request->endDate;
            $appointment->medicare = '';
            $appointment->obs = $request->obs;
            $appointment->status = 'active';
            $appointment->overturn = 0;
            $paciente = Paciente::find($request->patient_id)->first();
            $paciente->insurance_id = $request->insurance_id;
            $paciente->save();

            try 
            {
                $appointment->save();
                return redirect()->route('appointment.show', [
                    'institution_id' => $appointment->institution_id,
                    'user_id' => $appointment->user_id
                ]);
            
            } catch(\Illuminate\Database\QueryException $e)
            {
                $errorCode = $e->errorInfo[1];
                
                return back()->with('error', $e->getMessage());
                
            }
        }else
        {

            return back()->with('error', 'Debe seleccionar un paciente!');
            
        }
        
    }

    public function cancel(Request $request)
    {
        
        $appointment = Appointment::find($request->event_id);
        $appointment->status = 'cancelled';
        try 
        {
            $appointment->save();
            return redirect()->route('appointment.show', [
                'institution_id' => $appointment->institution_id,
                'user_id' => $appointment->user_id
            ]);
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            
             return 'error';
            
        }

    }

    // public function reschedule(Request $request) 
    // {
    //     return $request;
    // }

    public function reschedule(Request $request) 
    {
        if(empty($request->institution_id))
        {
            return redirect()->route('appointment.index');
        }else{
            
            $institution = Institution::find($request->institution_id);
            $professional = User::find($request->professional_id);
            $patient = Paciente::find($request->patient_id);
            $appointments = Appointment::where('institution_id',$institution->id)->where('user_id',$professional->id)->where('status','!=','cancelled')->get();
            $locks = Lock::where('institution_id',$institution->id)->where('user_id',$professional->id)->get();
            $events = array();
            $agendas = Agenda::where('user_id',$professional->id)->where('institution_id',$institution->id)->get();
            $frequency = 60;
            foreach ($appointments as $appointment){
                $events[] = [
                'id'=> $appointment->id,
                'room' => $appointment->room_id,
                'paciente' => $appointment->paciente_id,
                'nombrePaciente' => ucfirst($appointment->paciente->apellidoPaciente).' '.ucfirst($appointment->paciente->nombrePaciente),
                'title' => ucfirst($appointment->paciente->nombrePaciente).
                    ' '.ucfirst($appointment->paciente->apellidoPaciente).
                    ' - '.ucfirst($appointment->obs).' - '.$appointment->paciente->celularPaciente,
                'start' => $appointment->start,
                'end' => $appointment->end,
                'editable' => false,
                'backgroundColor' => '#4040a1'
                ];  
                
            }
            foreach ($locks as $lock){
                $events[] = [
                    'groupId' => 'unAvailable',
                    'id'=> $lock->id,
                    'title' => 'Bloqueado por: '.ucfirst($lock->creator->name).' '.ucfirst($lock->creator->lastName),
                    'start' => $lock->start,
                    'end' => $lock->end,
                    'editable' => 'false',
                    'overlap' => 'false',
                    'display' => 'background',
                    'color' => '#ff4021'
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
                        'color' => '#ccc',
                        'backgroundColor' => '#ffcc5c'
                        
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
                $eventId = $request->event_id;
                return view('calendar.reschedule',compact('eventId','events','institution','professional','availableAgenda','frequency','patient'));  

            }


        }  
    }
    public function toWaitingList(Request $request)
    {
        
        $paciente = Paciente::find($request->patient_id);

        $wating = new Wating_list;
        $wating->user_id = $request->professional_id;
        $wating->institution_id = $request->institution_id;
        $wating->paciente_id = $request->patient_id;
        if(Wating_list::where('paciente_id',$paciente->codPaciente)->exists())
        {
            return redirect('home/')->with('message', 'El paciente ya esta en lista de espera!');
             
        }else
        {
            $wating->save();
            return redirect('home/')->with('message', 'Paciente enviado a lista de espera!');
        }
        return $request;
    }

    public function restore(Request $request)
    {
       
        if (!empty($request->patient_id))
        {
            //First cancel previus appointment
            $cancelAppointment = Appointment::find($request->event_id);
            $cancelAppointment->status = 'cancelled';
            try 
            {
                $cancelAppointment->save();
            
            } catch(\Illuminate\Database\QueryException $e)
            {
                $errorCode = $e->errorInfo[1];
                
                return 'error';
                
            }
            //Store new appointment
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
                return redirect()->route('appointment.show', [
                    'institution_id' => $appointment->institution_id,
                    'user_id' => $appointment->user_id
                ]);
            
            } catch(\Illuminate\Database\QueryException $e)
            {
                $errorCode = $e->errorInfo[1];
                
                return back()->with('error', $e->getMessage());
                
            }
        }

    }

    public function storeLock(Request $request)
    {
        $creator = Auth::user();
        $lock = new Lock;

        $lock->institution_id = $request->institution_id;
        $lock->user_id = $request->user_id;
        $lock->start = $request->startDate;
        $lock->end = $request->endDate;
        $lock->creator_id = $creator->id;
        $lock->obs = 'BLOQUEO';
        try 
        {
            $lock->save();
            return back()->with('message', 'Bloqueo agendado correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            
            return back()->with('error', $e->getMessage());
            
        }
        return $lock;
    }

    public function storePatient(Request $request)
    {
        
        $paciente = new Paciente;
        $paciente->idPaciente = $request->dni;
        $paciente->fechaNacimientoPaciente = $request->fechaNacimiento;
        $paciente->nombrePaciente = strtolower($request->nombre);
        $paciente->apellidoPaciente = strtolower($request->apellido);
        $paciente->celularPaciente = $request->telefono;
        $paciente->emailPaciente = strtolower($request->email);
        $paciente->CoberturaPaciente = "";
        $paciente->insurance_id = $request->insurance_id;
        $paciente->numeroAfiliadoPaciente = $request->numeroAfiliado;
        $paciente->domicilioPaciente = strtolower($request->domicilio);
        $paciente->localidadPaciente = strtolower($request->localidad);

        try 
        {
            $paciente->save();
            $paciente_id = $paciente->codPaciente;
        
        

            $appointment = new Appointment;

            $appointment->institution_id = $request->institution_id;
            $appointment->user_id = $request->user_id;
            $appointment->paciente_id = $paciente_id;
            $appointment->room_id = $request->room_id;
            $appointment->start = $request->startDate;
            $appointment->end = $request->endDate;
            $appointment->medicare = 'issn';
            $appointment->obs = $request->obs;
            $appointment->status = 'active';
            $appointment->overturn = 0;
            
            $appointment->save();
            return redirect()->route('appointment.show',[
                'institution_id' => $appointment->institution_id,
                'user_id' => $appointment->user_id
            ]);
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            
            return back()->with('error', $e->getMessage());
            
        }
        
    }

}
