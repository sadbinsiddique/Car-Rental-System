// ...existing code...
// Pagination Component
function renderPagination({
  containerId,
  currentPage,
  totalPages,
  onPageChange,
  resultsPerPage,
  onResultsPerPageChange,
  resultsPerPageOptions = [10, 20, 50, 100]
}) {
  const container = document.getElementById(containerId);
  if (!container) return;
  let html = '';
  // Results per page dropdown
  html += `<div class="pagination-rpp">
    <label for="rppSelect">Results per page:</label>
    <select id="rppSelect">${resultsPerPageOptions.map(opt => `<option value="${opt}"${opt===resultsPerPage?' selected':''}>${opt}</option>`).join('')}</select>
  </div>`;
  // Page numbers with ellipsis
  html += '<ul class="pagination-list">';
  let start = Math.max(1, currentPage - 2);
  let end = Math.min(totalPages, currentPage + 2);
  if (currentPage <= 3) end = Math.min(5, totalPages);
  if (currentPage >= totalPages - 2) start = Math.max(1, totalPages - 4);
  if (start > 1) html += `<li class="pagination-ellipsis">...</li>`;
  for (let i = start; i <= end; i++) {
    html += `<li class="pagination-page${i===currentPage?' active':''}" data-page="${i}">${i}</li>`;
  }
  if (end < totalPages) html += `<li class="pagination-ellipsis">...</li>`;
  html += '</ul>';
  container.innerHTML = html;
  // Event listeners
  container.querySelectorAll('.pagination-page').forEach(el => {
    el.onclick = () => onPageChange(Number(el.getAttribute('data-page')));
  });
  container.querySelector('#rppSelect').onchange = e => onResultsPerPageChange(Number(e.target.value));
}

// Real-Time Form Validation Utility
function setupRealTimeValidation(formId, config) {
  const form = document.getElementById(formId);
  if (!form) return;
  Object.keys(config).forEach(field => {
    const input = form.querySelector(`[name="${field}"]`);
    const errorEl = form.querySelector(`#${field}Error`);
    if (!input || !errorEl) return;
    input.addEventListener('input', function() {
      const value = input.value.trim();
      let error = '';
      if (config[field].required && !value) {
        error = config[field].requiredMsg || 'Required.';
      } else if (config[field].type === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
        error = 'Enter a valid email.';
      } else if (config[field].type === 'password' && value && value.length < 6) {
        error = 'Password must be at least 6 characters.';
      } else if (config[field].match) {
        const matchInput = form.querySelector(`[name="${config[field].match}"]`);
        if (matchInput && value !== matchInput.value) {
          error = config[field].matchMsg || 'Fields do not match.';
        }
      }
      errorEl.textContent = error;
      input.classList.toggle('invalid', !!error);
    });
  });
  form.addEventListener('submit', function(e) {
    let valid = true;
    Object.keys(config).forEach(field => {
      const input = form.querySelector(`[name="${field}"]`);
      const errorEl = form.querySelector(`#${field}Error`);
      if (!input || !errorEl) return;
      const value = input.value.trim();
      let error = '';
      if (config[field].required && !value) {
        error = config[field].requiredMsg || 'Required.';
      } else if (config[field].type === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
        error = 'Enter a valid email.';
      } else if (config[field].type === 'password' && value && value.length < 6) {
        error = 'Password must be at least 6 characters.';
      } else if (config[field].match) {
        const matchInput = form.querySelector(`[name="${config[field].match}"]`);
        if (matchInput && value !== matchInput.value) {
          error = config[field].matchMsg || 'Fields do not match.';
        }
      }
      errorEl.textContent = error;
      input.classList.toggle('invalid', !!error);
      if (error) valid = false;
    });
    if (!valid) e.preventDefault();
  });
}
// ...existing code...