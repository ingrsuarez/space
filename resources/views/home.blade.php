@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center my-4">
        <div class="col-sm">
            <div class="card mb-3 shadow-sm">
                <div class="card-header">{{ __('Pacientes atendidos el último mes') }}</div>

                <div class="card-body">
                    Total: {{ $ultimosPacientes }}
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card mb-3 shadow-sm" style="max-width: 18rem;">
              <div class="card-header text-white bg-primary">Pacientes en espera:</div>
              <div class="card-body">
                <h5 class="card-title">Total de pacientes en espera: </h5>
                <p class="card-text">Según agenda del día.</p>
              </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3 shadow-sm" style="max-width: 18rem;">
              <div class="card-header">INSTITUCIÓN:</div>
              <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text">Institución actual!</p>
              </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        
        <div class="col-sm" style="max-width: 28rem;">
            <form id="nuevo-trabajo" action="{{ route('searchPaciente') }}" method="POST" class="d-flex">
                @csrf
                <input class="form-control me-2 shadow-sm" name="dni" type="search" placeholder="DNI" aria-label="Search" >
                <input class="form-control me-2 shadow-sm" name="nombre" type="search" placeholder="Nombre" aria-label="Search" >
                <input class="form-control me-2 shadow-sm" name="apellido" type="search" placeholder="Apellido" aria-label="Search" >
                <button class="btn btn-outline-success shadow-sm" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col-sm"></div>
    </div>
    @include('busqueda_paciente')
</div>
@endsection
