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
                      @if($paciente->sexoPaciente == 'f')  
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
                  Planilla Psicológica: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
              </div>
            </button>
          </h2>
          <div id="Sheet-collapseOne" class="accordion-collapse collapse" aria-labelledby="Sheet-headingOne">
            <div class="accordion-body">
              <div class="card mb-3 shadow" >
                
                <div class="card-body">
                  <form id="actualizar-ficha" action="{{ route('psychological.save',$paciente->codPaciente) }}" method="POST">
                    @csrf
                    @method('post')
                    
                    <div class="card-header text-white bg-primary bg-gradient mb-2">
                        DATOS GENERALES
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">Nombre</span>
                        <input type="text" class="form-control" id="name" name="name" value="{{ucfirst($paciente->nombrePaciente)}}" readonly>
                        <span class="input-group-text">Apellido</span>
                        <input type="text" class="form-control" name="apellido" value="{{ucfirst($paciente->apellidoPaciente)}}" readonly>
                        <span class="input-group-text" id="edad">Edad</span>
                        <input type="text" class="form-control" id="edad" name="edad" value="{{$edad}}" readonly>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">PESO (KG)</span>
                        <input type="text" class="form-control" id="peso" name="peso">
                        <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                        <span class="input-group-text">PESO MÁXIMO:</span>
                        <select class="form-select" name="peso_maximo" id="peso_maximo" required>
                            <option value="si">Si </option>
                            <option value="no">No </option>
                        </select>
                      
                        
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="edad">INTENCIÓN DE CIRUGÍA:</span>
                        <input type="text" class="form-control" id="intencion_cirugia" name="intencion_cirugia">
                
                    </div>
                    <div class="card-header text-white bg-primary bg-gradient mb-2">
                        REGISTRO DE SOBREPESO
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">ANTECEDENTES:</span>
                      <input type="text" class="form-control" id="antecedentes" name="antecedentes">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">TRATAMIENTO PSICOLÓGICO:</span>
                      <input type="text" class="form-control" id="tto_psicologico" name="tto_psicologico">
                      
                    </div> 
                    <div class="input-group mb-3">
                        <span class="input-group-text">TRATAMIENTO PSIQUIÁTRICO:</span>
                        <input type="text" class="form-control" id="tto_psiquiatrico" name="tto_psiquiatrico">
                    </div> 

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">CONDUCTA ALIMENTARIA:</span>
                      <input type="text" class="form-control" id="conducta_alimentaria" name="conducta_alimentaria">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ATRACÓN:</span>
                      <input type="text" class="form-control" id="atracon" name="atracon">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">COMEDOR NOCTURNO:</span>
                      <input type="text" class="form-control" id="comedor_nocturno" name="comedor_nocturno">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ACTIVIDAD FÍSICA:</span>
                      <input type="text" class="form-control" id="actividad_fisica" name="actividad_fisica">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">TRABAJO/OCUPACIÓN:</span>
                      <input type="text" class="form-control" id="trabajo" name="trabajo">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">FAMILIA:</span>
                      <input type="text" class="form-control" id="familia" name="familia">
                      
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">PÉRDIDAS/DUELOS:</span>
                        <input type="text" class="form-control" id="perdidas" name="perdidas">
                        
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">TRATAMIENTOS ANTERIORES:</span>
                        <input type="text" class="form-control" id="tto_anteriores" name="tto_anteriores">
                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">LIMITACIONES:</span>
                        <input type="text" class="form-control" id="limitaciones" name="limitaciones">
                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">EVOLUCIÓN:</span>

                        <textarea class="form-control" id="nueva-atencion" rows="3" name="evolucion" required></textarea>

                    
                    </div>

                    <div class="d-grid gap-2 col-4 ms-auto py-2">
                      <button type="submit" class="btn btn-sm btn-primary text-white">Guardar Planilla</button>
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
                <th>Peso</th>
                <th>Peso Máximo</th>
                <th>Intención de cirugía</th>

                <th></th>
            </thead>
            <tbody>  
              @foreach($psychological_sheets as $sheet)
                {{-- @if($paciente->codPaciente == $sheet->paciente_id)   --}}
                <tr>   
                  <td>{{date('d-m-Y',strtotime($sheet->created_at))}}</td>
                  <td>{{ucwords($sheet->user->name.' '.$sheet->user->lastName)}}</td>
                  <td>{{$sheet->peso}}</td>
                  <td>{{$sheet->peso_maximo}}</td>
                  <td class="d-none d-lg-table-cell">{{$sheet->intencion_cirugia}}</td>

                  <td width="10px">
                  {{-- <a class="btn btn-primary text-white" href="{{ route('sheet.index',$sheet) }}">Editar</a> --}}
                  <td style="width:15%"> 
                          <a class="btn btn-info text-white" 
                          href="{{route('psychological.edit',$sheet->id)}}">Editar</a>
                          <a class="btn btn-warning text-white" 
                          href="{{route('psychological.pdf',$sheet->id)}}" target="_blank">Imprimir</a>
                      </td>
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