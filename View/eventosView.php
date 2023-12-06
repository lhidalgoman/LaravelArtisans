<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<?php
session_start();
include 'headerView.php';
$header = new MenuView();
$header->render($header);
$idUsuario = $_SESSION['usuario_id'];
// Obtén actos con información de participación del usuario
// $actos = $controlador->mostrarActosConParticipacion($idUsuario);

include '../Controller/ActoController.php';

// La conexión ya debería estar establecida en tu aplicación
include '../db/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>

    </style>

</head>
<body>
    <?php
    $es_admin = isset($_SESSION['es_admin']) && $_SESSION['es_admin'] === true;
    // Mostrar todos los eventos
    $controlador = new ActoController($conexion);
    $actos = $controlador->mostrarActos(); // Necesitarás ajustar tu controlador para obtener los actos

    // Convertir los datos de los actos a un formato compatible con FullCalendar
    $eventos = [];
    foreach ($actos as $acto) {
        $evento = [
            'title' => $acto['Titulo'],
            'start' => $acto['Fecha'] . 'T' . $acto['Hora'], // Formato ISO8601
            // Puedes añadir más propiedades como 'description', 'id', etc.
        ];
        array_push($eventos, $evento);
    }
    ?>
    

    <div class="container">        
        <div class="row justify-content-center">            
            <div class="col-sm-12 col-md-10 col-lg-8">
                <div class="btn-group mt-3">
                    <button type="button" class="btn btn-secondary" id="dayBtn">Día</button>
                    <button type="button" class="btn btn-secondary" id="weekBtn">Semana</button>
                    <button type="button" class="btn btn-secondary" id="monthBtn">Mes</button>
                    <!-- <button type="button" class="btn btn-secondary" id="yearBtn">Año</button> -->
                </div>      
                <?php if ($es_admin) { ?>     
                <a class="btn btn-success mt-3" href="nuevo_evento.php">Agregar evento</a>   
                <?php } ?>        
                <div id="calendar"></div>
            </div>
        </div>
    </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: <?php echo json_encode($eventos); ?>,
        });

        calendar.render();
        
        // Configurar los eventos de clic para cambiar las vistas
        document.getElementById('dayBtn').addEventListener('click', function() {
            calendar.changeView('timeGridDay');
        });

        document.getElementById('weekBtn').addEventListener('click', function() {
            calendar.changeView('timeGridWeek');
        });

        document.getElementById('monthBtn').addEventListener('click', function() { 
            calendar.changeView('dayGridMonth');
        });

        document.getElementById('yearBtn').addEventListener('click', function() {
            calendar.changeView('dayGridYear');
        });
    });
</script> 
</body>
</html>



<!-- <h1>AQUI SE VERIAN LOS EVENTO</h1> -->