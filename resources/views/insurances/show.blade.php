@extends('layouts.app')

@section('content')
@if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

<form id="nuevo-trabajo" action="{{ route('insurance.show') }}" method="POST">
@csrf
@method('PUT'){{-- This is to send to update controller method --}}
<div class="col-sm px-5">
    <div class="card mb-3">
        <div class="card-header text-white bg-primary">
            Listado de Obrasociales
            
        </div>
        <div class="card-body">
            
            <table class="table">
                <thead class="table-light">

                    <th>Nombre</th>
                    <th>Provincia</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th colspan="2"></th>
                </thead>
                <tbody>
              
                @foreach($insurances as $insurance)
                    <tr>
                        <td>{{ucwords($insurance->name)}}</td>
                        <td>{{ucwords($insurance->state)}}</td>
                        <td>{{$insurance->email}}</td>
                        <td>{{$insurance->phone}}</td>
                        <td>{{$insurance->status}}</td>
                        <td width="10px">
                        <a class="btn btn-primary text-white" href="{{ route('insurance.edit',$insurance) }}">Editar</a>
                        </td>
                        <td>
                        <a class="btn btn-danger text-white" href="{{ route('insurance.delete') }}">Eliminar</a>
                        </td>
                    </tr>   
                @endforeach
              
            </tbody>
          </table>
        </div>
        <div class="card-footer">
        
        </div>
    </div>
</div>
</form>
@endsection