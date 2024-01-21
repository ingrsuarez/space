@extends('layouts.app')

@section('content')
  
  @if (session('error'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ session('error') }}</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  @if (session('message'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="max-width: 50rem;">
      <strong>{{ session('message') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif


  <div class="col-sm px-5 mb-3" style="max-width: 50rem;">
    <div class="accordion" id="accordionPanelsStayOpenExample">
      <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
            <div class="">
                Ficha Paciente: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
            </div>
          </button>
        </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
          <div class="accordion-body">
            <div class="card mb-3 shadow" >
              
              <div class="card-body">
                <form id="actualizar-ficha" action="{{ route('paciente.update',$paciente->idPaciente) }}" method="POST">
                  @csrf
                  @method('put')
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="dni">DNI</span>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="dni" name="dni" value="{{$paciente->idPaciente}}" readonly>
                    <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                    <span class="input-group-text" id="edad">Edad</span>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="edad" value="{{$edad}}" readonly>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Nombre</span>
                    <input type="text" class="form-control" aria-label="Username" id="nombre" name="nombre" value="{{ucfirst($paciente->nombrePaciente)}}">
                    <span class="input-group-text">Apellido</span>
                    <input type="text" class="form-control" aria-label="Username"id="apellido" name="apellido" value="{{ucfirst($paciente->apellidoPaciente)}}">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="telefono">Celular</span>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="telefono" name="telefono" value="{{$paciente->celularPaciente}}">
                    <span class="input-group-text" id="email">Correo</span>
                    <input type="email" name="email" class="form-control" aria-label="email" aria-describedby="email" value="{{$paciente->emailPaciente}}">
                    
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="edad">Cobertura médica</span>
                    <select class="form-select" name="insurance_id" id="insurance_id" required>
                      @isset($paciente->insurance_id)
                        <option value="{{$paciente->insurance_id}}">{{$paciente->insurance->name}}
                      @endisset
                        @foreach ($insurances as $insurance)
                          <option value="{{$insurance->id}}"> {{ucfirst($insurance->name)}}								
                        @endforeach	
                      
                    </select>
                    <span class="input-group-text" id="edad">Número Afiliado</span>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="edad" name="numeroAfiliado" value="{{$paciente->numeroAfiliadoPaciente}}">
                    
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Ocupación:</span>
                    <input type="text" class="form-control" aria-label="Username" id="ocupacion" name="ocupacion" value="{{$paciente->ocupacionPaciente}}">
                    <span class="input-group-text">Sexo:</span>
                    <select class="form-select" name="sexo" id="sexo" required>
                      @if(($paciente->sexoPaciente == 'F') or ($paciente->sexoPaciente == 'f'))  
                        <option value="f" selected>Femenino</option>
                        <option value="m">Masculino</option>
                        @else
                        <option value="f">Femenino</option>
                        <option value="m"selected>Masculino</option>
                        @endif
                    </select>
                          </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="edad">Domicilio</span>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="domicilio" name="domicilio" value="{{$paciente->domicilioPaciente}}">
                    <span class="input-group-text" id="localidad">Localidad</span>
                    <input type="text" class="form-control" aria-label="Username" aria-describedby="localidad" id="localidad" name="localidad" value="{{$paciente->localidadPaciente}}">
                    
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="fechaNacimiento">Fecha de Nacimiento</span>
                    <input type="date" class="form-control" aria-label="Username" aria-describedby="fechaNacimiento" id="domicilio" name="fechaNacimiento" value="{{$paciente->fechaNacimientoPaciente}}">
                  </div>
                  <div class="d-grid gap-2 col-4 ms-auto py-2">
                    <button type="submit" class="btn btn-sm btn-primary text-white">Actualizar Ficha</button>
                  </div>
                </form>

                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  @can('ficha')
    <div class="col-sm px-5 mb-3">
      <div class="accordion" id="accordionSheet">
        <div class="accordion-item">
          <h2 class="accordion-header" id="Sheet-headingOne">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Sheet-collapseOne" aria-expanded="true" aria-controls="Sheet-collapseOne">
              <div class="">
                  Evolución Kinesiología: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
              </div>
            </button>
          </h2>
          <div id="Sheet-collapseOne" class="accordion-collapse collapse" aria-labelledby="Sheet-headingOne">
            <div class="accordion-body">
              <div class="card mb-3 shadow" >
                
                <div class="card-body">
                    <form id="actualizar-ficha" action="{{ route('kinesiology.save',$paciente->codPaciente) }}" method="POST">
                        @csrf
                        @method('post')
                        <div class="input-group mb-3">
                        <span class="input-group-text" id="dni">Evolución:</span>
                        <textarea class="form-control" id="evolution" rows="5" name="evolution" MaxLength="512" required></textarea>
                        <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                        </div>
                        

                        <div class="d-grid gap-2 col-2 ms-auto py-2">
                        <button type="submit" class="btn btn-sm btn-primary text-white">Guardar</button>
                        </div>
                    </form>

                    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endcan
  <div class="col-sm px-5">
    <div class="card mb-3 shadow">
        <div class="card-header text-white bg-info">
            Historial de Planillas
            
        </div>
        <div class="card-body">
            
          <table class="table table-striped">
            <thead class="table-light">
                <th>Fecha</th>
                <th>Profesional</th>
                <th>Evolución</th>
                <th></th>
            </thead>
            <tbody>  
              @foreach($kinesiology_sheets as $sheet)
                {{-- @if($paciente->codPaciente == $sheet->paciente_id)   --}}
                <tr>   
                  <td style="min-width:120px">{{date('d-m-Y',strtotime($sheet->created_at))}}</td>
                  <td>{{ucwords($sheet->user->name.' '.$sheet->user->lastName)}}</td>
                  <td>{{ucfirst($sheet->evolution)}}</td>
                  <td style="width:20%"> 
                    <a class="btn btn-info text-white" 
                    href="{{route('kinesiology.edit',$sheet->id)}}">Editar</a>
                    <a class="btn btn-warning text-white" 
                    href="{{route('kinesiology.pdf',$sheet->id)}}" target="_blank">Imprimir</a>
                      
                  </td>
                </tr>
                {{-- @endif    --}}
              @endforeach
          
            </tbody>
          </table>
        </div>

    </div>
  </div>	





  <script>

    function calculate(){
    var peso = document.getElementById("peso").value;
    var altura = document.getElementById("altura").value;
    imc = peso / (altura*altura);    
    if (imc != Infinity)
    {
        document.getElementById("imc").value= imc.toFixed(2);
    }
        
    }



  </script>







  @endsection