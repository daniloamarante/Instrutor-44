<?php

class AuthController extends Controller {
    
    private $userModel;
    private $studentModel;
    private $instructorModel;
    
    public function __construct() {
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
        $this->instructorModel = $this->model('Instructor');
    }
    
    public function login() {
        if($this->isLoggedIn()) {
            $this->redirect($this->getDashboardByRole($_SESSION['user_role']));
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => ''
            ];
            
            if(empty($data['email'])) {
                $data['email_err'] = 'Por favor, insira seu email';
            }
            
            if(empty($data['password'])) {
                $data['password_err'] = 'Por favor, insira sua senha';
            }
            
            if(empty($data['email_err']) && empty($data['password_err'])) {
                $user = $this->userModel->findByEmail($data['email']);
                
                if($user && password_verify($data['password'], $user->password)) {
                    $_SESSION['user_id'] = $user->id;
                    $_SESSION['user_email'] = $user->email;
                    $_SESSION['user_name'] = $user->name;
                    $_SESSION['user_role'] = $user->role;
                    
                    $this->redirect($this->getDashboardByRole($user->role));
                } else {
                    $data['password_err'] = 'Email ou senha incorretos';
                    $this->view('auth/login', $data);
                }
            } else {
                $this->view('auth/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
            
            $this->view('auth/login', $data);
        }
    }
    
    public function register() {
        if($this->isLoggedIn()) {
            $this->redirect($this->getDashboardByRole($_SESSION['user_role']));
        }
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role' => trim($_POST['role']),
                'name_err' => '',
                'email_err' => '',
                'phone_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'role_err' => ''
            ];
            
            if(empty($data['name'])) {
                $data['name_err'] = 'Por favor, insira seu nome';
            }
            
            if(empty($data['email'])) {
                $data['email_err'] = 'Por favor, insira seu email';
            } else {
                if($this->userModel->findByEmail($data['email'])) {
                    $data['email_err'] = 'Email já cadastrado';
                }
            }
            
            if(empty($data['password'])) {
                $data['password_err'] = 'Por favor, insira uma senha';
            } elseif(strlen($data['password']) < 6) {
                $data['password_err'] = 'A senha deve ter pelo menos 6 caracteres';
            }
            
            if(empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Por favor, confirme sua senha';
            } else {
                if($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'As senhas não coincidem';
                }
            }
            
            if(!in_array($data['role'], ['aluno', 'instrutor'])) {
                $data['role_err'] = 'Tipo de usuário inválido';
            }
            
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err']) && empty($data['role_err'])) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                
                $userId = $this->userModel->create($data);
                
                if($userId) {
                    if($data['role'] == 'aluno') {
                        $this->studentModel->create(['user_id' => $userId]);
                    } else {
                        $this->instructorModel->create(['user_id' => $userId, 'status' => 'pendente']);
                    }
                    
                    $_SESSION['user_id'] = $userId;
                    $_SESSION['user_email'] = $data['email'];
                    $_SESSION['user_name'] = $data['name'];
                    $_SESSION['user_role'] = $data['role'];
                    
                    $this->redirect($this->getDashboardByRole($data['role']));
                } else {
                    die('Erro ao criar usuário');
                }
            } else {
                $this->view('auth/register', $data);
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'phone' => '',
                'password' => '',
                'confirm_password' => '',
                'role' => $_GET['tipo'] ?? 'aluno',
                'name_err' => '',
                'email_err' => '',
                'phone_err' => '',
                'password_err' => '',
                'confirm_password_err' => '',
                'role_err' => ''
            ];
            
            $this->view('auth/register', $data);
        }
    }
    
    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_role']);
        session_destroy();
        $this->redirect('');
    }
    
    private function getDashboardByRole($role) {
        switch($role) {
            case 'aluno':
                return 'aluno/dashboard';
            case 'instrutor':
                return 'instrutor/dashboard';
            case 'admin':
                return 'admin/dashboard';
            default:
                return '';
        }
    }
}
