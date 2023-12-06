<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<?php
session_start();
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] !== true) {
    header('Location: ../login.php');
    exit();
}
include 'headerView.php';
include '../db/conexion.php';

$header = new MenuView();
$header->render($header);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID del acto desde el formulario
    $id_acto = $_POST['id_acto'];

    // Obtener la lista de IDs de personas seleccionadas
    $personas_seleccionadas = $_POST['id_persona'];

    // Validar que se haya seleccionado al menos una persona
    if (empty($personas_seleccionadas)) {
        echo '<div class="alert alert-danger mt-3">Debes seleccionar al menos una persona para inscribir.</div>';
    } else {
        // Realizar la inscripción de cada persona seleccionada
        foreach ($personas_seleccionadas as $id_persona) {
            // Insertar el registro en la tabla de inscritos
            $stmt_inscribir = $conexion->prepare("INSERT INTO Inscritos (Id_persona, Id_acto, Fecha_inscripcion) VALUES (?, ?, NOW())");
            $stmt_inscribir->bind_param("ii", $id_persona, $id_acto);

            if ($stmt_inscribir->execute()) {
                echo '<div class="alert alert-success mt-3">Inscripción exitosa para la persona con ID ' . $id_persona . '.</div>';
            } else {
                echo '<div class="alert alert-danger mt-3">Error al inscribir a la persona con ID ' . $id_persona . '.</div>';
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <title>Inscripción de Usuario</title>
</head>

<body>
    <?php
    // Verificar si se ha pasado un ID de acto por parámetro
    if (isset($_GET['id'])) {
        $id_acto = $_GET['id'];
        // echo 'id acto: '.$id_acto;
        // Obtener detalles del acto
        $stmt_acto = $conexion->prepare("SELECT * FROM Actos WHERE Id_acto = ?");
        $stmt_acto->bind_param("i", $id_acto);
        $stmt_acto->execute();
        $resultado_acto = $stmt_acto->get_result();

        if ($resultado_acto->num_rows > 0) {
            $acto = $resultado_acto->fetch_assoc();

            // Mostrar detalles del acto con estilos de Bootstrap
            echo '<div class="container mt-5">
                    <h1>Detalles del Acto</h1>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">' . $acto['Titulo'] . '</h5>
                            <p class="card-text">' . $acto['Descripcion_larga'] . '</p>
                            <p class="card-text">Fecha: ' . $acto['Fecha'] . '</p>
                            <p class="card-text">Hora: ' . $acto['Hora'] . '</p>
                            <p class="card-text">Número de Asistentes: ' . $acto['Num_asistentes'] . '</p>
                        </div>
                    </div>';

            // Formulario para seleccionar personas
            echo '<form method="POST">
                    <input type="hidden" name="id_acto" value="' . $id_acto . '">
                    <div class="form-group mt-3">
                        <label for="id_persona">Seleccionar Persona:</label>
                        <select class="form-control" id="id_persona" name="id_persona[]" multiple required>';
            
                        // Obtener lista de personas
                        $stmt_personas = $conexion->prepare("SELECT Id_persona, Nombre, Apellido1, Apellido2 FROM Personas");
                        $stmt_personas->execute();
                        $resultado_personas = $stmt_personas->get_result();

                        while ($persona = $resultado_personas->fetch_assoc()) {
                            echo '<option value="' . $persona['Id_persona'] . '">' . $persona['Nombre'] . ' ' . $persona['Apellido1'] . ' ' . $persona['Apellido2'] . '</option>';
                        }

                        echo '</select>
                    </div>
                    <button type="submit" class="btn btn-primary">Inscribir Usuario</button>
                </form>
            </div>';
        } else {
            echo '<p>No se encontró el acto con el ID proporcionado.</p>';
        }
    } else {
        echo '<p>No se proporcionó un ID de acto.</p>';
    }
    ?>
</body>

</html>
