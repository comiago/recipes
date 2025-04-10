let ingredienteIndex = 2;
let passaggioIndex = 2;

function aggiungiIngrediente() {
  const container = document.getElementById('ingredienti');
  container.insertAdjacentHTML('beforeend', `
    <div class="ingrediente">
      <input type="text" name="ingredients[${ingredienteIndex}][name]" placeholder="Nome ingrediente" required>
      <input type="text" name="ingredients[${ingredienteIndex}][amount]" placeholder="Quantità" required>
    </div>
  `);
  ingredienteIndex++;
}

function aggiungiPassaggio() {
  const container = document.getElementById('passaggi');
  container.insertAdjacentHTML('beforeend', `
    <div class="passaggio">
      <h2>${passaggioIndex}:</h2>
      <textarea name="steps[${passaggioIndex}][description]" placeholder="Descrizione passaggio" required></textarea>
    </div>
  `);
  passaggioIndex++;
}