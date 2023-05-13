@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="row justify-content-center my-4">
        <div class="col-sm">
            <div class="card mb-3">
                <div class="card-header">{{ __('Pacientes atendidos el último mes') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ $ultimosPacientes }}
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card mb-3" style="max-width: 18rem;">
              <div class="card-header text-white bg-primary">Pacientes en espera:</div>
              <div class="card-body">
                <h5 class="card-title">Total de pacientes en espera: </h5>
                <p class="card-text">Segun agenda del día.</p>
              </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Estadisticas</div>
              <div class="card-body">
                <h5 class="card-title">Secondary {{Auth::user()->tipo}}</h5>
                <p class="card-text">Mis estadisticas de atención.</p>
              </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        
        <div class="col-sm" style="max-width: 28rem;">
            <form id="nuevo-trabajo" action="{{ route('searchPaciente') }}" method="POST" class="d-flex">
            @csrf
            <input class="form-control me-2" name="dni" type="search" placeholder="DNI" aria-label="Search" >
            <input class="form-control me-2" name="nombre" type="search" placeholder="Nombre" aria-label="Search" >
            <input class="form-control me-2" name="apellido" type="search" placeholder="Apellido" aria-label="Search" >
            <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col-sm"></div>
    </div>
    @include('busqueda_paciente')
</div>
@endsection
