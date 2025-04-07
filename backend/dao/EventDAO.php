<?php
require_once __DIR__ . '/../config/Database.php';

class EventDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($title, $description, $date, $location, $category_id, $user_id) {
        $stmt = $this->conn->prepare("INSERT INTO events (title, description, date, location, category_id, user_id) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$title, $description, $date, $location, $category_id, $user_id]);
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $title, $description, $date, $location, $category_id) {
        $stmt = $this->conn->prepare("UPDATE events SET title = ?, description = ?, date = ?, location = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$title, $description, $date, $location, $category_id, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>