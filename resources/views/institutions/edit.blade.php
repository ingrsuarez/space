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
                Editar Institución: 
            </div>
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
	                <div class="input-group mb-3" style="max-width: 20rem;">
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
    <div class="col-sm px-5">
	    <div class="card mb-3">
	        <div class="card-header text-white bg-primary">
	            Usuarios de la Institución
	            
	        </div>
	        <div class="card-body">
	            
	            <table class="table">
	                <thead class="table-light">
	                    <th>Nombre</th>
	                    <th>Email</th>
	                    <th>Teléfono</th>
	                    <th>Especialidad</th>
	                    <th colspan="2">Administrador</th>
	                </thead>
	                <tbody>
	              
	                @foreach($users as $user)
	                @if ($user->email_verified_at)
	                    <tr>
	                @else
	                    <tr class="table-warning">
	                @endif
 
	                    <td>{{ucfirst($user->lastName).' '.ucfirst($user->name)}}
	                    	@if($user->adminsInstitution($institution->id))
	                    	<br><span class="text-primary">Administrador</span>
	                    	@endif
	                    </td>
	                    <td>{{$user->email}}</td>
	                    <td>{{$user->telefono}}</td>
	                    <td>
	                    	@foreach($user->professions as $profession)
	                    	{{$profession->name.' - '}} 
	                    	@endforeach
	                    </td>
	                    <td width="10px">
	                    @if($user->adminsInstitution($institution->id))
	                    	<a class="btn btn-danger text-white" href="{{ route('institution.detachAdmin',['institution'=>$institution,'user'=>$user]) }}">Eliminar</a>
	                     @else
	                     	<a class="btn btn-primary text-white" href="{{ route('institution.attachAdmin',['institution'=>$institution,'user'=>$user]) }}">Agregar</a>
	                     @endif
	                    </td>
	                </tr>   
	                @endforeach
	              
	            </tbody>
	          </table>
	        </div>
	        {{-- <div class="card-footer">
	        @if(isset($users))
	         {!!$users->links()!!}

	        @endif
	        </div> --}}
	    </div>
	</div>	
@endsection