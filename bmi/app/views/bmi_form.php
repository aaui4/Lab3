
<!DOCTYPE html>
<html>
<head>
    <title>BMI Calculator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
<h3>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h3>

<?php if ($_SESSION['role'] === 'admin'): ?>
    <p class="text-success">You are logged in as <strong>Admin</strong></p>
    <a href="admin_panel.php" class="btn btn-warning mt-3">👥 عرض المستخدمين</a>

<?php else: ?>
    <p class="text-primary">You are logged in as <strong>User</strong></p>
<?php endif; ?>

    <h2>BMI Calculator</h2>
    <form action="" method="POST">
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
        <a href="logout.php" class="btn btn-danger">Logout</a>
        </form>
</body>
</html>
