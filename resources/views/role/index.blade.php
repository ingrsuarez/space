@extends('layouts.app')

@section('content')

	<div class="col-sm px-5">
	    <div class="card mb-3">
	        <div class="card-header text-white bg-primary">
	            Roles
	        </div>
	        <div class="card-body"> 
	            <table class="table">
	                <thead class="table-light">
	                    <th>#</th>
	                    <th>Nombre</th>
	                    <th>Fecha</th>
	                    <th></th>
	                </thead>
	                <tbody>
		                @foreach($roles as $role)
			                
			                    <tr>
			                
				                    <td>{{$role->id}}</td> 
				                    <td>{{ucfirst($role->name)}}</td>
				                    <td>{{$role->created_at}}</td>
				                    <td width="10px">
				                      <a class="btn btn-primary text-white" href="{{ route('role.edit',$role) }}">Editar</a>
				                      
				                    </td>
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