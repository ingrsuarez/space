@extends('layouts.app')

@section('content')
@if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ session('error') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>{{ session('message') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    <div class="col-sm px-5">
        <div class="card mb-3 shadow" style="max-width: 50rem;">
            <div class="card-header text-white bg-primary">
                Nueva habitación: 
            </div>
            <div class="card-body">
                <form id="actualizar-ficha" action="{{ route('room.store') }}" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nombre</span>
                        <input type="text" class="form-control" aria-label="Username" id="name" name="name" required>
                        <span class="input-group-text">Estado:</span>
                        <select class="form-select" name="status" id="status" required>
                            <option value="active">Activo</option>
                            <option value="inactive">Inactivo</option>							
                        </select>  
                        <input type="hidden" class="form-control"> 
                    </div>
                    <div class="input-group mb-3">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Descripción:</span>
                        <input type="text" class="form-control" aria-label="Username"id="description" name="description" required>
                        <input type="hidden" class="form-control" aria-label="Username"id="institution_id" name="institution_id" value="{{$institution->id}}">              
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
                        <button class="btn btn-outline-success " type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<form id="nuevo-trabajo" action="" method="POST">
@csrf
@method('PUT'){{-- This is to send to update controller method --}}
<div class="col-sm px-5">
    <div class="card mb-3">
        <div class="card-header text-white bg-primary">
            Listado de habitaciones: {{strtoupper($institution->name)}}
            
        </div>
        <div class="card-body">
            
            <table class="table">
                <thead class="table-light">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th colspan="2"></th>
                </thead>
                <tbody>
              
                @foreach($rooms as $room)
                @if ($room->status = 'active')
                    <tr>
                @else
                    <tr class="table-warning">
                @endif
                    <td>{{$room->name}}</td> 
                    <td>{{ucfirst($room->description)}}</td>
                    <td>{{ucfirst($room->status)}}</td>
                    <td width="10px">
                        <a class="btn btn-primary text-white" href="">Editar</a>
                    </td>
                    <td>
                        <a class="btn btn-danger text-white" href="{{ route('room.delete',[$room]) }}">
                            Eliminar
                        </a>
                    </td>
                </tr>   
                @endforeach
              
            </tbody>
          </table>
        </div>
        <div class="card-footer">
        {{-- @if(isset($rooms))
         {!!$rooms->links()!!}

        @endif --}}
        </div>
    </div>
</div>
</form>
{{-- <div class="col-sm px-5">
    @livewire('show-rooms', ['institution' => $institution, 'rooms' => $rooms])
</div> --}}

@endsection

{{-- {{ route('room.update')}}
{{ route('room.edit',$room) }}
{{ route('room.delete',[$room,'page='.$rooms->currentPage()]) }} --}}