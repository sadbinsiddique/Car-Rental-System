// License image preview
const licenseImageInput = document.getElementById('licenseImage');
const licenseImagePreview = document.getElementById('licenseImagePreview');
licenseImageInput.addEventListener('change', function () {
  const file = licenseImageInput.files[0];
  if (!file) return;
  const reader = new FileReader();
  reader.onload = function (e) {
    licenseImagePreview.innerHTML = `<img src="${e.target.result}" alt="License Preview" class="license-preview-img">`;
  };
  reader.readAsDataURL(file);
});

// Simulate OCR scan and auto-fill
const scanBtn = document.getElementById('scanLicenseBtn');
scanBtn.addEventListener('click', function () {
  // Simulate delay for OCR
  scanBtn.disabled = true;
  scanBtn.textContent = 'Scanning...';
  setTimeout(() => {
    // Mock data
    document.getElementById('licenseName').value = 'Alex Johnson';
    document.getElementById('licenseDOB').value = '1990-04-15';
    document.getElementById('licenseNumber').value = 'D123-456-7890';
    scanBtn.disabled = false;
    scanBtn.textContent = 'Scan & Auto-Fill';
  }, 1200);
});

// Allow editing after scan (fields are always editable)
// Optionally, you can add validation on submit
const licenseForm = document.getElementById('licenseForm');
licenseForm.addEventListener('submit', function (e) {
  e.preventDefault();
  // Simulate save
  alert('License details saved!');
});