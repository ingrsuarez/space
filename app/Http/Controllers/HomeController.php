<?php

namespace App\Http\Controllers;
use App\Models\HistorialClinico;
use App\Models\Paciente;
use App\Models\User;
use App\Models\Cash;
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
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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
        // $consultas = HistorialClinico::select('codUsuarioHC',DB::raw('COUNT(*) as total'))
        //     ->where('codInstitucionHC',$institution->id)
        //     ->where('fechaHC','>','2022-12-31')
        //     ->groupBy('codUsuarioHC')
        //     ->get();
        // return $consultas;
        // $chart_options = [
        //     'chart_title' => 'Consultas por usuarios',
        //     'chart_type' => 'bar',
        //     'report_type' => 'group_by_string',
        //     'model' => 'App\Models\HistorialClinico',
        //     'group_by_field' => 'codInstitucionHC', // users.name
        
            // 'aggregate_function' => 'sum',
            // 'aggregate_field' => 'amount',
            
            // 'filter_field' => 'fechaHC',
            // 'filter_days' => 360, // show only transactions for last 30 days
            // 'filter_period' => 'week', // show only transactions for this week
        // ];
        $names = User::select('id','name','lastName')->get();
        $labels = array();
        foreach($names as $name)
        {
            $labels[$name->id]  = ucwords($name->lastName.' '.$name->name);
        }
        
        // dd($labels);
        $chart_consultas = [
            'chart_title' => 'Consultas por usuarios',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\HistorialClinico',
            'relationship_name' => 'users', // represents function user() on Transaction model
            'group_by_field' => 'id', // users.name
            'where_raw' => 'codInstitucionHC = '.$institution->id.' AND codPacienteHC != 1',
            'chart_color' => '0,129,255',
            // 'aggregate_function' => 'sum',
            // 'aggregate_field' => 'amount',
            'labels' => $labels,
            'filter_field' => 'fechaHC',
            'filter_days' => 90, // show only transactions for last 30 days
            // 'filter_period' => 'week', // show only transactions for this week
        ];

        $turnos_cobertura = [
            'chart_title' => 'Turnos por obra social',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Appointment',
            'relationship_name' => 'insurance', // represents function user() on Transaction model
            'group_by_field' => 'name', // insurance.name
            'where_raw' => 'institution_id = '.$institution->id.' AND status != "cancelled" AND insurance_id != "" AND paciente_id != 1',
            // 'aggregate_function' => 'sum',
            // 'aggregate_field' => 'amount',
            // 'labels' => $labels,
            'chart_color' => '0,129,088',
            'filter_field' => 'created_at',
            'filter_days' => 90, // show only transactions for last 90 days
            
            // 'filter_period' => 'week', // show only transactions for this week
        ];
        
        $chart_turnos = [
            'chart_title' => 'Turnos por usuario',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Appointment',
            'relationship_name' => 'user', // represents function user() on Transaction model
            'group_by_field' => 'id', // users.name
            'where_raw' => 'institution_id = '.$institution->id.' AND status != "cancelled"',
            // 'aggregate_function' => 'sum',
            // 'aggregate_field' => 'amount',
            'labels' => $labels,
            'chart_color' => '0,129,088',
            'filter_field' => 'created_at',
            'filter_days' => 90, // show only transactions for last 30 days
            
            // 'filter_period' => 'week', // show only transactions for this week
        ];

        $turnos_institucion = [
            'chart_title' => 'Turnos por institución',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Appointment',
            'relationship_name' => 'institution', // represents function institution() on Transaction model
            'group_by_field' => 'name', // users.name
            'group_by_period' => 'month',
            'where_raw' => 'status != "cancelled"',
            'chart_type' => 'bar',
            'chart_color' => '17, 223, 58',
            'filter_field' => 'start',
            'filter_days' => 365, // show only last 30 days
        ];
        
        $turnos_usuario = [
            'chart_title' => 'Mis turnos',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Appointment',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => '171, 223, 58',
            'where_raw' => 'user_id = '.$user->id.' AND institution_id ='.$institution->id.' AND status != "cancelled"',
            'filter_field' => 'start',
            'filter_days' => 365, // show only last 30 days
        ];


         
        $cash_chart = [
            'chart_title' => 'Cobros por día',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Cash',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'sum',
            'aggregate_field' => 'debit',
            'where_raw' => 'owner_id = '.$user->id.' AND institution_id ='.$institution->id,
            'chart_type' => 'bar',
            'chart_color' => '47, 194, 241',
            'filter_field' => 'created_at',
            'filter_days' => 365, // show only last 30 days
        ];
        
        $consultas_usuario = [
            'chart_title' => 'Consultas',
            'chart_type' => 'bar',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\HistorialClinico',
            'group_by_field' => 'fechaHC', 
            'group_by_period' => 'month',
            'where_raw' => 'codUsuarioHC = '.$user->id,
            'chart_color' => '0,129,255',
            'filter_field' => 'fechaHC',
            'filter_days' => 365, // show only transactions for last 30 days
            // 'filter_period' => 'week', // show only transactions for this week
        ];

        $appointments_institution = new LaravelChart($turnos_institucion);
        
        $chart1 = new LaravelChart($chart_consultas);
        
        $chart2 = new LaravelChart($chart_turnos);

        $chart_professional = new LaravelChart($turnos_usuario);

        $user_cash = new LaravelChart($cash_chart);
        
        $user_attention = new LaravelChart($consultas_usuario);

        $chart_insurance = new LaravelChart($turnos_cobertura);

        return view('dashboard.index', compact('chart1','chart2','chart_professional','user_cash','appointments_institution','user_attention','chart_insurance'));
    }
    
}
