<?php

class InstrutorController extends Controller {
    
    private $userModel;
    private $instructorModel;
    private $scheduleModel;
    private $reviewModel;
    private $instructorDocumentModel;
    
    public function __construct() {
        $this->requireLogin();
        $this->requireRole('instrutor');
        
        $this->userModel = $this->model('User');
        $this->instructorModel = $this->model('Instructor');
        $this->scheduleModel = $this->model('Schedule');
        $this->reviewModel = $this->model('Review');
        $this->instructorDocumentModel = $this->model('InstructorDocument');
    }
    
    public function dashboard() {
        $instructor = $this->instructorModel->findByUserId($_SESSION['user_id']);
        
        $data = [
            'title' => 'Painel do Instrutor',
            'instructor' => $instructor,
            'pending_schedules' => $this->scheduleModel->getByInstructor($instructor->id, 'pendente'),
            'upcoming_schedules' => $this->scheduleModel->getUpcoming($instructor->id),
            'total_schedules' => count($this->scheduleModel->getByInstructor($instructor->id)),
            'reviews' => $this->reviewModel->getByInstructor($instructor->id)
        ];
        
        $this->view('instrutor/dashboard', $data);
    }
    
    public function perfil() {
        $user = $this->userModel->findById($_SESSION['user_id']);
        $instructor = $this->instructorModel->findByUserId($_SESSION['user_id']);
        $documents = $this->instructorDocumentModel->getByInstructor($instructor->id);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userData = [
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'avatar' => $user->avatar
            ];
            
            $instructorData = [
                'bio' => $_POST['bio'] ?? '',
                'price_per_hour' => floatval($_POST['price_per_hour']),
                'location_address' => $_POST['location_address'] ?? '',
                'location_lat' => $_POST['location_lat'] ?? null,
                'location_lng' => $_POST['location_lng'] ?? null,
                'vehicle_info' => $_POST['vehicle_info'] ?? '',
                'experience_years' => intval($_POST['experience_years']),
                'detran_number' => $_POST['detran_number'] ?? ''
            ];

            if(empty(trim($instructorData['detran_number']))) {
                $_SESSION['error'] = 'Informe seu número de credenciamento DETRAN.';
                $this->redirect('instrutor/perfil');
            }

            if(!$this->isValidDetranNumber($instructorData['detran_number'])) {
                $_SESSION['error'] = 'Número DETRAN inválido (ex: DETRAN-SP-12345).';
                $this->redirect('instrutor/perfil');
            }

            $this->handleDocumentUpload($instructor->id, 'cnh', 'doc_cnh');
            $this->handleDocumentUpload($instructor->id, 'credencial', 'doc_credencial');
            $this->handleDocumentUpload($instructor->id, 'lav', 'doc_lav');
            $this->handleDocumentUpload($instructor->id, 'crlv', 'doc_crlv');
            
            if(isset($_FILES['detran_doc']) && $_FILES['detran_doc']['error'] == 0) {
                $uploadDir = UPLOAD_PATH . 'detran/';
                if(!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $fileName = uniqid() . '_' . basename($_FILES['detran_doc']['name']);
                $targetFile = $uploadDir . $fileName;
                
                if(move_uploaded_file($_FILES['detran_doc']['tmp_name'], $targetFile)) {
                    $instructorData['detran_doc'] = 'detran/' . $fileName;
                }
            }
            
            $this->userModel->update($_SESSION['user_id'], $userData);
            $this->instructorModel->update($instructor->id, $instructorData);
            
            $_SESSION['user_name'] = $userData['name'];
            $_SESSION['success'] = 'Perfil atualizado com sucesso!';
            $this->redirect('instrutor/perfil');
        }
        
        $data = [
            'title' => 'Editar Perfil',
            'user' => $user,
            'instructor' => $instructor,
            'documents' => $documents
        ];
        
        $this->view('instrutor/perfil', $data);
    }

    private function handleDocumentUpload($instructorId, $docType, $fileKey) {
        if(!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] != 0) {
            return;
        }

