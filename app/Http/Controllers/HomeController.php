<?php

namespace App\Http\Controllers;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Waiting_list;
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
        $today = Carbon::now();
        $ultimosPacientes = HistorialClinico::where('codUsuarioHc',Auth::user()->id)->whereBetween('fechaHC',['2022-01-28 17:36:03',$today])->count();
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
            return view('home',compact('institutions','ultimosPacientes','search','pacientes','user','professionals'));
        }elseif(isset($request->nombre)){
            $search = ['nombre'=>$request->nombre];
            $pacientes = Paciente::whereRaw('lower(nombrePaciente) LIKE "'.strtolower($request->nombre).'%"')->paginate(5);
            return view('home',compact('institutions','ultimosPacientes','search','pacientes','user','professionals'));
        }elseif(isset($request->apellido)){
            $search = ['apellido'=>$request->apellido];
            $pacientes = Paciente::whereRaw('lower(apellidoPaciente) LIKE "'.strtolower($request->apellido).'%"')->paginate(5);
            return view('home',compact('institutions','ultimosPacientes','search','pacientes','user','professionals'));
        }
        return view('home',compact('institutions','ultimosPacientes','institution','user','professionals'));
    }
    
    
}
