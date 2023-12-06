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

// Verificar si se proporcionó el ID del acto
if (isset($_GET['id'])) {
  // Obtener el ID del acto
  $id_acto = $_GET['id'];
  echo 'id del acto: '.$id_acto ;

  // Consulta SQL para eliminar registros relacionados en la tabla documentacion
  $sql_delete_documentacion = "DELETE FROM documentacion WHERE Id_acto = ?";
  $stmt_delete_documentacion = $conexion->prepare($sql_delete_documentacion);
  $stmt_delete_documentacion->bind_param("i", $id_acto);

  // Consulta SQL para eliminar registros relacionados en la tabla inscritos
  $sql_delete_inscritos = "DELETE FROM inscritos WHERE Id_acto = ?";
  $stmt_delete_inscritos = $conexion->prepare($sql_delete_inscritos);
  $stmt_delete_inscritos->bind_param("i", $id_acto);

  // Consulta SQL para eliminar registros relacionados en la tabla lista_ponentes
  $sql_delete_ponentes = "DELETE FROM lista_ponentes WHERE Id_acto = ?";
  $stmt_delete_ponentes = $conexion->prepare($sql_delete_ponentes);
  $stmt_delete_ponentes->bind_param("i", $id_acto);

  // Ejecutar la eliminación de registros en documentacion
if ($stmt_delete_documentacion->execute()) {
  echo '<div class="alert alert-success" role="alert">
          Registros en documentacion eliminados correctamente.
        </div>';

  // Ejecutar la eliminación de registros en inscritos
  if ($stmt_delete_inscritos->execute()) {
      echo '<div class="alert alert-success" role="alert">
              Registros en inscritos eliminados correctamente.
            </div>';

      // Ejecutar la eliminación de registros en lista_ponentes
      $conexion->query('SET foreign_key_checks = 0;');
      if ($stmt_delete_ponentes->execute()) {
          echo '<div class="alert alert-success" role="alert">
                  Registros en lista_ponentes eliminados correctamente.
                </div>';

          // Consulta SQL para eliminar el acto
          $sql_delete = "DELETE FROM Actos WHERE Id_acto = ?";
          $stmt_delete = $conexion->prepare($sql_delete);
          $stmt_delete->bind_param("i", $id_acto);

          // Ejecutar la eliminación del acto
          if ($stmt_delete->execute()) {
              header('Location: actosView.php');
              echo '<div class="alert alert-success" role="alert">
                      El acto se ha eliminado correctamente.
                    </div>';
          } else {
              echo '<div class="alert alert-danger" role="alert">
                      Error al eliminar el acto. Detalles del error: ' . $stmt_delete->error . '
                    </div>';
          }
      } else {
          echo '<div class="alert alert-danger" role="alert">
                  Error al eliminar registros en lista_ponentes. Detalles del error: ' . $stmt_delete_ponentes->error . '
                </div>';
      }
  } else {
      echo '<div class="alert alert-danger" role="alert">
              Error al eliminar registros en inscritos. Detalles del error: ' . $stmt_delete_inscritos->error . '
            </div>';
  }
} else {
    echo '<div class="alert alert-danger" role="alert">
            Error al eliminar registros en documentacion. Detalles del error: ' . $stmt_delete_documentacion->error . '
          </div>';
}
} else {
  echo '<div class="alert alert-warning" role="alert">
          No se proporcionó el ID del acto para eliminar.
        </div>';
}

?>
