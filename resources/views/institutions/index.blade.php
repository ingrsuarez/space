@extends('layouts.app')

@section('content')
@if (session('message'))
    <div class="col-sm px-5">
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
<div class="col-sm px-5">
    <div class="card mb-3">
        <div class="card-header text-white bg-primary">
            Listado de Instituciones
            
        </div>
        <div class="card-body">
            
            <table class="table">
                <thead class="table-light">
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Ciudad</th>
                    <th>Domicilio</th>
                    <th>Estado</th>
                    <th></th>
                </thead>
                <tbody>
              
                @foreach($institutions as $institution)
                @if ($institution->status)
                    <tr>
                @else
                    <tr class="table-warning">
                @endif
                     
                    <td>{{ucfirst($institution->name)}}</td>
                    <td>{{$institution->email}}</td>
                    <td>{{$institution->phone}}</td>
                    <td>{{$institution->city}}</td>
                    <td>{{$institution->address}}</td>
                    <td>{{$institution->status}}</td>
                    <td width="10px">
                      <a class="btn btn-primary text-white" href="{{ route('institution.edit',$institution) }}">Editar</a>
                    </td>
                </tr>   
                @endforeach
              
            </tbody>
          </table>
        </div>
        <div class="card-footer">
        @if(isset($institutions))
         {!!$institutions->links()!!}

        @endif
        </div>
    </div>
</div>

@endsection