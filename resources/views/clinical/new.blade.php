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
                        @foreach ($insurances as $insurance_option)
                          <option value="{{$insurance_option->id}}"> {{ucfirst($insurance_option->name)}}								
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
                  Planilla clínica: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
              </div>
            </button>
          </h2>
          <div id="Sheet-collapseOne" class="accordion-collapse collapse" aria-labelledby="Sheet-headingOne">
            <div class="accordion-body">
              <div class="card mb-3 shadow" >
                
                <div class="card-body">
                  <form id="actualizar-ficha" action="{{ route('clinical.save',$paciente->idPaciente) }}" method="POST">
                    @csrf
                    @method('post')
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="dni">SCORE FIBROSCAN</span>
                      <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="fibroscan" name="fibroscan">
                      <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                      <input type="hidden" name="insurance_id" value="{{$insurance->id}}">
                      <span class="input-group-text" id="edad">SCORE EFCA</span>
                      <input type="text" class="form-control" aria-label="efca" aria-describedby="efca" id="efca" name="efca">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">CX BARIÁTRICA:</span>
                      <select class="form-select" name="cx_bariatrica" id="cx_bariatrica" required>
                          <option value="si">Si </option>
                          <option value="no">No </option>
                          <option value="no sabe">No sabe</option>
                      </select>
                      <span class="input-group-text"></span>
                      
                    </div>
                    <strong>Antecedentes personales:</strong>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">HTA</span>
                      <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="hta" name="hta">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">DBT</span>
                      <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="dbt" name="dbt">
                      
                    </div> 
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">CX</span>
                      <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="cx" name="cx">
                      
                    </div> 

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">OTROS ANTECEDENTES</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="otros" id="otros" name="otros">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">OAM</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="oam" id="oam" name="oam">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">GINECOLOGO</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="ginecologo" id="ginecologo" name="ginecologo">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">VACUNAS COVID</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="vacunas" id="vacunas" name="vacunas">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">HISTORIA DE OBESIDAD</span>
                      {{-- <input type="text" class="form-control" aria-label="otros" aria-describedby="obesidad" id="obesidad" name="obesidad"> --}}
                      <textarea class="form-control" rows="4" id="obesidad" name="obesidad"></textarea>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">INTERNACION</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="internacion" id="internacion" name="internacion">
                      
                    </div>

                    <strong>Examen físico:</strong>

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">TA</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="ta" id="ta" name="ta">
                      <span class="input-group-text" id="telefono">PESO (KG)</span>
                      <input type="number" class="form-control" aria-label="otros" aria-describedby="peso" id="peso" name="peso" onkeyup="calculate()">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ALTURA (MTS)</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="altura" id="altura" name="altura" onkeyup="calculate()">
                      <span class="input-group-text" id="telefono">IMC</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="ta" id="imc" name="imc">
                      

                    </div>

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">P. CINTURA</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="altura" id="cintura" name="cintura">
                      <span class="input-group-text" id="telefono">P. CUELLO</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="ta" id="cuello" name="cuello">   

                    </div>

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">RESP.</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="resp" id="resp" name="resp">
                      <span class="input-group-text" id="telefono">CV</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="cv" id="cv" name="cv">
                      
                    </div>

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ABDOMEN</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="abdomen" id="abdomen" name="abdomen">
                      <span class="input-group-text" id="telefono">MMII</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="mmii" id="mmii" name="mmii">
                      
                    </div>

                    

                    <strong>HÁBITOS:</strong>
                    
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ACTIVIDAD FÍSICA</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="actividad_fisica" id="actividad_fisica" name="actividad_fisica">
                      <span class="input-group-text" id="telefono">OH</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="oh" id="oh" name="oh">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">TBQ</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="tbq" id="tbq" name="tbq">
                      <span class="input-group-text" id="telefono">DROGAS</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="drogas" id="drogas" name="drogas">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ALERGIAS</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="alergias" id="alergias" name="alergias">
                      <span class="input-group-text" id="telefono">SUEÑO</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="sueño" id="sueño" name="sueño">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">CATARSIS</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="catarsis" id="catarsis" name="catarsis">
                      <span class="input-group-text" id="telefono">DIURESIS</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="diuresis" id="diuresis" name="diuresis">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">G_P_C_A_</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="gpca" id="gpca" name="gpca">
                      <span class="input-group-text" id="telefono">FUM</span>
                      <input type="text" class="form-control" aria-label="otros" aria-describedby="fum" id="fum" name="fum">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ACO</span>
                      <input type="text" class="form-control" aria-label="aco" aria-describedby="aco" id="gacopca" name="aco">

                    </div>
                    <div class="input-group mb-3 w-50">
                      <span class="input-group-text" id="telefono">PROBLEMAS</span>
                      {{-- <input type="text" class="form-control" aria-label="aco" aria-describedby="problemas" id="problemas" name="problemas"> --}}
                      <textarea class="form-control" rows="8" id="problemas" name="problemas"></textarea>
                    </div>
                    <strong>FAMILIOGRAMA:</strong>
                    
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ANT. FLIARES</span>
                      <input type="text" class="form-control" aria-label="aco" aria-describedby="ant_familiares" id="ant_familiares" name="ant_familiares">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">VIVE CON</span>
                      <input type="text" class="form-control" aria-label="aco" aria-describedby="vive_con" id="vive_con" name="vive_con">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">FARMACOS</span>
                      <input type="text" class="form-control" aria-label="aco" aria-describedby="farmacos" id="farmacos" name="farmacos">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">PLAN</span>
                      <input type="text" class="form-control" aria-label="aco" aria-describedby="plan" id="plan" name="plan">

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
                <th>IMC</th>
                <th class="d-none d-lg-table-cell">Fibroscan</th>
                <th class="d-none d-lg-table-cell">EFCA</th>
                <th class="d-none d-lg-table-cell">CX BARIÁTRICA:</th>
                <th></th>
            </thead>
            <tbody>  
              @foreach($clinical_sheets as $sheet)
                {{-- @if($paciente->codPaciente == $sheet->paciente_id)   --}}
                <tr>   
                  <td>{{date('d-m-Y',strtotime($sheet->created_at))}}</td>
                  <td>{{ucwords($sheet->user->name.' '.$sheet->user->lastName)}}</td>
                  <td>{{$sheet->peso}}</td>
                  <td>{{$sheet->imc}}</td>
                  <td class="d-none d-lg-table-cell">{{$sheet->fibroscan}}</td>
                  <td class="d-none d-lg-table-cell">{{$sheet->efca}}</td>
                  <td class="d-none d-lg-table-cell">{{$sheet->cx_bariatrica}}</td>
                  <td style="width:15%">
                    @if($sheet->user_id == Auth::user()->id) 
                      <a class="btn btn-info text-white" 
                      href="{{route('clinical.edit',$sheet->id)}}">Editar</a>
                    @endif
                    <a class="btn btn-warning text-white" 
                    href="{{route('clinical.pdf',$sheet->id)}}" target="_blank">Imprimir</a>
                      
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