<?php include('../src/models/Database.php'); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="assets/stylesheets/style.css">
</head>
<body>
    <?php include('../src/views/header.php'); ?>

    <main class="main">
        <div class="form">
            <h2 class="title">Crea il tuo account</h2>
            <form action="register.php" method="POST">
                <label for="username">Nome utente</label>
                <input type="text" name="username" id="username" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>

                <label for="firstName">Nome</label>
                <input type="text" name="firstName" id="firstName" required>

                <label for="lastName">Cognome</label>
                <input type="text" name="lastName" id="lastName" required>

                <label for="email">Email</label>
                <input type="email" name="email" id="email" required>

                <button type="submit">Registrati</button>
            </form>

            <p class="registerBtn">Sei già registrato? <a href="login.php">Accedi</a></p> <!-- Link alla registrazione -->
        </div>
    </main>
</body>
</html>
