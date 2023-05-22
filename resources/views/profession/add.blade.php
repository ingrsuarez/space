
@extends('layouts.app')

@section('content')
	@if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-sm px-5">
    	<div class="card mb-3" style="max-width: 50rem;">
    		<div class="card-header text-white bg-primary">
                Mis Especialidades: 
            </div>
            <div class="card-body">
              	<form id="actualizar-ficha" action="{{ route('home') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text">Nombre</span>
						<input type="text" class="form-control" aria-label="Username" id="nombre" name="name" value="{{$user->name}}">
						<span class="input-group-text">Apellido</span>
						<input type="text" class="form-control" aria-label="Username"id="apellido" name="lastName" value="{{$user->lastName}}">
	                </div>
            		<div class="input-group mb-3">
						<span class="input-group-text" id="email">Correo</span>
                  		<input type="email" name="email" class="form-control" aria-label="email" aria-describedby="email" value="{{$user->email}}">
						<span class="input-group-text" id="fechaNacimiento">Fecha de Nacimiento</span>
                  		<input type="date" class="form-control" aria-label="Username" aria-describedby="fechaNacimiento" id="fechaNacimiento" name="fechaNacimiento" value="{{Carbon\Carbon::parse($user->fechaNacimiento)->format('Y-m-d')}}">			
                	</div>

                	<div class="input-group mb-3">
						<label class="input-group-text" for="inputGroupSelect01">Options</label>
						<select class="form-select" id="inputGroupSelect01" name="tipo">
							<option value="{{$user->tipo}}"selected>Tipo...</option>
							<option value="3">Administrativo</option>
							<option value="2">Profesional</option>
							<option value="1">Administrador</option>
							
						</select>
						<label class="input-group-text" for="inputGroupSelect02">Options</label>
						<select class="form-select" id="inputGroupSelect02" name="estado">
							<option value="{{$user->estado}}" selected>Estado...</option>
							<option value="activo">Activo</option>
							<option value="inactivo">Inactivo</option>
							
						</select>
					</div>
                	
                	<div class="input-group mb-3">
                  		<span class="input-group-text" id="telefono">Teléfono</span>
                  		<input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="telefono" name="telefono" value="{{$user->telefono}}">
                  		<span class="input-group-text">Localidad</span>
						<input type="text" class="form-control" aria-label="Username"id="localidad" name="localidad" value="{{$user->localidad}}">
                  		
                	</div>

                	
                	<label class="h5">Roles:</label>
                		@foreach ($roles as $role)
                		<div class="input-group mb-3" style="max-width: 10rem;" >
							<div class="input-group-text">

							  
							   @if($user->hasRole($role->id) )
							   	<input type="checkbox" name="roles[]" value="{{$role->id}}" checked>
							   @else 
							    <input type="checkbox" name="roles[]" value="{{$role->id}}" >
							   @endif
							</div>
							<div class="form-control">
								{{ucfirst($role->name)}}	
							</div>
								
						</div>	
                		
                		@endforeach
                	
	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>	
@endsection