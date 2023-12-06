<?php
require_once 'db/conexion.php';

class UsuariosModel {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function registrarPersona($nombre, $apellido1, $apellido2) {
        $stmt = $this->db->prepare('INSERT INTO personas (Nombre, Apellido1, Apellido2) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $nombre, $apellido1, $apellido2);
        
        // Intentar ejecutar la consulta
        if ($stmt->execute()) {
            // Devolver el Id_persona recién insertado
            return $stmt->insert_id;
        } else {
            // Manejar el error si la consulta no se ejecuta correctamente
            die('Error en la ejecución de la consulta: ' . $stmt->error);
        }
    }
    
    public function registrarUsuario($email, $contrasena, $tipo_usuario, $nombre, $apellido1, $apellido2) {
        // Llamar a registrarPersona para obtener el Id_persona recién insertado
        $Id_persona = $this->registrarPersona($nombre, $apellido1, $apellido2);    
        $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);    
        $stmt = $this->db->prepare('INSERT INTO usuarios (Username, Password, Id_Persona, Id_tipo_usuario) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssii', $email, $hashedPassword, $Id_persona, $tipo_usuario);
        
        // Intentar ejecutar la consulta
        if ($stmt->execute()) {
            // Devolver true si la ejecución fue exitosa
            return true;
        } else {
            // Manejar el error si la consulta no se ejecuta correctamente
            die('Error en la ejecución de la consulta: ' . $stmt->error);
        }
    }
    

    
    public function validarLogin($email, $contrasena) {
        $id = $hashedPassword = null;  // Inicializar las variables antes del bloque if    
        $stmt = $this->db->prepare('SELECT Id_usuario, Username, Password FROM usuarios WHERE Username = ?');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result(); // Necesario para obtener el número de filas
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $email, $hashedPassword);
            $stmt->fetch();
    
            if (password_verify($contrasena, $hashedPassword)) {
                return ['id' => $id, 'nombre' => $email];
            }
        }
    
        return false;
    }    
        
}
?>
