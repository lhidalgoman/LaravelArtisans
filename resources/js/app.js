import './bootstrap';
import 'fullcalendar';
import '@fullcalendar/core';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import $, { event } from 'jquery';

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new Calendar(calendarEl, {
      plugins: [dayGridPlugin, timeGridPlugin],
      initialView: 'dayGridMonth',
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      events: actos.map(acto => ({
        title: acto.Titulo,
        start: acto.Fecha + 'T' + acto.Hora,
        id: acto.Id_acto // Utiliza la propiedad correcta del objeto para el ID
      })),
      eventDidMount: function(info) {
        var element = info.el;
        element.setAttribute('data-event-id', info.event.id); // Establecer el atributo de datos `event-id`
      }
    });
    calendar.render();
});




window.onload = function() {
    $('#calendar').on('click', '.fc-event', function() {
        var eventId = $(this).data('event-id');
        // console.log(eventId);
        // Redirigir a la vista "acto" con el ID del evento
        window.location.href = '/api/actos/' + eventId;
    });
}
