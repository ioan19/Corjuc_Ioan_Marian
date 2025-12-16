<?php
require 'auth.php';
require 'db.php';

// Preluăm toate misiunile
$stmt = $pdo->query("SELECT m.*, d.Model 
                     FROM Missions m 
                     LEFT JOIN Drones d ON m.DroneID = d.DroneID 
                     ORDER BY m.MissionID DESC");
$missions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>DroneFleet Manager - Misiuni</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .data-table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        .data-table th, .data-table td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
        .data-table th { background-color: #f4f4f4; }
    </style>
</head>
<body class="dashboard-layout">
    
    <div class="top-bar-dashboard">
        <div class="logo"><a href="home.php"><img src="logo1.png" alt="Logo"></a></div>
        <nav>
            <ul class="dashboard-nav-links">
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="users.php"><i class="fas fa-users"></i> Utilizatori</a></li>
                <li><a href="drones.php"><i class="fas fa-plane"></i> Drone</a></li>
                <li class="active"><a href="missions.php"><i class="fas fa-route"></i> Misiuni</a></li>
                <li><a href="maintenance.php"><i class="fas fa-tools"></i> Mentenanță</a></li>
                <li><a href="locations.php"><i class="fas fa-map-marker-alt"></i> Locații</a></li>
            </ul>
        </nav>
        <div class="user-controls-top">
             <div class="user-info-top">
                <i class="fas fa-user-circle"></i>
                <span class="user-role"><?= htmlspecialchars($_SESSION['username']); ?></span>
            </div>
             <a href="logout.php" class="logout-top-button"><i class="fas fa-sign-out-alt"></i> Deconectare</a>
        </div>
    </div>
    
    <div class="main-content">
        <section id="missions">
            <header class="dashboard-header"><h1>Programare și Monitorizare Misiuni</h1></header>
            
            <div style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Dronă (ID)</th>
                            <th>Tip</th>
                            <th>Start</th>
                            <th>Durată (min)</th>
                            <th>Rută (Start -> End)</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($missions as $m): ?>
                        <tr>
                            <td><?= $m['MissionID'] ?></td>
                            <td><?= htmlspecialchars($m['Model']) ?> (<?= $m['DroneID'] ?>)</td>
                            <td><?= htmlspecialchars($m['Type']) ?></td>
                            <td><?= htmlspecialchars($m['StartTime']) ?></td>
                            <td><?= htmlspecialchars($m['DurationMin']) ?></td>
                            <td><?= htmlspecialchars($m['StartCoord']) ?> &#8594; <?= htmlspecialchars($m['EndCoord']) ?></td>
                            <td>
                                <strong><?= htmlspecialchars($m['MissionStatus']) ?></strong>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>