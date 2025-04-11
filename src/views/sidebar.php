<?php
  require_once '../src/models/Database.php';
  require_once '../src/models/Role.php';
  $pdo = new Database();
  $pdo = $pdo->connect();
  $roleModel = new Role($pdo);
  $userRole = $roleModel->getRoleById($_SESSION['role'])['name'];
?>

<nav class="sidebar">
    <h2 class="sidebar-title">Menu</h2>
    <ul>
        <li><a href="dashboard.php?page=home"><i class="fas fa-home"></i> Dashboard</a></li>
        <li><a href="dashboard.php?page=recipes"><i class="fa-solid fa-file-lines"></i> Le mie ricette</a></li>
        <li><a href="dashboard.php?page=newRecipe"><i class="fa-solid fa-plus"></i> Crea nuova</a></li>
        <li><a href="dashboard.php?page=ingredients"><i class="fa-solid fa-file-lines"></i> Ingredienti</a></li>
        <?php if ($userRole == 'Admin'): ?>
            <li><a href="dashboard.php?page=users"><i class="fa-solid fa-users"></i> Utenti</a></li>
        <?php endif; ?>
        <li><a href="dashboard.php?page=settings"><i class="fa-solid fa-gear"></i> Profilo</a></li>
        <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
    </ul>
</nav>