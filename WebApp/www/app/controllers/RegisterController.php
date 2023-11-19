<?php
require_once '../../utils/Database.php';

class RegisterController
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function register($nombre, $apellido1, $apellido2, $username, $password)
    {
        try {
            // Iniciar la transacción
            $connection = $this->database->connect();
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $connection->beginTransaction();

            // Insertar la información de la persona
            $insertPersona = "INSERT INTO personas (Nombre, Apellido1, Apellido2) VALUES (:nombre, :apellido1, :apellido2)";
            $stmt = $connection->prepare($insertPersona);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':apellido1', $apellido1, PDO::PARAM_STR);
            $stmt->bindParam(':apellido2', $apellido2, PDO::PARAM_STR);
            $stmt->execute();

            // Obtener el ID de la persona recién creada
            $idPersona = $connection->lastInsertId();

            // Hashear la contraseña
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Preparar la consulta SQL para insertar el nuevo usuario
            // Id_tipo_usuario se establece en 1 para todos los nuevos registros (USUARIO DE TEST ACTUALMENTE, SE DEBERÁ CAMBIAR ESTO)
            $insertUsuario = "INSERT INTO usuarios (Username, Password, Id_Persona, Id_tipo_usuario) VALUES (:username, :password, :idPersona, 1)";
            $stmt = $connection->prepare($insertUsuario);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':idPersona', $idPersona, PDO::PARAM_INT);
            $stmt->execute();

            // Confirmar la transacción
            $connection->commit();
        } catch (PDOException $e) {
            // En caso de error, revertir para que solo se creen los registros si todo va bien
            $connection->rollBack();
            throw $e;
        }
    }

    public function handleRegistrationRequest()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $apellido1 = $_POST['apellido1'];
            $apellido2 = $_POST['apellido2'];
            $username = $_POST['usuario'];
            $password = $_POST['password'];

            $this->register($nombre, $apellido1, $apellido2, $username, $password);

            header("Location: /app/views/auth/login.php");
            exit;
        }
    }
}

$controller = new RegisterController();
$controller->handleRegistrationRequest();
