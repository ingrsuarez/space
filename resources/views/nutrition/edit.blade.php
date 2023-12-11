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


  <form id="actualizar-ficha" action="{{ route('nutrition.update',[$paciente->codPaciente,$nutritionSheet->id]) }}" method="POST">
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
                      <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="edad" name="edad" value="{{$edad}}" readonly>
                      <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                      <input type="hidden" name="sexo" id="sexo" value="{{$paciente->sexo}}">
                      <span class="input-group-text">FUMA:</span>
                      <select class="form-select" name="fuma" id="fuma" autofocus required>
                        @if($nutritionSheet->fuma == 'no')
                            <option value="no" selected>No </option>
                            <option value="si">Si </option>
                        @else
                            <option value="no">No </option>
                            <option value="si" selected>Si </option>
                        @endif
                      </select>
                      <span class="input-group-text">ACTIVIDAD FÍSICA:</span>
                      <select class="form-select" name="actividad" id="actividad" required>
                        @if($nutritionSheet->actividad == 'intensa')
                            <option value="intensa" selected>Intensa </option>
                            <option value="moderada">Moderada </option>
                            <option value="sedentaria">Sedentaria </option>
                        @elseif($nutritionSheet->actividad == 'moderada')
                            <option value="intensa">Intensa </option>
                            <option value="moderada" selected>Moderada </option>
                            <option value="sedentaria">Sedentaria </option>
                        @else
                            <option value="intensa">Intensa </option>
                            <option value="moderada">Moderada </option>
                            <option value="sedentaria" selected>Sedentaria </option>
                        @endif
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">TIPO DE ACTIVIDAD FÍSICA:</span>
                      <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" 
                      id="tipoActividad" name="tipoActividad" autocomplete="off" value="{{$nutritionSheet->tipo_actividad}}">

                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">FRECUENCIA:</span>
                      <input type="text" class="form-control" id="frecuenciaActividad" name="frecuenciaActividad" 
                      value="{{$nutritionSheet->frecuencia_actividad}}" autocomplete="off">
                      <span class="input-group-text">DURACIÓN:</span>
                      <input type="text" class="form-control" id="duracionActividad" name="duracionActividad" 
                      value="{{$nutritionSheet->duracion_actividad}}" autocomplete="off">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">PESO:</span>
                      <input type="text" class="form-control" aria-label="Username" 
                      id="peso" name="peso" autocomplete="off" value="{{$nutritionSheet->peso}}" onkeyup="fimc()">
                      <span class="input-group-text">Kg</span>
                      <span class="input-group-text" >ALTURA:</span>
                      <input type="text" class="form-control" aria-label="Username" 
                      id="altura" name="altura" autocomplete="off" value="{{$nutritionSheet->altura}}" onkeyup="pi();fimc()">
                      <span class="input-group-text">mts</span> 
                      <span class="input-group-text" >PESO IDEAL:</span>
                      <input type="text" class="form-control" value="{{$nutritionSheet->peso_ideal}}"
                      id="pesoIdeal" autocomplete="off" name="pesoIdeal">
                      <span class="input-group-text">Kg</span>
                      <span class="input-group-text">I.M.C.</span>
                      <input type="text" class="form-control" id="imc" name="imc" 
                      value="{{$nutritionSheet->imc}}" style="max-width: 10rem;" readonly>
                      <span class="input-group-text text-white" id="escalaimc">Normal</span>
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" >HORAS DE SUEÑO:</span>
                      <input type="text" class="form-control" id="horas_sueño" 
                      value="{{$nutritionSheet->horas_suenio}}" autocomplete="off" name="hora_sueño">
                      <span class="input-group-text" >OCUPACIÓN:</span>
                      <input type="text" class="form-control" id="ocupacion" name="ocupacion"
                      value="{{$nutritionSheet->ocupacion}}">
                      <span class="input-group-text" >JORNADA LABORAL:</span>
                      <input type="text" class="form-control" id="jornada" autocomplete="off" name="jornada"
                      value="{{$nutritionSheet->jornada}}">
                    </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">CANDIDATO A BARIÁTRICA:</span>
                    <select class="form-select text-center" name="bariatrica" id="bariatrica" style="max-width: 10rem;" required>
                        @if($nutritionSheet->bariatrica == 'si')
                            <option value="si" selected>Si </option>
                            <option value="no">no </option>
                        @else
                            <option value="si">Si </option>
                            <option value="no"selected>No </option>
                        @endif
                    </select>
                    <span class="input-group-text" >CIRCUNFERENCIA DE CUELLO:</span>
                    <input type="text" class="form-control" id="jornada" autocomplete="off" 
                    value="{{$nutritionSheet->cuello}}" name="cuello">
                    <span class="input-group-text" >CIRCUNFERENCIA DE CINTURA:</span>
                    <input type="text" class="form-control" id="jornada" autocomplete="off" 
                    value="{{$nutritionSheet->cintura}}" name="cintura">
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
                    <input type="text" class="form-control" id="desayuno" name="desayuno" value="{{$nutritionSheet->desayuno}}">
                    <span class="input-group-text">ALMUERZO Hr:</span>
                    <input type="text" class="form-control" id="almuerzo" name="almuerzo" value="{{$nutritionSheet->almuerzo}}">
                    <span class="input-group-text">MERIENDA Hr:</span>
                    <input type="text" class="form-control" id="merienda" name="merienda" value="{{$nutritionSheet->merienda}}">
                    <span class="input-group-text">CENA Hr:</span>
                    <input type="text" class="form-control" id="cena" name="cena" value="{{$nutritionSheet->cena}}">
                    <span class="input-group-text">COLACIONES Hr:</span>
                    <input type="text" class="form-control" id="colaciones" name="colaciones" value="{{$nutritionSheet->colaciones}}">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">ALIMENTOS QUE NO INGIERE</span>
                    <input type="text" class="form-control" id="no_ingiere" name="no_ingiere" value="{{$nutritionSheet->no_ingiere}}">
                    <span class="input-group-text">ALIMENTOS PREDILECTOS</span>
                    <input type="text" class="form-control" id="predilectos" name="predilectos" value="{{$nutritionSheet->predilectos}}">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">INTOLERACIAS Y/O ALERGIAS</span>
                    <input type="text" class="form-control" id="intolerancias_alergias" 
                    value="{{$nutritionSheet->intolerancias_alergias}}" name="intolerancias_alergias" >
                    <span class="input-group-text">CONSUME ALCOHOL</span>
                    <input type="text" class="form-control" id="alcohol" name="alcohol" value="{{$nutritionSheet->alcohol}}">
                  </div> 
                  <div class="input-group mb-3">
                    
                    <span class="input-group-text">OBSERVACIONES</span>
                    <input type="text" class="form-control" id="observaciones" name="observaciones" value="{{$nutritionSheet->observaciones}}">
                  </div> 
                </div>
                <div class="card-header text-white bg-primary bg-gradient">
                  DIAGNOSTICO NUTRICIONAL (PROBLEMA/ ETILOGÍA/ SINTOMA)
                </div>
                <div class="card-body">
                  <div class="input-group mb-3">

                    <input type="text" class="form-control" id="diagnostico_nutricional" 
                    name="diagnostico_nutricional" value="{{$nutritionSheet->diagnostico_nutricional}}">
                    
                  </div>
                </div>
                <div class="card-header text-white bg-primary bg-gradient">
                  INTERVENCION NUTRICIONAL
                </div>
                <div class="card-body">
                  <div class="input-group mb-3">
                    <span class="input-group-text" id="telefono">INDICACION NUTRICIONAL</span>
                    <input type="text" class="form-control" id="indicacion_nutricional" 
                    value="{{$nutritionSheet->indicacion_nutricional}}" name="indicacion_nutricional">
                    
                  </div>
                  <div class="input-group justify-content-center mb-1">
                    <span class="bg-info text-white input-group-text">METAS</span>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">1:</span>
                    <input type="text" class="form-control" id="meta_uno" name="meta_uno" value="{{$nutritionSheet->meta_uno}}">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">2:</span>
                    <input type="text" class="form-control" id="meta_dos" name="meta_dos" value="{{$nutritionSheet->meta_dos}}">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">3:</span>
                    <input type="text" class="form-control" id="meta_tres" name="meta_tres" value="{{$nutritionSheet->meta_tres}}">
                  </div>


                  <div class="input-group justify-content-center mb-1">
                    <span class="bg-info text-white input-group-text">VTC</span>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">GR HDC:</span>
                    <input type="text" class="form-control" id="gr_hdc" name="gr_hdc" value="{{$nutritionSheet->gr_hdc}}">
                    <span class="input-group-text">GR PROT:</span>
                    <input type="text" class="form-control" id="gr_prot" name="gr_prot" value="{{$nutritionSheet->gr_prot}}">
                    <span class="input-group-text">GR GRASAS:</span>
                    <input type="text" class="form-control" id="gr_grasas" name="gr_grasas" value="{{$nutritionSheet->gr_grasas}}">
                  </div>

                  <div class="input-group justify-content-center mb-1">
                    <span class="bg-info text-white input-group-text">SISTEMA DE PAUTA ALIMENTARIA</span>
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">CUALITATIVO:</span>
                    <input type="text" class="form-control" id="pauta_cualitativo" 
                    name="pauta_cualitativo" value="{{$nutritionSheet->pauta_cualitativo}}">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">CUANTITATIVO:</span>
                    <input type="text" class="form-control" id="pauta_cuantitativo" 
                    name="pauta_cuantitativo" value="{{$nutritionSheet->pauta_cuantitativo}}">
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">OBSERVACIONES:</span>
                    <input type="text" class="form-control" id="pauta_observaciones" 
                    name="pauta_observaciones" value="{{$nutritionSheet->pauta_observaciones}}">
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

	




  <script defer>

    function fimc(){
    var peso = document.getElementById("peso").value;
    var altura = document.getElementById("altura").value;
    var escala = document.getElementById("escalaimc");
    imc = peso / (altura*altura);    
    if (imc != Infinity)
    {
        document.getElementById("imc").value= imc.toFixed(2);
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
          
      if (sexo == 'M')
      {
        ideal = (altura*100)-100-(((altura*100)-150)/4);
        console.log(ideal);
        document.getElementById("pesoIdeal").value = ideal.toFixed(2);
      }else{
        ideal = (altura*100)-100-(((altura*100)-150)/2.5);
        document.getElementById("pesoIdeal").value = ideal.toFixed(2);
      }
        
    }


  </script>







  @endsection