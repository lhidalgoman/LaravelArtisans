<?php
session_start();
require_once 'controller/usuariosController.php';
$usuariosController = new UsuariosController();
$error = '';
// Procesar login
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login') {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    if ($usuariosController->login($email, $contrasena)) {
        // Login exitoso, redirigir al usuario a la página principal
        header('Location: index.php');
        exit();
    }
    else{
       $error = '<p style="color: red;">Credenciales incorrectos, por favor, inserte de forma correcta los credenciales</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Enlaza el archivo CSS de Bootstrap -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="/assets/img/calendario2.png" type="image/x-icon">
    <!-- Estilo personalizado para el fondo de la página y centrado -->
    <style>
        body {
            background-image: url('assets/img/fondo.png');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .login {
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
    <form method="post" action="login.php" class="login">
        <h2 class="text-center">Login</h2>
        <input type="hidden" name="action" value="login">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" name="contrasena" id="contrasena" class="form-control" required>
        </div>
        <div class="form-group text-center">
            <input type="submit" value="Iniciar sesión" class="btn btn-primary">
        </div>
        <p class="text-center">¿No tiene cuenta? <a href="registro.php">Registrarse</a></p>
        <?php 
           echo $error;
        ?>
    </form>
    
    <!-- Enlaza el archivo JavaScript de Bootstrap (si es necesario) -->
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>

