
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require '../config/database.php';
require '../app/models/BmiModel.php';
require '../app/controllers/BmiController.php';

$model = new BmiModel($db, $_SESSION['user_id']);
$controller = new BmiController($model);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->calculateBmi($_POST['name'], $_POST['weight'], $_POST['height']);
} else {
    include '../app/views/bmi_form.php';
}
?>
