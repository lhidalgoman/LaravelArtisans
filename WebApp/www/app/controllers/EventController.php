<?php
require_once __DIR__.'/../../utils/Database.php';

class EventController
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
    
    public function getEvents($month, $year) {
        // Calcula el primer y último día del mes
        $startDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
        $endDate = date("Y-m-t", mktime(0, 0, 0, $month, 1, $year)); // 't' devuelve el último día del mes

        $connection = $this->database->connect();
        $stmt = $connection->prepare("SELECT * FROM Actos WHERE Fecha BETWEEN :startDate AND :endDate");
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>