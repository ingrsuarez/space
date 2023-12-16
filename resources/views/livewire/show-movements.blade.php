<div>
    <div class="row my-2">
        <div class="col-md-4">
            <div class="card mb-4 shadow-sm" style="max-width: 48rem;">
                <div class="card-header text-white bg-primary">
                    Desde:
                </div>
                <div class="card-body  shadow">
                    <input class="form-control" wire:model="from" type="date" />
                    
                </div>
            </div>
        </div>
        @can('accounts.manage')
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                {{-- <form action="{{route('accounts.spend')}}" method="POST"> --}}
                    <div class="card-header text-white bg-primary">
                        Gastos y retiros:
                    </div>
                    <div class="card-body  shadow">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="dni">Descripción:</span>
                            <input class="form-control" type="text" wire:model="description"/>
                            <span class="input-group-text" id="dni">Total: $</span>
                            <input class="form-control" type="number" wire:model="credit"/>
                        </div>
                        <button wire:click="spend" class="btn btn-sm btn-primary text-white shadow">Retiro</button>
                        
                    </div>
                {{-- </form> --}}
            </div>
        </div>
        @endcan
    </div>
    <div class="col-sm px-1">
        <div class="card mb-3">
            <div class="card-header text-white bg-primary">
                Caja: {{ucwords($professional->lastName.' '.$professional->name)}}
            </div>
            <div class="card-body  shadow">
                
                <table class="table">
                    <thead class="table-light">
                      <th style="min-width: 8rem;">Fecha</th>
                      <th>Descripción</th>
                      <th>Usuario</th>
                      <th>Paciente</th>
                      <th>Ingreso</th>
                      <th>Salida</th>
                      <th>Saldo</th>


                    </thead>
                    <tbody>
                        @if(isset($balance))
                        @foreach($balance as $move)
                            @if(strpos(strtolower($move->description), 'cierre') != "")
                            <tr class="bg-light">
                            @else
                            <tr>
                            @endif
                                <td>{{date('d-m-Y', strtotime($move->created_at))}}</td>
                                <td>{{ucfirst($move->description)}}</td>
                                <td>
                                    @isset($move->users)
                                        {{ucwords($move->users->name.' '.$move->users->lastName)}}
                                    @endisset
                                </td>
                                <td>
                                    @isset($move->pacientes)
                                    {{ucwords($move->pacientes->nombrePaciente.' '.$move->pacientes->apellidoPaciente)}}
                                    @endisset
                                </td>
                                <td>{{$move->debit}}</td>
                                <td class="text-danger">{{$move->credit}}</td>
                                <td>{{$move->Balance}}</td>
                                <td width="10px">
                                   
                                {{-- @if($move->hasInstitutionmove($institution->id))    
                                    <a class="btn btn-danger text-white" href="{{ route('moveInstitution.detach',['institution'=>$institution,'move'=>$move]) }}">Quitar</a>
                                @else
                                    <a class="btn btn-info text-white" href="{{ route('moveInstitution.attach',['institution'=>$institution,'move'=>$user]) }}">
                                        Agregar</a>
                                
                                @endif --}}
                                </td>
                            </tr>   
                            @endforeach
                        @endif
                  
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
        
        </div>

    </div>
</div>
