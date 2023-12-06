<?php
include '../Model/ActoModel.php';
include '../View/ActoView.php';

class ActoController {
    private $modelo;
    private $vista;

    private $conexion;

    public function __construct($conexion) {
        $this->modelo = new ActoModel($conexion);
        $this->vista = new ActoView();
    }

    public function mostrarActos(): array {
        $actos = $this->modelo->obtenerActos();
         // Llamar al método render de la vista para mostrar los actos
        if ($actos !== false) {
            return $actos;
        } else {
            return [];
        }
    }
    
    // En tu controlador ActoController.php
    // public function mostrarActosConParticipacion($idUsuario): array {
    //     $actos = $this->modelo->obtenerActosConParticipacion($idUsuario);
    //     // Llamar al método render de la vista para mostrar los actos
    //     return $actos;
    // }

    

    public function agregarActo($fecha, $hora, $titulo, $descripcionCorta, $descripcionLarga, $numAsistentes, $idTipoActo, $id_ponente) {
        $exito = $this->modelo->agregarActo($fecha, $hora, $titulo, $descripcionCorta, $descripcionLarga, $numAsistentes, $idTipoActo, $id_ponente);
    
        // if ($exito) {
        //     echo json_encode(array('success' => true, 'message' => 'Acto agregado con éxito.'));
        // } else {
        //     echo json_encode(array('success' => false, 'message' => 'Error al agregar el acto.'));
        // }
    }
    
}

?>
