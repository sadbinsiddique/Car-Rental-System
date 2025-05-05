// --- Booking System Logic ---
const baseRate = 65; // Example base rate per day
const rateCalendarEl = document.getElementById('rateCalendar');
const pickupDateEl = document.getElementById('pickupDate');
const pickupTimeEl = document.getElementById('pickupTime');
const returnDateEl = document.getElementById('returnDate');
const returnTimeEl = document.getElementById('returnTime');
const summaryPickup = document.getElementById('summaryPickup');
const summaryReturn = document.getElementById('summaryReturn');
const summaryDays = document.getElementById('summaryDays');
const summaryRate = document.getElementById('summaryRate');
const summaryTotal = document.getElementById('summaryTotal');
const confirmBtn = document.getElementById('confirmBookingBtn');
const bookingSuccessMsg = document.getElementById('bookingSuccessMsg');

function formatDate(dateStr, timeStr) {
  if (!dateStr || !timeStr) return '-';
  const d = new Date(dateStr + 'T' + timeStr);
  return d.toLocaleString([], { dateStyle: 'medium', timeStyle: 'short' });
}

function getDateDiffDays(start, end) {
  const ms = end - start;
  return Math.ceil(ms / (1000 * 60 * 60 * 24));
}

function renderRateCalendar(start, end) {
  rateCalendarEl.innerHTML = '';
  if (!start || !end || end < start) return;
  let d = new Date(start);
  while (d <= end) {
    const day = d.toLocaleDateString(undefined, { month: 'short', day: 'numeric' });
    // Example: weekends +$10
    let rate = baseRate;
    if (d.getDay() === 0 || d.getDay() === 6) rate += 10;
    const cell = document.createElement('div');
    cell.className = 'rate-calendar-cell';
    cell.innerHTML = `<span>${day}</span><span>$${rate}</span>`;
    rateCalendarEl.appendChild(cell);
    d.setDate(d.getDate() + 1);
  }
}

function updateSummary() {
  const pickupDate = pickupDateEl.value;
  const pickupTime = pickupTimeEl.value;
  const returnDate = returnDateEl.value;
  const returnTime = returnTimeEl.value;
  let valid = true;
  if (!pickupDate || !pickupTime || !returnDate || !returnTime) valid = false;
  const start = new Date(pickupDate + 'T' + pickupTime);
  const end = new Date(returnDate + 'T' + returnTime);
  if (isNaN(start) || isNaN(end) || end <= start) valid = false;
  // Calculate days
  let days = 0;
  let total = 0;
  let rateStr = '-';
  if (valid) {
    days = getDateDiffDays(start, end);
    // Calculate total (weekends +$10)
    let d = new Date(start);
    let rates = [];
    while (d < end) {
      let rate = baseRate;
      if (d.getDay() === 0 || d.getDay() === 6) rate += 10;
      rates.push(rate);
      d.setDate(d.getDate() + 1);
    }
    total = rates.reduce((a, b) => a + b, 0);
    rateStr = `$${baseRate}–$${baseRate + 10}/day`;
    renderRateCalendar(start, new Date(end.getTime() - 24*60*60*1000));
  } else {
    rateCalendarEl.innerHTML = '';
  }
  summaryPickup.textContent = formatDate(pickupDate, pickupTime);
  summaryReturn.textContent = formatDate(returnDate, returnTime);
  summaryDays.textContent = days > 0 ? days : '-';
  summaryRate.textContent = rateStr;
  summaryTotal.textContent = total > 0 ? `$${total}` : '-';
  confirmBtn.disabled = !valid;
}

[pickupDateEl, pickupTimeEl, returnDateEl, returnTimeEl].forEach(el => {
  el.addEventListener('change', updateSummary);
});

confirmBtn.addEventListener('click', function() {
  confirmBtn.disabled = true;
  setTimeout(() => {
    bookingSuccessMsg.style.display = 'block';
    confirmBtn.style.display = 'none';
  }, 800);
});

// Set min dates (today)
const today = new Date();
const yyyy = today.getFullYear();
const mm = String(today.getMonth() + 1).padStart(2, '0');
const dd = String(today.getDate()).padStart(2, '0');
const minDate = `${yyyy}-${mm}-${dd}`;
pickupDateEl.min = minDate;
returnDateEl.min = minDate;

// Set default times
pickupTimeEl.value = '10:00';
returnTimeEl.value = '10:00';

// Initial summary
updateSummary();