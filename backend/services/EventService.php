<?php
require_once __DIR__ . '/../config/database.php';

class EventService {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAllEvents() {
        $stmt = $this->db->query("SELECT * FROM events");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEvent($id) {
        $stmt = $this->db->prepare("SELECT * FROM events WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createEvent($data) {
        if (!isset($data['name'], $data['date'], $data['venue_id'])) {
            throw new Exception("Missing fields");
        }

        $stmt = $this->db->prepare("INSERT INTO events (name, date, venue_id) VALUES (?, ?, ?)");
        return $stmt->execute([$data['name'], $data['date'], $data['venue_id']]);
    }

    public function updateEvent($id, $data) {
        $stmt = $this->db->prepare("UPDATE events SET name = ?, date = ?, venue_id = ? WHERE id = ?");
        return $stmt->execute([$data['name'], $data['date'], $data['venue_id'], $id]);
    }

    public function deleteEvent($id) {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
