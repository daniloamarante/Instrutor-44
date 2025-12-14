<?php

class HomeController extends Controller {
    
    private $instructorModel;
    
    public function __construct() {
        $this->instructorModel = $this->model('Instructor');
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
}
