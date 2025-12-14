<?php

class Plan extends Model {
    
    public function getAll() {
        $this->db->query('SELECT * FROM plans ORDER BY price ASC');
        return $this->db->resultSet();
    }
    
    public function findById($id) {
        $this->db->query('SELECT * FROM plans WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function create($data) {
        $this->db->query('INSERT INTO plans (name, price, duration_days, max_photos, featured, priority_listing, analytics, support_priority, description) 
                         VALUES (:name, :price, :duration_days, :max_photos, :featured, :priority_listing, :analytics, :support_priority, :description)');
        
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':duration_days', $data['duration_days']);
        $this->db->bind(':max_photos', $data['max_photos']);
        $this->db->bind(':featured', $data['featured']);
        $this->db->bind(':priority_listing', $data['priority_listing']);
        $this->db->bind(':analytics', $data['analytics']);
        $this->db->bind(':support_priority', $data['support_priority']);
        $this->db->bind(':description', $data['description']);
        
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    public function update($id, $data) {
        $this->db->query('UPDATE plans SET 
                         name = :name,
                         price = :price,
                         duration_days = :duration_days,
                         max_photos = :max_photos,
                         featured = :featured,
                         priority_listing = :priority_listing,
                         analytics = :analytics,
                         support_priority = :support_priority,
                         description = :description
                         WHERE id = :id');
        
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':duration_days', $data['duration_days']);
        $this->db->bind(':max_photos', $data['max_photos']);
        $this->db->bind(':featured', $data['featured']);
        $this->db->bind(':priority_listing', $data['priority_listing']);
        $this->db->bind(':analytics', $data['analytics']);
        $this->db->bind(':support_priority', $data['support_priority']);
        $this->db->bind(':description', $data['description']);
        
        return $this->db->execute();
    }
}
