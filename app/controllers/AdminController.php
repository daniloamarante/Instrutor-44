<?php

class AdminController extends Controller {
    
    private $userModel;
    private $instructorModel;
    private $studentModel;
    private $scheduleModel;
    private $reviewModel;
    private $planModel;
    private $instructorDocumentModel;
    private $emergencyAlertModel;
    private $emergencyAlertLocationModel;
    
    public function __construct() {
        $this->requireLogin();
        $this->requireRole('admin');
        
        $this->userModel = $this->model('User');
        $this->instructorModel = $this->model('Instructor');
        $this->studentModel = $this->model('Student');
        $this->scheduleModel = $this->model('Schedule');
        $this->reviewModel = $this->model('Review');
        $this->planModel = $this->model('Plan');
        $this->instructorDocumentModel = $this->model('InstructorDocument');
        $this->emergencyAlertModel = $this->model('EmergencyAlert');
        $this->emergencyAlertLocationModel = $this->model('EmergencyAlertLocation');
    }
    
    public function dashboard() {
        $data = [
            'title' => 'Painel Administrativo',
            'total_instructors' => count($this->instructorModel->getApproved()),
            'pending_instructors' => count($this->instructorModel->getPending()),
            'total_students' => count($this->studentModel->getAll()),
            'total_schedules' => count($this->scheduleModel->getAll()),
            'recent_schedules' => $this->scheduleModel->getAll(10),
            'pending_reviews' => $this->reviewModel->getAll('pendente'),
            'open_emergencies' => $this->emergencyAlertModel->countOpen()
        ];
        
        $this->view('admin/dashboard', $data);
    }

    public function emergencias() {
        $data = [
            'title' => 'Emergências',
            'alerts' => $this->emergencyAlertModel->getOpen(50)
        ];

        $this->view('admin/emergencias', $data);
    }

    public function encerrarEmergencia($id) {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('admin/emergencias');
        }

