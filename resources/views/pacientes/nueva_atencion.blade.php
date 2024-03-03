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
  <div class="col-sm px-5 mb-3" style="max-width: 64rem;">
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
                    <span class="input-group-text" id="email">Correo</span>
                    <input type="email" name="email" class="form-control" value="{{$paciente->emailPaciente}}">
                  </div>

                  <div class="input-group mb-3">
                    <span class="input-group-text">Nombre</span>
                    <input type="text" class="form-control" aria-label="Username" id="nombre" name="nombre" value="{{ucfirst($paciente->nombrePaciente)}}">
                    <span class="input-group-text">Apellido</span>
                    <input type="text" class="form-control" aria-label="Username"id="apellido" name="apellido" value="{{ucfirst($paciente->apellidoPaciente)}}">
                  </div>

                  <div class="input-group mb-3">
                    <span class="input-group-text" id="edad">Edad</span>
                    <input type="text" class="form-control" id="edad" value="{{$edad}}" readonly>
                    <span class="input-group-text" id="fechaNacimiento">Fecha de Nacimiento</span>
                    <input type="date" class="form-control" aria-label="Username" aria-describedby="fechaNacimiento" id="domicilio" name="fechaNacimiento" value="{{$paciente->fechaNacimientoPaciente}}">
                  </div>

                  <div class="input-group mb-3">
                    <span class="input-group-text" id="telefono">Teléfono</span>
                    <input type="text" class="form-control" aria-label="Username" id="telefono" name="telefono" value="{{$paciente->telefonoPaciente}}">
                    <span class="input-group-text" id="celular">Celular</span>
                    <input type="text" class="form-control" aria-label="Username" id="celular" name="celular" value="{{$paciente->celularPaciente}}">
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
                      @if(($paciente->sexoPaciente == 'F') or ($paciente->sexoPaciente == 'f') )  
                        <option value="F" selected>Femenino</option>
                        <option value="M">Masculino</option>
                        @else
                        <option value="F">Femenino</option>
                        <option value="M"selected>Masculino</option>
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
                    <span class="input-group-text" id="edad">Observaciones</span>
                    <input type="text" class="form-control" id="observations" name="observations" value="{{ucfirst($paciente->observations)}}">
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
    @cannot('ficha')
    
      <div class="row px-5 mb-3" style="max-width: 65rem;">
        <div class="accordion col" id="accordionWatingList">
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
                  @livewire('payment-panel',['institution' => $institution, 'paciente'=>$paciente, 'insurances' => $insurances]) 
                @endif
              </div>    
            </div>

          </div>
        </div>
        {{-- LAST PATIENT APPOINMENTS --}}

        <div class="accordion col" id="accordionAppoinments">
          <div class="accordion-item">
            <h2 class="accordion-header" id="Appoinments">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Appoinments-collapseOne" aria-expanded="true" aria-controls="Appoinments-collapseOne">
                <div class="">
                    Últimos turnos del paciente: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                </div>
              </button>
            </h2>
            <div id="Appoinments-collapseOne" class="accordion-collapse collapse" aria-labelledby="Appoinments-headingOne">
              <div class="accordion-body">
                @if(isset($institution))
                  <div class="input-group mb-3">
                    <table class="table table-striped">
                      <thead class="table-light">
                          <th>Profesional</th>
                          <th>Fecha</th>
                          <th>Cobertura</th>
                          <th>Observaciones</th>
                      </thead>
                      <tbody>
                        @if(!empty($appoinments))   
                          @foreach($appoinments as $appointment) 
                            <tr>
                                <td>{{strtoupper($appointment->user->name.' '.$appointment->user->lastName)}}</td>
                                <td style="min-width: 100px">{{date('d-m-Y', strtotime($appointment->start))}}</td>
                                <td>
                                  @if (!empty($appointment->insurance_id))
                                    {{$appointment->insurance->name}}
                                  @endif  
                                </td>
                                <td>{{($appointment->obs)}}</td>
                            </tr>
                          @endforeach
                        @endif   
                      </tbody>
                    </table>    
                  </div>
                @endif
              </div>    
            </div>

          </div>
        </div>
      </div>
    @endcan
    {{-- UPLOAD FILES --}}
    @cannot('ficha')
      @if($institution->hasServicePath('lab'))
        <div class="col-sm px-5 mb-3" style="max-width: 64rem;">
          <div class="accordion" id="accordionLaboratorio">
            <div class="accordion-item">
              <h2 class="accordion-header" id="Laboratorio">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Laboratorio-collapseOne" aria-expanded="true" aria-controls="Laboratorio-collapseOne">
                  <div class="">
                      Laboratorios: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                  </div>
                </button>
              </h2>
              <div id="Laboratorio-collapseOne" class="accordion-collapse collapse" aria-labelledby="Laboratorio-headingOne">
                <div class="accordion-body">
                  <form action="{{route('store.file')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="file" name="laboratory" required accept="application/pdf">
                      <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                      <span class="input-group-text" id="fechaNacimiento">Fecha estudio</span>
                      <input type="date" class="form-control" id="file_date" name="file_date" required>
                    </div>
                    <div class="d-grid gap-2 col-4 ms-auto py-2">
                      <button type="submit" class="btn btn-sm btn-primary text-white">SUBIR</button>                    
                    </div>
                  </form>
                  @foreach ($files as $file)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.file',['file'=>$file['name'], 'idPaciente'=>$file['idPaciente']])}}" target="_blank">{{ $file['name'] }}</a>
                    <br>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
      @if($institution->hasServicePath('fibroscan'))
        <div class="col-sm px-5 mb-3" style="max-width: 64rem;">
          <div class="accordion" id="accordionFibroscan">
            <div class="accordion-item">
              <h2 class="accordion-header" id="Fibroscan">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Fibroscan-collapseOne" aria-expanded="true" aria-controls="Fibroscan-collapseOne">
                  <div class="">
                      Fibroscan: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                  </div>
                </button>
              </h2>
              <div id="Fibroscan-collapseOne" class="accordion-collapse collapse" aria-labelledby="Fibroscan-headingOne">
                <div class="accordion-body">
                  <form action="{{route('store.fibroscan')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="fibroscan" name="fibroscan" required accept="application/pdf">
                      <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                      <span class="input-group-text" id="fechaNacimiento">Fecha estudio</span>
                      <input type="date" class="form-control" id="file_date" name="file_date" required>
                    </div>
                      <div class="d-grid gap-2 col-4 ms-auto py-2">
                      <button type="submit" class="btn btn-sm btn-primary text-white">SUBIR</button>                    
                    </div>
                  </form>
                  @foreach ($fibroscans as $fibroscan)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.fibroscan',['file'=>$fibroscan['name'], 'idPaciente'=>$fibroscan['idPaciente']])}}" target="_blank">{{ $fibroscan['name'] }}</a>
                    <br>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
      @if($institution->hasServicePath('ecografia'))
        <div class="col-sm px-5 mb-3" style="max-width: 64rem;">
          <div class="accordion" id="accordionEcografia">
            <div class="accordion-item">
              <h2 class="accordion-header" id="ecografia">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Ecografia-collapseOne" aria-expanded="true" aria-controls="Ecografia-collapseOne">
                  <div class="">
                      Ecografías: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                  </div>
                </button>
              </h2>
              <div id="Ecografia-collapseOne" class="accordion-collapse collapse" aria-labelledby="Ecografia-headingOne">
                <div class="accordion-body">
                  <form action="{{route('store.ecografia')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="ecografia" name="ecografia" required accept="application/pdf">
                      <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                      <span class="input-group-text" id="fechaNacimiento">Fecha estudio</span>
                      <input type="date" class="form-control" id="file_date" name="file_date" required>
                    </div>
                      <div class="d-grid gap-2 col-4 ms-auto py-2">
                      <button type="submit" class="btn btn-sm btn-primary text-white">SUBIR</button>                    
                    </div>
                  </form>
                  @foreach ($ecografias as $ecografia)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.ecografia',['file'=>$ecografia['name'], 'idPaciente'=>$ecografia['idPaciente']])}}" target="_blank">{{ $ecografia['name'] }}</a>
                    <br>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
      @if($institution->hasServicePath('endoscopia'))
        <div class="col-sm px-5 mb-3" style="max-width: 64rem;">
          <div class="accordion" id="accordionEndoscopia">
            <div class="accordion-item">
              <h2 class="accordion-header" id="Endoscopia">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Endoscopia-collapseOne" aria-expanded="true" aria-controls="Endoscopia-collapseOne">
                  <div class="">
                      Endoscopias: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                  </div>
                </button>
              </h2>
              <div id="Endoscopia-collapseOne" class="accordion-collapse collapse" aria-labelledby="Endoscopia-headingOne">
                <div class="accordion-body">
                  <form action="{{route('store.endoscopia')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="endoscopia" name="endoscopia" required accept="application/pdf">
                      <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                      <span class="input-group-text" id="fechaEndoscopia">Fecha estudio</span>
                      <input type="date" class="form-control" id="file_date" name="file_date" required>
                    </div>
                      <div class="d-grid gap-2 col-4 ms-auto py-2">
                      <button type="submit" class="btn btn-sm btn-primary text-white">SUBIR</button>                    
                    </div>
                  </form>
                  
                  @foreach ($endoscopias as $endoscopia)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.endoscopia',['file'=>$endoscopia['name'], 'idPaciente'=>$endoscopia['idPaciente']])}}" target="_blank">{{ $endoscopia['name'] }}</a>
                    <br>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
      @if($institution->hasServicePath('cardiologia'))
        <div class="col-sm px-5 mb-3" style="max-width: 64rem;">
          <div class="accordion" id="accordionEndoscopia">
            <div class="accordion-item">
              <h2 class="accordion-header" id="Cardiologia">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Cardiologia-collapseOne" aria-expanded="true" aria-controls="Cardiologia-collapseOne">
                  <div class="">
                      Estudios de cardiología: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                  </div>
                </button>
              </h2>
              <div id="Cardiologia-collapseOne" class="accordion-collapse collapse" aria-labelledby="Cardiologia-headingOne">
                <div class="accordion-body">
                  <form action="{{route('store.cardiologia')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                    <div class="input-group mb-3">
                      <input type="file" class="form-control" id="cardiologia" name="cardiologia" required accept="application/pdf">
                      <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                      <span class="input-group-text" id="fechaCardiologia">Fecha estudio</span>
                      <input type="date" class="form-control" id="file_date" name="file_date" required>
                    </div>
                      <div class="d-grid gap-2 col-4 ms-auto py-2">
                      <button type="submit" class="btn btn-sm btn-primary text-white">SUBIR</button>                    
                    </div>
                  </form>
                  
                  @foreach ($cardiologias as $cardiologia)
                    <a class="btn btn-sm btn-secondary m-2" href="{{route('download.cardiologia',['file'=>$cardiologia['name'], 'idPaciente'=>$cardiologia['idPaciente']])}}" target="_blank">{{ $cardiologia['name'] }}</a>
                    <br>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endif
    @endcan
{{-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ --}}
{{--                     Professional view                 --}}
{{-- ///////////////////////////////////////////////////// --}}
    @can('sheet.index')
      @if(count($institution->sheets))  
        <div class="col-sm px-5 mb-3" style="max-width: 64rem;">
          <div class="accordion" id="accordionSheets">
            <div class="accordion-item">  
              <h2 class="accordion-header" id="Sheets">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Sheets-collapseOne" aria-expanded="true" aria-controls="sheets-collapseOne">
                  <div class="">
                      Planillas: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                  </div>
                </button> 
              </h2>
              <div id="Sheets-collapseOne" class="accordion-collapse collapse" aria-labelledby="Sheets-headingOne">
                <div class="accordion-body">
                    @foreach ($institution->sheets as $sheet)
                      @if(Route::has($sheet->route))
                      <a class="btn btn-sm btn-warning m-2 shadow" href="{{route($sheet->route,['paciente'=>$paciente,'insurance'=>$watingInsurance])}}">{{ucfirst($sheet->name)}}</a>
                      @endif
                    @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      @endisset        
    @endcan  
    @can('ficha')
      <div class="row px-4">
        {{-- Historial  --}}
        <div class="col-lg" style="max-width:50rem">
          <div class="card mb-3 shadow">
            <div class="card-body m-2">
              <form id="nueva-atencion" action="{{ route('ficha.store',$paciente->idPaciente) }}" method="POST">
                @csrf
                <label for="nueva-atencion" class="form-label h5"><strong>Nueva atención</strong></label>
                <textarea class="form-control" id="nueva-atencion" rows="5" name="entrada" required></textarea>
                <input type="hidden" value="{{$paciente->codPaciente}}" name="codPaciente"> 
                <input type="hidden" value="{{$watingInsurance}}" name="insurance_id">
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
          @can('ficha.professional')
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
                      <label class="form-label">
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
          @endcan
          @can('ficha.services')
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
                    @endif 
                  </form> 
                @endforeach
              </div>
            </div>
          @endcan  
        </div>
       
        @can('services.view')
          <div class="col-sm px-2 mb-3" style="max-width: 30rem;">
            {{-- Laboratorios --}}
            <div class="accordion" id="accordionLaboratorio">
              <div class="accordion-item">
                <h2 class="accordion-header" id="Laboratorio">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Laboratorio-collapseOne" aria-expanded="true" aria-controls="Laboratorio-collapseOne">
                    <div class="">
                        Laboratorios: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                    </div>
                  </button>
                </h2>
                <div id="Laboratorio-collapseOne" class="accordion-collapse collapse" aria-labelledby="Laboratorio-headingOne">
                  <div class="accordion-body">
                    @foreach ($files as $file)
                      <a class="btn btn-sm btn-secondary m-2" href="{{route('download.file',['file'=>$file['name'], 'idPaciente'=>$file['idPaciente']])}}" target="_blank">{{ $file['name'] }}</a>
                    @endforeach
                    <form action="{{route('store.file')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="fechaNacimiento">Fecha estudio</span>
                        <input type="date" class="form-control" id="file_date" name="file_date" required>
                      </div>
                      <div class="input-group mb-3">
                        <input type="file" class="form-control" id="file" name="laboratory" required accept="application/pdf">
                        <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                      </div>
                      <div class="d-grid gap-2 col-4 ms-auto py-2">
                        <button type="submit" class="btn btn-sm btn-primary text-white">GUARDAR</button>                    
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>
            {{-- cardiologia --}}
            @if($institution->hasServicePath('cardiologia'))
              <div class="accordion" id="accordionEndoscopia">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="Cardiologia">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Cardiologia-collapseOne" aria-expanded="true" aria-controls="Cardiologia-collapseOne">
                      <div class="">
                          Estudios de cardiología: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                      </div>
                    </button>
                  </h2>
                  <div id="Cardiologia-collapseOne" class="accordion-collapse collapse" aria-labelledby="Cardiologia-headingOne">
                    <div class="accordion-body">
                      @foreach ($cardiologias as $cardiologia)
                        <a class="btn btn-sm btn-secondary m-2" href="{{route('download.cardiologia',['file'=>$cardiologia['name'], 'idPaciente'=>$cardiologia['idPaciente']])}}" target="_blank">{{ $cardiologia['name'] }}</a>
                        <br>
                      @endforeach
                      <form action="{{route('store.cardiologia')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" id="cardiologia" name="cardiologia" required accept="application/pdf">
                          <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="fechaCardiologia">Fecha estudio</span>
                          <input type="date" class="form-control" id="file_date" name="file_date" required>
                        </div>
                          <div class="d-grid gap-2 col-4 ms-auto py-2">
                          <button type="submit" class="btn btn-sm btn-primary text-white">SUBIR</button>                    
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            {{-- Estudios de Fibroscan --}}
            @if($institution->hasServicePath('fibroscan'))
              <div class="accordion" id="accordionFibroscan">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="Fibroscan">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Fibroscan-collapseOne" aria-expanded="true" aria-controls="Fibroscan-collapseOne">
                      <div class="">
                          Fibroscan: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                      </div>
                    </button>
                  </h2>
                  <div id="Fibroscan-collapseOne" class="accordion-collapse collapse" aria-labelledby="Fibroscan-headingOne">
                    <div class="accordion-body">
                      @foreach ($fibroscans as $fibroscan)
                        <a class="btn btn-sm btn-secondary m-2" href="{{route('download.fibroscan',['file'=>$fibroscan['name'], 'idPaciente'=>$fibroscan['idPaciente']])}}" target="_blank">{{ $fibroscan['name'] }}</a>
                        <br>
                      @endforeach
                      <form action="{{route('store.fibroscan')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" id="fibroscan" name="fibroscan" required accept="application/pdf">
                          <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="fechaNacimiento">Fecha estudio</span>
                          <input type="date" class="form-control" id="file_date" name="file_date" required>
                        </div>
                          <div class="d-grid gap-2 col-4 ms-auto py-2">
                          <button type="submit" class="btn btn-sm btn-primary text-white">GUARDAR</button>                    
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            @endif
            {{-- Endoscopias --}}
            @if($institution->hasServicePath('endoscopia'))
              <div class="accordion" id="accordionEndoscopia">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="Endoscopia">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Endoscopia-collapseOne" aria-expanded="true" aria-controls="Endoscopia-collapseOne">
                      <div class="">
                          Endoscopias: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                      </div>
                    </button>
                  </h2>
                  <div id="Endoscopia-collapseOne" class="accordion-collapse collapse" aria-labelledby="Endoscopia-headingOne">
                    <div class="accordion-body">
                      @foreach ($endoscopias as $endoscopia)
                        <a class="btn btn-sm btn-secondary m-2" href="{{route('download.endoscopia',['file'=>$endoscopia['name'], 'idPaciente'=>$endoscopia['idPaciente']])}}" target="_blank">{{ $endoscopia['name'] }}</a>
                        <br>
                      @endforeach
                      <form action="{{route('store.endoscopia')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" id="endoscopia" name="endoscopia" required accept="application/pdf">
                          <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="fechaEndoscopia">Fecha estudio</span>
                          <input type="date" class="form-control" id="file_date" name="file_date" required>
                        </div>
                          <div class="d-grid gap-2 col-4 ms-auto py-2">
                          <button type="submit" class="btn btn-sm btn-primary text-white">GUARDAR</button>                    
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            @endif
            {{-- Ecografías --}}
            @if($institution->hasServicePath('ecografia'))
              <div class="accordion" id="accordionEcografia">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="ecografia">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#Ecografia-collapseOne" aria-expanded="true" aria-controls="Ecografia-collapseOne">
                      <div class="">
                          Ecografías: <strong>{{strtoupper($paciente->apellidoPaciente).' '.strtoupper($paciente->nombrePaciente)}}</strong>
                      </div>
                    </button>
                  </h2>
                  <div id="Ecografia-collapseOne" class="accordion-collapse collapse" aria-labelledby="Ecografia-headingOne">
                    <div class="accordion-body">
                      @foreach ($ecografias as $ecografia)
                        <a class="btn btn-sm btn-secondary m-2" href="{{route('download.ecografia',['file'=>$ecografia['name'], 'idPaciente'=>$ecografia['idPaciente']])}}" target="_blank">{{ $ecografia['name'] }}</a>
                        <br>
                      @endforeach
                      <form action="{{route('store.ecografia')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="file" class="form-label h5"><strong>Asegurese de que el informe corresponda al paciente seleccionado!</strong></label>
                        <div class="input-group mb-3">
                          <input type="file" class="form-control" id="ecografia" name="ecografia" required accept="application/pdf">
                          <input type="hidden" id="dni" name="idPaciente" value="{{$paciente->idPaciente}}">
                        </div>
                        <div class="input-group mb-3">
                          <span class="input-group-text" id="fechaNacimiento">Fecha estudio</span>
                          <input type="date" class="form-control" id="file_date" name="file_date" required>
                        </div>
                          <div class="d-grid gap-2 col-4 ms-auto py-2">
                          <button type="submit" class="btn btn-sm btn-primary text-white">SUBIR</button>                    
                        </div>
                      </form>

                    </div>
                  </div>
                </div>
              </div>
            @endif
          </div>
        @endcan
      </div>
      {{-- Download FILES --}}
      {{-- Estudios de laboratorio --}}
      
    @endcan  
@endsection