        $allowed = ['pdf', 'jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION));
        if(!in_array($ext, $allowed)) {
            $_SESSION['error'] = 'Tipo de arquivo inválido. Envie PDF/JPG/PNG.';
            $this->redirect('instrutor/perfil');
        }

        $uploadDir = UPLOAD_PATH . 'docs/';
        if(!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $fileName = $docType . '_' . uniqid() . '_' . basename($_FILES[$fileKey]['name']);
        $targetFile = $uploadDir . $fileName;

        if(move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetFile)) {
            $this->instructorDocumentModel->create([
                'instructor_id' => $instructorId,
                'doc_type' => $docType,
                'file_path' => 'docs/' . $fileName,
                'status' => 'pendente'
            ]);
        }
    }

    private function isValidDetranNumber($detranNumber) {
        $detranNumber = trim($detranNumber);
        return (bool)preg_match('/^DETRAN-[A-Z]{2}-\d{3,}$/', strtoupper($detranNumber));
    }
    
    public function agenda() {
        $instructor = $this->instructorModel->findByUserId($_SESSION['user_id']);
        
        $data = [
            'title' => 'Minha Agenda',
            'schedules' => $this->scheduleModel->getByInstructor($instructor->id)
        ];
        
        $this->view('instrutor/agenda', $data);
    }
    
    public function confirmarAula($id) {
        $schedule = $this->scheduleModel->findById($id);
        $instructor = $this->instructorModel->findByUserId($_SESSION['user_id']);
        
        if($schedule && $schedule->instructor_id == $instructor->id) {
            $this->scheduleModel->updateStatus($id, 'confirmado');
            $_SESSION['success'] = 'Aula confirmada com sucesso!';
        }
        
        $this->redirect('instrutor/agenda');
    }
    
    public function rejeitarAula($id) {
        $schedule = $this->scheduleModel->findById($id);
        $instructor = $this->instructorModel->findByUserId($_SESSION['user_id']);
        
        if($schedule && $schedule->instructor_id == $instructor->id) {
            $this->scheduleModel->updateStatus($id, 'cancelado');
            $_SESSION['success'] = 'Aula rejeitada.';
        }
        
        $this->redirect('instrutor/agenda');
    }
    
    public function concluirAula($id) {
        $schedule = $this->scheduleModel->findById($id);
        $instructor = $this->instructorModel->findByUserId($_SESSION['user_id']);
        
        if($schedule && $schedule->instructor_id == $instructor->id) {
            $this->scheduleModel->updateStatus($id, 'concluido');
            $_SESSION['success'] = 'Aula marcada como concluída!';
        }
        
        $this->redirect('instrutor/agenda');
    }
    
    public function alunos() {
        $instructor = $this->instructorModel->findByUserId($_SESSION['user_id']);
        $schedules = $this->scheduleModel->getByInstructor($instructor->id);
        
        $students = [];
        foreach($schedules as $schedule) {
            if(!isset($students[$schedule->student_id])) {
                $students[$schedule->student_id] = [
                    'id' => $schedule->student_id,
                    'name' => $schedule->student_name,
                    'phone' => $schedule->student_phone,
                    'total_classes' => 0,
                    'completed_classes' => 0
                ];
            }
            $students[$schedule->student_id]['total_classes']++;
            if($schedule->status == 'concluido') {
                $students[$schedule->student_id]['completed_classes']++;
            }
        }
        
        $data = [
            'title' => 'Meus Alunos',
            'students' => array_values($students)
        ];
        
        $this->view('instrutor/alunos', $data);
    }
    
    public function avaliacoes() {
        $instructor = $this->instructorModel->findByUserId($_SESSION['user_id']);
        
        $data = [
            'title' => 'Minhas Avaliações',
            'reviews' => $this->reviewModel->getByInstructor($instructor->id),
            'instructor' => $instructor
        ];
        
        $this->view('instrutor/avaliacoes', $data);
    }
}
