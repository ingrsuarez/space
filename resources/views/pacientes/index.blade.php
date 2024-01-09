@extends('layouts.pacientes')

@section('content')
<div class="col-sm px-5">
    <div class="card mb-3" style="max-width: 20rem;">
        <a class="btn btn-success text-white" href="{{ route('pacientes.index') }}" >Mis turnos</a>
        <a href="">{{ucwords($paciente->nombrePaciente.' '.$paciente->apellidoPaciente)}}</a>
    </div>
</div>


@endsection