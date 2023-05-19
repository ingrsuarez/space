

<div class="col-sm px-1">
    <div class="card mb-3">
        <div class="card-header text-white bg-primary">
            Resultado de la búsqueda:
        </div>
        <div class="card-body">
            
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
         {!!$pacientes->appends($search)->links()!!}

        @endif
    </div>

</div>

    