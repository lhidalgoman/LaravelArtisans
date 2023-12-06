<?php
require_once 'controller/usuariosController.php';

$usuariosController = new UsuariosController();

// Procesar registro
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'register') {
    $nombre = $_POST['nombre'];
    $apellido1 = $_POST['apellido1'];
    $apellido2 = $_POST['apellido2'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];    
    $tipo_usuario = $_POST['tipo_usuario'];

    // if ($usuariosController->registrarUsuario($email, $contrasena, $tipo_usuario, $nombre, $apellido1, $apellido2) && $usuariosController->registrarPersona($nombre, $apellido1, $apellido2)) {
    //     // Registro exitoso, redirigir al usuario a la página de login
    //     header('Location: login.php');
    //     exit();
    // }

    if ($usuariosController->registrarUsuario($email, $contrasena, $tipo_usuario, $nombre, $apellido1, $apellido2)) {
        // Registro exitoso, redirigir al usuario a la página de login
        header('Location: login.php');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <!-- Enlaza el archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/assets/img/calendario2.png" type="image/x-icon">
    <!-- Estilo personalizado para el fondo de la página -->
    <style>
        body {
            background-image: url('assets/img/fondo2.png');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .registro-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container registro-container">
        <form method="post" action="registro.php" class="registro">
            <h2 class="text-center">Registro</h2>
            <input type="hidden" name="action" value="register">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="apellido1">Primer Apellido:</label>
                <input type="text" name="apellido1" id="apellido1" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="apellido2">Segundo Apellido:</label>
                <input type="text" name="apellido2" id="apellido2" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="tipo_usuario">Tipo de usuario</label>
                <select class="form-control" name="tipo_usuario" id="tipo_usuario">
                    <option value="3">Usuario</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
            </div>
            <div class="form-group text-center">
                <input type="submit" value="Registrarse" class="btn btn-primary">
            </div>
            <p class="text-center">¿Ya tiene cuenta? <a href="login.php">Entrar</a></p>
        </form>
    </div>
    
    <!-- Enlaza el archivo JavaScript de Bootstrap (si es necesario) -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>



