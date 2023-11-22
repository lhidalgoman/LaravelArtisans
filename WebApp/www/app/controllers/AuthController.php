<?php
session_start(); // Iniciar la sesión al principio del script
require_once '../../utils/Database.php';

class AuthController {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function login($username, $password) {    
        $sql = "SELECT * FROM usuarios WHERE username = :username";

        // Consulta
        $stmt = $this->database->connect()->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        // Verificar si se encontró el usuario
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['Password'])) {
                // Iniciar sesión y establecer variables de sesión
                $_SESSION['user_id'] = $user['Id_usuario'];
                $_SESSION['username'] = $user['Username'];
                $_SESSION['persona_id'] = $user['Id_Persona'];
                return true;
            }
        }
        return false;
    }
}

$auth = new AuthController();

// Verificar si se enviaron datos desde el login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Comprobación de credenciales
    if ($auth->login($username, $password)) {
        header("Location: /app/views/home/index.php");
        exit;
    } else {
        // Redirigir con un mensaje de error
        header("Location: /app/views/auth/login.php?error=invalid_credentials");
        exit;
    }
}
?>
