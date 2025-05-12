<?php
require_once __DIR__ . '/../config/Database.php';

class RegistrationDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($user_id, $event_id) {
        $stmt = $this->conn->prepare("INSERT INTO registrations (user_id, event_id) VALUES (?, ?)");
        return $stmt->execute([$user_id, $event_id]);
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM registrations");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM registrations WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM registrations WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>