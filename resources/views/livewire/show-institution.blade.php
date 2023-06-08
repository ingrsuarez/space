<div>
    <div class="row">
        <div class="col">
            <div class="card mb-3">
                <div class="card-header text-white bg-primary">
                    Buscar usuario:
                </div>
                <div class="card-body  shadow">
                    <form id="nuevo-trabajo" action="{{ route('institution.show') }}" method="POST" class="d-flex">
                        @csrf
                        <input class="form-control me-2 shadow-sm" name="name" type="search" placeholder="Nombre" wire:model="name" >
                        <input class="form-control me-2 shadow-sm" name="lastName" type="search" placeholder="Apellido" wire:model="lastName" >
                        <input class="form-control me-2 shadow-sm" name="email" type="search" placeholder="Email" aria-label="Search" >
                        
                        <button class="btn btn-outline-success shadow-sm" type="submit">Buscar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-3">
                <div class="card-header text-white bg-primary">
                    INSTITUCIÓN ACTUAL:
                </div>
                <div class="card-body  shadow">
                    <select class="form-select" wire:change="changeEvent($event.target.value)">
                        @if(isset($institution))
                            <option value="{{$institution->id}}">{{strtoupper($institution->name)}}</option>
                            @if(isset($userInstitutions))
                                @foreach($userInstitutions as $userInstitution)
                                    @if($institution->id != $userInstitution->id and Auth::user()->adminsInstitution($userInstitution->id))

                                    <option value="{{$userInstitution->id}}">{{strtoupper($userInstitution->name)}}</option>
                                    @endif
                                @endforeach
                            @endif
                        @endif
                    </select>
                    
                    
                </div>
            </div>
        </div>
    </div>   
    <div class="col-sm px-1">
        <div class="card mb-3">
            <div class="card-header text-white bg-primary">
                Agregar Usuario:
            </div>
            <div class="card-body  shadow">
                
                <table class="table">
                    <thead class="table-light">
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Teléfono</th>
                      <th>Especialidades</th>
                      <th></th>
                      <th></th>

                    </thead>
                    <tbody>
                        @if(isset($users))
                            @foreach($users as $user)
                            <tr> 
                                <td>{{strtoupper($user->lastName).' '.strtoupper($user->name)}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->telefono}}</td>
                                <td>@foreach($user->professions as $profession)
                                        {{$profession->name}}<br>
                                    @endforeach
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
        <div class="card-footer">
            @if(isset($users))
             {!!$users->links()!!}

            @endif
        </div>

    </div>
</div>
