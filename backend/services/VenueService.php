<?php
require_once __DIR__ . '/../config/database.php';

class VenueService {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getAllVenues() {
        $stmt = $this->db->query("SELECT * FROM venues");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVenue($id) {
        $stmt = $this->db->prepare("SELECT * FROM venues WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createVenue($data) {
        if (!isset($data['name'], $data['location'])) {
            throw new Exception("Missing fields");
        }

        $stmt = $this->db->prepare("INSERT INTO venues (name, location) VALUES (?, ?)");
        return $stmt->execute([$data['name'], $data['location']]);
    }

    public function updateVenue($id, $data) {
        $stmt = $this->db->prepare("UPDATE venues SET name = ?, location = ? WHERE id = ?");
        return $stmt->execute([$data['name'], $data['location'], $id]);
    }

    public function deleteVenue($id) {
        $stmt = $this->db->prepare("DELETE FROM venues WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
