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
    <?php require '../header.php'; ?>
    <div id="home-main" class="container mt-5">
        <!-- Botones para cambiar de mes -->
        <?php
            // Obtener mes y año de los parámetros GET, o usar el mes/año actual
            $month = isset($_GET['month']) ? intval($_GET['month']) : date("m");
            $year = isset($_GET['year']) ? intval($_GET['year']) : date("Y");

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
        <div class="d-flex justify-content-between">
            <a class="flecha" href="?month=<?= $prev_month; ?>&year=<?= $prev_year; ?>"><i class="fi fi-rr-angle-left"></i></a>
            <h2><?= $month . " - " . $year ?></h2>
            <a class="flecha" href="?month=<?= $next_month; ?>&year=<?= $next_year; ?>"><i class="fi fi-rr-angle-right"></i></a>
        </div>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Lun</th>
                    <th>Mar</th>
                    <th>Mie</th>
                    <th>Jue</th>
                    <th>Vie</th>
                    <th>Sáb</th>
                    <th>Dom</th>
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
                $currentDay = 1;
                for ($i = 0; $i < 5; $i++) {
                    echo "<tr>";
                    for ($j = 1; $j <= 7; $j++) {
                        echo "<td>";
                        if ($i == 0 && $j < $dayOfWeek) {
                            // Espacio en blanco hasta llegar al primer día del mes
                            echo " ";
                        } else if ($currentDay <= $daysInMonth) {
                            // Mostrar día del mes
                            echo $currentDay;
                            $currentDay++;
                        }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>