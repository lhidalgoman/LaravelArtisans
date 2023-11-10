<?php

class Database {
    private $host = "localhost";
    private $db_name = "Eventos";
    private $username = "root";
    private $password = "laravelArtisans";
    private $conn;

    // Conectar a la base de datos
    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Verificar conexión
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }

        return $this->conn;
    }

    // Ejecutar una consulta SQL
    public function query($sql) {
        $result = $this->connect()->query($sql);

        if (!$result) {
            die("Error al ejecutar la consulta: " . $this->conn->error);
        }

        return $result;
    }

    // Cerrar la conexión
    public function close() {
        $this->conn->close();
    }
}

?>