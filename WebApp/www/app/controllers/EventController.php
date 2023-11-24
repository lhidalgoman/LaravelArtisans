<?php
require_once __DIR__.'/../../utils/Database.php';

class EventController
{
    private $database;
    private $currentUserId;

    public function __construct($currentUserId)
    {
        $this->database = new Database();
        $this->currentUserId = $currentUserId;
    }
    
    public function getEvents($month, $year) {
        // Calcula el primer y último día del mes
        $startDate = date("Y-m-d", mktime(0, 0, 0, $month, 1, $year));
        $endDate = date("Y-m-t", mktime(0, 0, 0, $month, 1, $year)); // 't' devuelve el último día del mes

        $connection = $this->database->connect();
        $stmt = $connection->prepare("SELECT Actos.*, 
                                             IF(Lista_Ponentes.id_ponente IS NOT NULL, 1, 0) AS Es_Ponente,
                                             IF(Inscritos.Id_inscripcion IS NOT NULL, 1, 0) AS Esta_Inscrito
                                      FROM Actos
                                      LEFT JOIN Lista_Ponentes ON Actos.Id_acto = Lista_Ponentes.Id_acto AND Lista_Ponentes.Id_persona = :userId
                                      LEFT JOIN Inscritos ON Actos.Id_acto = Inscritos.id_acto AND Inscritos.Id_persona = :userId
                                      WHERE Fecha BETWEEN :startDate AND :endDate");
        $stmt->bindParam(':startDate', $startDate);
        $stmt->bindParam(':endDate', $endDate);
        $stmt->bindParam(':userId', $this->currentUserId);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>