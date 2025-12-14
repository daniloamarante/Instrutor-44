<?php

class Review extends Model {
    
    public function create($data) {
        $this->db->query('INSERT INTO reviews (student_id, instructor_id, schedule_id, rating, comment, status) 
                         VALUES (:student_id, :instructor_id, :schedule_id, :rating, :comment, :status)');
        
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':instructor_id', $data['instructor_id']);
        $this->db->bind(':schedule_id', $data['schedule_id'] ?? null);
        $this->db->bind(':rating', $data['rating']);
        $this->db->bind(':comment', $data['comment'] ?? null);
        $this->db->bind(':status', $data['status'] ?? 'aprovado');
        
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    public function getByInstructor($instructor_id, $status = 'aprovado') {
        $this->db->query('SELECT r.*, u.name as student_name, u.avatar as student_avatar
                         FROM reviews r
                         JOIN students s ON r.student_id = s.id
                         JOIN users u ON s.user_id = u.id
                         WHERE r.instructor_id = :instructor_id AND r.status = :status
                         ORDER BY r.created_at DESC');
        $this->db->bind(':instructor_id', $instructor_id);
        $this->db->bind(':status', $status);
        return $this->db->resultSet();
    }
    
    public function getByStudent($student_id) {
        $this->db->query('SELECT r.*, i.id as instructor_id, u.name as instructor_name
                         FROM reviews r
                         JOIN instructors i ON r.instructor_id = i.id
                         JOIN users u ON i.user_id = u.id
                         WHERE r.student_id = :student_id
                         ORDER BY r.created_at DESC');
        $this->db->bind(':student_id', $student_id);
        return $this->db->resultSet();
    }
    
    public function updateStatus($id, $status) {
        $this->db->query('UPDATE reviews SET status = :status WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }
    
    public function getAll($status = null) {
        $sql = 'SELECT r.*, 
                i.id as instructor_id, iu.name as instructor_name,
                s.id as student_id, su.name as student_name
                FROM reviews r
                JOIN instructors i ON r.instructor_id = i.id
                JOIN users iu ON i.user_id = iu.id
                JOIN students s ON r.student_id = s.id
                JOIN users su ON s.user_id = su.id';
        
        if($status) {
            $sql .= ' WHERE r.status = :status';
        }
        
        $sql .= ' ORDER BY r.created_at DESC';
        
        $this->db->query($sql);
        
        if($status) {
            $this->db->bind(':status', $status);
        }
        
        return $this->db->resultSet();
    }
    
    public function canReview($student_id, $instructor_id) {
        $this->db->query('SELECT COUNT(*) as count FROM schedules 
                         WHERE student_id = :student_id 
                         AND instructor_id = :instructor_id 
                         AND status = "concluido"');
        $this->db->bind(':student_id', $student_id);
        $this->db->bind(':instructor_id', $instructor_id);
        $result = $this->db->single();
        return $result->count > 0;
    }
}
