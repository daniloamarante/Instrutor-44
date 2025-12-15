<?php

class Schedule extends Model {
    
    public function create($data) {
        $this->db->query('INSERT INTO schedules (instructor_id, student_id, date_time, duration, status, price, location_address, notes) 
                         VALUES (:instructor_id, :student_id, :date_time, :duration, :status, :price, :location_address, :notes)');
        
        $this->db->bind(':instructor_id', $data['instructor_id']);
        $this->db->bind(':student_id', $data['student_id']);
        $this->db->bind(':date_time', $data['date_time']);
        $this->db->bind(':duration', $data['duration'] ?? 60);
        $this->db->bind(':status', $data['status'] ?? 'pendente');
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':location_address', $data['location_address'] ?? null);
        $this->db->bind(':notes', $data['notes'] ?? null);
        
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    public function findById($id) {
        $this->db->query('SELECT s.*, 
                         i.id as instructor_id, iu.name as instructor_name, iu.phone as instructor_phone,
                         st.id as student_id, su.name as student_name, su.phone as student_phone
                         FROM schedules s
                         JOIN instructors i ON s.instructor_id = i.id
                         JOIN users iu ON i.user_id = iu.id
                         JOIN students st ON s.student_id = st.id
                         JOIN users su ON st.user_id = su.id
                         WHERE s.id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getByInstructor($instructor_id, $status = null) {
        $sql = 'SELECT s.*, st.id as student_id, u.name as student_name, u.phone as student_phone, u.email as student_email
                FROM schedules s
                JOIN students st ON s.student_id = st.id
                JOIN users u ON st.user_id = u.id
                WHERE s.instructor_id = :instructor_id';
        
        if($status) {
            $sql .= ' AND s.status = :status';
        }
        
        $sql .= ' ORDER BY s.date_time DESC';
        
        $this->db->query($sql);
        $this->db->bind(':instructor_id', $instructor_id);
        
        if($status) {
            $this->db->bind(':status', $status);
        }
        
        return $this->db->resultSet();
    }
    
    public function getByStudent($student_id, $status = null) {
        $sql = 'SELECT s.*, i.id as instructor_id, i.price_per_hour, i.rating,
                u.name as instructor_name, u.phone as instructor_phone, u.avatar as instructor_avatar
                FROM schedules s
                JOIN instructors i ON s.instructor_id = i.id
                JOIN users u ON i.user_id = u.id
                WHERE s.student_id = :student_id';
        
        if($status) {
            $sql .= ' AND s.status = :status';
        }
        
        $sql .= ' ORDER BY s.date_time DESC';
        
        $this->db->query($sql);
        $this->db->bind(':student_id', $student_id);
        
        if($status) {
            $this->db->bind(':status', $status);
        }
        
        return $this->db->resultSet();
    }
    
    public function updateStatus($id, $status) {
        $this->db->query('UPDATE schedules SET status = :status WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        return $this->db->execute();
    }

    public function requestReschedule($id, $studentId, $newDateTime) {
        $this->db->query('UPDATE schedules
                         SET reschedule_requested_date_time = :new_date_time,
                             reschedule_status = "pendente"
                         WHERE id = :id AND student_id = :student_id');
        $this->db->bind(':id', $id);
        $this->db->bind(':student_id', $studentId);
        $this->db->bind(':new_date_time', $newDateTime);
        return $this->db->execute();
    }

    public function approveReschedule($id, $instructorId) {
        $this->db->query('UPDATE schedules
                         SET date_time = reschedule_requested_date_time,
                             reschedule_requested_date_time = NULL,
                             reschedule_status = "nenhum"
                         WHERE id = :id AND instructor_id = :instructor_id AND reschedule_status = "pendente"');
        $this->db->bind(':id', $id);
        $this->db->bind(':instructor_id', $instructorId);
        return $this->db->execute();
    }

    public function rejectReschedule($id, $instructorId) {
        $this->db->query('UPDATE schedules
                         SET reschedule_status = "rejeitado"
                         WHERE id = :id AND instructor_id = :instructor_id AND reschedule_status = "pendente"');
        $this->db->bind(':id', $id);
        $this->db->bind(':instructor_id', $instructorId);
        return $this->db->execute();
    }

    public function setCancellationFee($id, $fee) {
        $this->db->query('UPDATE schedules SET cancellation_fee = :fee WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':fee', $fee);
        return $this->db->execute();
    }
    
    public function getAll($limit = null) {
        $sql = 'SELECT s.*, 
                i.id as instructor_id, iu.name as instructor_name,
                st.id as student_id, su.name as student_name
                FROM schedules s
                JOIN instructors i ON s.instructor_id = i.id
                JOIN users iu ON i.user_id = iu.id
                JOIN students st ON s.student_id = st.id
                JOIN users su ON st.user_id = su.id
                ORDER BY s.date_time DESC';
        
        if($limit) {
            $sql .= ' LIMIT :limit';
        }
        
        $this->db->query($sql);
        
        if($limit) {
            $this->db->bind(':limit', $limit, PDO::PARAM_INT);
        }
        
        return $this->db->resultSet();
    }
    
    public function getUpcoming($instructor_id) {
        $this->db->query('SELECT s.*, st.id as student_id, u.name as student_name, u.phone as student_phone, u.email as student_email
                         FROM schedules s
                         JOIN students st ON s.student_id = st.id
                         JOIN users u ON st.user_id = u.id
                         WHERE s.instructor_id = :instructor_id 
                         AND s.date_time >= NOW()
                         AND s.status IN ("pendente", "confirmado")
                         ORDER BY s.date_time ASC
                         LIMIT 10');
        $this->db->bind(':instructor_id', $instructor_id);
        return $this->db->resultSet();
    }
}
