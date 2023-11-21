<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
</head>

<body class="bg-light">
    <?php 
        require '../header.php'; 
        require '../../controllers/EventController.php';
    ?>
    <div id="home-main" class="container mt-5">
        <!-- Botones para cambiar de mes -->
        <?php
            // Obtener mes y año de los parámetros GET, o usar el mes/año actual
            $month = isset($_GET['month']) ? intval($_GET['month']) : date("m");
            $year = isset($_GET['year']) ? intval($_GET['year']) : date("Y");

            // Convertir número del mes a nombre del mes
            $fecha = mktime(0, 0, 0, $month, 1, $year);
            $monthString = date("F", $fecha);

            // Calcular mes y año anterior
            $prev_month = $month - 1;
            $prev_year = $year;
            if ($prev_month < 1) {
                $prev_month = 12;
                $prev_year = $year - 1;
            }

            // Calcular mes y año siguiente
            $next_month = $month + 1;
            $next_year = $year;
            if ($next_month > 12) {
                $next_month = 1;
                $next_year = $year + 1;
            }
        ?>
        <div class="d-flex justify-content-between mx-auto w-75">
            <a class="flecha" href="?month=<?= $prev_month; ?>&year=<?= $prev_year; ?>"><i class="fi fi-rr-angle-left"></i></a>
            <h2><?= $monthString . " - " . $year ?></h2>
            <a class="flecha" href="?month=<?= $next_month; ?>&year=<?= $next_year; ?>"><i class="fi fi-rr-angle-right"></i></a>
        </div><br>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                    <th>Sun</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Obtener el primer día del mes
                $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
                // Obtener el nombre del día
                $dayOfWeek = date("w", $firstDayOfMonth);
                // Obtener el número de días en el mes
                $daysInMonth = date("t", $firstDayOfMonth);

                // Ajustar el día de la semana para empezar desde lunes (1)
                $dayOfWeek = ($dayOfWeek == 0 ? 7 : $dayOfWeek);

                // Calendario
                // crear objeto Event y obtener la información de los eventos 
                $eventController = new EventController();
                $events = $eventController->getEvents($month, $year);

                $currentDay = 1;
                for ($i = 0; $i < 5; $i++) {
                    echo "<tr>";
                    for ($j = 1; $j <= 7; $j++) {
                        echo "<td>";
                        if ($i == 0 && $j < $dayOfWeek) {
                            echo " ";
                        } else if ($currentDay <= $daysInMonth) {
                            echo $currentDay;
                            // Aquí, verifica si hay eventos para este día
                            foreach ($events as $event) {
                                if ($event['Fecha'] == date("Y-m-d", strtotime("$year-$month-$currentDay"))) {
                                    echo "<div class='event'>" . $event['Titulo'] . "</div>"; // Puedes personalizar esto
                                }
                            }
                            $currentDay++;
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>            
        </table>
        <div class="tipo_calendario">
            <a class="btn btn-outline-primary" href="./calendarioSemana.php"><img style="width: 50%" class="icono" src="/public/img/semana_dark.png"></a>
            <a class="btn btn-secondary" href="./index.php"><i class="fi fi-rr-refresh"></i></a>
            <a class="btn btn-outline-primary" href="./calendarioDia.php"><img style="width: 25%" class="icono" src="/public/img/dia_dark.png"></a>
        </div>
    </div>
</body>

</html>