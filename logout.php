<?php
session_start();

require_once 'controller/usuariosController.php';

$usuariosController = new UsuariosController();

// Procesar logout
$usuariosController->logout();

// Redirigir al usuario a la página de login
header('Location: login.php');
exit();
?>