@extends('layouts.pacientes')

@section('content')

    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @push('meta')
        <meta http-equiv="refresh" content="30">
    @endpush
    <div class="d-flex justify-content-center flex-column">
        <div class="card mb-3 p-4">
            <a class="btn btn-success text-white mx-auto" style="min-width: 20rem;" href="#" ><h2 class="h2" >Turnos</h2></a>
        
        </div>
        <div class="card mb-3 px-4" >
            <a class="btn btn-success text-white mx-auto mt-lg-n5" style="min-width: 20rem;" href="#" ><h2 class="h2" >Estudios</h2></a>
            @isset($files)  

            <div class="card mx-auto my-4" >
                <div class="card-header bg-info ">
                    Laboratorios:
                </div>
                <div class="card-body">
                    @foreach ($files as $file)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.file',['file'=>$file['name'], 'idPaciente'=>$file['idPaciente']])}}" target="_blank">{{ $file['name'] }}</a>
                    <br>
                    @endforeach

                </div>
               
            </div>

            @endisset

          
        </div>
    </div>
@endsection
@section('scripts')

    

@endsection