<?php
class AdminController {
    private $userModel;
    private $bmiModel;

    public function __construct($userModel, $bmiModel) {
        $this->userModel = $userModel;
        $this->bmiModel = $bmiModel;
    }

    public function dashboard() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
            return ['success' => false, 'message' => 'Access denied'];
        }

        $users = $this->userModel->getAllUsers();
        $allRecords = $this->bmiModel->getAllRecords();
        
        require '../app/views/admin/dashboard.php';
    }

    public function getUserStats($userId) {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 'admin') {
            return ['success' => false, 'message' => 'Access denied'];
        }

        return $this->bmiModel->getBmiHistory($userId);
    }
}
?>