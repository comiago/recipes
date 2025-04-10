<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="assets/stylesheets/style.css">
</head>
<body>
  <?php include '../src/views/header.php'; ?>
  <main class="main">
    <div class="form">
      <h2 class="title">Accedi al tuo account</h2>
      
      <!-- Mostra errore se presente -->
      <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
          <i class="fas fa-exclamation-circle"></i>
          <?php echo $_SESSION['error']; ?>
        </div>
        <?php unset($_SESSION['error']); ?>
      <?php endif; ?>

      <!-- Mostra successo se presente -->
      <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message">
          <i class="fas fa-check-circle"></i>
          <?php echo $_SESSION['success']; ?>
        </div>
        <?php unset($_SESSION['success']); ?>
      <?php endif; ?>

      <form action="../src/controllers/loginController.php" method="POST">
        <label for="username">Nome utente</label>
        <input type="text" name="username" id="username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Accedi</button>
      </form>
      <p class="registerBtn">Non hai un account? <a href="register.php">Registrati qui</a></p>
    </div>
  </main>
</body>
</html>
