<?php

class EmergencyAlert extends Model {

    public function create($data) {
        $this->db->query('INSERT INTO emergency_alerts (user_id, user_role, user_name, user_phone, lat, lng, status)
                         VALUES (:user_id, :user_role, :user_name, :user_phone, :lat, :lng, :status)');

        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':user_role', $data['user_role']);
        $this->db->bind(':user_name', $data['user_name']);
        $this->db->bind(':user_phone', $data['user_phone'] ?? null);
        $this->db->bind(':lat', $data['lat'] ?? null);
        $this->db->bind(':lng', $data['lng'] ?? null);
        $this->db->bind(':status', $data['status'] ?? 'aberto');

        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function getOpen($limit = 50) {
        $this->db->query('SELECT * FROM emergency_alerts WHERE status = "aberto" ORDER BY created_at DESC LIMIT :limit');
        $this->db->bind(':limit', (int)$limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }

    public function countOpen() {
        $this->db->query('SELECT COUNT(*) as count FROM emergency_alerts WHERE status = "aberto"');
        $result = $this->db->single();
        return (int)($result->count ?? 0);
    }

    public function findById($id) {
        $this->db->query('SELECT * FROM emergency_alerts WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateLocation($id, $userId, $lat, $lng) {
        $this->db->query('UPDATE emergency_alerts SET lat = :lat, lng = :lng WHERE id = :id AND user_id = :user_id AND status = "aberto"');
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':lat', $lat);
        $this->db->bind(':lng', $lng);
        return $this->db->execute();
    }

    public function close($id, $adminNotes = null) {
        $this->db->query('UPDATE emergency_alerts SET status = "encerrado", admin_notes = :admin_notes WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':admin_notes', $adminNotes);
        return $this->db->execute();
    }
}
