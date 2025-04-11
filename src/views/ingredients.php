<h1>Ingredienti</h1>
<div class="ingredients">
  <?php if ($data): ?>
  <?php foreach ($data as $ingredient): ?>
    <div class="ingredient">
      <h2 class="title"><?= htmlspecialchars($ingredient['name']) ?></h2>
    </div>
  <?php endforeach; ?>
  <?php else: ?>
    <div class="ingredient">
      <h2 class="title">Nessun ingrediente</h2>
      <p class="description">Al momento non ci sono ingredienti disponibili</p>
    </div>
  <?php endif; ?>
</div>