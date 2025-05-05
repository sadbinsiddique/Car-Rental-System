// Contact form validation and CAPTCHA
const contactForm = document.getElementById('contactForm');
const nameEl = document.getElementById('contactName');
const emailEl = document.getElementById('contactEmail');
const subjectEl = document.getElementById('contactSubject');
const messageEl = document.getElementById('contactMessage');
const captchaLabel = document.getElementById('captchaLabel');
const captchaInput = document.getElementById('captchaInput');
const contactSuccessMsg = document.getElementById('contactSuccessMsg');

let captchaAnswer = 0;
function generateCaptcha() {
  const a = Math.floor(Math.random() * 10) + 1;
  const b = Math.floor(Math.random() * 10) + 1;
  captchaAnswer = a + b;
  captchaLabel.textContent = `What is ${a} + ${b}?`;
  captchaInput.value = '';
}

generateCaptcha();

function validateEmail(email) {
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

contactForm.addEventListener('submit', function(e) {
  e.preventDefault();
  let valid = true;
  // Name
  if (!nameEl.value.trim()) {
    valid = false;
    document.getElementById('contactNameError').textContent = 'Name is required.';
  } else {
    document.getElementById('contactNameError').textContent = '';
  }
  // Email
  if (!validateEmail(emailEl.value.trim())) {
    valid = false;
    document.getElementById('contactEmailError').textContent = 'Enter a valid email.';
  } else {
    document.getElementById('contactEmailError').textContent = '';
  }
  // Subject
  if (!subjectEl.value.trim()) {
    valid = false;
    document.getElementById('contactSubjectError').textContent = 'Subject is required.';
  } else {
    document.getElementById('contactSubjectError').textContent = '';
  }
  // Message
  if (!messageEl.value.trim()) {
    valid = false;
    document.getElementById('contactMessageError').textContent = 'Message is required.';
  } else {
    document.getElementById('contactMessageError').textContent = '';
  }
  // CAPTCHA
  if (parseInt(captchaInput.value, 10) !== captchaAnswer) {
    valid = false;
    document.getElementById('captchaError').textContent = 'Incorrect answer.';
    generateCaptcha();
  } else {
    document.getElementById('captchaError').textContent = '';
  }
  if (valid) {
    contactSuccessMsg.style.display = 'block';
    contactForm.reset();
    generateCaptcha();
    setTimeout(() => { contactSuccessMsg.style.display = 'none'; }, 3000);
  }
});