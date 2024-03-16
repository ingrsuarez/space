<div>
    
        <div class="card mb-3">
            <div class="card-header text-white bg-primary">
                Filtrar:
            </div>
            <div class="card-body shadow">
                @if(isset($institution))
                    <div class="form-group row">
                        <select class="form-select mx-4" wire:change="changeEvent($event.target.value)" style="max-width: 20rem;" autofocus>    
                            @foreach($professionals as $professionalList)
                                @if($professionalList->hasRole('profesional'))
                                    @if($professionalList->id != $currentProfessional->id ) 
                                        <option value="{{$professionalList->id}}">{{strtoupper($professionalList->lastName).' '.strtoupper($professionalList->name)}}</option>
                                    @else
                                        <option selected value="{{$professionalList->id}}">{{strtoupper($professionalList->lastName).' '.strtoupper($professionalList->name)}}</option> 
                                    @endif
                                @endif
                            @endforeach
                        </select>

                        <select class="form-select mx-4" wire:change="changeMonth($event.target.value)" style="max-width: 10rem;">
                            <option value="1"> Enero </option>                                    
                            <option value="2"> Febrero </option>                                    
                            <option value="3"> Marzo </option>
                            <option value="4"> Abril </option>
                            <option value="5"> Mayo </option>
                            <option value="6"> Junio </option>
                            <option value="7"> Julio </option>
                            <option value="8"> Agosto </option>
                            <option value="9"> Septiembre </option>
                            <option value="10"> Octubre </option>
                            <option value="11"> Noviembre </option>
                            <option value="12"> Diciembre </option>

                        </select>
                    </div>
                @endif
            </div>
        </div>
    
    <div class="card mb-3">
        <table class="table">
            <thead class="table-primary">
                <th>Fecha</th>
                <th>Paciente</th>
                <th>Cobertura</th>
                
                <th>Valor</th>
            </thead>
            <tbody>
                @isset($report)
                    @foreach($report as $result)
                        <tr>
                            <td>{{date('d-m-Y', strtotime($result->start))}}</td>
                            <td>{{ucfirst($result->paciente->apellidoPaciente).' '.ucfirst($result->paciente->nombrePaciente)}}</td>
                            <td>{{$result->insurance->name}}</td>


                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>

    </div>
    
    {{-- <div>{{$report}}</div> --}}
</div>
