@extends('layouts.app')

@section('content')

<div class="col-sm px-5">
    <div class="card mb-3"> 
        <div class="card-header text-white bg-primary">
            Listado de pacientes:
        </div>

        <div class="card-body">   
            <div class="col-sm" style="max-width: 28rem;">
                <form id="nuevo-trabajo" action="{{ route('paciente.search') }}" method="POST" class="d-flex">
                    @csrf
                    
                    <input class="form-control me-2" name="dni" type="search" placeholder="DNI" aria-label="Search" >
                    <input class="form-control me-2" name="apellido" type="search" placeholder="Apellido" aria-label="Search" >
                    <input class="form-control me-2" name="nombre" type="search" placeholder="Nombre" aria-label="Search" >
                    <button class="btn btn-outline-success" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="col-sm px-5">
    @if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card mb-3">
        <div class="card-header text-white bg-primary">
            Listado de pacientes:
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
                  <td>{{strtoupper($paciente->apellidoPaciente)}}</td>
                  <td>{{strtoupper($paciente->nombrePaciente)}}</td>
                  <td>{{$paciente->celularPaciente}}</td>
                  <td>{{$paciente->fechaNacimientoPaciente}}</td>
                  <td>{{$paciente->emailPaciente}}</td>
               </tr>   
               @endforeach
              
            </tbody>
          </table>
        </div>
        <div class="card-footer">
            @if(isset($paciente) && isset($search))
             {!!$pacientes->appends($search)->links()!!}


            @endif
        </div>
    </div>
</div>

@endsection