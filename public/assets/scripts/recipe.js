document.addEventListener('DOMContentLoaded', () => {
  const plusBtn = document.querySelector('.amount button:first-of-type');
  const minusBtn = document.querySelector('.amount button:last-of-type');
  const amountText = document.querySelector('.amount p');

  // Prende la dose iniziale dal testo
  let initialAmount = parseInt(amountText.textContent.match(/\d+/)?.[0] || 1);
  let currentAmount = initialAmount;

  // Salva le quantità originali per calcolare proporzioni
  const rows = document.querySelectorAll('.ingredients-table tbody tr');
  const originalQuantities = [];

  rows.forEach(row => {
    const tds = row.querySelectorAll('td');
    const text = tds[1]?.textContent.trim();
    if (!text) return;

    const [value, ...unitParts] = text.split(' ');
    const unit = unitParts.join(' ');
    const number = parseFloat(value.replace(',', '.'));
    originalQuantities.push({ number, unit });
  });

  function updateQuantities(newAmount) {
    const ratio = newAmount / initialAmount;

    rows.forEach((row, index) => {
      const td = row.querySelectorAll('td')[1];
      const original = originalQuantities[index];
      if (!original) return;

      const newValue = (original.number * ratio).toFixed(2).replace('.', ',');
      td.textContent = `${newValue} ${original.unit}`;
    });

    currentAmount = newAmount;
    amountText.textContent = `Quantità: ${currentAmount}`;
  }

  plusBtn?.addEventListener('click', () => updateQuantities(currentAmount + 1));
  minusBtn?.addEventListener('click', () => {
    if (currentAmount > 1) updateQuantities(currentAmount - 1);
  });
});
