<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Institution;
use App\Models\User;
use App\Models\Agenda;


class AgendaController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        return view('agendas.index');
    }

    public function store(Request $request)
    {
        $agenda = new Agenda;
        $agenda->institution_id = $request->institution_id;
        $agenda->user_id = $request->professional_id;
        $agenda->room_id = $request->room_id;
        $agenda->day = $request->day;
        $agenda->frequency = $request->frequency;
        $agenda->start = $request->start;
        $agenda->end = $request->end;
        $agenda->max_days = '30';
        $agenda->overturn = '0';

        try 
        {
            $agenda->save();
            return back()->with('message', 'Agenda guardada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            
             return back()->with('error', $e->getMessage());
            
        } 
    }

    public function edit(Request $request)
    {
        
        $agenda = Agenda::find($request->agenda_id);
        $agenda->institution_id = $request->institution_id;
        $agenda->user_id = $request->professional_id;
        $agenda->room_id = $request->room_id;
        $agenda->day = $request->day;
        $agenda->frequency = $request->frequency;
        $agenda->start = $request->start;
        $agenda->end = $request->end;
        $agenda->max_days = '30';
        $agenda->overturn = '0';

        
        try 
        {
            $agenda->save();
            return back()->with('message', 'Agenda guardada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            
             return back()->with('error', $e->getMessage());
            
        } 
    }

    public function delete(Agenda $agenda)
    {

        try 
        {
            $agenda->delete();
            return back()->with('message', 'Agenda eliminada correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            
             return back()->with('error', $e->getMessage());
            
        } 
    }

}
