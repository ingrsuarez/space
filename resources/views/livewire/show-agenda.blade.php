<div>
    
    @if (session('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ session('error') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    <div class="col-sm px-5 mb-3" style="max-width: 50rem;">
      <div class="accordion" id="accordionWatingList">
        <div class="accordion-item">
          <h2 class="accordion-header" id="WatingList">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#WatingList-collapseOne" aria-expanded="true" aria-controls="WatingList-collapseOne">
            <div class="">
                Seleccionar profesional: <strong>{{strtoupper($institution->name)}}</strong>
                <input type="hidden" name="institution_id" value="{{$institution->id}}" form="new">

            </div>
          </button>
          </h2>
          <div id="WatingList-collapseOne" class="accordion-collapse collapse show" aria-labelledby="WatingList-headingOne">
            <div class="accordion-body">
              @if(isset($institution))
                
                  <div class="input-group mb-3">
                    
                    
                    <select class="form-select" wire:change="changeEvent($event.target.value)" autofocus>    
                    @if($professional->hasRole('profesional'))
                        <option value="{{$professional->id}}">{{strtoupper($professional->lastName).' '.strtoupper($professional->name)}}</option>    
                    @else
                        {{-- <option value="{{$professional->id}}">{{strtoupper($professional->lastName).' '.strtoupper($professional->name)}}</option> --}}
                        @foreach($professionals as $professional)
                            @if($professional->hasRole('profesional'))
                                <option value="{{$professional->id}}">{{strtoupper($professional->lastName).' '.strtoupper($professional->name)}}</option>
                            @endif
                        @endforeach
                    @endif
                        
                    </select>                        
                  </div>
                                   
              @endif
            </div>    
          </div>

        </div>
      </div>
    </div>

    <div class="col-sm px-5 mb-3" >
            
        <table class="table table-striped table-hover">
            <thead class="table table-primary">
                <tr>
                    <th>Día</th>
                    <th>Frecuencia</th>
                    <th>Inicio</th>
                    <th>Finaliza</th>
                    <th>Lugar</th>
                    <th colspan="2"></th>
                </tr>
            </thead>
            <tbody>
                <form id="new" action="{{route('agenda.store')}}" method="POST">
                @csrf
                    <tr>
                        <td>
                            <select class="form-select" name="day">
                                <option value="1" selected>lunes</option>        
                            @php
                                $days = [
                                    '2' => 'martes',
                                    '3' => 'miercoles',
                                    '4' => 'jueves',
                                    '5' => 'viernes',
                                    '6' => 'sábado',
                                    '7' => 'domingo'];
                                foreach($days as $day => $name)
                                {   
                                    echo('<option value="'.$day.'">'.$name.'</option>');        
                                }
                            @endphp
                            
                            </select>
                        </td>
                        <td>
                            <select name="frequency" class="form-select">
                                <option value="10" selected>10 min</option>
                                @php
                                $frequencys = [
                                    '15',
                                    '20',
                                    '30',
                                    '45',
                                    '60'];
                                foreach($frequencys as $frequency)
                                {
                                    echo('<option value="'.$frequency.'">'.$frequency.' min</option>');
                                }     
                                
                                @endphp
                            </select>    
                        </td>
                        <td>
                            <select name="start" class="form-select">
                                <option value="06:00:00" selected>06:00 hs</option>
                                @php
                                $start = [];
                                for ($h=6; $h < 19; $h++) {
                                    if($h <= 9){
                                        for ($m=0; $m < 6; $m++) { 
                                            $start['0'.$h.':'.$m.'0:00'] = '0'.$h.':'.$m.'0';
                                        }   
                                    }else {
                                        for ($m=0; $m < 6; $m++) { 
                                            $start[$h.':'.$m.'0:00'] = $h.':'.$m.'0';
                                        }
                                    } 
                                    
                                }
                                
                                foreach($start as $hour => $label)
                                {
                                    echo('<option value="'.$hour.'">'.$label.' hs</option>');
                                }     
                                
                                @endphp    
                            </select>    
                        </td>
                        <td>
                            <select name="end" class="form-select">
                                <option value="06:00:00" selected>06:00 hs</option>
                                @php
                                
                                foreach($start as $hour => $label)
                                {
                                    echo('<option value="'.$hour.'">'.$label.' hs</option>');
                                }     
                                
                                @endphp    
                            </select>    
                        </td>
                        <td>
                            <select class="form-select" name="room_id">
                            @foreach($rooms as $room)

                                <option value="{{$room->id}}">{{$room->name}}</option>
                            @endforeach
                            </select>
                        </td>
                        <td>
                            @if(!empty($user))
                            <input type="hidden" value="{{$user->id}}" name="professional_id">
                            <button type="submit" class="btn btn-sm btn-primary text-white">Agregar</button>
                            @endif
                        </td>

                    </tr>
                </form>
                
                   
                @if(!empty($agenda[0]))
                    @foreach($agenda as $segment)

                    <tr>
                        <td>
                            <input type="hidden" name="institution_id" value="{{$institution->id}}" form="{{$segment->id}}">
                            <input type="hidden" name="agenda_id" value="{{$segment->id}}" form="{{$segment->id}}">
                            <select id="day" class="form-select" name="day" form="{{$segment->id}}">
                            @php
                                $days = [
                                    '1' => 'lunes',
                                    '2' => 'martes',
                                    '3' => 'miercoles',
                                    '4' => 'jueves',
                                    '5' => 'viernes',
                                    '6' => 'sábado',
                                    '7' => 'domingo'];
                                foreach($days as $day => $name)
                                {   
                                    if($day == $segment->day)
                                    {
                                        echo('<option value="'.$segment->day.'" selected>'.$days[$segment->day].'</option>');
                                    }else
                                    {
                                        echo('<option value="'.$day.'">'.$name.'</option>');
                                    } 
                                    
                                }
                            @endphp
                            
                            </select>
                        </td>
                        <td>
                            <select name="frequency" class="form-select" form="{{$segment->id}}">
                                @php
                                $frequencys = [
                                    '10',
                                    '15',
                                    '20',
                                    '30',
                                    '45',
                                    '60'];
                                foreach($frequencys as $frequency)
                                {
                                    if($frequency == $segment->frequency)
                                    {
                                        echo('<option value="'.$segment->frequency.'" selected>'.$segment->frequency.' min</option>');
                                    }else
                                    {
                                        echo('<option value="'.$frequency.'">'.$frequency.' min</option>');
                                    } 
                                    
                                }     
                                
                                @endphp
                            </select>
                            
                        </td>
                        <td>
                            <select name="start" class="form-select" form="{{$segment->id}}">
                                
                                @php
                                
                                foreach($start as $hour => $label)
                                {
                                    if($hour == $segment->start)
                                    {
                                        echo('<option value="'.$hour.'" selected>'.$label.' hs</option>');
                                    }else{
                                        echo('<option value="'.$hour.'">'.$label.' hs</option>');   
                                    }
                                    
                                }     
                                
                                @endphp    
                            </select>
                            
                        </td>
                        <td>
                            <select name="end" class="form-select" form="{{$segment->id}}">
                                
                                @php
                                
                                foreach($start as $hour => $label)
                                {
                                    if($hour == $segment->end)
                                    {
                                        echo('<option value="'.$hour.'" selected>'.$label.' hs</option>');
                                    }else{
                                        echo('<option value="'.$hour.'">'.$label.' hs</option>');   
                                    }
                                    
                                }     
                                
                                @endphp    
                            </select>
                        </td>
                        <td>
                            <select name="room_id" class="form-select" form="{{$segment->id}}">
                                
                                @php
                                
                                foreach($rooms as $room)
                                {
                                    if($room->id == $segment->room->id)
                                    {
                                        echo('<option value="'.$room->id.'" selected>'.$room->name.' </option>');
                                    }else{
                                        echo('<option value="'.$room->id.'">'.$room->name.' </option>');   
                                    }
                                    
                                }     
                                
                                @endphp    
                            </select>
                            
                        </td>
                         <td>
                            <form id="{{$segment->id}}" action="{{route('agenda.edit')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$user->id}}" name="professional_id" form="{{$segment->id}}">
                            <button type="submit" class="btn btn-sm btn-primary text-white" form="{{$segment->id}}">Editar</button>
                            </form>
                        </td>
                        <td>
                            <a class="btn btn-danger text-white" href="{{ route('agenda.delete',$segment->id) }}">Eliminar</a>
                        </td>
                    </tr>
                     
                    @endforeach
                @endif 
               
            </tbody>
        </table>

    </div>

    
</div>
