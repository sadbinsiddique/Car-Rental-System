// Sample activity data
const activities = [
  {
    date: '2025-05-01',
    type: 'booking',
    description: 'Booked Toyota Camry',
    status: 'Completed'
  },
  {
    date: '2025-05-03',
    type: 'return',
    description: 'Returned Honda Civic',
    status: 'Completed'
  },
  {
    date: '2025-05-04',
    type: 'payment',
    description: 'Payment for Booking #1234',
    status: 'Pending'
  },
  {
    date: '2025-05-05',
    type: 'damage',
    description: 'Reported scratch on Ford Focus',
    status: 'Under Review'
  },
  // ...add more sample data as needed...
];

let filteredActivities = [...activities];
let currentSort = { key: 'date', asc: false };

const activityLogBody = document.getElementById('activityLogBody');
const searchInput = document.getElementById('searchInput');
const activityTypeFilter = document.getElementById('activityTypeFilter');
const noResults = document.getElementById('noResults');

// Add date filtering and CSV export
const dateFrom = document.getElementById('dateFrom');
const dateTo = document.getElementById('dateTo');
const exportCsvBtn = document.getElementById('exportCsvBtn');

function renderActivities(data) {
  activityLogBody.innerHTML = '';
  if (data.length === 0) {
    noResults.style.display = 'block';
    return;
  } else {
    noResults.style.display = 'none';
  }
  data.forEach(act => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${act.date}</td>
      <td>${capitalize(act.type)}</td>
      <td>${act.description}</td>
      <td>${act.status}</td>
    `;
    activityLogBody.appendChild(tr);
  });
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function filterActivities() {
  const search = searchInput.value.toLowerCase();
  const type = activityTypeFilter.value;
  const from = dateFrom.value;
  const to = dateTo.value;
  filteredActivities = activities.filter(act => {
    const matchesType = type === 'all' || act.type === type;
    const matchesSearch =
      act.description.toLowerCase().includes(search) ||
      act.status.toLowerCase().includes(search) ||
      act.type.toLowerCase().includes(search);
    let matchesDate = true;
    if (from) matchesDate = matchesDate && act.date >= from;
    if (to) matchesDate = matchesDate && act.date <= to;
    return matchesType && matchesSearch && matchesDate;
  });
  sortActivities(currentSort.key, currentSort.asc, false);
}

dateFrom.addEventListener('change', filterActivities);
dateTo.addEventListener('change', filterActivities);

function sortActivities(key, asc, rerender = true) {
  filteredActivities.sort((a, b) => {
    if (a[key] < b[key]) return asc ? -1 : 1;
    if (a[key] > b[key]) return asc ? 1 : -1;
    return 0;
  });
  if (rerender) renderActivities(filteredActivities);
}

searchInput.addEventListener('input', filterActivities);
activityTypeFilter.addEventListener('change', filterActivities);

document.querySelectorAll('.activity-log-table th').forEach(th => {
  th.addEventListener('click', () => {
    const key = th.getAttribute('data-sort');
    if (currentSort.key === key) {
      currentSort.asc = !currentSort.asc;
    } else {
      currentSort.key = key;
      currentSort.asc = true;
    }
    sortActivities(currentSort.key, currentSort.asc);
  });
});

// CSV Export
function exportToCsv() {
  if (!filteredActivities.length) return;
  const headers = ['Date', 'Type', 'Description', 'Status'];
  const rows = filteredActivities.map(act => [act.date, capitalize(act.type), act.description, act.status]);
  let csv = headers.join(',') + '\n';
  rows.forEach(row => {
    csv += row.map(val => '"' + String(val).replace(/"/g, '""') + '"').join(',') + '\n';
  });
  const blob = new Blob([csv], { type: 'text/csv' });
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url;
  a.download = 'activity-log.csv';
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  URL.revokeObjectURL(url);
}
exportCsvBtn.addEventListener('click', exportToCsv);

// Initial render
renderActivities(filteredActivities);