<?php

class InscritoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function eliminarInscrito($idInscripcion) {
        $sql = "DELETE FROM Inscritos WHERE Id_inscripcion = ?";
        $stmt = $this->conexion->prepare($sql);

        if ($stmt) {
            $stmt->bind_param('i', $idInscripcion);
            $stmt->execute();

            // Verificar si se eliminó la inscripción correctamente
            if ($stmt->affected_rows > 0) {
                return true; // Éxito al eliminar la inscripción
            } else {
                return false; // No se pudo eliminar la inscripción
            }

            //$stmt->close();
        } else {
            return false; // Error en la preparación de la consulta
        }
    }
}
