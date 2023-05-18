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
                Nuevo Usuario: 
            </div>
            <div class="card-body">
              	<form id="actualizar-ficha" action="{{ route('user.store') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text">Nombre</span>
						<input type="text" class="form-control" aria-label="Username" id="nombre" name="name">
						<span class="input-group-text">Apellido</span>
						<input type="text" class="form-control" aria-label="Username"id="apellido" name="lastName">
	                </div>
            		<div class="input-group mb-3">
						<span class="input-group-text" id="email">Correo</span>
                  		<input type="email" name="email" class="form-control" aria-label="email" aria-describedby="email">
						<span class="input-group-text" id="fechaNacimiento">Fecha de Nacimiento</span>
                  		<input type="date" class="form-control" aria-label="Username" aria-describedby="fechaNacimiento" id="fechaNacimiento" name="fechaNacimiento">			
                	</div>

                	<div class="input-group mb-3">
						<label class="input-group-text" for="inputGroupSelect01">Options</label>
						<select class="form-select" id="inputGroupSelect01" name="tipo">
							<option selected>Tipo...</option>
							<option value="3">Administrativo</option>
							<option value="2">Profesional</option>
							
						</select>
					</div>
                	
                	<div class="input-group mb-3">
                  		<span class="input-group-text" id="telefono">Teléfono</span>
                  		<input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="telefono" name="telefono">
                  		<span class="input-group-text">Localidad</span>
						<input type="text" class="form-control" aria-label="Username"id="localidad" name="localidad">
                  		
                	</div>

	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>	
@endsection