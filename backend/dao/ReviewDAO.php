<?php
require_once __DIR__ . '/../config/Database.php';

class ReviewDAO {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function create($user_id, $event_id, $rating, $comment) {
        $stmt = $this->conn->prepare("INSERT INTO reviews (user_id, event_id, rating, comment) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$user_id, $event_id, $rating, $comment]);
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM reviews");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $rating, $comment) {
        $stmt = $this->conn->prepare("UPDATE reviews SET rating = ?, comment = ? WHERE id = ?");
        return $stmt->execute([$rating, $comment, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM reviews WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>