        $this->emergencyAlertModel->close($id);
        $_SESSION['success'] = 'Emergência encerrada.';
        $this->redirect('admin/emergencias');
    }

    public function emergenciasCount() {
        $this->json([
            'count' => $this->emergencyAlertModel->countOpen()
        ]);
    }

    public function emergenciasOpen() {
        $alerts = $this->emergencyAlertModel->getOpen(50);
        $items = [];

        foreach($alerts as $a) {
            $latest = null;
            if(!empty($a->lat) && !empty($a->lng)) {
                $latest = [
                    'lat' => (float)$a->lat,
                    'lng' => (float)$a->lng,
                    'updated_at' => $a->updated_at
                ];
            }

            $items[] = [
                'id' => (int)$a->id,
                'user_name' => $a->user_name,
                'user_role' => $a->user_role,
                'user_phone' => $a->user_phone,
                'lat' => $a->lat,
                'lng' => $a->lng,
                'created_at' => $a->created_at,
                'updated_at' => $a->updated_at,
                'latest' => $latest
            ];
        }

        $this->json([
            'items' => $items
        ]);
    }
    
    public function instrutores() {
        $status = $_GET['status'] ?? 'aprovado';
        
        if($status == 'pendente') {
            $instructors = $this->instructorModel->getPending();
        } else {
            $instructors = $this->instructorModel->getApproved();
        }
        
        $data = [
            'title' => 'Gerenciar Instrutores',
            'instructors' => $instructors,
            'status' => $status
        ];
        
        $this->view('admin/instrutores', $data);
    }
    
    public function aprovarInstrutor($id) {
        $requiredTypes = ['cnh', 'credencial', 'lav', 'crlv'];
        foreach($requiredTypes as $type) {
            if(!$this->instructorDocumentModel->hasApprovedDocType($id, $type)) {
                $_SESSION['error'] = 'Não é possível aprovar: faltam documentos obrigatórios aprovados (CNH, Credencial, LAV, CRLV).';
                $this->redirect('admin/documentosInstrutor/' . $id);
            }
        }

        $this->instructorModel->updateStatus($id, 'aprovado');
        $_SESSION['success'] = 'Instrutor aprovado com sucesso!';
        $this->redirect('admin/instrutores?status=pendente');
    }
    
    public function rejeitarInstrutor($id) {
        $this->instructorModel->updateStatus($id, 'rejeitado');
        $_SESSION['success'] = 'Instrutor rejeitado.';
        $this->redirect('admin/instrutores?status=pendente');
    }

    public function documentosInstrutor($id) {
        $instructor = $this->instructorModel->findById($id);
        if(!$instructor) {
            $_SESSION['error'] = 'Instrutor não encontrado.';
            $this->redirect('admin/instrutores?status=pendente');
        }

        $documents = $this->instructorDocumentModel->getByInstructor($id);

        $required = [
            'cnh' => 'CNH',
            'credencial' => 'Credencial/Crachá de Instrutor',
            'lav' => 'Licença de Aprendizagem Veicular (LAV)',
            'crlv' => 'CRLV (Certificado de Registro e Licenciamento do Veículo)'
        ];

        $labels = $required + [
            'outro' => 'Outro'
        ];

        $requiredStatus = [];
        foreach(array_keys($required) as $type) {
            $requiredStatus[$type] = $this->instructorDocumentModel->hasApprovedDocType($id, $type);
        }

        $data = [
            'title' => 'Documentos do Instrutor',
            'instructor' => $instructor,
            'documents' => $documents,
            'required' => $required,
            'required_status' => $requiredStatus,
            'labels' => $labels
        ];

        $this->view('admin/documentos-instrutor', $data);
    }

    public function atualizarDocumento($id) {
        if($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->redirect('admin/dashboard');
        }

        $doc = $this->instructorDocumentModel->findById($id);
        if(!$doc) {
            $_SESSION['error'] = 'Documento não encontrado.';
            $this->redirect('admin/instrutores?status=pendente');
        }

        $action = $_POST['action'] ?? '';
        $notes = trim($_POST['admin_notes'] ?? '');

        if($action === 'aprovar') {
            $this->instructorDocumentModel->updateStatus($id, 'aprovado', $notes ?: null);
            $_SESSION['success'] = 'Documento aprovado.';
        } elseif($action === 'rejeitar') {
            $this->instructorDocumentModel->updateStatus($id, 'rejeitado', $notes ?: null);
            $_SESSION['success'] = 'Documento rejeitado.';
        } else {
            $_SESSION['error'] = 'Ação inválida.';
        }

        $this->redirect('admin/documentosInstrutor/' . $doc->instructor_id);
    }
    
    public function alunos() {
        $data = [
            'title' => 'Gerenciar Alunos',
            'students' => $this->studentModel->getAll()
        ];
        
        $this->view('admin/alunos', $data);
    }
    
    public function agendamentos() {
        $data = [
            'title' => 'Todos os Agendamentos',
            'schedules' => $this->scheduleModel->getAll()
        ];
        
        $this->view('admin/agendamentos', $data);
    }
    
    public function avaliacoes() {
        $status = $_GET['status'] ?? 'pendente';
        
        $data = [
            'title' => 'Moderar Avaliações',
            'reviews' => $this->reviewModel->getAll($status),
            'status' => $status
        ];
        
        $this->view('admin/avaliacoes', $data);
    }
    
    public function aprovarAvaliacao($id) {
        $review = $this->reviewModel->updateStatus($id, 'aprovado');
        $_SESSION['success'] = 'Avaliação aprovada!';
        $this->redirect('admin/avaliacoes');
    }
    
    public function rejeitarAvaliacao($id) {
        $this->reviewModel->updateStatus($id, 'rejeitado');
        $_SESSION['success'] = 'Avaliação rejeitada.';
        $this->redirect('admin/avaliacoes');
    }
    
    public function planos() {
        $data = [
            'title' => 'Gerenciar Planos',
            'plans' => $this->planModel->getAll()
        ];
        
        $this->view('admin/planos', $data);
    }
    
    public function relatorios() {
        $data = [
            'title' => 'Relatórios',
            'total_users' => count($this->userModel->getAll()),
            'total_instructors' => count($this->instructorModel->getApproved()),
            'total_students' => count($this->studentModel->getAll()),
            'total_schedules' => count($this->scheduleModel->getAll()),
            'total_reviews' => count($this->reviewModel->getAll('aprovado'))
        ];
        
        $this->view('admin/relatorios', $data);
    }
    
    public function deletarUsuario($id) {
        if($id != $_SESSION['user_id']) {
            $this->userModel->delete($id);
            $_SESSION['success'] = 'Usuário deletado com sucesso.';
        }
        $this->redirect('admin/dashboard');
    }
}
