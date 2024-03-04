<div>

    <div class="row justify-content-center mb-4">
        
        <div class="col-sm" style="max-width: 28rem;">
            <div class="d-flex">
                @csrf
                <input wire:model="dni" class="form-control me-2 shadow-sm" type="number" min="1" step="1" placeholder="DNI" aria-label="Search" >
                <input wire:model="name" class="form-control me-2 shadow-sm" type="text" placeholder="Nombre">
                <input wire:model="lastName" class="form-control me-2 shadow-sm" type="search" placeholder="Apellido" aria-label="Search" >
                
                
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
                    <th>#</th>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Cobertura</th>
                    <th>Último turno</th>

                </thead>
                <tbody>
                    @if(isset($pacientes))
                    @foreach($pacientes as $paciente)
                    <tr>
                      <td><div class="input-group-text">
                          <input type="checkbox" name="patient_id" value="{{$paciente->codPaciente}}">
                        </div></td>  
                        {{-- <td><a href="{{route("appointment.store",$paciente->idPaciente)}}"> {{$paciente->idPaciente}}</a></td>  --}}
                        <td><a href="{{route("ficha.index",$paciente->idPaciente)}}"> {{$paciente->idPaciente}}</a></td>
                        <td>{{strtoupper($paciente->nombrePaciente).' '.strtoupper($paciente->apellidoPaciente)}}</td>
                        <td>{{$paciente->celularPaciente}}</td>
                        <td>{{strtoupper($paciente->CoberturaPaciente)}}</td>
                        <td>{{$paciente->start}}</td>
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
