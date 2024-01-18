@extends('layouts.app')

@section('content')
	@if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-sm px-5">
    	<div class="card mb-3 shadow" style="max-width: 50rem;">
    		<div class="card-header text-white bg-primary">
                Nuevo Paciente: 
            </div>
            <div class="card-body">
              	<form id="actualizar-ficha" action="{{ route('paciente.store') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text" id="dni">DNI</span>
						<input type="text" class="form-control" aria-label="dni"id="dni" name="dni"required autofocus>
						<span class="input-group-text" id="fechaNacimiento">Fecha de Nacimiento</span>
                  		<input type="date" class="form-control" aria-label="Username" aria-describedby="fechaNacimiento" id="fechaNacimiento" name="fechaNacimiento" required>			
                	</div>
                	<div class="input-group mb-3">
						<span class="input-group-text">Nombre</span>
						<input type="text" class="form-control" aria-label="Username" id="nombre" name="nombre" required>
						<span class="input-group-text">Apellido</span>
						<input type="text" class="form-control" aria-label="Username"id="apellido" name="apellido" required>
	                </div>
                	<div class="input-group mb-3">
                  		<span class="input-group-text" id="telefono">Teléfono</span>
                  		<input type="text" class="form-control" aria-label="Username" id="telefono" name="telefono">
                  		<span class="input-group-text" id="celular">Celular</span>
                  		<input type="text" class="form-control" aria-label="Username" id="celular" name="celular" required>
						<span class="input-group-text" id="email">Correo</span>
                  		<input type="email" name="email" class="form-control" aria-label="email" aria-describedby="email">
                	</div>
                	<div class="input-group mb-3">
	                  	<span class="input-group-text">Cobertura médica</span>
						<select class="form-select" name="cobertura" id="cobertura" required>
							@isset($insurances)
								@foreach ($insurances as $insurance)
									<option value="{{$insurance->id}}"> {{ucfirst($insurance->name)}}								
								@endforeach	
							@endisset
						</select>
	                  	<span class="input-group-text">Número Afiliado</span>
	                  	<input type="text" class="form-control" aria-label="Username" id="numeroAfiliado" name="numeroAfiliado">	                  
	                </div>
					<div class="input-group mb-3">
						<span class="input-group-text">Ocupación:</span>
						<input type="text" class="form-control" aria-label="Username" id="ocupacion" name="ocupacion">
						<span class="input-group-text">Sexo:</span>
						<select class="form-select" name="sexo" id="sexo" required>
							<option value="F">Femenino</option>
							<option value="M">Masculino</option>
						</select>
	                </div>
	                <div class="input-group mb-3">
						<span class="input-group-text">Domicilio</span>
						<input type="text" class="form-control" aria-label="Username" id="domicilio" name="domicilio">
						<span class="input-group-text">Localidad</span>
						<input type="text" class="form-control" aria-label="Username"id="localidad" name="localidad">
	                </div>
					<div class="input-group mb-3">
						<span class="input-group-text">Observaciones:</span>
						<input type="text" class="form-control" id="observations" name="observations">
	                </div>
	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>	
@endsection