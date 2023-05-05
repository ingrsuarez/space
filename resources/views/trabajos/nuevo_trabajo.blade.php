@extends('layouts.app')

@section('content')
<form id="nuevo-trabajo" action="{{ route('storeTrabajo') }}" method="POST">
@csrf
<div class="col-sm px-5">
    <div class="card mb-3" style="max-width: 28rem;">
        <div class="card-header text-white bg-primary">
            Nuevo trabajo
        </div>
        <div class="card-body">
            
            <div class="input-group mb-3">
              <label class="input-group-text" for="cliente">Cliente</label>
              <select class="form-select" id="cliente" name="cliente">
                <option selected>Seleccione...</option>
                <option value="1">IPAC</option>
                <option value="2">PARTICULAR</option>
                <option value="3">YPF</option>
              </select>
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1">Título</span>
              <input type="text" class="form-control" placeholder="Título" aria-label="Username" aria-describedby="basic-addon1" id="titulo" name="titulo">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text">Descripción</span>
              <textarea class="form-control" name="descripcion" id="descripcion" aria-label="With textarea"></textarea>
            </div>
            <div class="input-group mb-3">
              <input type="date" name="fecha_fin" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
              <span class="input-group-text" id="basic-addon2">Fecha de finalización</span>
            </div>

            <label for="basic-url" class="form-label">Your vanity URL</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
              <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
            </div>

            <div class="input-group mb-3">
              <span class="input-group-text">$</span>
              <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
              <span class="input-group-text">.00</span>
            </div>

            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Username" aria-label="Username">
              <span class="input-group-text">@</span>
              <input type="text" class="form-control" placeholder="Server" aria-label="Server">
            </div>

            
        </div>
        <div class="d-grid gap-2 col-6 mx-auto py-2">
            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        </div>
    </div>
</div>
</form>
@endsection