// --- Quote Estimator Logic ---
const carRates = {
  camry: 65,
  explorer: 90,
  miata: 120
};
const feePerDay = 8; // e.g., insurance/cleaning
const promoCodes = {
  'SAVE10': 0.10, // 10% off
  'WEEKEND': 0.15 // 15% off
};

const carSelect = document.getElementById('carSelect');
const startDate = document.getElementById('startDate');
const endDate = document.getElementById('endDate');
const promoCode = document.getElementById('promoCode');
const applyPromoBtn = document.getElementById('applyPromoBtn');
const promoMsg = document.getElementById('promoMsg');

const breakdownBase = document.getElementById('breakdownBase');
const breakdownDays = document.getElementById('breakdownDays');
const breakdownFees = document.getElementById('breakdownFees');
const breakdownDiscount = document.getElementById('breakdownDiscount');
const breakdownTotal = document.getElementById('breakdownTotal');

let appliedPromo = '';

function getDays() {
  if (!startDate.value || !endDate.value) return 0;
  const s = new Date(startDate.value);
  const e = new Date(endDate.value);
  const diff = Math.ceil((e - s) / (1000 * 60 * 60 * 24));
  return diff > 0 ? diff : 0;
}

function animateValue(el, newValue) {
  const oldValue = parseFloat(el.textContent.replace(/[^\d.-]/g, '')) || 0;
  if (oldValue === newValue) {
    el.textContent = `$${newValue}`;
    return;
  }
  const duration = 350;
  const start = performance.now();
  function step(now) {
    const progress = Math.min((now - start) / duration, 1);
    const val = oldValue + (newValue - oldValue) * progress;
    el.textContent = `$${val.toFixed(2)}`;
    if (progress < 1) requestAnimationFrame(step);
  }
  requestAnimationFrame(step);
}

function updateBreakdown() {
  const car = carSelect.value;
  const days = getDays();
  if (!car || days === 0) {
    breakdownBase.textContent = '-';
    breakdownDays.textContent = '-';
    breakdownFees.textContent = '-';
    breakdownDiscount.textContent = '-';
    breakdownTotal.textContent = '-';
    return;
  }
  const base = carRates[car] * days;
  const fees = feePerDay * days;
  let discount = 0;
  let promoText = '';
  if (appliedPromo && promoCodes[appliedPromo]) {
    discount = (base + fees) * promoCodes[appliedPromo];
    promoText = `-${(promoCodes[appliedPromo]*100).toFixed(0)}%`;
  }
  const total = base + fees - discount;
  animateValue(breakdownBase, carRates[car]);
  breakdownDays.textContent = days;
  animateValue(breakdownFees, fees);
  breakdownDiscount.textContent = discount > 0 ? `- $${discount.toFixed(2)} (${promoText})` : '-';
  animateValue(breakdownTotal, total);
}

[carSelect, startDate, endDate].forEach(el => {
  el.addEventListener('change', () => {
    appliedPromo = '';
    promoMsg.textContent = '';
    updateBreakdown();
  });
});

applyPromoBtn.addEventListener('click', function() {
  const code = promoCode.value.trim().toUpperCase();
  if (promoCodes[code]) {
    appliedPromo = code;
    promoMsg.textContent = `Promo applied: ${code}`;
    promoMsg.style.color = '#28a745';
  } else {
    appliedPromo = '';
    promoMsg.textContent = 'Invalid promo code.';
    promoMsg.style.color = '#dc3545';
  }
  updateBreakdown();
});

// Set min date to today
const today = new Date();
const yyyy = today.getFullYear();
const mm = String(today.getMonth() + 1).padStart(2, '0');
const dd = String(today.getDate()).padStart(2, '0');
const minDate = `${yyyy}-${mm}-${dd}`;
startDate.min = minDate;
endDate.min = minDate;

updateBreakdown();