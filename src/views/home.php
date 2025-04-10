<h1>Benvenuto, <?= htmlspecialchars($_SESSION['username']) ?> 👋</h1>
<p>Questa è la tua dashboard personale. Qui trovi un riepilogo delle tue attività recenti.</p>

<div class="dashboard-widgets">
  <div class="widget">
    <h3>Ricette totali</h3>
    <p><?= $data['ricette'] ?? 0 ?></p>
  </div>
  <div class="widget">
    <h3>Approvate</h3>
    <p><?= $data['approvate'] ?? 0 ?></p>
  </div>
  <div class="widget">
    <h3>Ultime ricette</h3>
    <ul>
      <?php if (!empty($data['ultime'])): ?>
      <?php foreach (array_slice($data['ultime'], 0, 5) as $ricetta): ?>
        <li><?= htmlspecialchars($ricetta) ?></li>
      <?php endforeach; ?>
      <?php else: ?>
        <li>Nessuna ricetta recente.</li>
      <?php endif; ?>
    </ul>
  </div>
</div>
