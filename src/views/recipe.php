<?php
include_once('../models/Database.php');
include_once('../models/Recipe.php');
include_once('../models/User.php');

$db = new Database();
$pdo = $db->connect();
$recipeModel = new Recipe($pdo);
$userModel = new User($pdo);
$recipe = $recipeModel->getRecipeById($_GET['id']);
$ingredients = $recipeModel->getIngredientsByRecipe($_GET['id']);
$steps = $recipeModel->getStepsByRecipe($_GET['id']);
$user = $userModel->getUserById($recipe['createdBy']);
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Progetto Robotics Majorana</title>
  <link rel="stylesheet" href="../../public/assets/stylesheets/style.css">
</head>
<body>
  <?php include('header.php'); ?>
  <main class="main">
    <div class="recipe-detail">
      <h1 class="recipe-title"><?= htmlspecialchars($recipe['title']) ?></h1>
      <p class="recipe-description"><?= nl2br(htmlspecialchars($recipe['description'])) ?></p>
    
      <div class="info">
        <h2>Ingredienti</h2>
        <div class="amount">
          <p>Quantità: <?= htmlspecialchars($recipe['amount']) ?></p>
          <button><i class="fa-solid fa-plus"></i></button>
          <button><i class="fa-solid fa-minus"></i></button>
        </div>
      </div>
      <?php if ($ingredients): ?>
        <table class="ingredients-table">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Quantità</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($ingredients as $ingredient): ?>
              <tr>
                <td><?= htmlspecialchars($ingredient['name']) ?></td>
                <td><?= htmlspecialchars($ingredient['amount']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <div class="no-ingredients">
          <p>Non ci sono ingredienti disponibili per questa ricetta.</p>
        </div>
      <?php endif; ?>

      <div class="recipe-steps">
        <h2>Procedimento</h2>
        <?php if ($steps): ?>
          <ol>
            <?php foreach ($steps as $step): ?>
              <li><?= htmlspecialchars($step['description']) ?></li>
            <?php endforeach; ?>
          </ol>
        <?php else: ?>
          <p>Nessun passo disponibile per questa ricetta.</p>
        <?php endif; ?>
      </div>
      <!-- Meta informazioni ricetta -->
    <div class="recipe-meta">
        <p><strong>Creato da:</strong> <?= htmlspecialchars($user['firstName']) ?> <?= htmlspecialchars($user['lastName']) ?></p>
        <p><strong>Data creazione:</strong> <?= date('d/m/Y', strtotime($recipe['createdAt'])) ?></p>
    </div>
    </div>
  </main> 

  <script src="../../public/assets/scripts/recipe.js"></script>
</body>
</html>