<?php

class HomeController extends Controller {
    
    private $instructorModel;
    private $reviewModel;
    
    public function __construct() {
        $this->instructorModel = $this->model('Instructor');
        $this->reviewModel = $this->model('Review');
    }
    
    public function index() {
        $data = [
            'title' => 'Encontre Instrutor - Aulas de Direção Particulares',
            'featured_instructors' => $this->instructorModel->search(['limit' => 6])
        ];
        
        $this->view('home/index', $data);
    }
    
    public function planos() {
        $planModel = $this->model('Plan');
        
        $data = [
            'title' => 'Planos e Preços',
            'plans' => $planModel->getAll()
        ];
        
        $this->view('home/planos', $data);
    }
    
    public function paraInstrutores() {
        $data = [
            'title' => 'Para Instrutores'
        ];
        
        $this->view('home/para-instrutores', $data);
    }

    public function instrutor($id) {
        $instructor = $this->instructorModel->findById($id);
        if(!$instructor || ($instructor->status ?? '') !== 'aprovado') {
            $_SESSION['error'] = 'Instrutor não encontrado.';
            $this->redirect('');
        }

        $reviews = $this->reviewModel->getByInstructor($id, 'aprovado');

        $data = [
            'title' => $instructor->name,
            'instructor' => $instructor,
            'reviews' => $reviews
        ];

        $this->view('home/instrutor', $data);
    }
}
