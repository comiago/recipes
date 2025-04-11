<h1>Le mie Ricette</h1>
<div class="myRecipes">
  <?php if ($data): ?>
  <?php foreach ($data as $recipe): ?>
    <div class="ricetta">
      <h2 class="title"><?= htmlspecialchars($recipe['title']) ?></h2>
      <div class="commands">
        <a href="dashboard.php?page=editRecipe&recipe=<?= htmlspecialchars($recipe['idRecipe'])?>"><i class="fa-solid fa-pencil"></i> Edit</a>
        <a href="../src/views/deleteRecipe.php?id=<?= htmlspecialchars($recipe['idRecipe'])?>"><i class="fa-solid fa-trash"></i> Delete</a>
      </div>
    </div>
  <?php endforeach; ?>
  <?php else: ?>
    <div class="ricetta none">
      <h2 class="title">Nessuna ricetta</h2>
      <p class="description">Al momento non ci sono ricette disponibili</p>
    </div>
  <?php endif; ?>
</div>