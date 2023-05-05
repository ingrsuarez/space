@extends('layouts.app')

@section('content')
<form id="nuevo-trabajo" action="{{ route('usuarios') }}" method="POST">
@csrf
<div class="col-sm px-5">
    <div class="card mb-3">
        <div class="card-header text-white bg-primary">
            Listado de usuarios
        </div>
        <div class="card-body">
            
            <table class="table">
            <thead class="table-light">
              <th>#</th>
              <th>Nombre</th>
              <th>Email</th>
              <th>Teléfono</th>
              <th>Ingreso</th>
              <th>Fecha Nacimiento</th>
              <th>Estado</th>
            </thead>
            <tbody>
              
               @foreach($users as $user)
               <tr>
                  <td>{{$user->id}}</td> 
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->telefono}}</td>
                  <td>{{$user->fechaing}}</td>
                  <td>{{$user->fechanac}}</td>
                  <td>{{$user->estado}}</td>
               </tr>   
               @endforeach
              
            </tbody>
          </table>
        </div>
    </div>
</div>
</form>
@endsection