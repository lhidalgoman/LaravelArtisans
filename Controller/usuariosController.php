<?php
require_once 'model/usuariosModel.php';
class UsuariosController {
    private $model;

    public function __construct() {
        global $conexion;
        $this->model = new UsuariosModel($conexion);
    }

    public function registrarUsuario($email, $contrasena, $tipo_usuario, $nombre, $apellido1, $apellido2) {
        return $this->model->registrarUsuario($email, $contrasena, $tipo_usuario,$nombre, $apellido1, $apellido2);
    }

    public function registrarPersona($nombre, $apellido1, $apellido2) {
        return $this->model->registrarPersona($nombre, $apellido1, $apellido2);
    }

    public function login($email, $contrasena) {
        $usuario = $this->model->validarLogin($email, $contrasena);

        if ($usuario) {
            // Iniciar sesión
            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];

            // Verificar si el email es 'admin@admin.com' para establecer como administrador
            $_SESSION['es_admin'] = ($email === 'admin@admin.com');


            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        // Cerrar sesión
        session_start();
        session_destroy();
    }
}
?>
