<?php

namespace App\Http\Controllers;
use App\Models\Trabajo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TrabajoController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
         return view('trabajos.nuevo_trabajo');
    }

    public function store(Request $request)
    {
        // $data = array(
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'fecha_fin' => $request->fecha_fin);
        // return $data;

        $trabajo = new Trabajo;

        $trabajo->titulo = $request->titulo;
        $trabajo->descripcion = $request->descripcion;
        $trabajo->cliente = $request->cliente;
        $trabajo->fecha_fin = $request->fecha_fin;
        $trabajo->creador = Auth::id();
        $trabajo->categoria = 'testing';
        $trabajo->estado = 'pendiente';


        $trabajo->save();

        return redirect()->route('listadoTrabajos');
        // ->with('success', 'trabajo Added successfully.');
    }

    public function listado(Request $request)
    {
        $data['trabajos'] = Trabajo::all();
        // return $trabajos;
        return view('trabajos.listado_trabajos',$data);
    }
}
