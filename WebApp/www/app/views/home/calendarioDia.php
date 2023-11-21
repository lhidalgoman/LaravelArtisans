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
            // Obtener día, mes y año de los parámetros GET, o usar la fecha actual
            $day = isset($_GET['day']) ? intval($_GET['day']) : date("d");
            $month = isset($_GET['month']) ? intval($_GET['month']) : date("m");
            $year = isset($_GET['year']) ? intval($_GET['year']) : date("Y");

            // Crear fecha actual
            $currentDate = new DateTime("$year-$month-$day");

            // Calcular día anterior y siguiente
            $prevDate = clone $currentDate;
            $prevDate->modify('-1 day');
            $nextDate = clone $currentDate;
            $nextDate->modify('+1 day');
        ?>
        <div class="d-flex justify-content-between mx-auto w-75">
            <a class="flecha" href="?day=<?= $prevDate->format('d'); ?>&month=<?= $prevDate->format('m'); ?>&year=<?= $prevDate->format('Y'); ?>">
                <i class="fi fi-rr-angle-left"></i>
            </a>
            <h2><?= $currentDate->format('F Y') ?></h2>
            <a class="flecha" href="?day=<?= $nextDate->format('d'); ?>&month=<?= $nextDate->format('m'); ?>&year=<?= $nextDate->format('Y'); ?>">
                <i class="fi fi-rr-angle-right"></i>
            </a>
        </div><br>
        <table class="day_calendar">
            <tr>
                <td class="calendar_number"><?= $currentDate->format('d') ?></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td class="content">NO HAY EVENTOS PARA ESTE DÍA</td>
            </tr>
        </table>
        <div class="tipo_calendario">
            <a class="btn btn-outline-primary" href="./index.php"><img class="icono" src="/public/img/mes_dark.png"></a>
            <a class="btn btn-secondary" href="./calendarioDia.php"><i class="fi fi-rr-refresh"></i></a>
            <a class="btn btn-outline-primary" href="./calendarioSemana.php"><img style="width: 50%" class="icono" src="/public/img/semana_dark.png"></a>
        </div>
    </div>
</body>

</html>