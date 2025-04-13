<?php
require '../config/database.php';
require '../app/models/UserModel.php';
require '../app/controllers/AuthController.php';

$userModel = new UserModel($db);
$auth = new AuthController($userModel);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth->login($_POST['username'], $_POST['password']);
} else {
    include '../app/views/login.php';
}
?>
