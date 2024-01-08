@extends('layouts.app')

@section('content')
	@if (session('message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('message') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-sm px-5">
    	<div class="card mb-3" style="max-width: 50rem;">
    		<div class="card-header text-white bg-primary">
                Nuevo servicio: 
            </div> 
            <div class="card-body">
              	<form id="actualizar-ficha" action="{{ route('services.store') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text">Nombre</span>
						<input type="text" class="form-control" aria-label="Username" id="name" name="name" autofocus>			
                	</div>
                	<div class="input-group mb-3">
						<span class="input-group-text" id="email">Descripción</span>
                  		<input type="text" name="description" class="form-control" aria-label="email" aria-describedby="email">
                	</div>
                	<div class="input-group mb-3">
						<span class="input-group-text">Area</span>
						<input type="text" class="form-control" aria-label="Username"id="area" name="area">
                        <span class="input-group-text">Carpeta</span>
						<input type="text" class="form-control" aria-label="Username"id="path" name="path">
	                </div>
	                
	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>	
@endsection