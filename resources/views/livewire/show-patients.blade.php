<div>

    <div class="row justify-content-center my-4">
        <div class="col-sm">
            <div class="card mb-3 shadow-sm">
                <div class="card-header">{{ __('Pacientes atendidos el último mes') }}</div>

                <div class="card-body">
                    Total: {{ $ultimosPacientes }}
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card mb-3 shadow-sm" style="max-width: 18rem;">
              <div class="card-header text-white bg-primary">Pacientes en espera:</div>
              <div class="card-body">
                <h5 class="card-title">Total de pacientes en espera: </h5>
                <p class="card-text">Según agenda del día.</p>
              </div>
            </div>
        </div>
        <div class="col">
            <div class="card text-white bg-secondary mb-3 shadow-sm" style="max-width: 28rem;">
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




    <div class="row justify-content-center mb-4">
        
        <div class="col-sm" style="max-width: 28rem;">
            <div class="d-flex">
                @csrf
                <input wire:model="dni" class="form-control me-2 shadow-sm" name="dni" type="search" placeholder="DNI" aria-label="Search" >
                <input wire:model="name" class="form-control me-2 shadow-sm" name="nombre" type="text" placeholder="Nombre">
                <input wire:model="lastName" class="form-control me-2 shadow-sm" name="apellido" type="search" placeholder="Apellido" aria-label="Search" >
                
                
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
                  <th>Teléfono</th>
                  <th>Fecha de nacimiento</th>
                  <th>Email</th>

                </thead>
                <tbody>
                    @if(isset($pacientes))
                    @foreach($pacientes as $paciente)
                    <tr>
                      <td><a href="{{route("ficha.index",$paciente->idPaciente)}}"> {{$paciente->idPaciente}}</a></td> 
                      <td>{{strtoupper($paciente->apellidoPaciente)}}</td>
                      <td>{{strtoupper($paciente->nombrePaciente)}}</td>
                      <td>{{$paciente->celularPaciente}}</td>
                      <td>{{$paciente->fechaNacimientoPaciente}}</td>
                      <td>{{$paciente->emailPaciente}}</td>
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
