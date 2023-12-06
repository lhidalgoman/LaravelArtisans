<?php
session_start();
// Verificar si el usuario está conectado
$usuarioConectado = isset($_SESSION['usuario_id']);
// Verificar si el usuario es administrador
$esAdmin = isset($_SESSION['es_admin']) && $_SESSION['es_admin'];

if (!$usuarioConectado) {
    // Si el usuario no está conectado, redirigir a la página de login
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Artisans</title>
    <!-- Enlaza el archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <style>
        .navbar-menu .nav-link {
            margin-right: 5px; /* Ajusta el margen según tus preferencias */
        }
    </style>
    <link rel="shortcut icon" href="/assets/img/calendario2.png" type="image/x-icon">
</head>
<body>
    <header class="bg-danger text-white p-4">
        <!-- Encabezado con fondo azul y texto blanco -->
        <h1 class="text-center">Bienvenido al Gestor de Eventos de Laravel Artisans</h1>
        <nav class="text-center navbar-menu">
            <!-- Enlaces con estilo de botón Bootstrap -->
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="bg-warning nav-link btn btn-light mr-2" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="bg-warning nav-link btn btn-light mr-2" href="../MVC-Laravel-Artisans-p2/View/eventosView.php">Calendario</a>
                </li>
                <li class="nav-item">
                    <a class="bg-warning nav-link btn btn-light mr-2" href="../MVC-Laravel-Artisans-p2/View/perfilView.php">Perfil</a>
                </li>
                <?php if ($esAdmin): ?>
                    <!-- Mostrar solo si el usuario es administrador -->
                    <li class="nav-item">
                        <a class="bg-warning nav-link btn btn-light mr-2" href="../MVC-Laravel-Artisans-p2/View/actosView.php">Actos</a>
                    </li>
                    <li class="nav-item">
                        <a class="bg-warning nav-link btn btn-light mr-2" href="../MVC-Laravel-Artisans-p2/View/inscripcionesView.php">Inscripciones</a>
                    </li>
                <?php endif; ?>
                <!-- Boton para salir -->
                <li class="nav-item ml-auto">
                    <a class="bg-warning nav-link btn btn-light ml-auto" href="logout.php">Salir</a>
                </li>
            </ul>
        </nav>
    </header>


    <!-- <h1 class="d-flex align-items-center justify-content-center vh-100">
        AQUI EL CONTENIDO DE INICIOaaaaaaaaaaaaa
    </h1> -->
    <div class="container">
    <h1 class="mt-5">¡Bienvenido a nuestra web de eventos!</h1>
    <p class="lead">Aquí podrás encontrar información sobre los eventos a los que estás invitado, así como aquellos a los que aún no has recibido una invitación.</p>
    <p>Además, tendrás la posibilidad de modificar tus datos personales y navegar por nuestra web de manera fácil y rápida.</p>
    <p>Explora la variedad de eventos que ofrecemos y encuentra aquellos que más te interesen. ¡No te pierdas ninguna experiencia única!</p>
    <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos. ¡Estamos aquí para brindarte la mejor experiencia en eventos!</p>
    <a href="../MVC-Laravel-Artisans-p2/view/eventosView.php" class="btn btn-primary mt-3">Ver eventos</a>
  </div>

  <!-- Scripts de Bootstrap y jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <!-- Pie de página con estilo de Bootstrap -->
    <footer class="bg-dark text-white text-center p-2 fixed-bottom">
        <p>&copy; <?php echo date("Y"); ?> Laravel Artisans - MVC - 2</p>
    </footer>
    </body>
</html>


<?php

// Incluimos el archivo de la vista del menú principal
// include 'View/clientesView.php';
// include 'View/headerView.php';

// $header = new MenuView();
// $header->render($header);
