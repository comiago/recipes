<h1>Le mie Ricette</h1>

<?php if (!empty($data)): ?>
  <ul>
    <?php foreach ($data as $ricetta): ?>
      <li>
        <h3><?= htmlspecialchars($ricetta['title']) ?></h3>
        <p><?= nl2br(htmlspecialchars($ricetta['description'])) ?></p>
        
        <!-- Link per modificare la ricetta -->
        <a href="edit_recipe.php?id=<?= htmlspecialchars($ricetta['id']) ?>" class="btn-edit">Modifica</a>
        
        <!-- Link per eliminare la ricetta -->
        <a href="delete_recipe.php?id=<?= htmlspecialchars($ricetta['id']) ?>" class="btn-delete" 
           onclick="return confirm('Sei sicuro di voler eliminare questa ricetta?');">Elimina</a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php else: ?>
  <p>Nessuna ricetta trovata.</p>
<?php endif; ?>
