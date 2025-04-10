<?php
// Includi il file per la connessione al database
include_once('../src/models/Database.php');
include_once('../src/models/Recipe.php');

$db = new Database();
$pdo = $db->connect();
$recipeModel = new Recipe($pdo);
$recipes = $recipeModel->getAllRecipes();
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Progetto Robotics Majorana</title>
  <link rel="stylesheet" href="assets/stylesheets/style.css">
</head>
<body>
  <?php include('../src/views/header.php'); ?>
  <main class="main">
    <?php if ($recipes): ?>
    <?php foreach ($recipes as $recipe): ?>
      <a href="../src/views/recipe.php?id=<?= htmlspecialchars($recipe['idRecipe']) ?>" class="ricetta">
        <h2 class="title"><?= htmlspecialchars($recipe['title']) ?></h2>
        <p class="description"><?= htmlspecialchars($recipe['description']) ?></p>
      </a>
    <?php endforeach; ?>
    <?php else: ?>
      <div class="ricetta none">
        <h2 class="title">Nessuna ricetta</h2>
        <p class="description">Al momento non ci sono ricette disponibili</p>
      </div>
    <?php endif; ?>
  </main>
</body>
</html>
