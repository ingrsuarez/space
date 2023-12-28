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


  <form id="actualizar-ficha" action="{{ route('psychological.update',[$paciente->codPaciente,$psychologicalSheet->id]) }}" method="POST">
    @csrf
    @method('post')
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
                        <input type="text" class="form-control" id="peso" name="peso" value="{{$psychologicalSheet->peso}}">
                        <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                        <span class="input-group-text">PESO MÁXIMO:</span>
                        <select class="form-select" name="peso_maximo" id="peso_maximo" required>
                            <option value="si">Si </option>
                            <option value="no">No </option>
                        </select>
                      
                        
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="edad">INTENCIÓN DE CIRUGÍA:</span>
                        <input type="text" class="form-control" id="intencion_cirugia" name="intencion_cirugia" value="{{$psychologicalSheet->intencion_cirugia}}">
                
                    </div>
                    <div class="card-header text-white bg-primary bg-gradient mb-2">
                        REGISTRO DE SOBREPESO
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">ANTECEDENTES:</span>
                      <input type="text" class="form-control" id="antecedentes" name="antecedentes" value="{{$psychologicalSheet->antecedentes}}">
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text">TRATAMIENTO PSICOLÓGICO:</span>
                      <input type="text" class="form-control" id="tto_psicologico" name="tto_psicologico" value="{{$psychologicalSheet->tto_psicologico}}">
                      
                    </div> 
                    <div class="input-group mb-3">
                        <span class="input-group-text">TRATAMIENTO PSIQUIÁTRICO:</span>
                        <input type="text" class="form-control" id="tto_psiquiatrico" name="tto_psiquiatrico" value="{{$psychologicalSheet->tto_psiquiatrico}}">
                    </div> 

                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">CONDUCTA ALIMENTARIA:</span>
                      <input type="text" class="form-control" id="conducta_alimentaria" name="conducta_alimentaria" value="{{$psychologicalSheet->conducta_alimentaria}}">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ATRACÓN:</span>
                      <input type="text" class="form-control" id="atracon" name="atracon" value="{{$psychologicalSheet->atracon}}">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">COMEDOR NOCTURNO:</span>
                      <input type="text" class="form-control" id="comedor_nocturno" name="comedor_nocturno" value="{{$psychologicalSheet->comedor_nocturno}}">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">ACTIVIDAD FÍSICA:</span>
                      <input type="text" class="form-control" id="actividad_fisica" name="actividad_fisica" value="{{$psychologicalSheet->actividad_fisica}}">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">TRABAJO/OCUPACIÓN:</span>
                      <input type="text" class="form-control" id="trabajo" name="trabajo" value="{{$psychologicalSheet->trabajo}}">
                      
                    </div>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="telefono">FAMILIA:</span>
                      <input type="text" class="form-control" id="familia" name="familia" value="{{$psychologicalSheet->familia}}">
                      
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">PÉRDIDAS/DUELOS:</span>
                        <input type="text" class="form-control" id="perdidas" name="perdidas" value="{{$psychologicalSheet->perdidas}}">
                        
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">TRATAMIENTOS ANTERIORES:</span>
                        <input type="text" class="form-control" id="tto_anteriores" name="tto_anteriores" value="{{$psychologicalSheet->tto_anteriores}}">
                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">LIMITACIONES:</span>
                        <input type="text" class="form-control" id="limitaciones" name="limitaciones" value="{{$psychologicalSheet->limitaciones}}">
                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">EVOLUCIÓN:</span>
                        <input type="text" class="form-control" id="evolucion" name="evolucion" value="{{$psychologicalSheet->evolucion}}">
                    
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