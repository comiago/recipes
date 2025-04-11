<h1>Crea una Nuova Ricetta</h1>

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

<div class="form recipeForm">
<form action="../src/controllers/RecipeController.php?action=create" method="POST">
  <input type="hidden" name="action" value="create">

  <label for="title">Titolo</label>
  <input type="text" name="title" id="title" required>

  <label for="description">Descrizione</label>
  <textarea name="description" id="description" rows="4"></textarea>

  <label for="amount">Unità</label>
  <input type="number" name="amount" id="amount" required>

   <div class="formSection">
    <label>Ingredienti</label>
    <div id="ingredienti" class="ingredienti-group">
      <div class="ingrediente">
        <h2>1:</h2>
        <input type="text" name="ingredients[0][name]" placeholder="Nome ingrediente" required>
        <input type="text" name="ingredients[0][amount]" placeholder="Quantità" required>
      </div>
    </div>
    <button class="btn-add" type="button" onclick="aggiungiIngrediente()">+ Aggiungi ingrediente</button>
  </div>

  <div class="formSection">
    <label>Passaggi</label>
    <div id="passaggi" class="passaggi-group">
      <div class="passaggio">
        <h2>1:</h2>
        <textarea name="steps[1][description]" placeholder="Descrizione passaggio" required></textarea>
      </div>
    </div>
    <button class="btn-add" type="button" onclick="aggiungiPassaggio()">+ Aggiungi passaggio</button>
  </div>

  <button type="submit">Salva Ricetta</button>
</form>
</div>

<script src="../../public/assets/scripts/newRecipe.js"></script>
