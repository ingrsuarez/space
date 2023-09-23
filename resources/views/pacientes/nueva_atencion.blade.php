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
{{--                    Receptionist view                  --}}

    @can('wating.attach')
    <div class="col-sm px-5 mb-3" style="max-width: 50rem;">
      <div class="accordion" id="accordionWatingList">
        <div class="accordion-item">
          <h2 class="accordion-header" id="WatingList">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#WatingList-collapseOne" aria-expanded="true" aria-controls="WatingList-collapseOne">
            <div class="">
                Agregar a lista de espera: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
            </div>
          </button>
          </h2>
          <div id="WatingList-collapseOne" class="accordion-collapse collapse" aria-labelledby="WatingList-headingOne">
            <div class="accordion-body">
              @if(isset($institution))
                <form id="wating" action="{{route('wating.attach',['paciente'=>$paciente,'institution'=>$institution])}}" method="POST">
                  @csrf
                  {{-- @method('put') --}}
                  <div class="input-group mb-3">
                    <select class="form-select" name = 'user_id'>
                        

                          @foreach($institution->users as $user)
                            @if($user->hasRole('profesional'))

                            <option value="{{$user->id}}">{{strtoupper($user->lastName).' '.strtoupper($user->name)}}</option>
                            @endif
                          @endforeach

                        
                    </select>  
        
                    
                      
                  </div>
                  <div class="input-group mb-3">
                    <span class="input-group-text">$</span>
                    <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                    <span class="input-group-text">.00</span>
                  </div>
                  <div class="d-grid gap-2 col-4 ms-auto py-2">
                    <button type="submit" class="btn btn-sm btn-primary text-white">ENVIAR</button>                    
                  </div>
                </form>
              @endif
            </div>    
          </div>

        </div>
      </div>
    </div>
    @endcan

{{--                     Professional view                 --}}
      @can('ficha')
      <div class="col-sm px-5" style="max-width:50rem">
        <div class="card mb-3 shadow">
          <div class="card-body m-2">
            <form id="nueva-atencion" action="{{ route('ficha.store',$paciente->idPaciente) }}" method="POST">
              @csrf
              <label for="nueva-atencion" class="form-label h5"><strong>Nueva atención</strong></label>
              <textarea class="form-control" id="nueva-atencion" rows="3" name="entrada" required></textarea>
              <input type="hidden" value="{{$paciente->codPaciente}}" name="codPaciente"> 
              <input type="hidden" value="{{$insurance->id}}" name="insurance_id">
              <input class="form-check-input" type="checkbox" name="esPublico" id="flexCheckChecked" checked>
              <label class="form-check-label" for="flexCheckChecked">
                Es publico
              </label>
              <div class="input-group mb-3">
                <input type="date" class="form-control col-2 me-auto py-2" id="fechaAtencion" name="fechaAtencion" value="{{Carbon\Carbon::parse(now())->format('Y-m-d')}}" style="max-width: 15rem;">
                <div class="d-grid gap-2 col-4 ms-auto py-2">
                  <button type="submit" class="btn btn-sm btn-primary text-white">Guardar</button>
                </div>
              </div>
            </form>
          </div>  
        </div>
        <div class="card mb-3 shadow">
          <div class="card-body m-2">
            @foreach ($historiales as $historial)
              <form id="editar{{$historial->codPosteo}}" action="{{ url('editar/ficha/')}}" method="POST">
              @csrf
              @if ($historial->codUsuarioHC == Auth::user()->id)
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">
                    {{$historial->fechaHC}} <strong>{{strtoupper($historial->name)." ".strtoupper($historial->lastName)}}
                    @foreach($historial->users->professions as $profession)  
                       - {{ucfirst($profession->name)}}
                    @endforeach
                    </strong>
                    <button type="submit" class="btn btn-sm btn-primary text-white">Editar</button>
                    
                  </label>
                
                  <textarea class="form-control" rows="3" name="entrada"><?php echo($historial->entrada)?></textarea>
                  <input type="hidden" name="codPosteo" value="{{$historial->codPosteo}}">
                  <input type="hidden" name="idPaciente" value="{{$paciente->idPaciente}}">
                  
                </div>
              @elseif($historial->esPublico == 1)
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">
                    {{$historial->fechaHC}} <strong>{{strtoupper($historial->users->name)." ".strtoupper($historial->users->lastName)}}
                    @foreach($historial->users->professions as $profession)
                      - {{ucfirst($profession->name)}}               
                    @endforeach   
                    </strong>
                  </label>
                  <div class="form-control" id="exampleFormControlTextarea1">
                    <?php echo($historial->entrada)?>
                  </div>
                </div>
              @endif
                  
              </form> 
            @endforeach
          </div>
        </div>
      </div>
    @endcan    
@endsection