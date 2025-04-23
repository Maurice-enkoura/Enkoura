<?php
require_once 'db.php';

class EventManager {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect();
    }

    public function getAllEvents() {
        $stmt = $this->db->prepare("SELECT * FROM events ORDER BY date ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addEvent($data) {
        $stmt = $this->db->prepare("INSERT INTO events (title, date, start_time, end_time, description, status) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['title'], $data['date'], $data['start_time'],
            $data['end_time'], $data['description'], $data['status']
        ]);
    }

    public function updateEvent($id, $data) {
        $stmt = $this->db->prepare("UPDATE events SET title=?, date=?, start_time=?, end_time=?, description=?, status=? WHERE id=?");
        return $stmt->execute([
            $data['title'], $data['date'], $data['start_time'],
            $data['end_time'], $data['description'], $data['status'], $id
        ]);
    }

    public function deleteEvent($id) {
        $stmt = $this->db->prepare("DELETE FROM events WHERE id=?");
        return $stmt->execute([$id]);
    }
}
