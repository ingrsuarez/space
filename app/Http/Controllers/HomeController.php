<?php

namespace App\Http\Controllers;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
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
    public function index()
    {
        $today = Carbon::now();

        $data['ultimosPacientes'] = HistorialClinico::where('codUsuarioHc',Auth::user()->id)->whereBetween('fechaHC',['2022-01-28 17:36:03',$today])->count();
        
        return view('home',$data);
    }
    
    public function search(Request $request)
    {
        $data['ultimosPacientes'] = HistorialClinico::where('codUsuarioHc','57')->whereBetween('fechaHC',['2022-01-28 17:36:03','2023-02-28 17:36:03'])->count();
        if(isset($request->dni)){
            $data['pacientes'] = Paciente::where('idPaciente','LIKE',$request->dni.'%')->get();
        }elseif(isset($request->nombre)){
            $data['pacientes'] = Paciente::whereRaw('lower(nombrePaciente) LIKE "'.strtolower($request->nombre).'%"')->get();
        }elseif(isset($request->apellido)){
            $data['pacientes'] = Paciente::whereRaw('lower(apellidoPaciente) LIKE "'.strtolower($request->apellido).'%"')->get();
        }
        return view('home',$data);
        // return $data;
    }
}
