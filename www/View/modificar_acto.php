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

// Obtener el ID del acto de la URL
$id_acto = isset($_GET['id']) ? $_GET['id'] : die('ID del acto no proporcionado.');
// Consulta SQL para obtener los datos del acto
$sql_select = "SELECT * FROM Actos WHERE Id_acto = ?";
$stmt_select = $conexion->prepare($sql_select);
$stmt_select->bind_param("i", $id_acto);
$stmt_select->execute();
$resultado = $stmt_select->get_result();
// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    $acto = $resultado->fetch_assoc();

    // Verificar si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos actualizados desde el formulario
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $titulo = $_POST['titulo'];
        $descripcion_corta = $_POST['descripcion_corta'];
        $descripcion_larga = $_POST['descripcion_larga'];
        $num_asistentes = $_POST['num_asistentes'];
        $id_tipo_acto = $_POST['id_tipo_acto'];

        // Obtener el ID del ponente seleccionado
        $id_ponente = $_POST['id_ponente'];

        // Consulta SQL para actualizar los datos del acto
        $sql_update = "UPDATE Actos SET Fecha=?, Hora=?, Titulo=?, Descripcion_corta=?, Descripcion_larga=?, Num_asistentes=?, Id_tipo_acto=?, id_ponente=? WHERE Id_acto=?";
        $stmt_update = $conexion->prepare($sql_update);
        $stmt_update->bind_param("ssssssiii", $fecha, $hora, $titulo, $descripcion_corta, $descripcion_larga, $num_asistentes, $id_tipo_acto, $id_ponente, $id_acto);

        // Ejecutar la actualización
        if ($stmt_update->execute()) {
            echo '<div class="alert alert-success" role="alert">
                    Los datos se han actualizado correctamente.
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Error al actualizar los datos.
                  </div>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Modificar Acto</title>
</head>

<body>

    <div class="container mt-5">
        <h1>Modificar Acto</h1>

        <form method="POST">
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="text" class="form-control" id="fecha" name="fecha" value="<?php echo $acto['Fecha']; ?>">
            </div>

            <div class="form-group">
                <label for="hora">Hora</label>
                <input type="text" class="form-control" id="hora" name="hora" value="<?php echo $acto['Hora']; ?>">
            </div>

            <div class="form-group">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $acto['Titulo']; ?>">
            </div>

            <div class="form-group">
                <label for="descripcion_corta">Descripción Corta</label>
                <input type="text" class="form-control" id="descripcion_corta" name="descripcion_corta" value="<?php echo $acto['Descripcion_corta']; ?>">
            </div>

            <div class="form-group">
                <label for="descripcion_larga">Descripción Larga</label>
                <textarea class="form-control" id="descripcion_larga" name="descripcion_larga" rows="3"><?php echo $acto['Descripcion_larga']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="num_asistentes">Número de Asistentes</label>
                <input type="text" class="form-control" id="num_asistentes" name="num_asistentes" value="<?php echo $acto['Num_asistentes']; ?>">
            </div>

            <div class="form-group">
                <label for="id_tipo_acto">ID Tipo Acto</label>
                <input type="text" class="form-control" id="id_tipo_acto" name="id_tipo_acto" value="<?php echo $acto['Id_tipo_acto']; ?>">
            </div>

            <div class="form-group">
            <label for="id_ponente">Ponente:</label>
            <select class="form-control" id="id_ponente" name="id_ponente" required>
                <?php 
                        $id_ponente = $acto['id_ponente'];
                    // $sql = 'select Id_persona form lista_ponentes where id_ponente= '.$acto['id_ponente'];

                ?>
                <!-- AQUI QUIERO MOSTRAR EL NOMBRE DEL PONENTE ACTUAL, DE MOMENTO SE MUESTRA EL ID -->
                <option value="<?php echo $acto['id_ponente']; ?>">
                    <?php
                        // Obtener el nombre del ponente actual
                        $query = "SELECT p.Nombre FROM lista_ponentes lp
                                INNER JOIN personas p ON lp.id_persona = p.id_persona
                                WHERE lp.id_ponente = $id_ponente";
                        $result = $conexion->query($query);

                        // Verificar si se encontraron resultados
                        if ($result && $result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            echo $row['Nombre'];
                        }
                    ?>
                </option>
                
                <?php
                // Obtener la lista de ponentes y sus nombres
                $query = "SELECT lp.id_ponente, p.Nombre FROM lista_ponentes lp
                        INNER JOIN personas p ON lp.id_persona = p.id_persona";
                $result = $conexion->query($query);

                // Verificar si se encontraron resultados
                if ($result && $result->num_rows > 0) {
                    // Construir las opciones del select
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_ponente'] . '">' . $row['Nombre'] . '</option>';
                    }
                }
                ?>
            </select>
        </div>

            <!-- Puedes agregar más campos según sea necesario -->

            <button type="submit" class="btn btn-primary mb-5">
                Guardar Cambios
            </button>
        </form>
    </div>

    <!-- Otro contenido del modal y scripts -->

</body>

</html>

<?php
} else {
    echo "No se encontró el acto en la base de datos.";
}
?>
