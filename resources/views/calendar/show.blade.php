@extends('layouts.app')

@section('content')

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
                
                <div class="d-flex mb-3">
                  <button type="button" class="btn btn-secondary px-2 mb-2" data-bs-dismiss="modal">Cerrar</button>
                  
                  
                  <button type="submit" class="btn btn-warning mx-2 px-2 mb-2" id="lockBtn" form="lock">Bloqueo</button>
                  <button type="submit" class="btn btn-primary ms-auto px-2 mb-2" id="newPatient" form="createAndAppoint">Nuevo Paciente</button>
                  <button type="submit" class="btn btn-info mx-2 mb-2" id="saveModalBtn">Agendar Turno</button>
                </div>
                @livewire('find-patients')
              </div>
              <div class="modal-footer">

                
              </div>
            </div>
          </div>
        </div>





        <div class="container-fluid mx-6" id="calendar"></div>


      </form>

      {{-- EVENT CLICKED --}}
      <form id="eventAction" action="{{ route('appointment.cancel') }}" method="POST">
        @method('POST')
        @csrf

        
        <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="eventPaciente"></h5>
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
                  <button type="button" class="btn btn-secondary px-2 mb-2" data-bs-dismiss="modal">Cerrar</button>
                  
                  
                  <button type="submit" class="btn btn-primary mx-2 px-2 mb-2" id="lockBtn" form="sendToWatingList">Enviar a lista de espera</button>
                  <button type="submit" class="btn btn-warning ms-auto px-2 mb-2" id="newPatient" form="eventAction">Cancelar</button>
                  <button type="submit" class="btn btn-info mx-2 mb-2" id="saveModalBtn" form="eventReschedule">Reagendar</button>
                </div>
                
              </div>
              <div class="modal-footer">

                
              </div>
            </div>
          </div>
        </div>


      </form>
      <form id="sendToWatingList" action="{{ route('appointment.toWaitingList') }}" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" id="institution" name="institution_id" value="{{$institution->id}}">
        <input type="hidden" id="patient" name="patient_id" value="">
        <input type="hidden" id="professional" name="professional_id" value="{{$professional->id}}">
      </form>
      {{-- EVENT CLICKED --}}
      <form id="eventReschedule" action="{{ route('appointment.reschedule') }}" method="POST">
        @method('POST')
        @csrf
        <input type="hidden" id="institutionEvent" name="institution_id" value="{{$institution->id}}">
        <input type="hidden" id="professionalEvent" name="professional_id" value="{{$professional->id}}">
        <input type="hidden" id="patientEvent" name="patient_id" value="">
        <input type="hidden" id="eventId" name="event_id" value="">
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
            var frequency = @json($frequency);
            var today = new Date();
            today.setDate(today.getDate() + 7);
            let calendarEl = document.getElementById('calendar');
            
            var calendar = new Calendar(calendarEl, {
              
              plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin, momentPlugin, bootstrap5Plugin],
              
              locale: 'es',
              editable: true,
              initialView: 'timeGridWeek',
              initialDate: today,
              selectable: true,
              slotMinTime: '08:00',
              slotMaxTime: '20:00',
              scrollTime: '09:00',
              slotDuration: frequency,
              slotLabelInterval: frequency,
              firstDay: 1,
              height: 1350,
              weekends: false,
              selectOverlap: false,
              selectConstraint: 'available',
              eventConstraint: "available",

              headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: 'timeGridWeek,timeGridDay,dayGridMonth' 
              },

              businessHours: {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                daysOfWeek: [ 1, 2, 3, 4, 5 ], // Monday - Thursday

                startTime: '07:00', // a start time (10am in this example)
                endTime: '19:00', // an end time (6pm in this example)
              },

              nowIndicator: true,
              events: appointments.concat(agenda),
             

              eventClick: function(info) {
                if(info.event.title != '')
                {
                  $('#eventPaciente').text(info.event.extendedProps.nombrePaciente);
                  $('#eventModal').modal('toggle');
                  var today = new Date();
                  var dateText = moment(info.event.start).locale('es').format('dddd LLL');
                  var startDate = moment(info.event.start).format('YYYY-MM-DD HH:mm:ss');
                  var endDate = moment(info.event.end).format('YYYY-MM-DD HH:mm:ss');
                  
                  $('#patientEvent').val(info.event.extendedProps.paciente);
                  $('#patient').val(info.event.extendedProps.paciente);
                  $('#dateEvent').val(dateText);
                  $('#event_id').val(info.event.id);
                  $('#startDateEvent').val(startDate);
                  $('#timeEvent').val(moment(startDate).format('HH:mm:ss'));
                  $('#timeEndEvent').val(moment(endDate).format('HH:mm:ss'));
                  $('#startDateNew').val(startDate);
                  $('#startDateLock').val(startDate);
                  $('#endDateEvent').val(endDate);
                  $('#endDateNew').val(endDate);
                  $('#endDateLock').val(endDate);
                  $('#eventId').val(info.event.id);
                }
                // if(info.event.title != '')
                // { 


                  
                  // locked = info.event.title.slice(0, 9);
                  // if(locked != 'Bloqueado')
                  // {
                  //   if(confirm('Desea cancelar el turno de '+info.event.title))
                  //   {
                  //     alert('Cancelado!');
                  //     let event_id = info.event.id;
                  //     $.ajax({
                  //         url: "{{route('appointment.cancel')}}",
                  //         type: "POST",
                  //         dataType: 'json',
                  //         data: {event_id},
                  //         success:function(response)
                  //         {
                  //           console.log(response)
                  //         },
                  //         error:function(error)
                  //         {
                  //           console.log(error);
                  //         }
                  //       });
                        
                  //       location.reload();
                  //   }

                  // }
                  // else{
                  //   console.log(info);
                  // }
                      

                
                
                
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
               
              }
            });
            
            calendar.render();
          });
        
  </script>

@endsection