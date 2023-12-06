<?php
// Configuración de la base de datos
$host = 'localhost';
$usuario = 'root';
$contrasena = '';
$base_de_datos = 'eventos';
$puerto = 3307;

// Crear una nueva conexión
$conexion = new mysqli($host, $usuario, $contrasena, $base_de_datos, $puerto);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
else{
    // echo "Conectado 3";
}
?>
