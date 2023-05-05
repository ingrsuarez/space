@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm">
            <div class="card mb-3">
                <div class="card-header">{{ __('Datos de usuario') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Auth::user()->email }}
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
</div>
@endsection
