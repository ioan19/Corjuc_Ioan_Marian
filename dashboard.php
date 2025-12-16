<?php
require 'auth.php'; // Protejăm pagina
require 'db.php';   // Conexiune DB

// 1. Statistici pentru carduri
// Nr Drone Active
$stmt = $pdo->query("SELECT COUNT(*) FROM Drones WHERE Status = 'activa'");
$activeDrones = $stmt->fetchColumn();

// Nr Misiuni Planificate
$stmt = $pdo->query("SELECT COUNT(*) FROM Missions WHERE MissionStatus = 'planificata'");
$plannedMissions = $stmt->fetchColumn();

// Drone care NU sunt active (presupunem mentenanță sau inactivitate)
$stmt = $pdo->query("SELECT COUNT(*) FROM Drones WHERE Status != 'activa'");
$maintenanceDrones = $stmt->fetchColumn();

// Media Durată Misiune
$stmt = $pdo->query("SELECT AVG(DurationMin) FROM Missions");
$avgDuration = round($stmt->fetchColumn(), 2);

// 2. Misiuni Recente (Ultimele 5 planificate)
$stmt = $pdo->query("SELECT m.MissionID, m.DroneID, d.Model, m.Type, m.StartTime, m.MissionStatus 
                     FROM Missions m 
                     LEFT JOIN Drones d ON m.DroneID = d.DroneID 
                     WHERE m.MissionStatus = 'planificata' 
                     ORDER BY m.StartTime DESC LIMIT 5");
$recentMissions = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DroneFleet Manager - Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="dashboard-layout"> 
    
    <div class="top-bar-dashboard">
        <div class="logo">
            <a href="home.php">
                <img src="logo1.png" alt="Logo">
            </a>
        </div>
        <nav>
            <ul class="dashboard-nav-links">
                <li class="active"><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="users.php"><i class="fas fa-users"></i> Utilizatori</a></li>
                <li><a href="drones.php"><i class="fas fa-plane"></i> Gestiune Drone</a></li>
                <li><a href="missions.php"><i class="fas fa-route"></i> Misiuni</a></li>
                <li><a href="maintenance.php"><i class="fas fa-tools"></i> Mentenanță</a></li>
                <li><a href="locations.php"><i class="fas fa-map-marker-alt"></i> Locații</a></li>
            </ul>
        </nav>
        
        <div class="user-controls-top">
             <div class="user-info-top">
                <i class="fas fa-user-circle"></i>
                <span class="user-role"><?= htmlspecialchars($_SESSION['fullname']); ?> (<?= htmlspecialchars($_SESSION['role']); ?>)</span>
            </div>
             <a href="logout.php" class="logout-top-button" title="Deconectare">
                <i class="fas fa-sign-out-alt"></i> Deconectare
            </a>
        </div>
    </div>

    <div class="main-content">
        <section id="dashboard">
            <header class="dashboard-header">
                <h1>Tablou de Bord Principal</h1>
            </header>

            <section class="overview-cards">
                <div class="card">
                    <h2>Drone Active</h2>
                    <p class="metric-value"><?= $activeDrones ?></p>
                    <i class="fas fa-check-circle card-icon active-icon"></i>
                </div>
                <div class="card">
                    <h2>Misiuni Planificate</h2>
                    <p class="metric-value"><?= $plannedMissions ?></p>
                    <i class="fas fa-calendar-alt card-icon planned-icon"></i>
                </div>
                <div class="card">
                    <h2>Alte Statusuri</h2>
                    <p class="metric-value"><?= $maintenanceDrones ?></p>
                    <i class="fas fa-wrench card-icon maintenance-icon"></i>
                </div>
                <div class="card">
                    <h2>Media Durată Misiune</h2>
                    <p class="metric-value"><?= $avgDuration ?> min</p>
                    <i class="fas fa-clock card-icon time-icon"></i>
                </div>
            </section>
            
            <section class="data-tables">
                <h2>Misiuni Recente (Status: Planificată)</h2>
                <table>
                    <thead>
                        <tr>
                            <th>MissionID</th>
                            <th>DroneID</th>
                            <th>Model</th>
                            <th>Tip Misiune</th>
                            <th>Start Timp</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recentMissions as $m): ?>
                        <tr>
                            <td><?= $m['MissionID'] ?></td>
                            <td><?= $m['DroneID'] ?></td>
                            <td><?= htmlspecialchars($m['Model'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($m['Type']) ?></td>
                            <td><?= htmlspecialchars($m['StartTime']) ?></td>
                            <td><?= htmlspecialchars($m['MissionStatus']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </section>
    </div> 
</body>
</html>