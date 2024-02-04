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
                Nueva Profesión: 
            </div>
            <div class="card-body">
              	<form id="actualizar-ficha" action="{{ route('profession.store') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text">Nombre</span>
						<input type="text" class="form-control" id="nombre" name="name">
	                </div>

	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
        <div class="card mb-3">
            <div class="card-header text-white bg-primary">
                <label class="h5">Mis Especialidades:</label>               
            </div>
            <div class="card-body">
                

                <table class="table">
                    <thead class="table-light">
                        <th>#</th>
                        <th>Nombre</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($professions as $profession)
                        <tr>
                            <td>
                               @if($user->hasProfession($profession->id) )
                                <input type="checkbox" name="roles[]" value="{{$profession->id}}" onclick="return false;" checked>
                               @else 
                                <input type="checkbox" name="roles[]" value="{{$profession->id}}" disabled>
                               @endif
                            </td>  
                            <td>
                                
                                {{ucfirst($profession->name)}}
                            </td>                       
                            <td>
                                <div class="btn-group" role="group">
                                    <a class="btn btn-primary text-white mx-2" href="{{ route('profession.add',$profession) }}">Agregar</a>
                                    <form id="agregar-especialidad" action="{{ route('profession.detach',$profession) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger " type="submit">Eliminar</button>
                                    </form>
                                </div>
                            </td>      
                        </tr>  
                        
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @if(isset($professions))
                 {!!$professions->links()!!}

                @endif
            
            </div>
            
        </div>
    
    </div>
    	
@endsection