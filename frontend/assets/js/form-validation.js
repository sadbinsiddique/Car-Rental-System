// Utility: Email regex
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// Password visibility toggle
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

document.addEventListener('DOMContentLoaded', () => {
  setupPasswordToggles();

  // Login form validation
  const loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', function (e) {
      e.preventDefault();
      let valid = true;
      const email = loginForm.email.value.trim();
      const password = loginForm.password.value;
      // Email
      if (!emailRegex.test(email)) {
        valid = false;
        document.getElementById('loginEmailError').textContent = 'Enter a valid email.';
      } else {
        document.getElementById('loginEmailError').textContent = '';
      }
      // Password
      if (!password) {
        valid = false;
        document.getElementById('loginPasswordError').textContent = 'Password is required.';
      } else {
        document.getElementById('loginPasswordError').textContent = '';
      }
      if (valid) {
        // Simulate login (replace with real logic)
        document.getElementById('loginGeneralError').textContent = '';
        loginForm.querySelector('button[type="submit"]').disabled = true;
        setTimeout(() => {
          loginForm.querySelector('button[type="submit"]').disabled = false;
          // Simulate error
          document.getElementById('loginGeneralError').textContent = 'Invalid credentials.';
        }, 1000);
      }
    });
    // Forgot password modal
    const forgotLink = document.getElementById('forgotPasswordLink');
    const forgotModal = document.getElementById('forgotPasswordModal');
    const closeForgot = document.getElementById('closeForgotModal');
    forgotLink.onclick = e => {
      e.preventDefault();
      forgotModal.style.display = 'block';
    };
    closeForgot.onclick = () => {
      forgotModal.style.display = 'none';
      document.getElementById('forgotSuccessMsg').style.display = 'none';
      document.getElementById('forgotPasswordForm').style.display = 'block';
      document.getElementById('forgotEmailError').textContent = '';
    };
    window.onclick = function(event) {
      if (event.target === forgotModal) closeForgot.onclick();
    };
    // Forgot password form
    const forgotForm = document.getElementById('forgotPasswordForm');
    forgotForm.addEventListener('submit', function(e) {
      e.preventDefault();
      const email = forgotForm.email.value.trim();
      if (!emailRegex.test(email)) {
        document.getElementById('forgotEmailError').textContent = 'Enter a valid email.';
        return;
      }
      document.getElementById('forgotEmailError').textContent = '';
      forgotForm.style.display = 'none';
      document.getElementById('forgotSuccessMsg').style.display = 'block';
    });
  }

  // Signup form validation
  const signupForm = document.getElementById('signupForm');
  if (signupForm) {
    signupForm.addEventListener('submit', function (e) {
      e.preventDefault();
      let valid = true;
      const email = signupForm.email.value.trim();
      const name = signupForm.name.value.trim();
      const password = signupForm.password.value;
      const confirmPassword = signupForm.confirmPassword.value;
      // Email
      if (!emailRegex.test(email)) {
        valid = false;
        document.getElementById('signupEmailError').textContent = 'Enter a valid email.';
      } else {
        document.getElementById('signupEmailError').textContent = '';
      }
      // Name
      if (!name) {
        valid = false;
        document.getElementById('signupNameError').textContent = 'Name is required.';
      } else {
        document.getElementById('signupNameError').textContent = '';
      }
      // Password
      if (password.length < 6) {
        valid = false;
        document.getElementById('signupPasswordError').textContent = 'Password must be at least 6 characters.';
      } else {
        document.getElementById('signupPasswordError').textContent = '';
      }
      // Confirm Password
      if (password !== confirmPassword) {
        valid = false;
        document.getElementById('signupConfirmPasswordError').textContent = 'Passwords do not match.';
      } else {
        document.getElementById('signupConfirmPasswordError').textContent = '';
      }
      if (valid) {
        // Simulate signup (replace with real logic)
        document.getElementById('signupGeneralError').textContent = '';
        signupForm.querySelector('button[type="submit"]').disabled = true;
        setTimeout(() => {
          signupForm.querySelector('button[type="submit"]').disabled = false;
          signupForm.style.display = 'none';
          document.getElementById('signupVerifyMsg').style.display = 'block';
        }, 1000);
      }
    });
  }
});