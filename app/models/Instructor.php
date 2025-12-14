<?php

class Instructor extends Model {
    
    public function create($data) {
        $this->db->query('INSERT INTO instructors (user_id, detran_number, status, bio, price_per_hour, location_address, location_lat, location_lng, vehicle_info, experience_years, plan_id) 
                         VALUES (:user_id, :detran_number, :status, :bio, :price_per_hour, :location_address, :location_lat, :location_lng, :vehicle_info, :experience_years, :plan_id)');
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':detran_number', $data['detran_number'] ?? null);
        $this->db->bind(':status', $data['status'] ?? 'pendente');
        $this->db->bind(':bio', $data['bio'] ?? null);
        $this->db->bind(':price_per_hour', $data['price_per_hour'] ?? 0);
        $this->db->bind(':location_address', $data['location_address'] ?? null);
        $this->db->bind(':location_lat', $data['location_lat'] ?? null);
        $this->db->bind(':location_lng', $data['location_lng'] ?? null);
        $this->db->bind(':vehicle_info', $data['vehicle_info'] ?? null);
        $this->db->bind(':experience_years', $data['experience_years'] ?? 0);
        $this->db->bind(':plan_id', $data['plan_id'] ?? 1);
        
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    public function findByUserId($user_id) {
        $this->db->query('SELECT i.*, u.name, u.email, u.phone, u.avatar 
                         FROM instructors i 
                         JOIN users u ON i.user_id = u.id 
                         WHERE i.user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }
    
    public function findById($id) {
        $this->db->query('SELECT i.*, u.name, u.email, u.phone, u.avatar 
                         FROM instructors i 
                         JOIN users u ON i.user_id = u.id 
                         WHERE i.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function search($filters = []) {
        $sql = 'SELECT i.*, u.name, u.email, u.phone, u.avatar,
                (6371 * acos(cos(radians(:lat)) * cos(radians(i.location_lat)) * 
                cos(radians(i.location_lng) - radians(:lng)) + 
                sin(radians(:lat)) * sin(radians(i.location_lat)))) AS distance
                FROM instructors i 
                JOIN users u ON i.user_id = u.id 
                WHERE i.status = "aprovado"';
        
        if(isset($filters['max_price'])) {
            $sql .= ' AND i.price_per_hour <= :max_price';
        }
        
        if(isset($filters['min_rating'])) {
            $sql .= ' AND i.rating >= :min_rating';
        }
        
        if(isset($filters['lat']) && isset($filters['lng'])) {
            $sql .= ' HAVING distance <= :max_distance';
        }
        
        $sql .= ' ORDER BY i.rating DESC, distance ASC';
        
        if(isset($filters['limit'])) {
            $sql .= ' LIMIT :limit';
        }
        
        $this->db->query($sql);
        
        $lat = $filters['lat'] ?? -23.550520;
        $lng = $filters['lng'] ?? -46.633308;
        
        $this->db->bind(':lat', $lat);
        $this->db->bind(':lng', $lng);
        
        if(isset($filters['max_price'])) {
            $this->db->bind(':max_price', $filters['max_price']);
        }
        
        if(isset($filters['min_rating'])) {
            $this->db->bind(':min_rating', $filters['min_rating']);
        }
        
        if(isset($filters['lat']) && isset($filters['lng'])) {
            $this->db->bind(':max_distance', $filters['max_distance'] ?? 50);
        }
        
        if(isset($filters['limit'])) {
            $this->db->bind(':limit', $filters['limit'], PDO::PARAM_INT);
        }
        
        return $this->db->resultSet();
    }
    
    public function update($id, $data) {
        $this->db->query('UPDATE instructors SET 
                         bio = :bio,
                         price_per_hour = :price_per_hour,
                         location_address = :location_address,
                         location_lat = :location_lat,
                         location_lng = :location_lng,
                         vehicle_info = :vehicle_info,
                         experience_years = :experience_years,
                         detran_number = :detran_number
                         WHERE id = :id');
        
        $this->db->bind(':id', $id);
        $this->db->bind(':bio', $data['bio']);
        $this->db->bind(':price_per_hour', $data['price_per_hour']);
        $this->db->bind(':location_address', $data['location_address']);
        $this->db->bind(':location_lat', $data['location_lat']);
        $this->db->bind(':location_lng', $data['location_lng']);
        $this->db->bind(':vehicle_info', $data['vehicle_info']);
        $this->db->bind(':experience_years', $data['experience_years']);
        $this->db->bind(':detran_number', $data['detran_number']);
        
        return $this->db->execute();
    }
    
    public function updateStatus($id, $status) {
        $this->db->query('UPDATE instructors SET status = :status WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }
    
    public function getPending() {
        $this->db->query('SELECT i.*, u.name, u.email, u.phone 
                         FROM instructors i 
                         JOIN users u ON i.user_id = u.id 
                         WHERE i.status = "pendente" 
                         ORDER BY i.created_at DESC');
        return $this->db->resultSet();
    }
    
    public function getApproved() {
        $this->db->query('SELECT i.*, u.name, u.email, u.phone, u.avatar 
                         FROM instructors i 
                         JOIN users u ON i.user_id = u.id 
                         WHERE i.status = "aprovado" 
                         ORDER BY i.rating DESC');
        return $this->db->resultSet();
    }
    
    public function updateRating($id) {
        $this->db->query('UPDATE instructors i SET 
                         i.rating = (SELECT COALESCE(AVG(r.rating), 0) FROM reviews r WHERE r.instructor_id = i.id AND r.status = "aprovado"),
                         i.total_reviews = (SELECT COUNT(*) FROM reviews r WHERE r.instructor_id = i.id AND r.status = "aprovado")
                         WHERE i.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
