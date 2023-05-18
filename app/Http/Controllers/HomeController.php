<?php

namespace App\Http\Controllers;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
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
        $today = Carbon::now();
        $data['ultimosPacientes'] = HistorialClinico::where('codUsuarioHc',Auth::user()->id)->whereBetween('fechaHC',['2022-01-28 17:36:03',$today])->count();

        if(isset($request->dni)){
            $data['search'] = ['dni'=>$request->dni];

            $data['pacientes'] = Paciente::where('idPaciente','LIKE',$request->dni.'%')->paginate(5);
        }elseif(isset($request->nombre)){
            $data['search'] = ['nombre'=>$request->nombre];
            $data['pacientes'] = Paciente::whereRaw('lower(nombrePaciente) LIKE "'.strtolower($request->nombre).'%"')->paginate(5);
        }elseif(isset($request->apellido)){
            $data['search'] = ['apellido'=>$request->apellido];
            $data['pacientes'] = Paciente::whereRaw('lower(apellidoPaciente) LIKE "'.strtolower($request->apellido).'%"')->paginate(5);
        }
        return view('home',$data);
    }
    
    
}
