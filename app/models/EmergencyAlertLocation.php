<?php

class EmergencyAlertLocation extends Model {

    public function create($data) {
        $this->db->query('INSERT INTO emergency_alert_locations (alert_id, lat, lng, accuracy_meters)
                         VALUES (:alert_id, :lat, :lng, :accuracy_meters)');

        $this->db->bind(':alert_id', $data['alert_id']);
        $this->db->bind(':lat', $data['lat']);
        $this->db->bind(':lng', $data['lng']);
        $this->db->bind(':accuracy_meters', $data['accuracy_meters'] ?? null);

        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function getLatestByAlert($alertId) {
        $this->db->query('SELECT * FROM emergency_alert_locations WHERE alert_id = :alert_id ORDER BY created_at DESC LIMIT 1');
        $this->db->bind(':alert_id', $alertId);
        return $this->db->single();
    }

    public function getByAlert($alertId, $limit = 50) {
        $this->db->query('SELECT * FROM emergency_alert_locations WHERE alert_id = :alert_id ORDER BY created_at DESC LIMIT :limit');
        $this->db->bind(':alert_id', $alertId);
        $this->db->bind(':limit', (int)$limit, PDO::PARAM_INT);
        return $this->db->resultSet();
    }
}
