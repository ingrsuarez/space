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
				{{$errors}}
            </div>
            <div class="card-body">
              	<form id="actualizar-ficha" action="{{ route('user.store') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text">Nombre</span>
						<input type="text" class="form-control" id="nombre" name="name">
						<span class="input-group-text">Apellido</span>
						<input type="text" class="form-control" id="apellido" name="lastName">
	                </div>
					<div class="input-group mb-3">
						<span class="input-group-text" id="email">Correo</span>
                  		<input type="email" name="email" class="form-control">
			
                	</div>
                	<div class="input-group mb-3">
						<span class="input-group-text">Contraseña</span>
                  		<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
						  @error('password')
						  <span class="invalid-feedback" role="alert">
							  <strong>{{ $message }}</strong>
						  </span>
					  @enderror
                  		<span class="input-group-text">Confirmar Contraseña</span>
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                  		
                	</div>

	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>	
@endsection