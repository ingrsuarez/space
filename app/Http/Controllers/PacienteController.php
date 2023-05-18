<?php

namespace App\Http\Controllers;

use App\Models\HistorialClinico;
use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['pacientes'] = Paciente::orderBy('apellidoPaciente')->paginate(10);
        return view('pacientes.listado_pacientes',$data);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('pacientes.nuevo_paciente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $paciente = new Paciente;
        $paciente->idPaciente = $request->dni;
        $paciente->fechaNacimientoPaciente = $request->fechaNacimiento;
        $paciente->nombrePaciente = strtolower($request->nombre);
        $paciente->apellidoPaciente = strtolower($request->apellido);
        $paciente->celularPaciente = $request->telefono;
        $paciente->emailPaciente = strtolower($request->email);
        $paciente->CoberturaPaciente = strtolower($request->cobertura);
        $paciente->numeroAfiliadoPaciente = $request->numeroAfiliado;
        $paciente->domicilioPaciente = strtolower($request->domicilio);
        $paciente->localidadPaciente = strtolower($request->localidad);
        try 
        {
            $paciente->save();
            return redirect('pacientes')->with('message', 'Paciente guardado correctamente!');
        
        } catch(\Illuminate\Database\QueryException $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
               return back()->with('error', 'Paciente ya existente!');
            }
            else{
             return back()->with('error', $e->getMessage());
            }
        }
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function busqueda(Request $request)
    {
        //
        if(isset($request->dni)){
            $data['search'] = ['dni'=>$request->dni];
            $data['pacientes'] = Paciente::where('idPaciente','LIKE',$request->dni.'%')->orderBy('apellidoPaciente')->paginate(10);

        }elseif(isset($request->nombre)){
            $data['search'] = ['nombre'=>$request->nombre];
            $data['pacientes'] = Paciente::whereRaw('lower(nombrePaciente) LIKE "'.strtolower($request->nombre).'%"')->orderBy('nombrePaciente')->paginate(10);

        }elseif(isset($request->apellido)){
            $data['search'] = ['apellido'=>$request->apellido];
            $data['pacientes'] = Paciente::whereRaw('lower(apellidoPaciente) LIKE "'.strtolower($request->apellido).'%"')->orderBy('apellidoPaciente')->paginate(10);
        }
        return view('pacientes.listado_pacientes',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
