@extends('layouts.app')

@section('content')
	@if (session('success'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    {{-- @foreach ( $notes as $note)
    {{var_dump($note)}}
    @endforeach --}}
	<div class="col-sm px-5">
    	<div class="card mb-3" style="max-width: 50rem;">
    		<div class="card-header text-white bg-primary">
                Nueva Nota: 
            </div>
            <div class="card-body">
              	<form id="create-permission" action="{{ route('note.store') }}" method="POST">
            		@csrf
            		<div class="input-group mb-3">
						<span class="input-group-text">Título</span>
						<input type="text" class="form-control" id="title" name="title">
                        <span class="input-group-text">Nota:</span>
						<input type="text" class="form-control" id="note" name="note">
                        <input type="hidden" class="form-control" id="institution" name="institution" value="{{$institution->id}}">
	                </div>
                    @if ($user->hasRole('profesional'))
                        <div class="input-group mb-3">
                            <input type="hidden" class="form-control" id="professional" name="professional" value="{{$user->id}}">
                            
                        </div>
                    @else
                        <div class="input-group mb-3">
                            <select class="form-select" name="professional" id="professional" required>
                                
                                @foreach ($users as $professional)
                                    @if ($professional->hasRole('profesional'))
                                        <option value="{{$professional->id}}"> {{ucwords($professional->name.' '.$professional->lastName)}}	</option>							
                                    @endif            
                                @endforeach	
                                
                            </select>
                        </div>
                    @endif
	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>
    <div class="col-sm px-5 py-2">
	    <div class="card mb-4  shadow">
	        <div class="card-header text-white bg-primary">
	            Notas:
	        </div>
	        <div class="card-body"> 
	            <table class="table">
	                <thead class="table-light">
	                    <th class="d-none d-md-table-cell">Título</th>
	                    <th class="w-25">Nota</th>
                        @if(!$user->hasRole('profesional'))
                            <th>Nombre</th>
                        @endif
	                    <th class="d-none d-md-table-cell">Fecha</th>
	                    <th colspan="2"></th>
	                </thead>
	                <tbody>
		            @foreach($notes as $note)   
                        <tr>
                            
                            <td class="d-none d-md-table-cell">{{Str::ucfirst($note->title)}}</td> 
                            <td class="w-25">{{Str::ucfirst($note->note)}}</td>
                            @if(!$user->hasRole('profesional'))
                                <td>{{ucwords($note->lastName.' '.$note->name)}}</td>
                            @endif
                            <td class="d-none d-md-table-cell">{{date("d-m-Y", strtotime($note->created_at))}}</td>
                            <td>
                                <a class="btn btn-primary text-white" href="">Editar</a>
                                
                                <a class="btn btn-danger text-white" href="{{route('note.delete',[$note->note_id])}}">Eliminar</a>    
                            </td>
                        </tr>   
		            @endforeach   
	              
	            	</tbody>
	          	</table>
	        </div>
        </div>
    </div>
@endsection