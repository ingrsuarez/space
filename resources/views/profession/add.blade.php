
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
                Agregar Especialidad: 
            </div>
            <div class="card-body">
            	<form id="agregar-especialidad" action="{{ route('profession.attach',$profession) }}" method="POST">
            		@csrf
					
					<div class="input-group mb-3">
						<span class="input-group-text">Especialidad</span>
						<input type="text" class="form-control" id="nombre" name="profession_id" value="{{$profession->name}}" readonly>
						<span class="input-group-text">Matrícula</span>
						<input type="number" class="form-control" id="number" name="number" required>
	                </div>

	                <div class="input-group mb-3">
						<span class="input-group-text">Fecha de matriculación</span>
						<input type="date" class="form-control" id="fecha_expedicion" name="expedition" required>
						<span class="input-group-text">Vencimiento</span>
						<input type="date" class="form-control" id="expiration" name="expiration" required>
	                </div>
	                <div class="input-group mb-3">
						<label class="input-group-text" for="inputGroupSelect01">Entidad</label>
						<select class="form-select" id="inputGroupSelect01" name="entity" required>
							<option selected>Entidad...</option>
							@foreach ($entities as $entity)
							<option value="{{$entity->id}}">{{$entity->name}}</option>
							@endforeach
						</select>
					</div>

					<div class="d-grid gap-2 d-md-flex justify-content-md-end">     	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
				</form>
			</div>
		</div>
    </div>


    <div class="card mb-3">
        <div class="card-header text-white bg-primary">
            <label class="h5">Mis Matrículas:</label>               
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="table-light">
                    <th>#</th>
                    <th>Especialidad</th>
                    <th>Entidad</th>
                    <th>Vencimiento</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($registrations as $registration)
                    <tr>
                        <td>
						
                            {{$registration->number}}

                        </td>  
                        <td>
                            
                            {{$registration->profession()}}
                        </td>                       
                        <td>
                        	{{$registration->entity()}}
                            
                        </td>
                        <td>
                        	{{date("d/m/Y",strtotime($registration->expiration))}}
                        </td>
                        <td> 
                        	<form id="delete-registration" action="{{ route('registration.delete',$registration) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger " type="submit">Eliminar</button>
                                    </form>
                        	  
                        </td>    
                    </tr>  
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection