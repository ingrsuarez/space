//FullCalendar

import {Calendar} from '@fullcalendar/core';
window.Calendar = Calendar;
import bootstrap5Plugin from '@fullcalendar/bootstrap5';
window.bootstrap5Plugin = bootstrap5Plugin;
import dayGridPlugin from '@fullcalendar/daygrid';
window.dayGridPlugin = dayGridPlugin;
import timeGridPlugin from '@fullcalendar/timegrid';
window.timeGridPlugin = timeGridPlugin;
import listPlugin from '@fullcalendar/list';
window.listPlugin = listPlugin;
import interactionPlugin, {Draggable} from '@fullcalendar/interaction';
window.interactionPlugin = interactionPlugin;
import momentPlugin from '@fullcalendar/moment';
window.momentPlugin = momentPlugin;
window.moment = require('moment');
import allocates from '@fullcalendar/core/locales-all';
window.allocates = allocates;

document.addEventListener('DOMContentLoaded',function() {

	let calendarEl = document.getElementById('calendar');
	// var calendar = $('#calendar').fullCalendar({
	var calendar = new Calendar(calendarEl, {
		plugins: [dayGridPlugin, timeGridPlugin, listPlugin, interactionPlugin, momentPlugin, bootstrap5Plugin],
		
		locale: 'es',
		editable: true,
		initialView: 'timeGridWeek',
		scrollTime: '08:00:00',
		slotDuration: '00:15:00',
		slotLabelInterval:'00:15:00',
		headerToolbar: {
			left: 'prev,next',
			center: 'title',
			right: 'timeGridWeek,timeGridDay' // user can switch between the two
		},


	});
	calendar.render();
})