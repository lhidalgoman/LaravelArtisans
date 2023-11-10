<?php
require_once '../core/Database.php';

class Auth {
    private $database;

    public function __construct() {
        $this->database = new Database();
    }

    public function login($username, $password) {
        // Aquí debes encriptar la contraseña y verificarla con la almacenada en la base de datos.
        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        $result = $this->database->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Iniciar sesión y establecer variables de sesión
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                // Otros detalles del usuario pueden ser almacenados en la sesión aquí
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