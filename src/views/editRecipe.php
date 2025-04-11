<?php
$pdo = new Database();
$recipeModel = new Recipe($pdo->connect());
$recipe = $recipeModel->getRecipeById($_GET['recipe']);
$ingredients = $recipeModel->getIngredientsByRecipe($recipe['idRecipe']);
$steps = $recipeModel->getStepsByRecipe($recipe['idRecipe']);
?>

<h1>Modifica ricetta</h1>

<!-- Messaggi -->
<?php if (isset($_SESSION['error'])): ?>
  <div class="error-message"><i class="fas fa-exclamation-circle"></i><?= $_SESSION['error']; ?></div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['success'])): ?>
  <div class="success-message"><i class="fas fa-check-circle"></i><?= $_SESSION['success']; ?></div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<div class="form recipeForm">
  <form action="../src/controllers/RecipeController.php?action=update" method="POST">
    <input type="hidden" name="action" value="update">
    <input type="hidden" name="recipe_id" value="<?= htmlspecialchars($recipe['idRecipe']) ?>">

    <label for="title">Titolo</label>
    <input type="text" name="title" id="title" value="<?= htmlspecialchars($recipe['title']) ?>" required>

    <label for="description">Descrizione</label>
    <textarea name="description" id="description" rows="4" required><?= htmlspecialchars($recipe['description']) ?></textarea>

    <label for="amount">Unità</label>
    <input type="number" name="amount" id="amount" value="<?= htmlspecialchars($recipe['amount']) ?>" required>

    <!-- Ingredienti -->
    <div class="formSection">
      <label>Ingredienti</label>
      <div id="ingredienti" class="ingredienti-group">
        <?php if (!empty($ingredients)): ?>
          <?php foreach ($ingredients as $index => $ingredient): ?>
            <div class="ingrediente">
              <h2><?= htmlspecialchars($index) + 1 ?></h2>
              <input type="text" name="ingredients[<?= $index ?>][name]" placeholder="Nome ingrediente" value="<?= htmlspecialchars($ingredient['name']) ?>" required>
              <input type="text" name="ingredients[<?= $index ?>][amount]" placeholder="Quantità" value="<?= htmlspecialchars($ingredient['amount']) ?>" required>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="ingrediente">
            <h2>1</h2>
            <input type="text" name="ingredients[0][name]" placeholder="Nome ingrediente" required>
            <input type="text" name="ingredients[0][amount]" placeholder="Quantità" required>
          </div>
        <?php endif; ?>
      </div>
      <button class="btn-add" type="button" onclick="aggiungiIngrediente()">+ Aggiungi ingrediente</button>
    </div>

    <!-- Passaggi -->
    <div class="formSection">
      <label>Passaggi</label>
      <div id="passaggi" class="passaggi-group">
        <?php if (!empty($steps)): ?>
          <?php foreach ($steps as $index => $step): ?>
            <div class="passaggio">
              <h2><?= htmlspecialchars($index) + 1 ?></h2>
              <textarea name="steps[<?= $index ?>][description]" placeholder="Descrizione passaggio" required><?= htmlspecialchars($step['description']) ?></textarea>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div class="passaggio">
            <h2>1</h2>
            <textarea name="steps[0][description]" placeholder="Descrizione passaggio" required></textarea>
          </div>
        <?php endif; ?>
      </div>
      <button class="btn-add" type="button" onclick="aggiungiPassaggio()">+ Aggiungi passaggio</button>
    </div>

    <button type="submit">Salva Ricetta</button>
  </form>
</div>

<script src="../../public/assets/scripts/newRecipe.js"></script>
