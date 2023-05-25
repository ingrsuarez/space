
@extends('layouts.app')

@section('content')
	@if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="card mb-3 mx-2 shadow">
        <div class="card-header text-white bg-primary">
            <label class="h5">Mis Matrículas:</label>               
        </div>
        <div class="card-body">
            <table class="table">
                <thead class="table-light">
                    <th>#</th>
                    <th>Especialidad</th>
                    <th>Entidad</th>
                    <th>Vencimiento</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($registrations as $registration)
                    <tr>
                        <td>
						
                            {{$registration->number}}

                        </td>  
                        <td>
                            
                            {{$registration->profession()}}
                        </td>                       
                        <td>
                        	{{$registration->entity()}}
                            
                        </td>
                        <td>
                        	{{date("d/m/Y",strtotime($registration->expiration))}}
                        </td>
                        <td> 
                        	<form id="delete-registration" action="{{ route('registration.delete',$registration) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger " type="submit">Eliminar</button>
                                    </form>
                        	  
                        </td>    
                    </tr>  
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection