@extends('layouts.app')

@section('content')
	@if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-sm px-5 mb-2">	

	    <div class="accordion" id="accordionPanelsStayOpenExample">
			<div class="accordion-item">
				<h2 class="accordion-header" id="panelsStayOpen-headingOne">
				  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
				    <div class="">
				        Datos de la  Institución: {{strtoupper($institution->name)}}
				    </div>
				  </button>
				</h2>
				<div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
					<div class="accordion-body">
						<div class="card mb-3" style="max-width: 50rem;">
				    		
				            <div class="card-body">
				              	<form id="actualizar-ficha" action="{{ route('institution.update',$institution) }}" method="POST">
				            		@csrf
				            		<div class="input-group mb-3">
										<span class="input-group-text" id="dni">CUIT</span>
										<input type="text" class="form-control" id="tax_id" name="tax_id" value="{{$institution->tax_id}}" autofocus>
										<span class="input-group-text">Nombre</span>
										<input type="text" class="form-control" id="name" name="name" value="{{$institution->name}}">			
				                	</div>
				                	<div class="input-group mb-3">
										<span class="input-group-text" id="email">Correo</span>
				                  		<input type="email" name="email" class="form-control" value="{{$institution->email}}">
				                  		<span class="input-group-text" id="telefono">Teléfono</span>
				                  		<input type="text" class="form-control" id="phone" name="phone" value="{{$institution->phone}}">
				                  		
				                	</div>
				                	<div class="input-group mb-3">
										<span class="input-group-text">Domicilio</span>
										<input type="text" class="form-control" id="address" name="address" value="{{$institution->address}}">
										<span class="input-group-text">Localidad</span>
										<input type="text" class="form-control" id="city" name="city" value="{{$institution->city}}">
					                </div>
				                	<div class="input-group mb-3">
					                  	<span class="input-group-text">País</span>
					                  	<input type="text" class="form-control" id="country" name="country" value="{{$institution->country}}">
					                  	<span class="input-group-text">Provincia</span>
					                  	<input type="text" class="form-control" id="state" name="state" value="{{$institution->state}}">	                  
					                </div>
									<div class="input-group mb-3">
										<span class="input-group-text">Google Maps:</span>
										<input type="text" class="form-control" id="location" name="location" value="{{$institution->location}}">	                  
					                	<span class="input-group-text">Estado:</span>
					                	<select class="form-select" name="status" id="status">
					                		<option value="{{$institution->status}}">Estado..</option>
					                		<option value="activa">Activa</option>
					                		<option value="inactiva">Inactiva</option>

					                	</select>

					                </div>
					                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
					                	<button class="btn btn-outline-success " type="submit">Guardar</button>
					                </div>
				          		</form>
				      		</div>
				    	</div>

					</div>
				</div>
			</div>
		</div>


    </div>

    
 	<div class="col-sm px-5">
    	@livewire('edit-institution', ['institution' => $institution, 'sheets' => $sheets])
	</div>
	

    



		
@endsection