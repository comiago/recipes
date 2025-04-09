<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
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

    <main class="main">
        <p>Benvenuto nella tua dashboard.</p>
    </main>
</body>
</html>
