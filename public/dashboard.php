<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once('../src/controllers/DashboardController.php');

$page = $_GET['page'] ?? 'home';
$controller = new DashboardController();
$response = $controller->handle($page);

$view = $response['view'];
$data = $response['data'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="assets/stylesheets/style.css">
</head>
<body>
    <?php include '../src/views/header.php'; ?>
    <div class="dashboard-container">
        <?php include '../src/views/sidebar.php'; ?>

        <main class="content">
        <?php include "../src/views/$view"; ?>
        </main>
    </div>
</body>
</html>
