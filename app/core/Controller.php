<?php

class Controller {
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }
    
    public function view($view, $data = []) {
        if(file_exists('../app/views/' . $view . '.php')) {
            require_once '../app/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
    
    public function redirect($url) {
        header('Location: ' . URL_ROOT . '/' . $url);
        exit();
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    
    public function requireLogin() {
        if(!$this->isLoggedIn()) {
            $this->redirect('auth/login');
        }
    }
    
    public function requireRole($role) {
        if(!$this->isLoggedIn()) {
            $this->redirect('auth/login');
        }

        if(($_SESSION['user_role'] ?? '') !== $role) {
            $_SESSION['error'] = 'Você não tem acesso a esse perfil.';

            $currentRole = $_SESSION['user_role'] ?? '';
            switch($currentRole) {
                case 'aluno':
                    $this->redirect('aluno/dashboard');
                    break;
                case 'instrutor':
                    $this->redirect('instrutor/dashboard');
                    break;
                case 'admin':
                    $this->redirect('admin/dashboard');
                    break;
                default:
                    $this->redirect('');
                    break;
            }
        }
    }
    
    public function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit();
    }
}
