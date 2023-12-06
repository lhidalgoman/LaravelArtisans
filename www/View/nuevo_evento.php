<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<?php
session_start();
if (!isset($_SESSION['es_admin']) || $_SESSION['es_admin'] !== true) {
    header('Location: ../login.php');
    exit();
}
include 'headerView.php';

$header = new MenuView();
$header->render($header);

include '../Controller/ActoController.php';

// La conexión ya debería estar establecida en tu aplicación
include '../db/conexion.php';

$controlador = new ActoController($conexion);
$message = '';

try {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $titulo = $_POST['titulo'];
        $descripcionCorta = $_POST['descripcionCorta'];
        $descripcionLarga = $_POST['descripcionLarga'];
        $numAsistentes = $_POST['numAsistentes'];
        $idTipoActo = $_POST['idTipoActo'];
        
        // Obtener el ID del ponente seleccionado
        $id_ponente = $_POST['id_ponente'];

        $controlador->agregarActo($fecha, $hora, $titulo, $descripcionCorta, $descripcionLarga, $numAsistentes, $idTipoActo, $id_ponente);

        $message = 'Acto agregado exitosamente!';
    }
} catch (Exception $e) {
    $message = 'Hubo un error al agregar el acto: ' . $e->getMessage();
}

?>

<div class="container mt-5">
    <?php if (!empty($message)): ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <form  method="post" id="addActoForm">
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="form-group">
            <label for="hora">Hora:</label>
            <input type="time" class="form-control" id="hora" name="hora" required>
        </div>
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="descripcionCorta">Descripción corta:</label>
            <textarea class="form-control" id="descripcionCorta" name="descripcionCorta" required></textarea>
        </div>
        <div class="form-group">
            <label for="descripcionLarga">Descripción larga:</label>
            <textarea class="form-control" id="descripcionLarga" name="descripcionLarga" required></textarea>
        </div>
        <div class="form-group">
            <label for="numAsistentes">Número de asistentes:</label>
            <input type="number" class="form-control" id="numAsistentes" name="numAsistentes" required>
        </div>
        <div class="form-group">
            <label for="idTipoActo">Tipo de Acto:</label>
            <select class="form-control" id="idTipoActo" name="idTipoActo" required>
                <option value="">Elige una opción</option>
                <option value="1">Musical</option>
                <option value="2">Gastronómico</option>
                <option value="3">Cine</option>
                <option value="4">Teatro</option>
                <option value="5">Moda</option>
            </select>
        </div>

        <div class="form-group">
            <label for="id_ponente">Ponente:</label>
            <select class="form-control" id="id_ponente" name="id_ponente" required>
                <option value="">Elige una opción</option>
                
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


        <button type="submit" class="btn btn-primary mt-3">Agregar Acto</button>
    </form>
</div>


