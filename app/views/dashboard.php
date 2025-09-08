<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Dashboard de Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/sidebar.css">
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        /* Estilos generales y del layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            overflow: hidden; /* Evita el scroll del body */
        }

        .page-container {
            display: flex;
            min-height: 100vh;
        }

        /* --- Sidebar Fijo --- */
        .sidebar {
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            width: 250px;
            position: fixed; /* Mantiene el sidebar en su posición */
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-logo {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu li a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #555;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .sidebar-menu li a:hover {
            background-color: #f0f2f5;
        }

        /* --- Contenido Principal (Dashboard) --- */
        .main-content {
            /* Mueve el contenido a la derecha del sidebar fijo */
            margin-left: 300px; 
            
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            width: 100%;
            height: 100vh; /* Ocupa toda la altura disponible */
            overflow-y: auto; /* Permite el scroll solo en esta sección */
        }

        .dashboard-header {
            width: 100%;
            max-width: 1200px;
            text-align: left;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 28px;
            color: #333;
        }

        /* --- Estilos de las secciones del Dashboard --- */
        .kpi-section,
        .chart-section {
            display: grid;
            gap: 20px;
            grid-template-columns: repeat(3, 1fr);
            width: 100%;
            max-width: 1200px;
            margin-bottom: 20px;
        }

        .kpi-card,
        .chart-card {
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .kpi-section .kpi-card {
            padding: 30px;
        }

        .kpi-label {
            font-size: 14px;
            color: #888;
            text-transform: uppercase;
        }

        .kpi-value {
            font-size: 48px;
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }

        .chart-card {
            position: relative;
            padding-top: 50px;
        }

        .chart-title {
            font-size: 16px;
            font-weight: bold;
            color: #444;
            position: absolute;
            top: 20px;
            left: 20px;
            z-index: 10;
        }
    </style>
</head>
<body>

    <div class="page-container">
        
        <aside class="sidebar">
            <?php include __DIR__ . '/partials/sidebar.php'; ?>
        </aside>

        <div class="main-content">
            <!--header class="dashboard-header">
                <h1>Dashboard de Gestión de Biblioteca</h1>
            </header-->

            <div class="kpi-section">
                <div class="kpi-card">
                    <span class="kpi-label">Books Borrowed</span>
                    <span class="kpi-value">85%</span>
                </div>
                <div class="kpi-card">
                    <span class="kpi-label">New Registrations</span>
                    <span class="kpi-value">72%</span>
                </div>
                <div class="kpi-card">
                    <span class="kpi-label">Overdue Books</span>
                    <span class="kpi-value">15%</span>
                </div>
            </div>

            <div class="chart-section trends-section">
                <div class="chart-card">
                    <span class="chart-title">Daily Borrowing Trends</span>
                    <canvas id="borrowingChart"></canvas>
                </div>
                <div class="chart-card">
                    <span class="chart-title">Monthly Returns</span>
                    <canvas id="returnsChart"></canvas>
                </div>
                <div class="chart-card">
                    <span class="chart-title">Weekly Holds</span>
                    <canvas id="holdsChart"></canvas>
                </div>
            </div>

            <div class="chart-section averages-section">
                <div class="chart-card">
                    <span class="chart-title">Average Borrower Demographics</span>
                    <canvas id="demographicsChart"></canvas>
                </div>
                <div class="chart-card">
                    <span class="chart-title">Average Book Category Usage</span>
                    <canvas id="categoryChart"></canvas>
                </div>
                <div class="chart-card">
                    <span class="chart-title">Average Loan Duration</span>
                    <canvas id="durationChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Código de los gráficos
        document.addEventListener('DOMContentLoaded', function() {
            const generateRandomData = (length, max) => Array.from({ length }, () => Math.floor(Math.random() * max));

            const borrowingCtx = document.getElementById('borrowingChart').getContext('2d');
            new Chart(borrowingCtx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Daily Borrowing Trends',
                        data: generateRandomData(7, 100),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } } }
            });

            const returnsCtx = document.getElementById('returnsChart').getContext('2d');
            new Chart(returnsCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'Monthly Returns',
                        data: generateRandomData(6, 150),
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } } }
            });

            const holdsCtx = document.getElementById('holdsChart').getContext('2d');
            new Chart(holdsCtx, {
                type: 'line',
                data: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [{
                        label: 'Weekly Holds',
                        data: generateRandomData(4, 80),
                        backgroundColor: 'rgba(255, 159, 64, 0.2)',
                        borderColor: 'rgba(255, 159, 64, 1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } } }
            });

            const demographicsCtx = document.getElementById('demographicsChart').getContext('2d');
            new Chart(demographicsCtx, {
                type: 'bar',
                data: {
                    labels: ['Students', 'Faculty', 'Public'],
                    datasets: [{
                        label: 'Demographics',
                        data: [50, 75, 40],
                        backgroundColor: ['#36a2eb', '#4bc0c0', '#ff9f40'],
                        borderColor: ['#36a2eb', '#4bc0c0', '#ff9f40'],
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } } }
            });

            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Fiction', 'Non-Fiction', 'Reference'],
                    datasets: [{
                        label: 'Book Categories',
                        data: [45, 30, 25],
                        backgroundColor: ['#36a2eb', '#ffcd56', '#ff6384'],
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: { responsive: true, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, } } } }
            });

            const durationCtx = document.getElementById('durationChart').getContext('2d');
            new Chart(durationCtx, {
                type: 'doughnut',
                data: {
                    labels: ['1 Week', '2 Weeks', '3+ Weeks'],
                    datasets: [{
                        label: 'Loan Duration',
                        data: [60, 30, 10],
                        backgroundColor: ['#ff9f40', '#4bc0c0', '#9966ff'],
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: { responsive: true, plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, } } } }
            });
        });
    </script>
</body>
</html>