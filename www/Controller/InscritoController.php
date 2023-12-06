<?php

include '../Model/InscritoModel.php';

class InscritoController {
    private $modelo;

    public function __construct($conexion) {
        $this->modelo = new InscritoModel($conexion);
    }

    public function eliminarInscrito($idInscripcion) {
        $exito = $this->modelo->eliminarInscrito($idInscripcion);

        // if ($exito) {
        //     echo json_encode(array('success' => true, 'message' => 'Inscripción eliminada con éxito.'));
        // } else {
        //     echo json_encode(array('success' => false, 'message' => 'Error al eliminar la inscripción.'));
        // }
    }
}
