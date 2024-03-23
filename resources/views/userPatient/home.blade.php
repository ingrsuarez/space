@extends('layouts.pacientes')

@section('content')

    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="d-flex justify-content-center flex-column">
        <div class="card mb-3 p-4">
            <h5 class="card-header">{{ucwords($user->lastName.' '.$user->name)}}</h5>
            <div class="card-body">
                <a class="btn btn-success text-white container-sm" href="#" ><h2 class="h2" >Turnos</h2></a>
            </div>
            <div class="card-body">

                <a class="btn btn-success text-white container-sm" href="{{route('user.studies')}}" ><h2 class="h2" >Estudios</h2></a>
            </div>
          
        </div>
    </div>
@endsection
@section('scripts')

    

@endsection