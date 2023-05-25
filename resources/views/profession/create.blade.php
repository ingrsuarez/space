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
    </div>
    <div class="col-sm px-5">
 
    <div class="card mb-3">
        <div class="card-header text-white bg-primary">
            Listado de especialidades
            
        </div>
        <div class="card-body">
            
            <table class="table">
                <thead class="table-light">
                    <th>#</th>
                    <th>Nombre</th>
                    <th></th>
                </thead>
                <tbody>
              
                @foreach($professions as $profession)
                
                <tr>

                    <td>{{$profession->id}}</td> 
                    <td>{{ucfirst($profession->name)}}</td>
                    
                    <td width="10px">
                      <a class="btn btn-primary text-white" href="{{ route('profession.edit',$profession) }}">Editar</a>
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