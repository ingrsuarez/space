<?php

namespace App\Http\Controllers;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Wating_list;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $user = Auth::user();
        $institution = $user->currentInstitution;
        if (empty($institution))
        {
            $institution_id = $user->institutions->first();
            $user->institution_id = $institution_id->id;
            $user->save();
            $institution = $user->currentInstitution;
        }
        
        $today = Carbon::now();
        $monthAgo = Carbon::now()->subDays(30);
        
        $ultimosPacientes = HistorialClinico::where('codUsuarioHc',$user->id)
            ->whereBetween('fechaHC',[$monthAgo->format('Y-m-d').' 00:00:00',$today->format('Y-m-d').' 23:59:59'])
            ->count();
        if ($user->hasRole('profesional'))
        {
            $wating_institution = Wating_list::where('institution_id',$institution->id)->where('user_id',$user->id)->count();
        }else{
            $wating_institution = Wating_list::where('institution_id',$institution->id)->count();
        }
        
        $institutions = Auth::user()->institutions;
        if(!empty($institution))
        {
            $professionals = $institution->users;
        }else
        {
            $professionals = null;
        }

        
        if(isset($request->dni)){
            $search = ['dni'=>$request->dni];

            $pacientes = Paciente::where('idPaciente','LIKE',$request->dni.'%')->paginate(5);
            return view('home',compact('institutions','ultimosPacientes','search','pacientes','user','professionals','wating_institution'));
        }elseif(isset($request->nombre)){
            $search = ['nombre'=>$request->nombre];
            $pacientes = Paciente::whereRaw('lower(nombrePaciente) LIKE "'.strtolower($request->nombre).'%"')->paginate(5);
            return view('home',compact('institutions','ultimosPacientes','search','pacientes','user','professionals','wating_institution'));
        }elseif(isset($request->apellido)){
            $search = ['apellido'=>$request->apellido];
            $pacientes = Paciente::whereRaw('lower(apellidoPaciente) LIKE "'.strtolower($request->apellido).'%"')->paginate(5);
            return view('home',compact('institutions','ultimosPacientes','search','pacientes','user','professionals','wating_institution'));
        }
        return view('home',compact('institutions','ultimosPacientes','institution','user','professionals','wating_institution'));
    }
    
    
}
