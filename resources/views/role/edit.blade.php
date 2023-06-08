
@extends('layouts.app')

@section('content')
	@if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-sm px-5">
        <div class="card mb-3">
            <div class="card-header text-white bg-primary">
                Rol:    <strong>{{ucfirst($role->name)}}</strong>
            </div>
            <div class="card-body"> 
                <table class="table">
                    <thead class="table-light">
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th colspan="2"></th>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            
                                <tr>
                            
                                    <td>{{$permission->id}}</td> 
                                    <td>{{ucfirst($permission->name)}}</td>
                                    <td>{{$permission->created_at}}</td>
                                    <td width="10px">
                                               
                                            @if($role->hasPermissionTo($permission->id))    
                                                <a class="btn btn-danger text-white" href="{{ route('permission.detach',[$permission,$role]) }}">Quitar</a>
                                            @else
                                                <a class="btn btn-info text-white" 
                                                href="{{ route('permission.attach',[$permission,$role]) }}">
                                                    Agregar</a>
                                            
                                            @endif
                                            </td>
                                    <td>
                                </tr>   
                        @endforeach
                  
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
    {{--         @if(isset($roles))
             {!!$roles->links()!!}

            @endif --}}
            </div>
        </div>    
    </div>

@endsection
