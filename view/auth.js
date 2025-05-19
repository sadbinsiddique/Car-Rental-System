// Common JavaScript for authentication pages (login.html and signup.html)

document.addEventListener('DOMContentLoaded', function() {
  // Set current year in footer
  const yearEl = document.getElementById('year');
  if (yearEl) {
    yearEl.textContent = new Date().getFullYear();
  }

  // Mobile menu toggle
  const menuBtn = document.getElementById("menu-btn");
  const navLinks = document.getElementById("nav-links");
  const menuBtnIcon = menuBtn.querySelector("i");

  menuBtn.addEventListener("click", () => {
    navLinks.classList.toggle("open");
    const isOpen = navLinks.classList.contains("open");
    menuBtnIcon.setAttribute("class", isOpen ? "ri-close-line" : "ri-menu-line");
  });

  navLinks.addEventListener("click", () => {
    navLinks.classList.remove("open");
    menuBtnIcon.setAttribute("class", "ri-menu-line");
  });

  // Handle sticky navigation
  const nav = document.querySelector("nav");

  function checkScroll() {
    if (window.scrollY > 100) {
      nav.classList.add("nav--scrolled");
      const logoDark = document.querySelector(".logo-dark");
      const logoWhite = document.querySelector(".logo-white");
      if (logoDark && logoWhite) {
        logoDark.style.display = "flex";
        logoWhite.style.display = "none";
      }
    } else {
      nav.classList.remove("nav--scrolled");
      const logoDark = document.querySelector(".logo-dark");
      const logoWhite = document.querySelector(".logo-white");
      if (logoDark && logoWhite && window.innerWidth <= 768) {
        logoDark.style.display = "none";
        logoWhite.style.display = "flex";
      }
    }
  }

  window.addEventListener("scroll", checkScroll);
  
  // Check scroll position on page load
  window.addEventListener("load", checkScroll);
  
 

  // Password toggle visibility
  const passwordToggles = document.querySelectorAll('.password-toggle');
  
  passwordToggles.forEach(toggle => {
    toggle.addEventListener('click', function() {
      const passwordField = this.previousElementSibling;
      const toggleIcon = this.querySelector('i');
      
      if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.className = 'ri-eye-off-line';
      } else {
        passwordField.type = 'password';
        toggleIcon.className = 'ri-eye-line';
      }
    });
  });

  // Display error or success message if present in URL
  const urlParams = new URLSearchParams(window.location.search);
  
  // For login page
  const registration = urlParams.get('registration');
  if (registration === 'success') {
    const successElement = document.getElementById('success-message');
    if (successElement) {
      successElement.style.display = 'block';
      successElement.textContent = 'Account created successfully! Please log in.';
    }
  }
  
  // For both pages
  const error = urlParams.get('error');
  if (error) {
    const errorElement = document.getElementById('error-message');
    if (errorElement) {
      errorElement.style.display = 'block';
      
      // For login page
      if (document.title.includes('Login')) {
        switch(error) {
          case 'invalid':
            errorElement.textContent = 'Invalid username or password. Please try again.';
            break;
          case 'empty':
            errorElement.textContent = 'Username and password are required.';
            break;
          default:
            errorElement.textContent = 'An error occurred. Please try again.';
        }
      } 
      // For signup page
      else if (document.title.includes('Sign Up')) {
        switch(error) {
          case 'empty_fields':
            errorElement.textContent = 'Please fill in all required fields.';
            break;
          case 'invalid_username':
            errorElement.textContent = 'Username can only contain letters, numbers, and underscores.';
            break;
          case 'password_too_short':
            errorElement.textContent = 'Password must be at least 6 characters long.';
            break;
          case 'invalid_email':
            errorElement.textContent = 'Please enter a valid email address.';
            break;
          case 'registration_failed':
            errorElement.textContent = 'Registration failed. Please try again.';
            break;
          default:
            errorElement.textContent = 'An error occurred. Please try again.';
        }
      }
    }
  }
});
