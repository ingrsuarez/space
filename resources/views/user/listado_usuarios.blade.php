@extends('layouts.app')

@section('content')
<form id="nuevo-trabajo" action="{{ route('user.update',$users[0]) }}" method="POST">
@csrf
@method('PUT'){{-- This is to send to update controller method --}}
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
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th></th>
                </thead>
                <tbody>
              
                @foreach($users as $user)
                @if ($user->email_verified_at)
                    <tr>
                @else
                    <tr class="table-warning">
                @endif
                    <td>{{$user->id}}</td> 
                    <td>{{ucfirst($user->name)}}</td>
                    <td>{{ucfirst($user->lastName)}}</td>
                    @if ($user->email_verified_at)
                        <td>{{$user->email}}</td>
                    @else
                        <td>{{$user->email}} <span class="bg-warning">No verificado!</span></td>
                    @endif
                    <td>{{$user->telefono}}</td>
                    <td>{{$user->estado}}</td>
                    <td width="10px">
                      <a class="btn btn-primary text-white" href="{{ route('user.edit',$user) }}">Editar</a>
                    </td>
                </tr>   
                @endforeach
              
            </tbody>
          </table>
        </div>
        <div class="card-footer">
        @if(isset($users))
         {!!$users->links()!!}

        @endif
        </div>
    </div>
</div>
</form>
@endsection