<link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
<?php
session_start();
include 'headerView.php';
include '../db/conexion.php';

$header = new MenuView();
$header->render($header);

$id = $_SESSION['usuario_id'];

// Consulta SQL para seleccionar todos los datos del usuario con el ID proporcionado
$sql = "SELECT * FROM usuarios WHERE Id_usuario = ?";

// Preparar la consulta
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

// Obtener los resultados
$resultado = $stmt->get_result();

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Iterar sobre los resultados y mostrar la información
    while ($fila = $resultado->fetch_assoc()) {
        // echo "Nombre: " . $fila['Username'] . "<br>";
        //echo "Pass: " . $fila['Password'] . "<br>";
        $mail = $fila['Username'];
    }
} else {
    echo "No se encontraron resultados para el ID proporcionado.";
}

/******************************************************************** */
// Consulta SQL para seleccionar Id_persona y otros campos de la tabla personas
$sql = "SELECT usuarios.Id_usuario, personas.Id_persona, personas.Nombre, personas.Apellido1, personas.Apellido2
        FROM usuarios
        INNER JOIN personas ON usuarios.Id_persona = personas.Id_persona
        WHERE usuarios.Id_usuario = ?";

// Preparar la consulta
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

// Obtener los resultados
$resultado = $stmt->get_result();

// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Iterar sobre los resultados y mostrar la información
    while ($fila = $resultado->fetch_assoc()) {
        $nombre= $fila['Nombre'];
        $apellido1= $fila['Apellido1'];
        $apellido2= $fila['Apellido2'];
        // Puedes agregar más campos según la estructura de tu tabla
    }
} else {
    echo "No se encontraron resultados para el ID proporcionado.";
}

 /********************************************************************** */


// Verificar si se encontraron resultados
if ($resultado->num_rows > 0) {
    // Iterar sobre los resultados y mostrar la información
    while ($fila = $resultado->fetch_assoc()) {
        $mail = $fila['Username'];
    }
} else {
    echo "No se encontraron resultados para el ID proporcionado.";
}
// ****************************************************************** //
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verificar si el formulario de cambio de contraseña fue enviado
    if (isset($_POST['guardar_cambios'])) {
      $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : null;
      // $password = $_POST['password'];
      $new_password = $_POST['new_password'];
      $confirm_password = $_POST['confirm_password'];

      // Verificar que la nueva contraseña y la confirmación coincidan
      if ($new_password === $confirm_password) {
          // Hash de la nueva contraseña
          $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

          // Actualizar la contraseña en la base de datos
          $sql_update_password = "UPDATE usuarios SET Password = ? WHERE Id_usuario = ?";
          $stmt_update_password = $conexion->prepare($sql_update_password);
          $stmt_update_password->bind_param("si", $hashed_new_password, $id);
      } else {
          echo "La nueva contraseña y la confirmación de contraseña no coinciden.";
      }




      // Actualizar otros campos
      $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
      $apellido1 = isset($_POST['apellido1']) ? $_POST['apellido1'] : null;
      $apellido2 = isset($_POST['apellido2']) ? $_POST['apellido2'] : null;

      // Consulta SQL para actualizar otros campos
      $sql_update_info = "UPDATE personas SET Nombre = ?, Apellido1 = ?, Apellido2 = ? WHERE Id_persona = ?";
      $stmt_update_info = $conexion->prepare($sql_update_info);
      $stmt_update_info->bind_param("sssi", $nombre, $apellido1, $apellido2, $id);

      if ($stmt_update_info->execute()) {
          echo '<div class="alert alert-success" role="alert">
                  Información actualizada correctamente.
                </div>';
      } else {
          echo "Error al actualizar la información: " . $stmt_update_info->error;
      }
    }

    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Enlace a Bootstrap CSS -->
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <!-- <title>Modal de Cambio de Contraseña</title> -->
</head>

<body>
  <div class="container">
    <!-- <h1>Modal de Cambio de Contraseña</h1> -->
    <h2>Información</h2>
    <?php 
        echo 'Email: '.$mail.'<br>';
        echo 'Nombre: '.$nombre.'<br>';
        echo 'Primer Apellido: '.$apellido1.'<br>';
        echo 'Segundo Apellido: '.$apellido2.'<br>';
    ?>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cambioContrasenaModal">
      Modificar Datos
    </button>

    <!-- Modal -->
    <div class="modal fade" id="cambioContrasenaModal" tabindex="-1" role="dialog"
      aria-labelledby="cambioContrasenaModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="cambioContrasenaModalLabel">Cambio de Contraseña</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="POST" action="perfilView.php">
              <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
              </div>
              <div class="form-group">
                  <label for="apellido1">Primer Apellido</label>
                  <input type="text" class="form-control" id="apellido1" name="apellido1" value="<?php echo $apellido1; ?>">
              </div>
              <div class="form-group">
                  <label for="apellido2">Segundo Apellido</label>
                  <input type="text" class="form-control" id="apellido2" name="apellido2" value="<?php echo $apellido2; ?>">
              </div>
              <div class="form-group">
                <label for="newPassword">Nueva contraseña</label>
                <input type="password" class="form-control" id="newPassword" name="new_password" >
              </div>
              <div class="form-group">
                <label for="confirmPassword">Confirmar contraseña</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" >
              </div>
              <button type="submit" class="btn btn-primary" name="guardar_cambios">Guardar cambios</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts de Bootstrap y jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
