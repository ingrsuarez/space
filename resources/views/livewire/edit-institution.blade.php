<div>
    <div class="accordion" id="panelUsuarios">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelUsuarios">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelUsuarios-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                
                    Usuarios: 
                
              </button>
            </h2>
            <div id="panelUsuarios-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelUsuarios">
                <div class="accordion-body">
                    <div class="card mb-3">

                        <div class="card-body  shadow">
                            <form id="nuevo-trabajo" action="{{ route('institution.show') }}" method="POST" class="d-flex">
                                @csrf
                                <input class="form-control me-2 shadow-sm" name="name" type="search" placeholder="Nombre" wire:model="name" >
                                <input class="form-control me-2 shadow-sm" name="lastName" type="search" placeholder="Apellido" wire:model="lastName" >
                                <input class="form-control me-2 shadow-sm" name="email" type="search" placeholder="Email" wire:model="email" >
                                
                                <button class="btn btn-outline-success shadow-sm" type="submit">Buscar</button>
                            </form>

              
                                
                            <table class="table mt-3">
                                <thead class="table-light">
                                  <th>Nombre</th>
                                  <th>Email</th>
                                  <th>Teléfono</th>
                                  <th>Especialidades</th>
                                  <th>Administrador</th>
                                  <th>Institución</th>

                                </thead>
                                <tbody>
                                    @if(isset($users))
                                        @foreach($users as $user)
                                        <tr> 
                                            <td>{{strtoupper($user->lastName).' '.strtoupper($user->name)}}
                                                @if($user->adminsInstitution($institution->id))
                                                    <br><span class="text-primary">Administrador</span> 
                                                @endif
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->telefono}}</td>
                                            <td>@foreach($user->professions as $profession)
                                                    {{$profession->name}}<br>
                                                @endforeach
                                            </td>
                                            <td width="10px">
                                            @if($user->hasInstitutionUser($institution->id))   
                                                @if($user->adminsInstitution($institution->id))    
                                                    <a class="btn btn-warning text-white" href="{{ route('institution.detachAdmin',['institution'=>$institution,'user'=>$user]) }}">Quitar</a>
                                                @else
                                                    <a class="btn btn-info text-white" href="{{ route('institution.attachAdmin',['institution'=>$institution,'user'=>$user]) }}">
                                                        Agregar</a>
                                                
                                                @endif
                                            @endif
                                            </td> 
                                            <td width="10px">
                                               
                                            @if($user->hasInstitutionUser($institution->id))    
                                                <a class="btn btn-danger text-white" href="{{ route('userInstitution.detach',['institution'=>$institution,'user'=>$user]) }}">Quitar</a>
                                            @else
                                                <a class="btn btn-info text-white" href="{{ route('userInstitution.attach',['institution'=>$institution,'user'=>$user]) }}">
                                                    Agregar</a>
                                            
                                            @endif
                                            </td>

                                        </tr>   
                                        @endforeach
                                    @endif
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    
    <div class="accordion" id="panelPlanillas">
        <div class="accordion-item">
            <h2 class="accordion-header" id="panelPlanillas">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelPlanillas-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                
                    Planillas: 
                
              </button>
            </h2>
            <div id="panelPlanillas-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelPlanillas">
                <div class="accordion-body">
                    <div class="card mb-3">

                        <div class="card-body  shadow">
                            <form id="nuevo-trabajo" action="{{ route('institution.show') }}" method="POST" class="d-flex">
                                @csrf
                                <input class="form-control me-2 shadow-sm" name="sheet_name" type="search" placeholder="Nombre" wire:model="sheet_name" >
                                
                                <button class="btn btn-outline-success shadow-sm" type="submit">Buscar</button>
                            </form>

              
                                
                            <table class="table mt-3">
                                <thead class="table-light">
                                  <th>Nombre</th>
                                  <th>Ruta</th>
                                  <th>Tabla</th>
                                  <th>Modelo</th>

                                </thead>
                                <tbody>
                                    @if(isset($users))
                                        @foreach($sheets as $sheet)
                                        <tr> 
                                            <td>{{strtoupper($sheet->name)}}</td>
                                            <td>{{$sheet->route}}</td>
                                            <td>{{$sheet->table_name}}</td>
                                            <td>{{$sheet->model}}</td>
                                            <td width="10px">
                                            @if($sheet->hasInstitutionUser($institution->id))   
                                                @if($user->adminsInstitution($institution->id))    
                                                    <a class="btn btn-warning text-white" href="{{ route('institution.detachAdmin',['institution'=>$institution,'user'=>$user]) }}">Quitar</a>
                                                @else
                                                    <a class="btn btn-info text-white" href="{{ route('institution.attachAdmin',['institution'=>$institution,'user'=>$user]) }}">
                                                        Agregar</a>
                                                
                                                @endif
                                            @endif
                                            </td> 
                                            <td width="10px">
                                               
                                            @if($user->hasInstitutionUser($institution->id))    
                                                <a class="btn btn-danger text-white" href="{{ route('userInstitution.detach',['institution'=>$institution,'user'=>$user]) }}">Quitar</a>
                                            @else
                                                <a class="btn btn-info text-white" href="{{ route('userInstitution.attach',['institution'=>$institution,'user'=>$user]) }}">
                                                    Agregar</a>
                                            
                                            @endif
                                            </td>

                                        </tr>   
                                        @endforeach
                                    @endif
                              
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </div>  
</div>
