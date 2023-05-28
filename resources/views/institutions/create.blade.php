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
                Nueva Institución: 
            </div>
            <div class="card-body">
              	<form id="actualizar-ficha" action="{{ route('institution.store') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text" id="dni">CUIT</span>
						<input type="text" class="form-control" aria-label="tax_id"id="tax_id" name="tax_id" autofocus>
						<span class="input-group-text">Nombre</span>
						<input type="text" class="form-control" aria-label="Username" id="name" name="name">			
                	</div>
                	<div class="input-group mb-3">
						<span class="input-group-text" id="email">Correo</span>
                  		<input type="email" name="email" class="form-control" aria-label="email" aria-describedby="email">
                  		<span class="input-group-text" id="telefono">Teléfono</span>
                  		<input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="phone" name="phone">
                  		
                	</div>
                	<div class="input-group mb-3">
						<span class="input-group-text">Domicilio</span>
						<input type="text" class="form-control" aria-label="Username" id="address" name="address">
						<span class="input-group-text">Localidad</span>
						<input type="text" class="form-control" aria-label="Username"id="city" name="city">
	                </div>
                	<div class="input-group mb-3">
	                  	<span class="input-group-text">País</span>
	                  	<input type="text" class="form-control" aria-label="Username"id="country" name="country">
	                  	<span class="input-group-text">Provincia</span>
	                  	<input type="text" class="form-control" aria-label="Username" id="state" name="state">	                  
	                </div>
	                
	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>	
@endsection