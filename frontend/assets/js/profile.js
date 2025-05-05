// Avatar preview and crop (center square)
function handleAvatarInput(input, previewImg) {
  input.addEventListener('change', function () {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function (e) {
      const img = new window.Image();
      img.onload = function () {
        // Crop to center square
        const size = Math.min(img.width, img.height);
        const sx = (img.width - size) / 2;
        const sy = (img.height - size) / 2;
        const canvas = document.createElement('canvas');
        canvas.width = canvas.height = 200;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, sx, sy, size, size, 0, 0, 200, 200);
        previewImg.src = canvas.toDataURL('image/png');
      };
      img.src = e.target.result;
    };
    reader.readAsDataURL(file);
  });
}

function setupProfileAvatarCrop() {
  const avatarInput = document.getElementById('avatarInput');
  const avatarPreview = document.getElementById('avatarPreview');
  if (avatarInput && avatarPreview) {
    handleAvatarInput(avatarInput, avatarPreview);
  }
}

// Password visibility toggle (reuse from form-validation.js if needed)
function setupPasswordToggles() {
  document.querySelectorAll('.toggle-password').forEach(btn => {
    btn.onclick = function () {
      const input = btn.previousElementSibling;
      if (input.type === 'password') {
        input.type = 'text';
        btn.classList.add('visible');
      } else {
        input.type = 'password';
        btn.classList.remove('visible');
      }
    };
  });
}

// Edit profile form validation
function setupEditProfileValidation() {
  const form = document.getElementById('editProfileForm');
  if (!form) return;
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    let valid = true;
    const name = form.name.value.trim();
    const phone = form.phone.value.trim();
    // Name
    if (!name) {
      valid = false;
      document.getElementById('editNameError').textContent = 'Name is required.';
    } else {
      document.getElementById('editNameError').textContent = '';
    }
    // Phone (basic check)
    if (!/^([0-9\-\+\s\(\)]{7,})$/.test(phone)) {
      valid = false;
      document.getElementById('editPhoneError').textContent = 'Enter a valid phone number.';
    } else {
      document.getElementById('editPhoneError').textContent = '';
    }
    // Avatar (optional, but check file type if present)
    const avatarInput = document.getElementById('avatarInput');
    if (avatarInput && avatarInput.files.length > 0) {
      const file = avatarInput.files[0];
      if (!file.type.startsWith('image/')) {
        valid = false;
        document.getElementById('avatarError').textContent = 'Please select a valid image file.';
      } else {
        document.getElementById('avatarError').textContent = '';
      }
    } else {
      document.getElementById('avatarError').textContent = '';
    }
    if (valid) {
      form.querySelector('button[type="submit"]').disabled = true;
      setTimeout(() => {
        form.querySelector('button[type="submit"]').disabled = false;
        // Simulate save
        window.location.href = 'profile.html';
      }, 1000);
    }
  });
}

// Change password form validation
function setupChangePasswordValidation() {
  const form = document.getElementById('changePasswordForm');
  if (!form) return;
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    let valid = true;
    const current = form.currentPassword.value;
    const next = form.newPassword.value;
    const confirm = form.confirmNewPassword.value;
    // Current password
    if (!current) {
      valid = false;
      document.getElementById('currentPasswordError').textContent = 'Current password required.';
    } else {
      document.getElementById('currentPasswordError').textContent = '';
    }
    // New password
    if (next.length < 6) {
      valid = false;
      document.getElementById('newPasswordError').textContent = 'At least 6 characters.';
    } else {
      document.getElementById('newPasswordError').textContent = '';
    }
    // Confirm
    if (next !== confirm) {
      valid = false;
      document.getElementById('confirmNewPasswordError').textContent = 'Passwords do not match.';
    } else {
      document.getElementById('confirmNewPasswordError').textContent = '';
    }
    if (valid) {
      form.querySelector('button[type="submit"]').disabled = true;
      setTimeout(() => {
        form.querySelector('button[type="submit"]').disabled = false;
        // Simulate password change
        alert('Password changed!');
        form.reset();
      }, 1000);
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  setupProfileAvatarCrop();
  setupPasswordToggles();
  setupEditProfileValidation();
  setupChangePasswordValidation();
});