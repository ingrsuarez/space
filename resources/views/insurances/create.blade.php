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
                Nueva Obrasocial: 
            </div>
            <div class="card-body">
                <form id="actualizar-ficha" action="{{ route('insurance.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nombre</span>
                        <input type="text" class="form-control" aria-label="Username" id="name" name="name" required>
                        <span class="input-group-text">Cuit:</span>
                        <input type="text" class="form-control" aria-label="Username"id="tax_id" name="tax_id" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">Teléfono</span>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="phone" name="phone" required>
                        <span class="input-group-text" id="email">Correo</span>
                        <input type="email" name="email" class="form-control" aria-label="email" aria-describedby="email">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Pais:</span>
                        <select class="form-select" name="cobertura" id="cobertura" required>
                            <option value="argentina">Argentina</option>
                            <option value="chile">Chile</option>
                            <option value="uruguay">Uruguay</option>								
                        </select>
                        <span class="input-group-text">Localidad</span>
                        <input type="text" class="form-control" aria-label="Username"id="localidad" name="localidad">	                  
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Domicilio</span>
                        <input type="text" class="form-control" aria-label="Username" id="domicilio" name="domicilio">
                        <span class="input-group-text"></span>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
                        <button class="btn btn-outline-success " type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection