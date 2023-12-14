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
                    <input type="text" class="form-control" id="dni" name="dni" value="{{$paciente->idPaciente}}" readonly>
                    <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                    <span class="input-group-text">Edad</span>
                    <input type="text" class="form-control" id="edad" value="{{$edad}}" readonly>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Nombre</span>
                    <input type="text" class="form-control" aria-label="Username" id="nombre" name="nombre" value="{{ucfirst($paciente->nombrePaciente)}}">
                    <span class="input-group-text">Apellido</span>
                    <input type="text" class="form-control" aria-label="Username"id="apellido" name="apellido" value="{{ucfirst($paciente->apellidoPaciente)}}">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="telefono">Celular</span>
                    <input type="text" class="form-control" id="telefono" name="telefono" value="{{$paciente->celularPaciente}}">
                    <span class="input-group-text" id="email">Correo</span>
                    <input type="email" name="email" class="form-control" aria-label="email" aria-describedby="email" value="{{$paciente->emailPaciente}}">
                    
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Cobertura médica</span>
                    <select class="form-select" name="insurance_id" id="insurance_id" required>
                      @isset($paciente->insurance_id)
                        <option value="{{$paciente->insurance_id}}">{{$paciente->insurance->name}}
                      @endisset
                        @foreach ($insurances as $insurance)
                          <option value="{{$insurance->id}}"> {{ucfirst($insurance->name)}}								
                        @endforeach	
                      
                    </select>
                    <span class="input-group-text">Número Afiliado</span>
                    <input type="text" class="form-control" id="numeroAfiliado" name="numeroAfiliado" value="{{$paciente->numeroAfiliadoPaciente}}">
                    
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Ocupación:</span>
                    <input type="text" class="form-control" aria-label="Username" id="ocupacion" name="ocupacion" value="{{$paciente->ocupacionPaciente}}">
                    <span class="input-group-text">Sexo:</span>
                    <select class="form-select" name="sexo" id="sexo" required>
                      @if($paciente->sexoPaciente == 'f')  
                        <option value="F" selected>Femenino</option>
                        <option value="M">Masculino</option>
                        @else
                        <option value="F">Femenino</option>
                        <option value="M"selected>Masculino</option>
                        @endif
                    </select>
                          </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">Domicilio</span>
                    <input type="text" class="form-control" id="domicilio" name="domicilio" value="{{$paciente->domicilioPaciente}}">
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


  <form id="actualizar-ficha" action="{{ route('nutrition.save',$paciente->codPaciente) }}" method="POST">
    @csrf
    @method('post')
    <div class="col-sm px-5 mb-3">
      <div class="accordion" id="accordionSheet">
        <div class="accordion-item">
          <h2 class="accordion-header" id="Sheet-headingOne">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#Sheet-collapseOne" aria-expanded="true" aria-controls="Sheet-collapseOne">
              <div class="">
                  Planilla nutricional: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
              </div>
            </button>
          </h2>
          <div id="Sheet-collapseOne" class="accordion-collapse collapse show" aria-labelledby="Sheet-headingOne">
            <div class="accordion-body">
              <div class="card mb-3 shadow" >
                <div class="card-header text-white bg-primary bg-gradient">
                  VALORACIÓN NUTRICIONAL
                </div>
                <div class="card-body">

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="dni">EDAD:</span>
                      <input type="text" class="form-control" id="edad" name="edad" value="{{$edad}}" readonly>
                      <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                      <span class="input-group-text">FUMA:</span>
                      <select class="form-select" name="fuma" id="fuma" autofocus required>
                        <option value="no">No </option>
                        <option value="si">Si </option>
                      </select>
                      <span class="input-group-text">ACTIVIDAD FÍSICA:</span>
                      <select class="form-select" name="actividad" id="actividad" required>
                        <option value="intensa">Intensa </option>
                        <option value="moderada">Moderada </option>
                        <option value="sedentaria">Sedentaria </option>
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">TIPO DE ACTIVIDAD FÍSICA:</span>
                      <input type="text" class="form-control" id="tipoActividad" name="tipoActividad" autocomplete="off">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">FRECUENCIA:</span>
                      <input type="text" class="form-control" id="frecuenciaActividad" name="frecuenciaActividad" autocomplete="off">
                      <span class="input-group-text">DURACIÓN:</span>
                      <input type="text" class="form-control" id="duracionActividad" name="duracionActividad" autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">PESO:</span>
                      <input type="text" class="form-control" id="peso" name="peso" autocomplete="off" onkeyup="fimc();pi()">
                      <span class="input-group-text">Kg</span>
                      <span class="input-group-text" >ALTURA:</span>
                      <input type="text" class="form-control" id="altura" name="altura" autocomplete="off" onkeyup="pi();fimc()">
                      <span class="input-group-text">mts</span> 
                      <span class="input-group-text" >PESO IDEAL:</span>
                      <input type="text" class="form-control" id="pesoIdeal" autocomplete="off" name="pesoIdeal">
                      <span class="input-group-text">Kg</span>
                      <span class="input-group-text">I.M.C.</span>
                      <input type="text" class="form-control" id="imc" name="imc" style="max-width: 10rem;" readonly>
                      <span class="input-group-text text-white" id="escalaimc">Normal</span>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" >HORAS DE SUEÑO:</span>
                      <input type="text" class="form-control" id="horas_sueño" autocomplete="off" name="hora_sueño">
                      <span class="input-group-text" >OCUPACIÓN:</span>
                      <input type="text" class="form-control" id="ocupacion" name="ocupacion">
                      <span class="input-group-text" >JORNADA LABORAL:</span>
                      <input type="text" class="form-control" id="jornada" autocomplete="off" name="jornada">
                    </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text" >CIRC DE CUELLO (cm):</span>
                    <input type="text" class="form-control" id="jornada" autocomplete="off" name="cuello">
                    <span class="input-group-text" >CIRC DE CINTURA (cm):</span>
                    <input type="text" class="form-control" id="jornada" autocomplete="off" name="cintura">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">CANDIDATO A BARIÁTRICA:</span>
                    <select class="form-select text-center" name="bariatrica" id="bariatrica" style="max-width: 10rem;" required>
                      <option value="si">Si </option>
                      <option value="no">No </option>
                    </select>
                    <span class="input-group-text">CONTROL:</span>
                    <select class="form-select text-center" name="bariatrica" id="bariatrica" style="max-width: 10rem;" required>
                      <option value="pre operatorio">Pre Operatorio </option>
                      <option value="post operatorio">Post Operatorio </option>
                    </select>

                  </div>
                </div>
                <div class="card-header text-white bg-primary bg-gradient">
                  ANAMNESIS ALIMENTARIA
                </div>
                <div class="card-body">
                  <div class="input-group justify-content-center mb-1">
                    <span class="bg-info text-white input-group-text">COMIDAS QUE REALIZA CADA 24HS</span>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">DESAYUNO Hr:</span>
                    <input type="text" class="form-control" id="desayuno" name="desayuno">
                    <span class="input-group-text">ALMUERZO Hr:</span>
                    <input type="text" class="form-control" id="almuerzo" name="almuerzo">
                    <span class="input-group-text">MERIENDA Hr:</span>
                    <input type="text" class="form-control" id="merienda" name="merienda">
                    <span class="input-group-text">CENA Hr:</span>
                    <input type="text" class="form-control" id="cena" name="cena">
                    <span class="input-group-text">COLACIONES Hr:</span>
                    <input type="text" class="form-control" id="colaciones" name="colaciones">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">ALIMENTOS QUE NO INGIERE</span>
                    <input type="text" class="form-control" id="no_ingiere" name="no_ingiere">
                    <span class="input-group-text">ALIMENTOS PREDILECTOS</span>
                    <input type="text" class="form-control" id="predilectos" name="predilectos">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">INTOLERACIAS Y/O ALERGIAS</span>
                    <input type="text" class="form-control" id="intolerancias_alergias" name="intolerancias_alergias">
                    <span class="input-group-text">CONSUME ALCOHOL</span>
                    <input type="text" class="form-control" id="alcohol" name="alcohol">
                  </div> 
                  <div class="input-group mb-3">
                    
                    <span class="input-group-text">OBSERVACIONES</span>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                  </div> 
                </div>
                <div class="card-header text-white bg-primary bg-gradient">
                  DIAGNOSTICO NUTRICIONAL (PROBLEMA/ ETILOGÍA/ SINTOMA)
                </div>
                <div class="card-body">
                  <div class="input-group mb-3">

                    <input type="text" class="form-control" id="diagnostico_nutricional" name="diagnostico_nutricional">
                    
                  </div>
                </div>
                <div class="card-header text-white bg-primary bg-gradient">
                  INTERVENCION NUTRICIONAL
                </div>
                <div class="card-body">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="telefono">INDICACION NUTRICIONAL</span>
                    <input type="text" class="form-control" id="indicacion_nutricional" name="indicacion_nutricional">
                    
                  </div>
                  <div class="input-group justify-content-center mb-1">
                    <span class="bg-info text-white input-group-text justify-content-center" style="width: 30rem;">METAS</span>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">1:</span>
                    <input type="text" class="form-control" id="meta_uno" name="meta_uno">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">2:</span>
                    <input type="text" class="form-control" id="meta_dos" name="meta_dos">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">3:</span>
                    <input type="text" class="form-control" id="meta_tres" name="meta_tres">
                  </div>


                  <div class="input-group justify-content-center mb-1 text-center" >
                    <span class="bg-info text-white input-group-text justify-content-center" style="width: 30rem;">VTC --></span>
                  </div>
                  <div class="input-group mb-4">
                    <span class="input-group-text">GR HDC:</span>
                    <input type="text" class="form-control" id="gr_hdc" name="gr_hdc">
                    <span class="input-group-text">GR PROT:</span>
                    <input type="text" class="form-control" id="gr_prot" name="gr_prot">
                    <span class="input-group-text">GR GRASAS:</span>
                    <input type="text" class="form-control" id="gr_grasas" name="gr_grasas">
                  </div>

                  <div class="input-group justify-content-center mb-1">
                    <span class="bg-info text-white input-group-text justify-content-center" style="width: 30rem;">SISTEMA DE PAUTA ALIMENTARIA</span>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">CUALITATIVO:</span>
                    <input type="text" class="form-control" id="pauta_cualitativo" name="pauta_cualitativo">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">CUANTITATIVO:</span>
                    <input type="text" class="form-control" id="pauta_cuantitativo" name="pauta_cuantitativo">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">OBSERVACIONES:</span>
                    <input type="text" class="form-control" id="pauta_observaciones" name="pauta_observaciones">
                  </div>
                  <div class="input-group justify-content-center mb-1">
                    <span class="bg-info text-white input-group-text justify-content-center" style="width: 30rem;">SEGUIMIENTO</span>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">PESO INICIAL:</span>
                    <input type="text" class="form-control" id="peso_inicial" name="peso_inicial">
                    <span class="input-group-text">PESO IDEAL AJUSTADO:</span>
                    <input type="text" class="form-control" id="peso_ajustado" name="peso_ajustado" >
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">IMC INICIAL:</span>
                    <input type="text" class="form-control" id="imc_inicial" name="imc_inicial" onkeyup="pi()">
                    <span class="input-group-text">% IMC PERDIDO:</span>
                    <input type="text" class="form-control" id="imc_perdido" name="imc_perdido" >
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">% EXCESO DE PESO PERDIDO:</span>
                    <input type="text" class="form-control" id="peso_perdido" name="peso_perdido" >
                    <span class="input-group-text">% EXCESO DE IMC PERDIDO:</span>
                    <input type="text" class="form-control" id="exceso_imc_perdido" name="exceso_imc_perdido" >
                    <span class="input-group-text">% MASA GRASA:</span>
                    <input type="text" class="form-control" id="masa_grasa" name="masa_grasa" >
                  </div>
                  <div class="d-grid gap-2 col-4 ms-auto py-2">
                    <button type="submit" class="btn btn-sm btn-primary text-white">Guardar Ficha</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>

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
                <th>CX BARIÁTRICA:</th>
                <th></th>
            </thead>
            <tbody>  
              @foreach($nutrition_sheets as $sheet)
                {{-- @if($paciente->codPaciente == $sheet->paciente_id)   --}}
                <tr>   
                  <td>{{date('d-m-Y',strtotime($sheet->created_at))}}</td>
                  <td>{{ucwords($sheet->user->name.' '.$sheet->user->lastName)}}</td>
                  <td>{{$sheet->peso}}</td>
                  <td>{{$sheet->imc}}</td>
                  <td class="d-none d-lg-table-cell">{{$sheet->cx_bariatrica}}</td>
                  <td style="width:15%">
                    @if($sheet->user_id == Auth::user()->id) 
                      <a class="btn btn-info text-white" 
                      href="{{route('nutrition.edit',$sheet->id)}}">Editar</a>
                    @endif
                    <a class="btn btn-warning text-white" 
                    href="{{route('nutrition.pdf',$sheet->id)}}" target="_blank">Imprimir</a>
                  </td>
                </tr>
                {{-- @endif    --}}
              @endforeach
          
            </tbody>
          </table>
        </div>

    </div>
  </div>	




  <script defer>

    function fimc(){
    var sexo = document.getElementById("sexo").value;
    var peso = document.getElementById("peso").value;
    var altura = document.getElementById("altura").value;
    var escala = document.getElementById("escalaimc");
    var edad = document.getElementById("edad").value;
    var imc = peso / (altura*altura); 
    var masaGrasa = 0;
    if (sexo == 'M')
    {
      masaGrasa= (1.2 * imc) + (0.23 * edad) - 16.2;
    }
    else
    {
      masaGrasa= (1.2 * imc) + (0.23 * edad) - 5.4;
    }
    document.getElementById("masa_grasa").value= imc.toFixed(2);
    if (imc != Infinity)
    {
        document.getElementById("imc").value= masaGrasa.toFixed(2);
        if(imc < 25){
          escala.removeAttribute('class');
          escala.setAttribute('class', 'input-group-text text-white bg-success');
          escala.textContent = "Normal";
        }
        if((25 <= imc) && (imc < 27)){
          escala.removeAttribute('class');
          escala.setAttribute('class', 'input-group-text text-white bg-warning');
          escala.textContent = "Sobrepeso";
        }
        if((27 <= imc) && (imc < 30)){
          escala.removeAttribute('class');
          escala.setAttribute('class', 'input-group-text text-white bg-warning');
          escala.textContent = "Preobesidad";
        }
        if((30 <= imc) && (imc < 35)){
          escala.removeAttribute('class');
          escala.setAttribute('class', 'input-group-text text-white bg-danger');
          escala.textContent = "Obesidad G.I";
        }
        if((35 <= imc) && (imc < 40)){
          escala.removeAttribute('class');
          escala.setAttribute('class', 'input-group-text text-white bg-danger');
          escala.textContent = "Obesidad G.II";
        }
        if((40 <= imc) && (imc < 50)){
          escala.removeAttribute('class');
          escala.setAttribute('class', 'input-group-text text-white bg-danger');
          escala.textContent = "Obesidad G.III";
        }
        if((50 <= imc) && (imc < 60)){
          escala.removeAttribute('class');
          escala.setAttribute('class', 'input-group-text text-white bg-danger');
          escala.textContent = "Obesidad G.IV";
        }
        if(60 <= imc){
          escala.removeAttribute('class');
          escala.setAttribute('class', 'input-group-text text-white bg-danger');
          escala.textContent = "Obesidad G.V";
        }

       
    }
        
    }

    function pi(){
      var sexo = document.getElementById("sexo").value;
      var altura = document.getElementById("altura").value;
      var pesoActual = document.getElementById("peso").value;  
      var imcInicial = document.getElementById("imc_inicial").value;
      // var imc = document.getElementById("imc").value; 
      var imc = pesoActual / (altura*altura);  
      var pesoInicial = document.getElementById("peso_inicial").value; 
      
      if (sexo == 'M')
      {
        ideal = (altura*100)-100-(((altura*100)-150)/4);
        console.log(ideal);
        document.getElementById("pesoIdeal").value = ideal.toFixed(2);
      }else{
        ideal = (altura*100)-100-(((altura*100)-150)/2.5);
        document.getElementById("pesoIdeal").value = ideal.toFixed(2);
      }

      var pesoAjustado = ((pesoActual - ideal) * 0.25) + ideal;
      document.getElementById("peso_ajustado").value = pesoAjustado.toFixed(2);
      console.log("imc "+ imc)
      console.log("inicial: "+imcInicial)  
      var porcentageIMCperdido = ((imcInicial-imc) / imcInicial) * 100;
      if (porcentageIMCperdido >= 0)
      {
        document.getElementById("imc_perdido").value = porcentageIMCperdido.toFixed(2);
      }
      var excesoPesoPerdido = ((pesoInicial-pesoActual)/(pesoInicial-ideal)) * 100;
      if (excesoPesoPerdido != Infinity)
      {
        document.getElementById("peso_perdido").value = excesoPesoPerdido.toFixed(2);
      }
       
      
      var excesoIMCPerdido = ((imcInicial-imc)/(imcInicial-25)) * 100;
      if (excesoIMCPerdido != Infinity)
      {
        document.getElementById("exceso_imc_perdido").value = excesoIMCPerdido.toFixed(2);
      }
    }


  </script>







  @endsection