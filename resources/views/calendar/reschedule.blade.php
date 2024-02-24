@extends('layouts.app')

@section('content')
<div class="card mx-4">
    <div class="card-header">
        Agenda: <strong>
          {{ucFirst($professional->lastName).' '.ucFirst($professional->name)}}</strong><br>
        Reagendar turno de: 
        <strong>       {{ucfirst($patient->nombrePaciente).' '.ucfirst($patient->apellidoPaciente)}} </strong>
    </div>
    <div class="card-body">
        <form id="rescheduleForm" action="{{ route('appointment.restore') }}" method="POST">
            @method('POST')
            @csrf
    
            
            <div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="calendarModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="calendarModalLabel">{{ucfirst($patient->nombrePaciente).' '.ucFirst($patient->apellidoPaciente)}}</h5>
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
                      <input type="hidden" id="institution" name="patient_id" value="{{$patient->codPaciente}}">
                      <input type="hidden" id="event_id" name="event_id" value="{{$eventId}}">
                      <input type="hidden" id="insuranceId" name="insurance_id" value="{{$insuranceId}}">
                    </div>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Fecha:</span>
                      </div>
                      <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="date" readonly>
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Observaciones:</span>
                      </div>
                      <input type="text" class="form-control" value="{{$observaciones}}" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="obs" name="obs" required>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <button type="button" class="btn btn-secondary px-2 mb-2" data-bs-dismiss="modal">Cerrar</button>
                      
                      
                        <button type="submit" class="btn btn-info mx-2 mb-2" id="saveModalBtn">Agendar Turno</button>
                    </div>
                    
                  </div>
                  <div class="modal-footer">
    
                    
                  </div>
                </div>
              </div>
            </div>

            <div class="container-fluid mx-6" id="calendar"></div>
    
    
          </form>

    </div>
    <div class="container-fluid mx-6" id="calendar"></div>



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
                
                var startDay = new Date();
                startDay.setDate(today.getDate() + 7);
                today.setDate(today.getDate() - 1);
                
                var daysOfWeek = [0,1,2,3,4,5,6];

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
                });

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
                  weekends: true,
                  selectOverlap: false,
                  selectConstraint: 'available',
                  eventConstraint: "available",
                  hiddenDays: daysOfWeek,
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
                  eventOrder: "id",
                  nowIndicator: true,
                  events: appointments.concat(agenda),
                 
    
                  eventClick: function(info) {

                    
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

                    var today = new Date();
                    var dateText = moment(start.start).locale('es').format('dddd LLL');
    
                    var startDate = moment(start.start).format('YYYY-MM-DD HH:mm:ss');
                    var endDate = moment(start.end).format('YYYY-MM-DD HH:mm:ss');
                    $('#room').val(eid);
                    $('#roomLock').val(eid);
                    $('#roomNew').val(eid);
                    // $('#calendarModalLabel').text('Reagendar turno');
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