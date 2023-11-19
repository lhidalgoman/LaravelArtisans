<?php

class Database {
    private $host = "mysql";
    private $db_name = "Eventos";
    private $username = "root";
    private $password = "laravelArtisans";
    private $conn;

    // Conectar a la base de datos
    public function connect() {
        $this->conn = null;
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }

        return $this->conn;
    }

    // Ejecutar una consulta SQL
    public function query($sql) {
        try {
            $statement = $this->connect()->prepare($sql);
            $statement->execute();

            return $statement;
        } catch(PDOException $e) {
            die("Error al ejecutar la consulta: " . $e->getMessage());
        }
    }

    // Cerrar la conexión
    public function close() {
        $this->conn = null;
    }
}

?>