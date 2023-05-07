@extends('layouts.app')

@section('content')
<form id="nueva-atencion" action="{{ url('ficha/'.$paciente->idPaciente) }}" method="POST">
@csrf
<div class="col-sm px-5">
    <div class="card mb-3" >
        <div class="card-header text-white bg-primary">
            Ficha Paciente: {{$paciente->apellidoPaciente.' '.$paciente->nombrePaciente}}
        </div>
        <div class="card-body">
            <div class="input-group mb-3">
              <span class="input-group-text" id="dni">DNI</span>
              <input type="text" class="form-control" readonly aria-label="Username" aria-describedby="edad" id="dni" name="dni" value="{{$paciente->idPaciente}}">

              <span class="input-group-text" id="edad">Edad</span>
              <input type="text" class="form-control" readonly aria-label="Username" aria-describedby="edad" id="edad" name="edad" value="{{$edad}}">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="dni">Celular</span>
              <input type="text" class="form-control" readonly aria-label="Username" aria-describedby="edad" id="dni" name="dni" value="{{$paciente->celularPaciente}}">

              <span class="input-group-text" id="edad">Cobertura médica</span>
              <input type="text" class="form-control" readonly aria-label="Username" aria-describedby="edad" id="edad" name="edad" value="{{$paciente->CoberturaPaciente}}">
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text" id="edad">Número Afiliado</span>
              <input type="text" class="form-control" readonly aria-label="Username" aria-describedby="edad" id="edad" name="edad" value="{{$paciente->numeroAfiliadoPaciente}}">
              <span class="input-group-text" id="email">Correo</span>
              <input type="email" name="email" class="form-control" readonly aria-label="email" aria-describedby="email" value="{{$paciente->emailPaciente}}">
              

            </div>
            <label for="nueva-atencion" class="form-label">Nueva atención</label>
                <textarea class="form-control" id="nueva-atencion" rows="3" name="entrada"></textarea>
            <div class="d-grid gap-2 col-6 mx-auto py-2">
              <button type="submit" class="btn btn-sm btn-primary">Guardar</button>
            </div>
          </div>
          <div class="card-body">
            @foreach ($historiales as $historial)
              <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">
                  {{$historial->fechaHC}}</label>
                <div class="form-control" id="exampleFormControlTextarea1" rows="3">  
                <?php echo($historial->entrada)?>
              </div>
            @endforeach
          </div>

    </div>
</div>
</form>
@endsection