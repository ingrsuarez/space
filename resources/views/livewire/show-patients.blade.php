<div>
    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="row my-2">

        @can('profession')
        <div class="col-md-4">
        @else
        <div class="col-md-8">
        @endcan    
            <div class="card mb-4 shadow-sm" style="max-width: 48rem;">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                    <div class="accordion-item ">
                        <h2 class="accordion-header card-header text-white" id="panelsStayOpen-headingOne">
                        <button class="accordion-button collapsed text-white bg-primary" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            <div>
                                 <strong>Pacientes en espera: {{$wating_institution}}</strong>
                            </div>
                        </button>
                        </h2> 
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body"> 
                                
                                    <div class="card-body">                
                                        @can('wating.list')
                                            <p class="card-text">
                                            @if(!empty($institution))    
                                            @foreach($watingMe as $paciente)
                                                @php $insuranceName = explode(" ",$paciente->insurance);@endphp
                                                @if($paciente->institution_id == $institution->id)
                                                    {{(($loop->index)+1).' - '}}  
                                                    <a href="{{route("ficha.index",$paciente->idPaciente)}}"> 
                                                    {{strtoupper($paciente->apellidoPaciente).' '.
                                                    strtoupper($paciente->nombrePaciente)}}
                                                    </a>{{' - '.$insuranceName[0]}}<br>
                                                @endif
                                            @endforeach
                                            @endif
                                            </p>
                                        @else                        
                                            
                                            <table class="table">
                                                <thead class="table-light">
                                                    <th>Profesional</th>
                                                    <th>Paciente</th>
                                                    <th>Hora de ingreso</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                @if(!empty($professionals))   
                                                    @foreach($professionals as $professional) 

                                                        @if ($professional->hasRole('profesional') && (!empty($institution)))
                                                                    
                                                            @foreach($professional->watingMe as $paciente)
                                                                @if($paciente->pivot->institution_id == $institution->id)
                                                                <tr>
                                                                    <td>
                                                                        
                                                                            {{strtoupper($professional->name.' '.$professional->lastName)}}
                                                                        
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{route("ficha.index",$paciente->idPaciente)}}">
                                                                            {{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}    
                                                                        </a>
                                                                    </td>
                                                                    
                                                                    <td>{{($paciente->pivot->created_at)->format('H:i:s A')}}</td>
                                                                    <td><a class="btn btn-danger text-white" href="{{ route('wating.detach',['paciente'=>$paciente,'institution'=>$institution]) }}">Quitar</a></td>
                                                                </tr>
                                                                @endif
                                                            @endforeach
                                                            
                                                        @endif
                                                    @endforeach
                                                @endif   
                                                </tbody>
                                            </table>    

                                        @endcan    
                                    
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        

        </div>
        @can('profession')
        <div class="col-sm-4">
            <div class="card mb-3 shadow-sm">
                <div class="card-header">{{ __('Pacientes atendidos el último mes') }}</div>

                <div class="card-body">
                    Total: {{ $ultimosPacientes }}
                </div>
            </div>
        </div>
        @endcan
        <div class="col-md-4">
            <div class="card text-white bg-secondary mb-3 shadow-sm" style="max-width: 18rem;">
                  <div class="card-header"><i class="fa-solid fa-hospital mx-2"></i> 
                    INSTITUCIÓN:    
                    
                  <div class="card-body">
                    <h5 class="card-title"></h5>

                    <select class="form-select" wire:change="changeEvent($event.target.value)">
                        @if(isset($institution))
                            <option value="{{$institution->id}}">{{strtoupper($institution->name)}}</option>
                            @if(isset($userInstitutions))
                                @foreach($userInstitutions as $userInstitution)
                                    @if($institution->id != $userInstitution->id)
                                    <option value="{{$userInstitution->id}}">{{strtoupper($userInstitution->name)}}</option>
                                    @endif
                                @endforeach
                            @endif
                        @else
                            <option value="">Seleccione institución</option>
                            @foreach($userInstitutions as $userInstitution)
                                   
                                <option value="{{$userInstitution->id}}">{{strtoupper($userInstitution->name)}}</option>
                                    
                            @endforeach    

                        @endif    
                    </select>
                  </div>
                </div>

            </div>
        </div>    
    </div>




    <div class="row justify-content-center mb-4">
        
        <div class="col-sm" style="max-width: 28rem;">
            <div class="d-flex">
                @csrf
                <input wire:model="dni" class="form-control me-2 shadow-sm" name="dni" type="search" placeholder="DNI" aria-label="Search" >
                <input wire:model="name" class="form-control me-2 shadow-sm" name="nombre" type="text" placeholder="Nombre">
                <input wire:model="lastName" class="form-control me-2 shadow-sm" name="apellido" type="search" placeholder="Apellido" aria-label="Search" >
                <a href="{{route('paciente.create')}}" class="btn btn-primary me-2 shadow-sm" aria-label="Search">Nuevo</a>
                
            </div>
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
                        <th>DNI</th>
                        <th>Apellido</th>
                        <th>Nombre</th>
                        <th class="d-none d-md-table-cell">Teléfono</th>
                        <th>Cobertura</th>
                        <th  class="d-none d-md-table-cell">Nro. Afiliado</th>

                    </thead>
                    <tbody>
                        
                        @if(isset($pacientes))
                        @foreach($pacientes as $paciente)
                        @php $insuranceName = explode(" ",$paciente->cobertura);@endphp
                        <tr>
                            <td><a href="{{route("ficha.index",$paciente->idPaciente)}}"> {{$paciente->idPaciente}}</a></td> 
                            <td>{{strtoupper($paciente->apellidoPaciente)}}</td>
                            <td>{{strtoupper($paciente->nombrePaciente)}}</td>
                            <td class="d-none d-md-table-cell">{{$paciente->celularPaciente}}</td>
                            <td>{{$insuranceName[0]}}</td>
                            <td class="d-none d-md-table-cell">{{$paciente->numeroAfiliadoPaciente}}</td>
                        </tr>   
                        @endforeach
                        @endif
                  
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            @if(isset($paciente))
             {!!$pacientes->links()!!}

            @endif
        </div>

    </div>
</div>

