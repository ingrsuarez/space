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
              <div class="card-header text-white bg-primary">Trabajos Pendientes</div>
              <div class="card-body">
                <h5 class="card-title">Total de trabajos pendientes: 12</h5>
                <p class="card-text">Texto descriptivo según requisitos de este template.</p>
              </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
              <div class="card-header">Título</div>
              <div class="card-body">
                <h5 class="card-title">Secondary {{isset($id)? $id : 'Sin id'}}</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
              </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        
        <div class="col-sm" style="max-width: 28rem;">
            <form id="nuevo-trabajo" action="{{ route('searchPaciente') }}" method="POST" class="d-flex">
            @csrf
            <input class="form-control me-2" name="nombre" type="search" placeholder="Nombre" aria-label="Search">
            <input class="form-control me-2" name="apellido" type="search" placeholder="Apellido" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col-sm"></div>
    </div>
    @include('busqueda_paciente')
</div>
@endsection
