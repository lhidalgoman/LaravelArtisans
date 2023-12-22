// Código para abrir el modal de edición al hacer clic en un evento
$('#calendar').on('click', '.fc-event', function() {
    var eventId = $(this).data('event-id');
    // Obtener los detalles del evento desde el backend usando AJAX
    $.get('/eventos/' + eventId, function(event) {
        // Rellenar el formulario del modal con los detalles del evento
        $('#editModal #eventTitle').val(event.title);
        $('#editModal #eventDate').val(event.date);
        // ...
        // Abrir el modal de edición
        $('#editModal').modal('show');
    });
});
// Código para enviar la solicitud AJAX al backend para actualizar un evento
$('#editModal #saveButton').click(function() {
    var eventId = $(this).data('event-id');
    var eventData = {
        title: $('#editModal #eventTitle').val(),
        date: $('#editModal #eventDate').val(),
        // ...
    };
    // Enviar la solicitud AJAX para actualizar el evento
    $.ajax({
        url: '/eventos/' + eventId,
        type: 'PUT',
        data: eventData,
        success: function(response) {
            // Actualizar el evento en el calendario
            // ...
            // Cerrar el modal de edición
            $('#editModal').modal('hide');
        }
    });
});

// Código para eliminar un evento
$('#editModal #deleteButton').click(function() {
    var eventId = $(this).data('event-id');
    // Mostrar confirmación al usuario
    if (confirm('¿Estás seguro de que deseas eliminar este evento?')) {
        // Enviar la solicitud AJAX para eliminar el evento
        $.ajax({
            url: '/eventos/' + eventId,
            type: 'DELETE',
            success: function(response) {
                // Eliminar el evento del calendario
                // ...
                // Cerrar el modal de edición
                $('#editModal').modal('hide');
            }
        });
    }
});

// Código para abrir el modal de añadir nuevo evento
$('#addEventButton').click(function() {
    // Abrir el modal de añadir nuevo evento
    $('#addModal').modal('show');
});

// Código para enviar la solicitud AJAX al backend para guardar un nuevo evento
$('#addModal #saveButton').click(function() {
    var eventData = {
        title: $('#addModal #eventTitle').val(),
        date: $('#addModal #eventDate').val(),
        // ...
    };
    // Enviar la solicitud AJAX para guardar el nuevo evento
    $.ajax({
        url: '/eventos',
        type: 'POST',
        data: eventData,
        success: function(response) {
            // Agregar el nuevo evento al calendario
            // ...
            // Cerrar el modal de añadir nuevo evento
            $('#addModal').modal('hide');
        }
    });
});
