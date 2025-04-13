<?php

session_start();

// تحقق من صلاحيات الدخول
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

require '../config/database.php';
require '../app/models/UserModel.php';

$userModel = new UserModel($db);
$users = $userModel->getAllUsers();
?>


<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

    <h2> Welcome Admin <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
    <h4 class="mt-4">All Registered Users:</h4>

    <table class="table table-striped mt-3">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['username']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    <a href="logout.php" class="btn btn-danger">Logout</a>

</body>
</html>
