@extends('layouts.pacientes')

@section('content')

    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif 
    <div class="card mx-auto my-4" >
        <div class="card-header bg-info text-white">
            ESTUDIOS
        </div>
    </div>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Laboratorios:
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @foreach ($labs as $file)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.file',['file'=>$file['name'], 'idPaciente'=>$file['idPaciente']])}}" target="_blank">{{ $file['name'] }}</a>
                    <br>
                    @endforeach

                </div>
                
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne">
                    Ecografías:
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @foreach ($ecografias as $file)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.ecografia',['file'=>$file['name'], 'idPaciente'=>$file['idPaciente']])}}" target="_blank">{{ $file['name'] }}</a>
                    <br>
                    @endforeach

                </div>
                
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Endoscopías:
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @foreach ($endoscopias as $file)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.endoscopia',['file'=>$file['name'], 'idPaciente'=>$file['idPaciente']])}}" target="_blank">{{ $file['name'] }}</a>
                    <br>
                    @endforeach
                </div>
                </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseThree">
                    Cardiología:
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    @foreach ($cardiologias as $file)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.cardiologia',['file'=>$file['name'], 'idPaciente'=>$file['idPaciente']])}}" target="_blank">{{ $file['name'] }}</a>
                    <br>
                    @endforeach
                </div>
                </div>
        </div>
    </div>
    

@endsection
