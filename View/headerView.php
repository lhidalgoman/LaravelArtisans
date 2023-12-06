<?php
class MenuView {
    public function render($Menu) {
        // Esta función renderizará la vista
        // Puedes pasar datos desde $Menu y usarlos en tu vista
        
        // Verificar si el usuario es administrador
        $esAdmin = isset($_SESSION['es_admin']) && $_SESSION['es_admin'];

        // La parte de la vista HTML se encuentra aquí
        ?>
        <!DOCTYPE html>
          <html lang="es">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Laravel Artisans</title>
                <!-- Enlaza el archivo CSS de Bootstrap -->
                <!-- <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"> -->
                <style>
                    .navbar-menu .nav-link {
                        margin-right: 5px; /* Ajusta el margen según tus preferencias */
                    }
                </style>
                <link rel="shortcut icon" href="/assets/img/calendario2.png" type="image/x-icon">
            </head>
            <header class="bg-danger text-white p-4">
                <!-- Encabezado con fondo azul y texto blanco -->
                <h1 class="text-center">Bienvenido al Gestor de Eventos de Laravel Artisans</h1>
                <nav class="text-center navbar-menu">
                    <!-- Enlaces con estilo de botón Bootstrap -->
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="bg-warning nav-link btn btn-light mr-2" href="../index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="bg-warning nav-link btn btn-light mr-2" href="eventosView.php">Calendario</a>
                        </li>
                        <li class="nav-item">
                            <a class="bg-warning nav-link btn btn-light mr-2" href="perfilView.php">Perfil</a>
                        </li>
                        <?php if ($esAdmin): ?>
                            <!-- Mostrar solo si el usuario es administrador -->
                        <li class="nav-item">
                            <a class="bg-warning nav-link btn btn-light mr-2" href="actosView.php">Actos</a>
                        </li>
                        <li class="nav-item">
                            <a class="bg-warning nav-link btn btn-light mr-2" href="inscripcionesView.php">Inscripciones</a>
                        </li>
                        <?php endif; ?>        

                        <!-- Boton para salir -->
                        <li class="nav-item">
                            <a class="bg-warning nav-link btn btn-light ml-auto" href="../logout.php">Salir</a>
                        </li>
                    </ul>
                </nav>
            </header>
            


                    <!-- Pie de página con estilo de Bootstrap -->
                <footer class="bg-dark text-white text-center p-2 fixed-bottom">
                    <p>&copy; <?php echo date("Y"); ?> Laravel Artisans - MVC - 2</p>
                </footer>
              
          </html>
        <?php
    }
}
?>