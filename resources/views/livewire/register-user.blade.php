<div>
    <div class="col-sm mt-4">
    	<div class="card mb-3 shadow" style="max-width: 50rem;">
    		<div class="card-header text-white bg-primary">
                Actualice sus datos:
            </div>
            <div class="card-body">
              	<form id="actualizar-ficha" action="{{ route('userPatient.store') }}" method="POST">
            		@csrf

            		<div class="d-sm-flex flex-row mb-0 mb-sm-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="dni2">DNI</span>
                            <input wire:model="dni" class="form-control" type="number" min="1" step="1" name="idPaciente">
                        </div>
                        <div class="input-group ms-sm-2 mb-3">                    
                            <span class="input-group-text" id="fechaNacimiento">Fecha de Nacimiento</span>
                            <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" style="max-width: 20rem" 
                            @isset($paciente->fechaNacimientoPaciente)
                                value="{{$paciente->fechaNacimientoPaciente}}" required>
                                <input type="hidden" name="codPaciente" value="{{$paciente->codPaciente}}">
                            @else
                                required>    
                            @endisset		
                        </div>
                    </div>
                    <div class="d-sm-flex flex-row mb-0 mb-sm-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Nombre</span>
                            <input type="text" class="form-control" aria-label="Username" id="nombre" name="nombre"
                            @if(!empty($paciente))
                                value="{{ucfirst($paciente->nombrePaciente)}}" required>	
                            @else
                                required>    
                            @endif
                        </div>
                        <div class="input-group ms-sm-2 mb-3">
                            <span class="input-group-text">Apellido</span>
                            <input type="text" class="form-control" id="apellido" name="apellido"
                            @if(!empty($paciente))
                                value="{{ucfirst($paciente->apellidoPaciente)}}" required>	
                            @else
                                required>    
                            @endif
                        </div>
                    
                    </div>
                    <div class="d-sm-flex flex-row mb-0 mb-sm-2">
                        <div class="input-group mb-3">    
                            <span class="input-group-text" id="email">Correo</span>
                            <input type="email" name="email" class="form-control" aria-label="email" aria-describedby="email"                        
                                value="{{$user->email}}">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text ms-sm-2" id="celular">Celular</span>
                            <input type="text" class="form-control" aria-label="Username" id="celular" name="celular"
                                @if(!empty($paciente))
                                    value="{{$paciente->celularPaciente}}" required>	
                                @else
                                    required>    
                                @endif
                        </div>
                    </div>	

                	<div class="d-sm-flex flex-row mb-0 mb-sm-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="telefono">Teléfono</span>
                            <input type="text" class="form-control" aria-label="Username" id="telefono" name="telefono" style="min-width: 10rem"
                                @if(!empty($paciente))
                                    value="{{$paciente->telefonoPaciente}}">	
                                @else
                                    >    
                                @endif
                             

                        </div>
                    </div>
                    <div class="d-sm-flex flex-row mb-0 mb-sm-2">
                        <div class="input-group mb-3">
                            <span class="input-group-text">Cobertura médica</span>
                            <select class="form-select" name="insurance_id" id="cobertura" required>
                                @isset($insurances)
                                    @foreach ($insurances as $insurance)
                                        @if(isset($paciente->insurance_id) and $insurance->id == $paciente->insurance_id)
                                            <option value="{{$insurance->id}}" selected> {{ucfirst($insurance->name)}}	
                                        @else
                                            <option value="{{$insurance->id}}"> {{ucfirst($insurance->name)}}								
                                        @endif
                                    @endforeach	
                                @endisset
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text ms-sm-2">Número Afiliado</span>
                            <input type="text" class="form-control" aria-label="Username" id="numeroAfiliado" name="numeroAfiliado">	                  
                        </div>
                    </div>
					<div class="input-group mb-3">
						<span class="input-group-text">Ocupación:</span>
						<input type="text" class="form-control" aria-label="Username" id="ocupacion" name="ocupacion"
                            @if(!empty($paciente))
                                value="{{ucfirst($paciente->ocupacionPaciente)}}">	
                            @else
                                >    
                            @endif
						<span class="input-group-text">Sexo:</span>
						<select class="form-select" name="sexo" id="sexo" required>
                            @if(isset($paciente->sexoPaciente) and $paciente->sexoPaciente == 'F')
                                <option value="F" selected>Femenino</option>
                                <option value="M">Masculino</option>	
                            @else
                                <option value="F">Femenino</option>
                                <option value="M" selected>Masculino</option>								
                            @endif
							
						</select>
	                </div>
	                <div class="input-group mb-3">
						<span class="input-group-text">Domicilio</span>
						<input type="text" class="form-control" aria-label="Username" id="domicilio" name="domicilio"
                            @if(!empty($paciente))
                                value="{{ucfirst($paciente->domicilioPaciente)}}">	
                            @else
                                >    
                            @endif
						<span class="input-group-text">Localidad</span>
						<input type="text" class="form-control" aria-label="Username"id="localidad" name="localidad">
	                </div>
	                <div class="d-grid gap-2 d-md-flex justify-content-md-end">	                	
	                	<button class="btn btn-outline-success " type="submit">Guardar</button>
	                </div>
          		</form>
      		</div>
    	</div>
    </div>
</div>
