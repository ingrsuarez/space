@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-4">
        
        <div class="col-sm" style="max-width: 28rem;">
            <form id="nuevo-trabajo" action="{{ route('institution.show') }}" method="POST" class="d-flex">
                @csrf
                <input class="form-control me-2 shadow-sm" name="name" type="search" placeholder="Nombre" aria-label="Search" >
                <input class="form-control me-2 shadow-sm" name="city" type="search" placeholder="Ciudad" aria-label="Search" >
                
                <button class="btn btn-outline-success shadow-sm" type="submit">Buscar</button>
            </form>
        </div>
        <div class="col-sm"></div>
    </div>

    <div class="col-sm px-1">
        <div class="card mb-3">
            <div class="card-header text-white bg-primary">
                Resultado de la búsqueda:
            </div>
            <div class="card-body  shadow">
                
                <table class="table">
                <thead class="table-light">
                  <th>Nombre</th>
                  <th>Ciudad</th>
                  <th>Dirección</th>
                  <th>Teléfono</th>
                  <th>Email</th>
                  <th></th>
                  <th></th>

                </thead>
                <tbody>
                    @if(isset($institutions))
                        @foreach($institutions as $institution)
                        <tr> 
                            <td>{{strtoupper($institution->name)}}</td>
                            <td>{{strtoupper($institution->city)}}</td>
                            <td>{{strtoupper($institution->address)}}</td>
                            <td>{{$institution->phone}}</td>
                            <td>{{$institution->email}}</td>
                            <td width="10px">

                            @if($user->hasInstitution($institution->id))    
                                <a class="btn btn-danger text-white" href="{{ route('institution.detach',$institution) }}">Eliminar</a>
                            @else
                                <a class="btn btn-info text-white" href="{{ route('institution.attach',$institution) }}">Agregar</a>
                            
                            @endif
                            </td>
                        </tr>   
                        @endforeach
                    @endif
                  
                </tbody>
              </table>
            </div>
        </div>
        <div class="card-footer">
            @if(isset($institutions))
             {!!$institutions->appends($search)->links()!!}

            @endif
        </div>

    </div>
</div>
@endsection