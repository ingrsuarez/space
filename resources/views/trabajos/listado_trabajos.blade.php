@extends('layouts.app')

@section('content')
<form id="nuevo-trabajo" action="{{ route('nuevoTrabajo') }}" method="POST">
@csrf
<div class="col-sm px-5">
    <div class="card mb-3">
        <div class="card-header text-white bg-primary">
            Listado de trabajos
        </div>
        <div class="card-body">
            
            <table class="table">
            <thead class="table-light">
              <th>Fecha</th>
              <th>Título</th>
              <th>Descripción</th>
              <th>Finaliza</th>
              <th>Responsable</th>
              <th>Cliente</th>
              <th>Categoría</th>
              <th>Estado</th>
            </thead>
            <tbody>
              
               @foreach($trabajos as $trabajo)
               <tr>
                  <td>{{$trabajo->created_at}}</td> 
                  <td>{{$trabajo->titulo}}</td>
                  <td>{{$trabajo->descripcion}}</td>
                  <td>{{$trabajo->fecha_fin}}</td>
                  <td>{{$trabajo->creador}}</td>
                  <td>{{$trabajo->categoria}}</td>
                  <td>{{$trabajo->cliente}}</td>
                  <td>{{$trabajo->estado}}</td>
               </tr>   
               @endforeach
              
            </tbody>
          </table>
        </div>
    </div>
</div>
</form>
@endsection