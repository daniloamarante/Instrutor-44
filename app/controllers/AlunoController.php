<?php

class AlunoController extends Controller {
    
    private $userModel;
    private $studentModel;
    private $instructorModel;
    private $scheduleModel;
    private $reviewModel;
    
    public function __construct() {
        $this->requireLogin();
        $this->requireRole('aluno');
        
        $this->userModel = $this->model('User');
        $this->studentModel = $this->model('Student');
        $this->instructorModel = $this->model('Instructor');
        $this->scheduleModel = $this->model('Schedule');
        $this->reviewModel = $this->model('Review');
    }
    
    public function dashboard() {
        $student = $this->studentModel->findByUserId($_SESSION['user_id']);
        
        $data = [
            'title' => 'Meu Painel',
            'student' => $student,
            'upcoming_schedules' => $this->scheduleModel->getByStudent($student->id, 'confirmado'),
            'pending_schedules' => $this->scheduleModel->getByStudent($student->id, 'pendente')
        ];
        
        $this->view('aluno/dashboard', $data);
    }
    
    public function buscar() {
        $filters = [];
        
        if(isset($_GET['lat']) && isset($_GET['lng'])) {
            $filters['lat'] = floatval($_GET['lat']);
            $filters['lng'] = floatval($_GET['lng']);
            $filters['max_distance'] = $_GET['distance'] ?? 50;
        }
        
        if(isset($_GET['max_price'])) {
            $filters['max_price'] = floatval($_GET['max_price']);
        }
        
        if(isset($_GET['min_rating'])) {
            $filters['min_rating'] = floatval($_GET['min_rating']);
        }
        
        $instructors = $this->instructorModel->search($filters);
        
        $data = [
            'title' => 'Buscar Instrutores',
            'instructors' => $instructors,
            'filters' => $filters
        ];
        
        $this->view('aluno/buscar', $data);
    }
    
    public function instrutor($id) {
        $instructor = $this->instructorModel->findById($id);
        
        if(!$instructor) {
            $this->redirect('aluno/buscar');
        }
        
        $reviews = $this->reviewModel->getByInstructor($id);
        
        $data = [
            'title' => $instructor->name,
            'instructor' => $instructor,
            'reviews' => $reviews
        ];
        
        $this->view('aluno/instrutor', $data);
    }
    
    public function agendar($instructor_id) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $student = $this->studentModel->findByUserId($_SESSION['user_id']);
            $instructor = $this->instructorModel->findById($instructor_id);
            
            $scheduleData = [
                'instructor_id' => $instructor_id,
                'student_id' => $student->id,
                'date_time' => $_POST['date_time'],
                'duration' => $_POST['duration'] ?? 60,
                'price' => $instructor->price_per_hour * (($_POST['duration'] ?? 60) / 60),
                'location_address' => $_POST['location_address'] ?? '',
                'notes' => $_POST['notes'] ?? ''
            ];
            
            if($this->scheduleModel->create($scheduleData)) {
                $_SESSION['success'] = 'Aula agendada com sucesso! Aguarde a confirmação do instrutor.';
                $this->redirect('aluno/minhas-aulas');
            } else {
                $_SESSION['error'] = 'Erro ao agendar aula. Tente novamente.';
                $this->redirect('aluno/instrutor/' . $instructor_id);
            }
        }
    }
    
    public function minhasAulas() {
        $student = $this->studentModel->findByUserId($_SESSION['user_id']);
        
        $data = [
            'title' => 'Minhas Aulas',
            'schedules' => $this->scheduleModel->getByStudent($student->id)
        ];
        
        $this->view('aluno/minhas-aulas', $data);
    }
    
    public function cancelarAula($id) {
        $schedule = $this->scheduleModel->findById($id);
        $student = $this->studentModel->findByUserId($_SESSION['user_id']);
        
        if($schedule && $schedule->student_id == $student->id) {
            $this->scheduleModel->updateStatus($id, 'cancelado');
            $_SESSION['success'] = 'Aula cancelada com sucesso.';
        }
        
        $this->redirect('aluno/minhas-aulas');
    }
    
    public function avaliar($instructor_id) {
        $student = $this->studentModel->findByUserId($_SESSION['user_id']);

        if(!$this->reviewModel->canReview($student->id, $instructor_id)) {
            $_SESSION['error'] = 'Você só pode avaliar após concluir uma aula com este instrutor.';
            $this->redirect('aluno/minhas-aulas');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $hygieneVehicle = isset($_POST['hygiene_vehicle']) ? intval($_POST['hygiene_vehicle']) : null;
            $serviceQuality = isset($_POST['service_quality']) ? intval($_POST['service_quality']) : null;
            $punctuality = isset($_POST['punctuality']) ? intval($_POST['punctuality']) : null;
            $vehicleQuality = isset($_POST['vehicle_quality']) ? intval($_POST['vehicle_quality']) : null;

            $criteria = array_filter([$hygieneVehicle, $serviceQuality, $punctuality, $vehicleQuality], function($v) {
                return $v !== null;
            });

            $rating = 0;
            if(!empty($criteria)) {
                $rating = (int)round(array_sum($criteria) / count($criteria));
            } else {
                $rating = isset($_POST['rating']) ? intval($_POST['rating']) : 0;
            }

            $reviewData = [
                'student_id' => $student->id,
                'instructor_id' => $instructor_id,
                'rating' => $rating,
                'hygiene_vehicle' => $hygieneVehicle,
                'service_quality' => $serviceQuality,
                'punctuality' => $punctuality,
                'vehicle_quality' => $vehicleQuality,
                'comment' => $_POST['comment'] ?? ''
            ];

            if($this->reviewModel->create($reviewData)) {
                $this->instructorModel->updateRating($instructor_id);
                $_SESSION['success'] = 'Avaliação enviada com sucesso!';
                $this->redirect('aluno/instrutor/' . $instructor_id);
            } else {
                $_SESSION['error'] = 'Erro ao enviar avaliação.';
                $this->redirect('aluno/avaliar/' . $instructor_id);
            }
        }

        $instructor = $this->instructorModel->findById($instructor_id);
        if(!$instructor) {
            $_SESSION['error'] = 'Instrutor não encontrado.';
            $this->redirect('aluno/minhas-aulas');
        }

        $data = [
            'title' => 'Avaliar Instrutor',
            'instructor' => $instructor
        ];

        $this->view('aluno/avaliar', $data);
    }
    
    public function perfil() {
        $user = $this->userModel->findById($_SESSION['user_id']);
        $student = $this->studentModel->findByUserId($_SESSION['user_id']);
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $userData = [
                'name' => $_POST['name'],
                'phone' => $_POST['phone'],
                'avatar' => $user->avatar
            ];
            
            $studentData = [
                'location_address' => $_POST['location_address'] ?? '',
                'location_lat' => $_POST['location_lat'] ?? null,
                'location_lng' => $_POST['location_lng'] ?? null
            ];
            
            $this->userModel->update($_SESSION['user_id'], $userData);
            $this->studentModel->update($student->id, $studentData);
            
            $_SESSION['user_name'] = $userData['name'];
            $_SESSION['success'] = 'Perfil atualizado com sucesso!';
            $this->redirect('aluno/perfil');
        }
        
        $data = [
            'title' => 'Meu Perfil',
            'user' => $user,
            'student' => $student
        ];
        
        $this->view('aluno/perfil', $data);
    }
}
