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
                Nueva Planilla: 
            </div>
            <div class="card-body">
              	<form id="actualizar-ficha" action="{{ route('sheet.store') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text">Nombre</span>
						<input type="text" class="form-control" aria-label="name"id="name" name="name" autofocus>
						<span class="input-group-text">Ruta</span>
						<input type="text" class="form-control" aria-label="route" id="route" name="route">			
                	</div>
                	<div class="input-group mb-3">
						<span class="input-group-text" id="email">Tabla</span>
                  		<input type="text" name="table_name" class="form-control" aria-label="table_name" aria-describedby="table_name">
                  		<span class="input-group-text" id="telefono">Modelo</span>
                  		<input type="text" class="form-control" aria-label="model" aria-describedby="model" id="model" name="model">
                  		
                	</div>
	                
	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>
    <div class="col-sm px-5">
        <div class="card mb-3 shadow">
            <div class="card-header text-white bg-info">
                Listado de Planillas
                
            </div>
            <div class="card-body">
                
                <table class="table table-striped">
                    <thead class="table-light">
                        <th>Nombre</th>
                        <th>Ruta</th>
                        <th class="d-none d-lg-table-cell">Tabla</th>
                        <th class="d-none d-lg-table-cell">Modelo</th>
                        <th></th>
                    </thead>
                    <tbody>
                
                    @foreach($sheets as $sheet)

                        <tr>   
                            <td>{{ucfirst($sheet->name)}}</td>
                            <td>{{$sheet->route}}</td>
                            <td class="d-none d-lg-table-cell">{{$sheet->table_name}}</td>
                            <td class="d-none d-lg-table-cell">{{$sheet->model}}</td>
                            <td width="10px">
                            <a class="btn btn-primary text-white" href="{{ route('sheet.index',$sheet) }}">Editar</a>
                            </td>
                        </tr>   
                    @endforeach
                
                </tbody>
            </table>
            </div>

        </div>
    </div>	
@endsection