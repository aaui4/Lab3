<?php
require '../config/database.php';
require '../app/models/UserModel.php';
require '../app/controllers/AuthController.php';

$auth = new AuthController(new UserModel($db));
$auth->logout();
?>
