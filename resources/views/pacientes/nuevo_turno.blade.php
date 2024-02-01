@extends('layouts.app')

@section('content')
	@if (session('error'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('error') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  @endif


  <form id="actualizar-ficha" action="{{ route('appointment.storePatient') }}" method="POST">
    @method('POST')
    @csrf
    <div class="col-sm px-5">
      <div class="card mb-3 shadow" style="max-width: 50rem;">
          <div class="card-header text-white bg-primary">
              Turno: 
          </div>
          <div class="card-body">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Profesional:</span>
              </div>
              <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="user" value="{{ucfirst($professional->lastName).' '.ucfirst($professional->name)}}" readonly>
              <input type="hidden" name="user_id" value="{{$professional->id}}">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Hora:</span>
              </div>
              <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="time" name="startTime" value="{{date('H:i:s',strtotime($appointment->start))}}" readonly>
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Finaliza:</span>
              </div>
              <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="timeEnd" name="endTime" value="{{date('H:i:s',strtotime($appointment->end))}}" readonly>
              
              <input type="hidden" id="startDate" name="startDate" value="{{$appointment->start}}">
              <input type="hidden" id="endDate" name="endDate" value="{{$appointment->end}}">
              <input type="hidden" id="room" name="room_id" value="{{$appointment->room_id}}">
              <input type="hidden" id="institution" name="institution_id" value="{{$institution->id}}">
            </div>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Fecha:</span>
              </div>
              <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" value="{{date('d-m-Y',strtotime($appointment->start))}}" readonly>
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Observaciones:</span>
              </div>
              <input type="text" class="form-control" value="{{$appointment->obs}}" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="obs" name="obs" required>
            </div>  
          </div>   
      </div> 

        <div class="card mb-3 shadow" style="max-width: 50rem;">
            <div class="card-header text-white bg-primary">
                Nuevo Paciente: 
            </div>
          <div class="card-body">
            <div class="input-group mb-3">
        <span class="input-group-text" id="dni">DNI</span>
        <input type="text" class="form-control" aria-label="dni"id="dni" name="dni"required autofocus>
        <span class="input-group-text" id="fechaNacimiento">Fecha de Nacimiento</span>
                  <input type="date" class="form-control" aria-label="Username" aria-describedby="fechaNacimiento" id="fechaNacimiento" name="fechaNacimiento">			
              </div>
              <div class="input-group mb-3">
        <span class="input-group-text">Nombre</span>
        <input type="text" class="form-control" aria-label="Username" id="nombre" name="nombre" required>
        <span class="input-group-text">Apellido</span>
        <input type="text" class="form-control" aria-label="Username"id="apellido" name="apellido" required>
              </div>
              <div class="input-group mb-3">
                  <span class="input-group-text" id="telefono">Teléfono</span>
                  <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="telefono" name="telefono" required>
                  <span class="input-group-text" id="email">Correo</span>
                  <input type="email" name="email" class="form-control" aria-label="email" aria-describedby="email">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Cobertura:</span>
                </div>
                <select class="form-select" name="insurance_id" required>
                  @foreach ($insurances as $insurance)
                    <option value="{{$insurance->id}}">{{$insurance->name}}</option>
                  @endforeach
                </select>
                <span class="input-group-text">Número Afiliado</span>
                <input type="text" class="form-control" aria-label="Username" id="edad" name="numeroAfiliado">	                  
              </div>
              <div class="input-group mb-3">
        <span class="input-group-text">Domicilio</span>
        <input type="text" class="form-control" aria-label="Username" id="domicilio" name="domicilio">
        <span class="input-group-text">Localidad</span>
        <input type="text" class="form-control" aria-label="Username"id="localidad" name="localidad">
              </div>
                <div class="d-flex mb-3">
                    <button type="button" class="btn btn-secondary px-2 mb-2" data-bs-dismiss="modal">Cerrar</button>
                    
                    <button type="submit" class="btn btn-info ms-auto px-2 mb-2" id="saveModalBtn">Agendar Turno</button>
                    
                </div> 
          </div>
      </div>
        

    </div>
  </form>

    	
@endsection