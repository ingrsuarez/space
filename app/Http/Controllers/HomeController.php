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
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

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

    public function dashboard()
    {
        $user = Auth::user();
        $institution = $user->currentInstitution;
        $chart_options = [
            'chart_title' => 'Transactions by user',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\HistorialClinico',
            'relationship_name' => 'institutions', // represents function user() on Transaction model
            'group_by_field' => 'name', // users.name
        
            // 'aggregate_function' => 'sum',
            // 'aggregate_field' => 'amount',
            
            'filter_field' => 'fechaHC',
            'filter_days' => 360, // show only transactions for last 30 days
            // 'filter_period' => 'week', // show only transactions for this week
        ];

        $chart_options1 = [
            'chart_title' => 'Consultas por usuarios',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\HistorialClinico',
            'relationship_name' => 'users', // represents function user() on Transaction model
            'group_by_field' => 'name', // users.name
            'where_raw' => 'codInstitucionHC = '.$institution->id,
            'chart_color' => '0,129,255',
            // 'aggregate_function' => 'sum',
            // 'aggregate_field' => 'amount',
            
            'filter_field' => 'fechaHC',
            'filter_days' => 360, // show only transactions for last 30 days
            // 'filter_period' => 'week', // show only transactions for this week
        ];

        $chart_options2 = [
            'chart_title' => 'Turnos por usuario',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Appointment',
            'relationship_name' => 'user', // represents function user() on Transaction model
            'group_by_field' => 'name', // users.name
            'where_raw' => 'institution_id = '.$institution->id,
            // 'aggregate_function' => 'sum',
            // 'aggregate_field' => 'amount',
            'chart_color' => '0,129,088',
            'filter_field' => 'created_at',
            'filter_days' => 120, // show only transactions for last 30 days
            // 'filter_period' => 'week', // show only transactions for this week
        ];
        
        // $chart_options = [
            // 'chart_title' => 'Users by months',
            // 'report_type' => 'group_by_date',
            // 'model' => 'App\Models\HistorialClinico',
            // 'group_by_field' => 'codUsuarioHC',
            // 'group_by_period' => 'month',
            // 'chart_type' => 'bar',
            // 'filter_field' => 'created_at',
            // 'filter_days' => 1200, // show only last 30 days
        // ];

        $chart1 = new LaravelChart($chart_options1);
        $chart2 = new LaravelChart($chart_options2);
        return view('dashboard.index', compact('chart1','chart2'));
    }
    
}
