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

        $locationText = !empty($instructor->location_address) ? (' em ' . $instructor->location_address) : '';
        $metaDescription = 'Aulas práticas de direção com ' . $instructor->name . $locationText . '. Nota ' . number_format((float)$instructor->rating, 1) . '/5 com ' . (int)$instructor->total_reviews . ' avaliações. Agende sua aula agora.';

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $instructor->name,
            'url' => rtrim(URL_ROOT, '/') . '/home/instrutor/' . $instructor->id,
        ];

        if(!empty($instructor->phone)) {
            $schema['telephone'] = $instructor->phone;
        }

        if(!empty($instructor->location_address)) {
            $schema['address'] = $instructor->location_address;
        }

        if(isset($instructor->rating) && isset($instructor->total_reviews)) {
            $schema['aggregateRating'] = [
                '@type' => 'AggregateRating',
                'ratingValue' => (float)$instructor->rating,
                'reviewCount' => (int)$instructor->total_reviews,
                'bestRating' => 5,
                'worstRating' => 1
            ];
        }

        $data = [
            'title' => $instructor->name,
            'instructor' => $instructor,
            'reviews' => $reviews,
            'meta_description' => $metaDescription,
            'og_type' => 'profile',
            'schema_jsonld' => $schema
        ];

        $this->view('home/instrutor', $data);
    }
}
