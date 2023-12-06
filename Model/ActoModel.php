<?php
class ActoModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function obtenerActos() {
        $query = "SELECT * FROM Actos";
        $result = $this->conexion->query($query);

        if ($result) {
            $actos = $result->fetch_all(MYSQLI_ASSOC);
            return $actos;
        } else {
            return []; // Devolver un array vacío en lugar de false
        }
    }

    // En tu modelo ActoModel.php
    // public function obtenerActosConParticipacion($idUsuario) {
    //     // Recupera los actos de tu base de datos
    //     $actos = $this->obtenerActos();  // Ajusta según la estructura de tu modelo

    //     // Obtén la información de participación del usuario
    //     $participacionUsuario = $this->obtenerParticipacionUsuario($idUsuario);

    //     // Añade la información de participación a cada acto
    //     foreach ($actos as &$acto) {
    //         $idActo = $acto['Id_acto'];

    //         if (in_array($idActo, $participacionUsuario['noInscrito'])) {
    //             $acto['color'] = 'red';
    //         } elseif (in_array($idActo, $participacionUsuario['inscrito'])) {
    //             $acto['color'] = 'green';
    //         } elseif (in_array($idActo, $participacionUsuario['ponente'])) {
    //             $acto['color'] = 'orange';
    //         }
    //     }

    //     return $actos;
    // }

    public function agregarActo($fecha, $hora, $titulo, $descripcionCorta, $descripcionLarga, $numAsistentes, $idTipoActo, $id_ponente) {
        $query = "INSERT INTO Actos (Fecha, Hora, Titulo, Descripcion_corta, Descripcion_larga, Num_asistentes, Id_tipo_acto, id_ponente)
                  VALUES (?, ?, ?, ?, ?, ?, ?,?)";
        
        $stmt = $this->conexion->prepare($query);

        if ($stmt) {
            $stmt->bind_param("sssssiii", $fecha, $hora, $titulo, $descripcionCorta, $descripcionLarga, $numAsistentes, $idTipoActo, $id_ponente);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                return true; // Éxito al insertar el acto
            } else {
                return false; // No se insertó el acto
            }

            // $stmt->close();
        } else {
            return false; // Error en la preparación de la consulta
        }
    }
}

?>
