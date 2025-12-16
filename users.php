<?php
require 'auth.php';
require 'db.php';

// Preluăm toți utilizatorii
$stmt = $pdo->query("SELECT UserID, Username, Email, Role, FullName FROM Users ORDER BY UserID ASC");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>DroneFleet Manager - Utilizatori</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .data-table { width: 100%; border-collapse: collapse; margin-top: 20px; background: white; }
        .data-table th, .data-table td { padding: 12px; border-bottom: 1px solid #ddd; text-align: left; }
        .data-table th { background-color: #f8f9fa; color: #2c3e50; }
        .role-badge { padding: 4px 8px; border-radius: 4px; font-size: 0.85em; font-weight: bold; text-transform: uppercase; }
        .role-admin { background-color: #e3f2fd; color: #1565c0; }
        .role-operator { background-color: #f3e5f5; color: #7b1fa2; }
    </style>
</head>
<body class="dashboard-layout">
    
    <div class="top-bar-dashboard">
        <div class="logo"><a href="home.php"><img src="logo1.png" alt="Logo"></a></div>
        <nav>
            <ul class="dashboard-nav-links">
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li class="active"><a href="users.php"><i class="fas fa-users"></i> Utilizatori</a></li>
                <li><a href="drones.php"><i class="fas fa-plane"></i> Drone</a></li>
                <li><a href="missions.php"><i class="fas fa-route"></i> Misiuni</a></li>
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
        <section id="users">
            <header class="dashboard-header"><h1>Gestiunea Utilizatorilor și Operatorilor</h1></header>
            
            <div style="overflow-x: auto;">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nume Complet</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Rol</th>
                            <th>Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['UserID'] ?></td>
                            <td><strong><?= htmlspecialchars($user['FullName']) ?></strong></td>
                            <td><?= htmlspecialchars($user['Username']) ?></td>
                            <td><?= htmlspecialchars($user['Email']) ?></td>
                            <td>
                                <span class="role-badge role-<?= strtolower($user['Role']) ?>">
                                    <?= htmlspecialchars($user['Role']) ?>
                                </span>
                            </td>
                            <td>
                                <button style="border:none; background:none; cursor:pointer; color:#e74c3c;" title="Șterge"><i class="fas fa-trash-alt"></i></button>
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