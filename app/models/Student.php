<?php

class Student extends Model {
    
    public function create($data) {
        $this->db->query('INSERT INTO students (user_id, location_address, location_lat, location_lng) 
                         VALUES (:user_id, :location_address, :location_lat, :location_lng)');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':location_address', $data['location_address'] ?? null);
        $this->db->bind(':location_lat', $data['location_lat'] ?? null);
        $this->db->bind(':location_lng', $data['location_lng'] ?? null);
        
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    public function findByUserId($user_id) {
        $this->db->query('SELECT s.*, u.name, u.email, u.phone, u.avatar 
                         FROM students s 
                         JOIN users u ON s.user_id = u.id 
                         WHERE s.user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }
    
    public function findById($id) {
        $this->db->query('SELECT s.*, u.name, u.email, u.phone, u.avatar 
                         FROM students s 
                         JOIN users u ON s.user_id = u.id 
                         WHERE s.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function update($id, $data) {
        $this->db->query('UPDATE students SET 
                         location_address = :location_address,
                         location_lat = :location_lat,
                         location_lng = :location_lng
                         WHERE id = :id');
        
        $this->db->bind(':id', $id);
        $this->db->bind(':location_address', $data['location_address']);
        $this->db->bind(':location_lat', $data['location_lat']);
        $this->db->bind(':location_lng', $data['location_lng']);
        
        return $this->db->execute();
    }
    
    public function getAll() {
        $this->db->query('SELECT s.*, u.name, u.email, u.phone, u.created_at 
                         FROM students s 
                         JOIN users u ON s.user_id = u.id 
                         ORDER BY u.created_at DESC');
        return $this->db->resultSet();
    }
}
