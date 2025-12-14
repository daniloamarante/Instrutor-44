<?php

class AdminController extends Controller {
    
    private $userModel;
    private $instructorModel;
    private $studentModel;
    private $scheduleModel;
    private $reviewModel;
    private $planModel;
    
    public function __construct() {
        $this->requireLogin();
        $this->requireRole('admin');
        
        $this->userModel = $this->model('User');
        $this->instructorModel = $this->model('Instructor');
        $this->studentModel = $this->model('Student');
        $this->scheduleModel = $this->model('Schedule');
        $this->reviewModel = $this->model('Review');
        $this->planModel = $this->model('Plan');
    }
    
    public function dashboard() {
        $data = [
            'title' => 'Painel Administrativo',
            'total_instructors' => count($this->instructorModel->getApproved()),
            'pending_instructors' => count($this->instructorModel->getPending()),
            'total_students' => count($this->studentModel->getAll()),
            'total_schedules' => count($this->scheduleModel->getAll()),
            'recent_schedules' => $this->scheduleModel->getAll(10),
            'pending_reviews' => $this->reviewModel->getAll('pendente')
        ];
        
        $this->view('admin/dashboard', $data);
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
        $this->instructorModel->updateStatus($id, 'aprovado');
        $_SESSION['success'] = 'Instrutor aprovado com sucesso!';
        $this->redirect('admin/instrutores?status=pendente');
    }
    
    public function rejeitarInstrutor($id) {
        $this->instructorModel->updateStatus($id, 'rejeitado');
        $_SESSION['success'] = 'Instrutor rejeitado.';
        $this->redirect('admin/instrutores?status=pendente');
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
