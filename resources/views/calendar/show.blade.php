@extends('layouts.app')

@section('content')


    @if(count($notes) >= 1)
      <script type="text/javascript">
        window.onload = () => {
            $('#notesModal').modal('show');
        }
      </script>

    @endif

    <form id="notes" action="{{ route('note.read') }}" method="POST">
      @method('POST')
      @csrf

      <div class="modal fade" id="notesModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="notesModalLabel">Indicaciones de {{strToUpper($professional->lastName.' '.$professional->name)}}</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-default">NOTAS:{{request()->session()->get('notes'.$professional->id)}}</span>
                          </div>
                      </div>
                      <input type="hidden" name="user_note" id="note" value="{{$professional->id}}">
                      <div class="card mb-4  shadow">
                        <div class="card-header text-white bg-primary">
                            Notas:
                        </div>
                        <div class="card-body">

                            <table class="table">
                                <thead class="table-light">
                                    <th class="d-none d-md-table-cell">Título</th>
                                    <th class="w-25">Nota</th>
                                      @if(!$user->hasRole('profesional'))
                                          <th>Nombre</th>
                                      @endif
                                    <th class="d-none d-md-table-cell">Fecha</th>
                                    
                                </thead>
                                <tbody>
                                @foreach($notes as $note)   
                                    <tr>
                                        <td class="d-none d-md-table-cell">{{Str::ucfirst($note->title)}}</td> 
                                        <td class="w-25">{{Str::ucfirst($note->note)}}</td>
                                        @if(!$user->hasRole('profesional'))
                                            <td>{{ucwords($note->lastName.' '.$note->name)}}</td>
                                        @endif
                                        <td class="d-none d-md-table-cell">{{date("d-m-Y", strtotime($note->created_at))}}</td>
                                        
                                    </tr>   
                                @endforeach   
                              </tbody>
                            </table>
                            <div>
                              <button class="btn btn-outline-success " type="submit">Marcar como leidas</button>
                              {{-- <a class="btn btn-info text-white" href="">Marcar como leida</a>     --}}
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer">

                  
                  </div>
              </div>
          </div>
      </div>
    </form>
  <div class="card mx-4">
    <div class="card-header">
      Agenda: <strong>
          {{ucFirst($professional->lastName).' '.ucFirst($professional->name)}}  
        </strong>
    </div>
    <div class="card-body">

      <!-- Modal -->
      <form id="lock" action="{{ route('appointment.storeLock') }}" method="POST">
        @method('POST')
        @csrf
          <input type="hidden" name="user_id" value="{{$professional->id}}">
          <input type="hidden" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="dateLock" readonly>
          <input type="hidden" id="startDateLock" name="startDate" readonly>
          <input type="hidden" id="endDateLock" name="endDate" readonly>
          <input type="hidden" id="roomLock" name="room_id">
          <input type="hidden" id="institutionLock" name="institution_id" value="{{$institution->id}}">
      </form>
      <form id="createAndAppoint" action="{{ route('createAndAppoint') }}" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" name="user_id" value="{{$professional->id}}">
        <input type="hidden" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="dateLock" readonly>
        <input type="hidden" id="startDateNew" name="startDate" readonly>
        <input type="hidden" id="endDateNew" name="endDate" readonly>
        <input type="hidden" id="roomNew" name="room_id">
        <input type="hidden" id="obsNew" name="obs">
        <input type="hidden" id="institutionNew" name="institution_id" value="{{$institution->id}}">
      </form>

      {{-- DAY CLICKED --}}
      <form id="dayClick" action="{{ route('appointment.day') }}" method="POST">
        @method('POST')
        @csrf

        
        <div class="modal fade" id="dayModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="eventPaciente">Turnos del día</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Profesional:</span>
                  </div>
                  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="userEvent" value="{{ucfirst($professional->lastName).' '.ucfirst($professional->name)}}" readonly>
                  <input type="hidden" name="user_id" value="{{$professional->id}}">
                  <input type="hidden" name="institution_id" value="{{$institution->id}}">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Dia:</span>
                  </div>
                  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" name="day" id="day" readonly>

                </div>
                
                <div class="d-flex mb-3">
                  <button type="button" class="btn btn-secondary px-2 mb-2" data-bs-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-warning ms-auto px-2 mb-2" form="dayClick">Imprimir</button>
                </div>
                
              </div>
              <div class="modal-footer">

                
              </div>
            </div>
          </div>
        </div>


      </form>
      {{-- EMPTY DATE CLICKED --}}
      <form id="actualizar-ficha" action="{{ route('appointment.store') }}" method="POST">
        @method('POST')
        @csrf

        
        <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="calendarModalLabel">{{$institution->name}}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Profesional:</span>
                  </div>
                  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="user" value="{{ucfirst($professional->lastName).' '.ucfirst($professional->name)}}" readonly>
                  <input type="hidden" name="user_id" value="{{$professional->id}}">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Hora:</span>
                  </div>
                  <input type="time" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="time" name="startTime" readonly>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Finaliza:</span>
                  </div>
                  <input type="time" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="timeEnd" name="endTime" readonly>
                  
                  <input type="hidden" id="startDate" name="startDate" readonly>
                  <input type="hidden" id="endDate" name="endDate" readonly>
                  <input type="hidden" id="room" name="room_id">
                  <input type="hidden" id="institution" name="institution_id" value="{{$institution->id}}">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Fecha:</span>
                  </div>
                  <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="date" readonly>
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Observaciones:</span>
                  </div>
                  <input type="text" class="form-control" value="Consulta" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="obs" name="obs" required>
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroup-sizing-default">Cobertura:</span>
                  </div>
                  <select class="form-select" name="insurance_id" required>
                    @foreach ($insurances as $insurance)
                      <option value="{{$insurance->id}}">{{$insurance->name.'  $'.$insurance->users()->where('user_id', $professional->id)->first()->pivot->patient_charge}}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="d-flex mb-3">
                  <button type="button" class="btn btn-secondary px-2 mb-2" data-bs-dismiss="modal">Cerrar</button>
                  
                  
                  <button type="submit" class="btn btn-warning mx-2 px-2 mb-2" id="lockBtn" form="lock">Bloqueo</button>
                  <button type="submit" class="btn btn-primary ms-auto px-2 mb-2" id="newPatient" form="createAndAppoint">Nuevo Paciente</button>
                  <button type="submit" class="btn btn-info mx-2 mb-2" id="saveModalBtn">Agendar Turno</button>

                </div>
                @livewire('find-patients',['professional' => $professional])
              </div>
              <div class="modal-footer">

                
              </div>
            </div>
          </div>
        </div>





        <div class="container-fluid mx-6" id="calendar"></div>


      </form>

      {{-- EVENT CLICKED --}}
      

        
        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="eventPaciente"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="eventAction" action="{{ route('appointment.cancel') }}" method="POST">
                @method('POST')
                @csrf
                <div class="modal-body">
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Profesional:</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="userEvent" value="{{ucfirst($professional->lastName).' '.ucfirst($professional->name)}}" readonly>
                    <input type="hidden" name="user_id" value="{{$professional->id}}">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Hora:</span>
                    </div>
                    <input type="time" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="timeEvent" name="startTime" readonly>
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Finaliza:</span>
                    </div>
                    <input type="time" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="timeEndEvent" name="endTime" readonly>
                    <input type="hidden" id="event_id" name="event_id" readonly>
                    <input type="hidden" id="startDateEvent" name="startDate" readonly>
                    <input type="hidden" id="endDateEvent" name="endDate" readonly>
                    <input type="hidden" id="roomEvent" name="room_id">
                    <input type="hidden" id="institutionEvent" name="institution_id" value="{{$institution->id}}">
                    <input type="hidden" id="groupId" name="groupId">
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Fecha:</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="dateEvent" readonly>
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroup-sizing-default">Observaciones:</span>
                    </div>
                    <input type="text" class="form-control" value="Consulta" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="obsEvent" name="obs" required>
                  </div>
                  
                  <div class="d-flex mb-3">
                    <button type="button" class="btn btn-secondary px-2 mb-2 shadow" data-bs-dismiss="modal">Cerrar</button>
                    
                    
                    <button type="submit" class="btn btn-warning ms-auto px-2 mb-2 shadow" id="newPatient" form="eventAction">Cancelar</button>
                    @if (!$user->hasRole('profesional'))
                    <button type="submit" class="btn btn-info mx-2 mb-2 shadow" id="saveModalBtn" form="eventReschedule">Reagendar</button>
                    <button type="submit" class="btn btn-info mx-2 mb-2 shadow" id="saveModalBtn" form="sendConfirmation">Enviar confirmacion</button>
                    <button type="submit" class="btn btn-primary mx-2 mb-2 shadow text-white" id="saveModalBtn" form="confirm">Confirmar</button>
                    @endif
                  </div>

                </div>
              </form>
              @if (!$user->hasRole('profesional'))
                <form id="sendToWatingList" action="{{ route('appointment.toWaitingList') }}" method="POST">
                @method('POST')
                @csrf
                  <div class="modal-body">
                    <input type="hidden" id="institution" name="institution_id" value="{{$institution->id}}">
                    <input type="hidden" id="watingPatient" name="patient_id">
                    <input type="hidden" id="professional" name="professional_id" value="{{$professional->id}}">
                    <input type="hidden" id="insuranceId" name="insurance_id">
                    
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Cobro: $</span>
                      </div>
                      <input type="text" class="form-control" form="sendToWatingList" name="amount" id="amount">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Método de pago:</span>
                      </div>
                      <select class="form-select" name="method" form="sendToWatingList" required>
                        {{-- @foreach ($insurances as $insurance)
                          <option value="{{$insurance->id}}">{{$insurance->name.'  $'.$insurance->users()->where('user_id', $professional->id)->first()->pivot->patient_charge}}</option>
                        @endforeach --}}
                        <option value="cash">Efectivo</option>
                      </select>
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Descripción:</span>
                      </div>
                      <input type="text" class="form-control" form="sendToWatingList" name="description" id="description">
                    </div>
                    <div class="d-flex mb-3">
                        <button type="submit" class="btn btn-primary mx-2 px-2 mb-2 shadow text-white" id="lockBtn" form="sendToWatingList">Enviar a lista de espera</button>
                    </div>
                  </div>
                </form>
              @endif
            </div>
          </div>
        </div>


      </form>
      <form id="sendConfirmation" action="{{ route('wa.send') }}" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" id="wa_event_id" name="event_id" readonly>
      </form>
      <form id="confirm" action="{{ route('appointment.confirm') }}" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" id="confirm_event_id" name="event_id" readonly>
      </form>
      {{-- <form id="sendToWatingList" action="{{ route('appointment.toWaitingList') }}" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" id="institution" name="institution_id" value="{{$institution->id}}">
        <input type="hidden" id="patient" name="patient_id" value="">
        <input type="hidden" id="professional" name="professional_id" value="{{$professional->id}}">
        <input type="hidden" id="insuranceId" name="insurance_id">

      </form> --}}
      {{-- EVENT CLICKED --}}
      <form id="eventReschedule" action="{{ route('appointment.reschedule') }}" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" id="institutionEvent" name="institution_id" value="{{$institution->id}}">
        <input type="hidden" id="professionalEvent" name="professional_id" value="{{$professional->id}}">
        <input type="hidden" id="patientEvent" name="patient_id" value="">
        <input type="hidden" id="eventId" name="event_id" value="">
        <input type="hidden" id="insuranceId2" name="insurance_id" value="">
      </form>
    </div>
  </div>
  
  <script>
    
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    document.addEventListener('DOMContentLoaded',function() {

            var appointments = @json($events);
            var eid = '3';
            var agenda = @json($availableAgenda);
            var daysOfWeek = [0,1,2,3,4,5,6];
            console.log("dias "+daysOfWeek);
            var scroll = '23:59:59';
            agenda.forEach(function(item, index){
              if (item.startTime < scroll)
              {
                scroll = item.startTime;
              }
              for (let i = 0; i < daysOfWeek.length; i++) {
                    if (daysOfWeek[i] == item.daysOfWeek[0]) {
                      delete daysOfWeek[item.daysOfWeek[0]];
                    }
                }
                
                console.log("item " +item.daysOfWeek[0]);
              
            });
            console.log(daysOfWeek);
            var hour = parseInt(scroll)-1;
            if (hour > 9)
            {
              start = hour+':00';
            }else{
              start = '0'+hour+':00';
            }
            
           

            
            var frequency = @json($frequency);
            var today = new Date();
            today.setDate(today.getDate());
            let calendarEl = document.getElementById('calendar');
            
            var calendar = new Calendar(calendarEl, {
              
              plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin, momentPlugin, bootstrap5Plugin],
              
              
              editable: true,
              initialView: 'timeGridWeek',
              initialDate: today,
              selectable: true,
              slotMinTime: start,
              slotMaxTime: '22:00',
              scrollTime: '08:00',
              slotDuration: frequency,
              slotLabelInterval: frequency,
              firstDay: 1,
              height: 2350,
              weekends: true,
              selectOverlap: false,
              selectConstraint: 'available',
              eventConstraint: "available",
              allDaySlot:false,
              displayEventTime: false,
              navLinks: true,
              hiddenDays: daysOfWeek,
              headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'timeGridWeek,timeGridDay,dayGridMonth' 
              },
              locale: 'es',
              businessHours: {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                daysOfWeek: [ 1, 2, 3, 4, 5, 6 ], // Monday - Thursday [ 1, 2, 3, 4, 5, 6 ]

                startTime: '07:00', // a start time (10am in this example)
                endTime: '22:00', // an end time (6pm in this example)
              },

              nowIndicator: true,
              events: appointments.concat(agenda),


              navLinkDayClick: function(date, jsEvent) {
                var day = moment(date.toISOString()).format('YYYY-MM-DD'); ;
                $('#day').val(day);
                $('#dayModal').modal('toggle');
              },
              eventClick: function(info) {
                // console.log(info.event);
                if(info.event.title != '')
                {
                  
                  $('#eventModal').modal('toggle');
                  var today = new Date();
                  var dateText = moment(info.event.start).locale('es').format('dddd LLL');
                  var startDate = moment(info.event.start).format('YYYY-MM-DD HH:mm:ss');
                  var endDate = moment(info.event.end).format('YYYY-MM-DD HH:mm:ss');
                  
                  $('#patientEvent').val(info.event.extendedProps.paciente);
                  $('#patient').val(info.event.extendedProps.paciente);
                  $('#watingPatient').val(info.event.extendedProps.paciente);
                  $('#dateEvent').val(dateText);
                  $('#event_id').val(info.event.id);
                  $('#wa_event_id').val(info.event.id);
                  $('#confirm_event_id').val(info.event.id);
                  $('#startDateEvent').val(startDate);
                  $('#timeEvent').val(moment(startDate).format('HH:mm:ss'));
                  $('#timeEndEvent').val(moment(endDate).format('HH:mm:ss'));
                  $('#startDateNew').val(startDate);
                  $('#startDateLock').val(startDate);
                  $('#endDateEvent').val(endDate);
                  $('#endDateNew').val(endDate);
                  $('#endDateLock').val(endDate);
                  $('#eventId').val(info.event.id);
                  $('#insuranceId').val(info.event.extendedProps.insurance);
                  $('#insuranceId2').val(info.event.extendedProps.insurance);
                  $('#groupId').val(info.event.groupId);
                  if(info.event.groupId == 'unAvailable')
                  {
                    $('#eventPaciente').text(info.event.title);
                  }else{
                    $('#eventPaciente').text(info.event.extendedProps.nombrePaciente);
                  }
                    
                }

              },

              selectOverlap: function(event) {
                eid = event.id;
                
                
                return !(event.groupId == "unAvailable");
              },

              eventDrop: function(info) {
                alert(info.event.title + " was dropped on " + info.event.start.toString());

                if (!confirm("Are you sure about this change?")) {
                  info.revert();
                }
              },

              select: function(start,end){
                
                
                console.log(eid);
                
                // var end = moment(start).add(15,'minutes').format();
                var today = new Date();
                today.setDate(today.getDate() - 1);
                var dateText = moment(start.start).locale('es').format('dddd LLL');

                var startDate = moment(start.start).format('YYYY-MM-DD HH:mm:ss');
                var endDate = moment(start.end).format('YYYY-MM-DD HH:mm:ss');
                $('#room').val(eid);
                $('#roomLock').val(eid);
                $('#roomNew').val(eid);
                $('#calendarModalLabel').text('Agendar turno');
                $('#time').val(moment(start.startStr).format('HH:mm:ss'));
                $('#timeEnd').val(moment(start.endStr).format('HH:mm:ss'));
                $('#startDate').val(startDate);
                $('#startDateNew').val(startDate);
                $('#startDateLock').val(startDate);
                $('#endDate').val(endDate);
                $('#endDateNew').val(endDate);
                $('#endDateLock').val(endDate);
                $('#date').val(dateText);
                $('#dateNew').val(dateText);
                $('#dateLock').val(dateText);
                
                if(start.start <= today){
                  alert('La fecha seleccionada ya pasó')
                }else{
                  $('#calendarModal').modal('toggle');
                }
               
              },


              
            });
            
            calendar.render();
          });
        
  </script>

@endsection