<?php
require_once '../core/Database.php';

class Auth {
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
            if (password_verify(password_hash($password, PASSWORD_DEFAULT), $user['password'])) {
                // Iniciar sesión y establecer variables de sesión
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                return true;
            }
        }
        return false;
    }
}

$auth = new Auth();

// Verificar si se enviaron datos desde el login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Comprobación de credenciales
    if ($auth->login($username, $password)) {
        echo "hey";
        header("Location: /app/views/home/index.php");
    } else {
        echo "Credenciales incorrectas.";
    }
}
?>