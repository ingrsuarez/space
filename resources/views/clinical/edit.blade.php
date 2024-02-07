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
                    <form id="actualizar-ficha" action="{{ route('clinical.update',[$paciente->codPaciente,$clinicalSheet->id]) }}" method="POST">
                    @csrf
                    {{-- @method('post') --}}
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="dni">SCORE FIBROSCAN</span>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="fibroscan" name="fibroscan" value="{{$clinicalSheet->fibroscan}}">
                        <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                        <span class="input-group-text" id="edad">SCORE EFCA</span>
                        <input type="text" class="form-control" aria-label="efca" aria-describedby="efca" id="efca" name="efca"  value="{{$clinicalSheet->efca}}">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text">CX BARIÁTRICA:</span>
                        <select class="form-select" name="cx_bariatrica" id="cx_bariatrica" required>
                            <option  value="{{$clinicalSheet->cx_bariatrica}}"> {{$clinicalSheet->cx_bariatrica}}</option>
                            <option value="si">Si </option>
                            <option value="no">No </option>
                        </select>
                        <span class="input-group-text"></span>
                        
                    </div>
                    <strong>Antecedentes personales:</strong>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">HTA</span>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="hta" name="hta"  value="{{$clinicalSheet->hta}}">
                        
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">DBT</span>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="dbt" name="dbt"  value="{{$clinicalSheet->dbt}}">
                        
                    </div> 
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">CX</span>
                        <input type="text" class="form-control" aria-label="Username" aria-describedby="edad" id="cx" name="cx"  value="{{$clinicalSheet->cx}}">
                        
                    </div> 

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">OTROS ANTECEDENTES</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="otros" id="otros" name="otros"  value="{{$clinicalSheet->otros}}">
                        
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">OAM</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="oam" id="oam" name="oam"  value="{{$clinicalSheet->oam}}">
                        
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">GINECOLOGO</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="ginecologo" id="ginecologo" name="ginecologo"  value="{{$clinicalSheet->ginecologo}}">
                        
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">VACUNAS COVID</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="vacunas" id="vacunas" name="vacunas"  value="{{$clinicalSheet->vacunas}}">
                        
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">HISTORIA DE OBESIDAD</span>
                        {{-- <input type="text" class="form-control" aria-label="otros" aria-describedby="obesidad" id="obesidad" name="obesidad"  value="{{$clinicalSheet->obesidad}}"> --}}
                        <textarea class="form-control" rows="4" id="obesidad" name="obesidad">{{$clinicalSheet->obesidad}}</textarea>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">INTERNACION</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="internacion" id="internacion" name="internacion"  value="{{$clinicalSheet->internacion}}">
                        
                    </div>

                    <strong>Examen físico:</strong>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">TA</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="ta" id="ta" name="ta"  value="{{$clinicalSheet->ta}}">
                        <span class="input-group-text" id="telefono">PESO (KG)</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="peso" id="peso" name="peso" onkeyup="calculate()"  value="{{$clinicalSheet->peso}}">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">ALTURA (MTS)</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="altura" id="altura" name="altura" onkeyup="calculate()"  value="{{$clinicalSheet->altura}}">
                        <span class="input-group-text" id="telefono">IMC</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="ta" id="imc" name="imc"  value="{{$clinicalSheet->imc}}">
                        

                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">P. CINTURA</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="altura" id="cintura" name="cintura"  value="{{$clinicalSheet->cintura}}">
                        <span class="input-group-text" id="telefono">P. CUELLO</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="ta" id="cuello" name="cuello"  value="{{$clinicalSheet->cuello}}">   

                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">RESP.</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="resp" id="resp" name="resp"  value="{{$clinicalSheet->resp}}">
                        <span class="input-group-text" id="telefono">CV</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="cv" id="cv" name="cv"  value="{{$clinicalSheet->cv}}">
                        
                    </div>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">ABDOMEN</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="abdomen" id="abdomen" name="abdomen"  value="{{$clinicalSheet->abdomen}}">
                        <span class="input-group-text" id="telefono">MMII</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="mmii" id="mmii" name="mmii"  value="{{$clinicalSheet->mmii}}">
                        
                    </div>

                    

                    <strong>HÁBITOS:</strong>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">ACTIVIDAD FÍSICA</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="actividad_fisica" id="actividad_fisica" name="actividad_fisica"  value="{{$clinicalSheet->actividad_fisica}}">
                        <span class="input-group-text" id="telefono">OH</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="oh" id="oh" name="oh"  value="{{$clinicalSheet->oh}}">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">TBQ</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="tbq" id="tbq" name="tbq"  value="{{$clinicalSheet->tbq}}">
                        <span class="input-group-text" id="telefono">DROGAS</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="drogas" id="drogas" name="drogas"  value="{{$clinicalSheet->drogas}}">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">ALERGIAS</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="alergias" id="alergias" name="alergias"  value="{{$clinicalSheet->alergias}}">
                        <span class="input-group-text" id="telefono">SUEÑO</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="sueño" id="sueño" name="sueño"  value="{{$clinicalSheet->sueño}}">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">CATARSIS</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="catarsis" id="catarsis" name="catarsis"  value="{{$clinicalSheet->catarsis}}">
                        <span class="input-group-text" id="telefono">DIURESIS</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="diuresis" id="diuresis" name="diuresis"  value="{{$clinicalSheet->diuresis}}">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">G_P_C_A_</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="gpca" id="gpca" name="gpca"  value="{{$clinicalSheet->gpca}}">
                        <span class="input-group-text" id="telefono">FUM</span>
                        <input type="text" class="form-control" aria-label="otros" aria-describedby="fum" id="fum" name="fum"  value="{{$clinicalSheet->fum}}">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">ACO</span>
                        <input type="text" class="form-control" aria-label="aco" aria-describedby="aco" id="gacopca" name="aco"  value="{{$clinicalSheet->aco}}">

                    </div>
                    <div class="input-group mb-3 w-50">
                        <span class="input-group-text" id="telefono">PROBLEMAS</span>
                        {{-- <input type="text" class="form-control" aria-label="aco" aria-describedby="problemas" id="problemas" name="problemas"  value="{{$clinicalSheet->problemas}}"> --}}
                        <textarea class="form-control" rows="8" id="problemas" name="problemas">{{$clinicalSheet->problemas}}</textarea>
                    </div>
                    <strong>FAMILIOGRAMA:</strong>
                    
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">ANT. FLIARES</span>
                        <input type="text" class="form-control" aria-label="aco" aria-describedby="ant_familiares" id="ant_familiares" name="ant_familiares"  value="{{$clinicalSheet->ant_familiares}}">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">VIVE CON</span>
                        <input type="text" class="form-control" aria-label="aco" aria-describedby="vive_con" id="vive_con" name="vive_con"  value="{{$clinicalSheet->vive_con}}">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">FARMACOS</span>
                        <input type="text" class="form-control" aria-label="aco" aria-describedby="farmacos" id="farmacos" name="farmacos"  value="{{$clinicalSheet->farmacos}}">

                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="telefono">PLAN</span>
                        <input type="text" class="form-control" aria-label="aco" aria-describedby="plan" id="plan" name="plan"  value="{{$clinicalSheet->plan}}">

                    </div>

                    <div class="d-grid gap-2 col-4 ms-auto py-2">
                        <button type="submit" class="btn btn-sm btn-primary text-white">Guardar Ficha</button>
                    </div>
                    </form>

                    
                </div>
                </div>
            </div>
            </div>
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