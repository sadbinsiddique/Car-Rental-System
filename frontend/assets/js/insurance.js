// ...existing code...
// Highlight selected tier
const table = document.getElementById('insuranceTable');
const rows = table.querySelectorAll('.insurance-row');
const radios = table.querySelectorAll('input[type="radio"][name="insuranceTier"]');
radios.forEach(radio => {
  radio.addEventListener('change', function() {
    rows.forEach(row => row.classList.remove('selected'));
    const row = radio.closest('.insurance-row');
    if (radio.checked) row.classList.add('selected');
  });
});

// Show extra details on hover/click
const detailsPopup = document.getElementById('insuranceDetails');
table.querySelectorAll('.claim-example').forEach(cell => {
  // Show on hover
  cell.addEventListener('mouseenter', function(e) {
    detailsPopup.textContent = cell.getAttribute('data-details');
    detailsPopup.style.display = 'block';
    const rect = cell.getBoundingClientRect();
    detailsPopup.style.top = (window.scrollY + rect.bottom + 5) + 'px';
    detailsPopup.style.left = (window.scrollX + rect.left) + 'px';
  });
  cell.addEventListener('mouseleave', function() {
    detailsPopup.style.display = 'none';
  });
  // Show on click (for mobile)
  cell.addEventListener('click', function(e) {
    detailsPopup.textContent = cell.getAttribute('data-details');
    detailsPopup.style.display = 'block';
    const rect = cell.getBoundingClientRect();
    detailsPopup.style.top = (window.scrollY + rect.bottom + 5) + 'px';
    detailsPopup.style.left = (window.scrollX + rect.left) + 'px';
    setTimeout(() => { detailsPopup.style.display = 'none'; }, 2500);
  });
});
// ...existing code...