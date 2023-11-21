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
        <?php
            // Obtener el número de la semana actual o de una semana específica
            $week = isset($_GET['week']) ? intval($_GET['week']) : date("W");
            $year = isset($_GET['year']) ? intval($_GET['year']) : date("Y");

            // Calcular la fecha del lunes de la semana seleccionada
            $currentWeekStart = new DateTime();
            $currentWeekStart->setISODate($year, $week);
            $month = $currentWeekStart->format("F");

            // Calcular las fechas para el resto de la semana
            $weekDays = [];
            for ($i = 0; $i < 7; $i++) {
                $weekDays[] = $currentWeekStart->format('d');
                $currentWeekStart->modify('+1 day');
            }

            // Calcular mes y año anterior
            $prevWeek = $week - 1;
            $prevYear = $year;
            if ($prevWeek < 1) {
                $prevWeek = 52;
                $prevYear = $year - 1;
            }

            // Calcular mes y año siguiente
            $nextWeek = $week + 1;
            $nextYear = $year;
            if ($nextWeek > 52) {
                $nextWeek = 1;
                $nextYear = $year + 1;
            }
        ?>

        <!-- Enlaces para cambiar de semana -->
        <div class="d-flex justify-content-between mx-auto w-75">
            <a class="flecha" href="?week=<?= $prevWeek; ?>&year=<?= $prevYear; ?>"><i class="fi fi-rr-angle-left"></i></a>
            <h2>Week <?= $week; ?> - <?= $month ?> <?= $year ?></h2>
            <a class="flecha" href="?week=<?= $nextWeek; ?>&year=<?= $nextYear; ?>"><i class="fi fi-rr-angle-right"></i></a>
        </div>
        <!-- Mostrar los días de la semana -->
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
                <tr>
                    <?php foreach ($weekDays as $day): ?>
                        <td><?= $day ?></td>
                    <?php endforeach; ?>
                </tr>
            </tbody>            
        </table>
        <div class="tipo_calendario">
            <a class="btn btn-outline-primary" href="./index.php"><img class="icono" src="/public/img/mes_dark.png"></a>
            <a class="btn btn-secondary" href="./calendarioSemana.php"><i class="fi fi-rr-refresh"></i></a>
            <a class="btn btn-outline-primary" href="./calendarioDia.php"><img class="icono" src="/public/img/dia_dark.png"></a>
        </div>
    </div>
</body>

</html>