@extends('layout.app')

@section('content')
    <form id="nuevo-paciente" action="{{ route('home') }}" method="POST">
    @csrf
        <div class="row justify-content-center mb-4">
            
            <div class="col-sm" style="max-width: 28rem;">
                <form id="nuevo-trabajo" action="{{ route('paciente.show') }}" method="POST" class="d-flex">
                @csrf
                <input class="form-control me-2" name="dni" type="search" placeholder="DNI" aria-label="Search" >
                <input class="form-control me-2" name="nombre" type="search" placeholder="Nombre" aria-label="Search" >
                <input class="form-control me-2" name="apellido" type="search" placeholder="Apellido" aria-label="Search" >
                <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
            <div class="col-sm"></div>
        </div>
        <div class="col-sm px-5">
            <div class="card mb-3">
                <div class="card-header text-white bg-primary">
                    Resultado de la búsqueda:
                </div>
                <div class="card-body">
                    
                    <table class="table">
                    <thead class="table-light">
                      <th>DNI</th>
                      <th>Apellido</th>
                      <th>Nombre</th>
                      <th>Teléfono</th>
                      <th>Fecha de nacimiento</th>
                      <th>Email</th>

                    </thead>
                    <tbody>
                      
                       @foreach($pacientes as $paciente)
                       <tr>
                          <td>{{$paciente->idPaciente}}</td> 
                          <td>{{$paciente->apellidoPaciente}}</td>
                          <td>{{$paciente->nombrePaciente}}</td>
                          <td>{{$paciente->celularPaciente}}</td>
                          <td>{{$paciente->fechaNacimientoPaciente}}</td>
                          <td>{{$paciente->emailPaciente}}</td>
                       </tr>   
                       @endforeach
                      
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </form>
@endsection