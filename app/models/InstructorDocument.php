<?php

class InstructorDocument extends Model {

    public function create($data) {
        $this->db->query('INSERT INTO instructor_documents (instructor_id, doc_type, file_path, status, admin_notes)
                         VALUES (:instructor_id, :doc_type, :file_path, :status, :admin_notes)');

        $this->db->bind(':instructor_id', $data['instructor_id']);
        $this->db->bind(':doc_type', $data['doc_type']);
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':status', $data['status'] ?? 'pendente');
        $this->db->bind(':admin_notes', $data['admin_notes'] ?? null);

        if($this->db->execute()) {
            return $this->db->lastInsertId();
        }

        return false;
    }

    public function getByInstructor($instructor_id) {
        $this->db->query('SELECT * FROM instructor_documents WHERE instructor_id = :instructor_id ORDER BY created_at DESC');
        $this->db->bind(':instructor_id', $instructor_id);
        return $this->db->resultSet();
    }

    public function findById($id) {
        $this->db->query('SELECT * FROM instructor_documents WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function updateStatus($id, $status, $admin_notes = null) {
        $this->db->query('UPDATE instructor_documents SET status = :status, admin_notes = :admin_notes WHERE id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':status', $status);
        $this->db->bind(':admin_notes', $admin_notes);
        return $this->db->execute();
    }

    public function hasApprovedDocType($instructor_id, $doc_type) {
        $this->db->query('SELECT id FROM instructor_documents WHERE instructor_id = :instructor_id AND doc_type = :doc_type AND status = "aprovado" LIMIT 1');
        $this->db->bind(':instructor_id', $instructor_id);
        $this->db->bind(':doc_type', $doc_type);
        return (bool)$this->db->single();
    }
}
