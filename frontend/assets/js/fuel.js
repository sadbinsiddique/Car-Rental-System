// Fuel cost calculator and receipt preview
const fuelPrice = document.getElementById('fuelPrice');
const fuelAmount = document.getElementById('fuelAmount');
const fuelCost = document.getElementById('fuelCost');

function updateFuelCost() {
  const price = parseFloat(fuelPrice.value) || 0;
  const amount = parseFloat(fuelAmount.value) || 0;
  const cost = price * amount;
  fuelCost.textContent = `$${cost.toFixed(2)}`;
}

fuelPrice.addEventListener('input', updateFuelCost);
fuelAmount.addEventListener('input', updateFuelCost);

// Receipt image preview
const fuelReceipt = document.getElementById('fuelReceipt');
const fuelReceiptPreview = document.getElementById('fuelReceiptPreview');
fuelReceipt.addEventListener('change', function () {
  fuelReceiptPreview.innerHTML = '';
  const file = fuelReceipt.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = function (e) {
    fuelReceiptPreview.innerHTML = `<img src="${e.target.result}" alt="Receipt Preview" class="fuel-receipt-img">`;
  };
  reader.readAsDataURL(file);
});

// Optional: Prevent form submission for demo
const fuelForm = document.getElementById('fuelForm');
fuelForm.addEventListener('submit', function(e) {
  e.preventDefault();
  alert('Fuel log saved!');
});