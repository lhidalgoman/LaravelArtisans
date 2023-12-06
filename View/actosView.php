<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<?php
session_start();
include 'headerView.php';
include '../db/conexion.php';

if (!isset($_SESSION['es_admin'])) {
    session_destroy();
    header('Location: ../login.php');
}
$header = new MenuView();
$header->render($header);

// Consulta SQL para seleccionar todos los actos
$sql = "SELECT * FROM Actos";

// Preparar la consulta
$stmt = $conexion->prepare($sql);
$stmt->execute();

// Obtener los resultados
$resultado = $stmt->get_result();

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Mostrar una tabla con los actos y botones de eliminar/modificar
    echo '<div class="container mt-5">
        <h1>Lista de Actos</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Título</th>
                        <th>Descripción Corta</th>
                        <th>Descripción Larga</th>
                        <th>Número de Asistentes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

while ($fila = $resultado->fetch_assoc()) {
    echo '<tr>
            <td>' . $fila['Fecha'] . '</td>
            <td>' . $fila['Hora'] . '</td>
            <td>' . $fila['Titulo'] . '</td>
            <td>' . $fila['Descripcion_corta'] . '</td>
            <td>' . $fila['Descripcion_larga'] . '</td>
            <td>' . $fila['Num_asistentes'] . '</td>
            <td>
                <a href="eliminar_acto.php?id=' . $fila['Id_acto'] . '" class="btn btn-danger">Eliminar</a>
                <a href="modificar_acto.php?id=' . $fila['Id_acto'] . '" class="btn btn-primary">Modificar</a>
            </td>
        </tr>';
}

echo '</tbody></table></div></div>';

} else {
    echo "No se encontraron actos en la base de datos.";
}
?>
<h1>AQUI SE VERÍA EL CONTENIDO DEL PERFIL</h1>
