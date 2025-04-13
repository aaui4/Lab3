<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// تحميل الملفات
require_once '../app/models/BmiModel.php';
require_once '../app/controllers/BmiController.php';
require_once '../config/database.php';

// تحضير النموذج والمتحكم
$model = new BmiModel( $db);
$controller = new BmiController($model);

// حساب BMI إذا تم الإرسال
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->calculateBmi($_POST['name'], $_POST['weight'], $_POST['height'], $_SESSION['user_id']);
}

// جلب بيانات الرسم البياني
$bmiHistory = $model->getBmiHistoryByUser($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="container mt-5">

<h3>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h3>

<?php if ($_SESSION['role'] === 'admin'): ?>
    <a href="admin_panel.php" class="btn btn-warning mt-3">👥 عرض المستخدمين</a>
<?php endif; ?>

<a href="logout.php" class="btn btn-danger mt-3">Log out</a>



<h2>BMI Calculator</h2>
<form method="POST">
    <div class="mb-3">
        <label>Name:</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Weight (kg):</label>
        <input type="number" step="0.1" name="weight" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Height (cm):</label>
        <input type="number" step="0.1" name="height" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Calculate BMI</button>
</form>






</body>
</html>
