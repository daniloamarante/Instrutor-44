<?php

class User extends Model {
    
    public function findByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        return $this->db->single();
    }
    
    public function findById($id) {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function create($data) {
        $this->db->query('INSERT INTO users (email, password, role, name, phone) VALUES (:email, :password, :role, :name, :phone)');
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        $this->db->bind(':role', $data['role']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        
        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }
    
    public function update($id, $data) {
        $this->db->query('UPDATE users SET name = :name, phone = :phone, avatar = :avatar WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':avatar', $data['avatar'] ?? null);
        return $this->db->execute();
    }
    
    public function getAll($role = null) {
        if($role) {
            $this->db->query('SELECT * FROM users WHERE role = :role ORDER BY created_at DESC');
            $this->db->bind(':role', $role);
        } else {
            $this->db->query('SELECT * FROM users ORDER BY created_at DESC');
        }
        return $this->db->resultSet();
    }
    
    public function delete($id) {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
