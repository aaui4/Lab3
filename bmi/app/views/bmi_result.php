<!DOCTYPE html>
<html>
<head>
    <title>BMI Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body class="container mt-5">
    <h2>BMI Result</h2>
    <div class="alert alert-info">
        <p><strong>Name:</strong> <?= htmlspecialchars($name) ?></p>
        <p><strong>BMI:</strong> <?= $bmi ?></p>
        <p><strong>Status:</strong> <?= $status ?></p>
    </div>
    <a href="index.php" class="btn btn-secondary">Back</a>
<button id="showHistoryBtn" class="btn btn-success mt-4">View history BMI</button>

    <!-- قسم الرسم البياني سيتم إظهاره عند الضغط على الزر -->
    <div id="bmiHistorySection" style="display:none;">
        <h3>Your BMI history</h3>
        <canvas id="bmiChart"></canvas>
    </div>

    <script>
        // إضافة حدث الزر لعرض الرسم البياني
        document.getElementById('showHistoryBtn').addEventListener('click', function() {
            document.getElementById('bmiHistorySection').style.display = 'block';

            const labels = <?= json_encode(array_column($bmiHistory, 'timestamp')) ?>;
            const data = <?= json_encode(array_column($bmiHistory, 'bmi')) ?>;

            const ctx = document.getElementById('bmiChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'BMI',
                        data: data,
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.2)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: false
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
</body>
</html>
