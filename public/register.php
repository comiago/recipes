<?php 
  session_start();

  include_once('../src/models/Database.php');
  include_once('../src/models/Role.php');

  $db = new Database();
  $pdo = $db->connect();
  $roleModel = new Role($pdo);
  $roles = $roleModel->getAllRoles();
?>

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
      
      <form action="../src/controllers/registerController.php" method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>

        <label for="firstName">Nome</label>
        <input type="text" name="firstName" id="firstName" required>

        <label for="lastName">Cognome</label>
        <input type="text" name="lastName" id="lastName" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" required>

        <label for="confirm_password">Conferma Password</label>
        <input type="password" name="confirm_password" id="confirm_password" required>

        <label for="role">Ruolo</label>
        <select name="role" id="role" required>
          <option value="" selected>--Ruolo</option>
          <?php if ($roles): ?>
          <?php foreach ($roles as $role): ?>
            <option value="<?= htmlspecialchars($role['idRole']) ?>"><?= htmlspecialchars($role['name']) ?></option>
          <?php endforeach; ?>
          <?php else: ?>
            <option value="">No roles available</option>
          <?php endif; ?>
        </select>

        <button type="submit">Registrati</button>
      </form>

      <p class="registerBtn">Sei già registrato? <a href="login.php">Accedi</a></p>
    </div>
  </main>
</body>
</html>
