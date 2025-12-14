<?php

class EmergenciaController extends Controller {

    private $emergencyAlertModel;
    private $emergencyAlertLocationModel;
    private $userModel;

    public function __construct() {
        $this->requireLogin();
        $this->emergencyAlertModel = $this->model('EmergencyAlert');
        $this->emergencyAlertLocationModel = $this->model('EmergencyAlertLocation');
        $this->userModel = $this->model('User');
    }

    public function acionar() {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Método inválido']);
        }

        $role = $_SESSION['user_role'] ?? '';
        if($role !== 'aluno' && $role !== 'instrutor') {
            $this->json(['success' => false, 'message' => 'Permissão negada']);
        }

        $raw = file_get_contents('php://input');
        $payload = json_decode($raw, true);
        if(!is_array($payload)) {
            $payload = $_POST;
        }

        $user = $this->userModel->findById($_SESSION['user_id']);
        if(!$user) {
            $this->json(['success' => false, 'message' => 'Usuário não encontrado']);
        }

        $lat = null;
        $lng = null;
        if(isset($payload['lat'])) {
            $lat = is_numeric($payload['lat']) ? (float)$payload['lat'] : null;
        }
        if(isset($payload['lng'])) {
            $lng = is_numeric($payload['lng']) ? (float)$payload['lng'] : null;
        }

        $alertId = $this->emergencyAlertModel->create([
            'user_id' => $user->id,
            'user_role' => $role,
            'user_name' => $user->name,
            'user_phone' => $user->phone ?? null,
            'lat' => $lat,
            'lng' => $lng,
            'status' => 'aberto'
        ]);

        if($alertId) {
            $this->json(['success' => true, 'id' => $alertId]);
        }

        $this->json(['success' => false, 'message' => 'Erro ao registrar alerta']);
    }

    public function atualizar($alert_id) {
        if($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Método inválido']);
        }

        $role = $_SESSION['user_role'] ?? '';
        if($role !== 'aluno' && $role !== 'instrutor') {
            $this->json(['success' => false, 'message' => 'Permissão negada']);
        }

        $raw = file_get_contents('php://input');
        $payload = json_decode($raw, true);
        if(!is_array($payload)) {
            $payload = $_POST;
        }

        if(!isset($payload['lat']) || !isset($payload['lng']) || !is_numeric($payload['lat']) || !is_numeric($payload['lng'])) {
            $this->json(['success' => false, 'message' => 'Localização inválida']);
        }

        $lat = (float)$payload['lat'];
        $lng = (float)$payload['lng'];
        $accuracy = null;
        if(isset($payload['accuracy_meters']) && is_numeric($payload['accuracy_meters'])) {
            $accuracy = (int)$payload['accuracy_meters'];
        }

        $updated = $this->emergencyAlertModel->updateLocation($alert_id, $_SESSION['user_id'], $lat, $lng);
        if(!$updated) {
            $this->json(['success' => false, 'message' => 'Alerta não encontrado ou encerrado']);
        }

        $this->emergencyAlertLocationModel->create([
            'alert_id' => (int)$alert_id,
            'lat' => $lat,
            'lng' => $lng,
            'accuracy_meters' => $accuracy
        ]);

        $this->json(['success' => true]);
    }
}
