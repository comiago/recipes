<?php include('../src/models/Database.php'); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/stylesheets/style.css">
</head>
<body>
    <?php include('../src/views/header.php'); ?>

    <main class="main">
        <div class="form">
            <h2 class="title">Accedi al tuo account</h2>
            <form action="login.php" method="POST">
                <label for="username">Nome utente</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Accedi</button>
            </form>

            <p class="registerBtn">Non hai un account? <a href="register.php">Registrati qui</a></p> <!-- Link alla registrazione -->
        </div>
    </main>
</body>
</html>
