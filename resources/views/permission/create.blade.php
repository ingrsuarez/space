@extends('layouts.app')

@section('content')
	@if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
	<div class="col-sm px-5">
    	<div class="card mb-3" style="max-width: 50rem;">
    		<div class="card-header text-white bg-primary">
                Nuevo Permiso: 
            </div>
            <div class="card-body">
              	<form id="create-permission" action="{{ route('permission.store') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text">Nombre</span>
						<input type="text" class="form-control" id="name" name="name">
	                </div>

	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>













@endsection