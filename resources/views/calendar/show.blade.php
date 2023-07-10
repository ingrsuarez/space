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
                  <span class="input-group-text" id="inputGroup-sizing-default">Fecha:</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="date" readonly>
                <input type="hidden" id="startDate" name="startDate" readonly>
                <input type="hidden" id="endDate" name="endDate" readonly>
                <input type="hidden" id="room" name="room_id">
                <input type="hidden" id="institution" name="institution_id" value="{{$institution->id}}">
              </div>
               <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroup-sizing-default">Observaciones:</span>
                </div>
                <input type="text" class="form-control" value="Consulta" aria-label="Default" aria-describedby="inputGroup-sizing-default" id="obs" name="obs" required>
              </div>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-info my-2" id="saveModalBtn">Agendar Turno</button>
              @livewire('find-patients')
            </div>
            <div class="modal-footer">

              
            </div>
          </div>
        </div>
      </div>





      <div class="container-fluid mx-6" id="calendar"></div>


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
            
            let calendarEl = document.getElementById('calendar');

            var calendar = new Calendar(calendarEl, {
              
              plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin, momentPlugin, bootstrap5Plugin],
              
              locale: 'es',
              editable: true,
              initialView: 'timeGridWeek',
              selectable: true,
              slotMinTime: '07:30',
              slotMaxTime: '20:00',
              scrollTime: '08:00:00',
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
                endTime: '18:00', // an end time (6pm in this example)
              },

              nowIndicator: true,
              events: appointments.concat(agenda),

             

              eventClick: function(info) {
                
                if(info.event.title != '')
                { 
                  if(confirm('Desea cancelar el turno de '+info.event.title))
                  {
                    alert('Cancelado!');
                    let event_id = info.event.id;
                    $.ajax({
                        url: "{{route('appointment.cancel')}}",
                        type: "POST",
                        dataType: 'json',
                        data: {event_id},
                        success:function(response)
                        {
                          console.log(response)
                        },
                        error:function(error)
                        {
                          console.log(error);
                        }
                      });
                      
                      location.reload();
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
                var user = 57;
                // var end = moment(start).add(15,'minutes').format();
                var today = new Date();
                var dateText = moment(start.start).locale('es').format('dddd LLL');

                var startDate = moment(start.start).format('YYYY-MM-DD HH:mm:ss');
                var endDate = moment(start.end).format('YYYY-MM-DD HH:mm:ss');
                console.log(today);
                console.log(start.start);
                $('#room').val(eid);
                $('#calendarModalLabel').text('Agendar turno');
                $('#time').val(moment(start.startStr).format('HH:mm:ss'));
                $('#startDate').val(startDate);
                $('#endDate').val(endDate);
                $('#date').val(dateText);
                if(start.start <= today){
                  alert('La fecha seleccionada ya pasó')
                }else{
                    $('#calendarModal').modal('toggle');
                    $('#saveModalBtn').click(function(){
                      var title = $('#modalTitle').val();
                      var start_date = start.startStr;
                      var end = new Date(start_date);
                      var end_date = moment(end);
                      end_date.add(15,'minutes');
                      var end_parse = end_date.format("YYYY-MM-DDTHH:mm:ssZ");
                      
                      
                    
                    })
                }
               
              }
            });
            
            calendar.render();
          });
        
  </script>

@endsection