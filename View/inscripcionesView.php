<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<?php
session_start();
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] !== true) {
    header('Location: ../login.php');
    exit();
}
include 'headerView.php';
include '../db/conexion.php';
include '../Controller/InscritoController.php';
$inscritoController = new InscritoController($conexion);

$header = new MenuView();
$header->render($header);
/************************************************************** */
// Consulta SQL para seleccionar todos los inscritos y sus datos
// Consulta SQL para seleccionar todas las inscripciones ordenadas por fecha descendente
$sql1 = "SELECT i.*, p.Nombre, p.Apellido1, p.Apellido2 FROM Inscritos i
        INNER JOIN Personas p ON i.Id_persona = p.Id_persona
        ORDER BY i.Fecha_inscripcion DESC";


// Preparar la consulta
$stmt = $conexion->prepare($sql1);
$stmt->execute();

// Obtener los resultados
$resultado = $stmt->get_result();

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Mostrar una tabla con los inscritos y botones de eliminar
    echo '<div class="container mt-5">
        <h1>Lista de Inscritos</h1>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID Inscripción</th>
                        <th>ID Persona</th>
                        <th>Nombre</th>
                        <th>Apellido 1</th>
                        <th>Apellido 2</th>
                        <th>ID Acto</th>
                        <th>Fecha Inscripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>';

    while ($fila = $resultado->fetch_assoc()) {
        $fila = array_reverse($fila);
        echo '<tr>
                <td>' . $fila['Id_inscripcion'] . '</td>
                <td>' . $fila['Id_persona'] . '</td>
                <td>' . $fila['Nombre'] . '</td>
                <td>' . $fila['Apellido1'] . '</td>
                <td>' . $fila['Apellido2'] . '</td>
                <td>' . $fila['id_acto'] . '</td>
                <td>' . $fila['Fecha_inscripcion'] . '</td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="id_inscripcion" value="' . $fila['Id_inscripcion'] . '">
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>';
    }

    echo '</tbody></table></div></div>';
} else {
    echo "No se encontraron inscritos en la base de datos.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id_inscripcion'])) {
        echo 'id_: '. $_POST['id_inscripcion'];
        $idInscripcion = $_POST['id_inscripcion'];
        $inscritoController->eliminarInscrito($idInscripcion);
        // Puedes redirigir o actualizar la página según tus necesidades
        header('Location: inscripcionesView.php');
        exit();
    }
}
/************************************************************** */
// Consulta SQL para seleccionar todos los actos
$sql = "SELECT * FROM Actos
 ORDER BY Fecha DESC";

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
                <a href="inscribir_usuario.php?id=' . $fila['Id_acto'] . '" class="btn btn-danger">Inscribir Usuario</a>
            </td>
        </tr>';
}

echo '</tbody></table></div></div>';

} else {
    echo "No se encontraron actos en la base de datos.";
}
?>
<h1>AQUI SE VERÍA EL CONTENIDO DEL PERFIL</h1>
