<?php
// 1. Includem conexiunea la baza de date
require 'db.php';

// 2. Extragem datele din tabelul Drones
try {
    $stmt = $pdo->query("SELECT * FROM Drones ORDER BY DroneID ASC");
    $drones = $stmt->fetchAll();
} catch (PDOException $e) {
    $error = "Eroare la preluarea datelor: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DroneFleet Manager - Gestiune Drone</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Stiluri specifice pentru tabel */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .data-table th, .data-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }
        .data-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }
        .status-badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85em;
            font-weight: bold;
            text-transform: uppercase;
        }
        .status-activa { background-color: #e8f5e9; color: #2e7d32; }
        .status-mentenanta { background-color: #fff3e0; color: #ef6c00; }
        .status-inactiva { background-color: #ffebee; color: #c62828; }
    </style>
</head>
<body class="dashboard-layout">
    
    <div class="top-bar-dashboard">
        <div class="logo">
            <a href="home.html">
                <img src="logo1.png" alt="DroneFleet Manager Logo">
            </a>
        </div>
        <nav>
            <ul class="dashboard-nav-links">
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="users.php"><i class="fas fa-users"></i> Utilizatori & Operatori</a></li>
                <li class="active"><a href="drones.php"><i class="fas fa-plane"></i> Gestiune Drone</a></li>
                <li><a href="missions.php"><i class="fas fa-route"></i> Programare Misiuni</a></li>
                <li><a href="maintenance.php"><i class="fas fa-tools"></i> Mentenanță</a></li>
                <li><a href="locations.php"><i class="fas fa-map-marker-alt"></i> Locații Bază</a></li>
            </ul>
        </nav>
        <div class="user-controls-top">
             <div class="user-info-top">
                <i class="fas fa-user-circle"></i>
                <span class="user-role">Administrator</span>
            </div>
             <a href="index.html" class="logout-top-button" title="Deconectare">
                <i class="fas fa-sign-out-alt"></i> Deconectare
            </a>
        </div>
    </div>
    
    <div class="main-content">
        <section id="drones">
            <header class="dashboard-header">
                <h1>Gestiunea Flotei de Drone</h1>
                <div class="header-actions">
                    <button class="cta-button" style="padding: 8px 15px; font-size: 0.9em;">+ Adaugă Dronă</button>
                </div>
            </header>
            
            <p>Vizualizați specificațiile tehnice, starea bateriei și istoricul de zbor al fiecărei drone înregistrate în sistem.</p>

            <?php if (isset($error)): ?>
                <div style="background-color: #ffebee; color: #c62828; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
                    <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <div style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Model</th>
                            <th>Capacitate (kg)</th>
                            <th>Autonomie (min)</th>
                            <th>Status</th>
                            <th>Ultima Verificare</th>
                            <th>Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($drones)): ?>
                            <?php foreach ($drones as $drone): ?>
                                <tr>
                                    <td>#<?= htmlspecialchars($drone['DroneID']) ?></td>
                                    <td><strong><?= htmlspecialchars($drone['Model']) ?></strong></td>
                                    <td><?= htmlspecialchars($drone['PayloadCapacity']) ?> kg</td>
                                    <td><?= htmlspecialchars($drone['AutonomyMin']) ?> min</td>
                                    <td>
                                        <span class="status-badge status-<?= strtolower(htmlspecialchars($drone['Status'])) ?>">
                                            <?= htmlspecialchars($drone['Status']) ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($drone['LastCheckDate']) ?></td>
                                    <td>
                                        <button title="Editează" style="border:none; background:none; cursor:pointer; color:#3498db;"><i class="fas fa-edit"></i></button>
                                        <button title="Mentenanță" style="border:none; background:none; cursor:pointer; color:#f39c12;"><i class="fas fa-tools"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align:center; padding: 20px;">Nu există drone înregistrate în baza de date.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</body>
</html>