// Sample branch data
const branches = [
  {
    name: 'Downtown LA Branch',
    city: 'Los Angeles',
    airport: 'LAX',
    address: '123 Main St, Los Angeles, CA',
    mapImg: 'assets/img/maps/la-branch.png',
    hours: 'Mon-Sun: 7am - 10pm',
    afterHours: 'After-hours drop-off available. Use key drop box at entrance.',
    amenities: ['Car Wash', 'Lounge', 'EV Charging']
  },
  {
    name: 'JFK Airport Branch',
    city: 'New York',
    airport: 'JFK',
    address: 'Terminal 4, JFK Airport, NY',
    mapImg: 'assets/img/maps/jfk-branch.png',
    hours: 'Mon-Sun: 6am - 11pm',
    afterHours: 'No after-hours service. Please return during business hours.',
    amenities: ['Lounge', 'Snacks']
  },
  {
    name: 'Chicago O’Hare Branch',
    city: 'Chicago',
    airport: 'ORD',
    address: '456 Airport Rd, Chicago, IL',
    mapImg: 'assets/img/maps/ord-branch.png',
    hours: 'Mon-Sun: 8am - 8pm',
    afterHours: 'After-hours pickup available by appointment only.',
    amenities: ['Car Wash', 'Lounge']
  }
  // ...add more branches as needed...
];

function renderBranches(data) {
  const list = document.getElementById('branchList');
  list.innerHTML = '';
  if (!data.length) {
    list.innerHTML = '<div class="no-results">No branches found.</div>';
    return;
  }
  data.forEach((branch, idx) => {
    const card = document.createElement('div');
    card.className = 'branch-card';
    card.innerHTML = `
      <div class="branch-map-preview" data-idx="${idx}">
        <img src="${branch.mapImg}" alt="${branch.name} Map" class="branch-map-img">
        <button class="open-map-btn" data-idx="${idx}">View Map</button>
      </div>
      <div class="branch-info">
        <h3>${branch.name}</h3>
        <p><strong>City:</strong> ${branch.city} &nbsp; <strong>Airport:</strong> ${branch.airport}</p>
        <p><strong>Address:</strong> ${branch.address}</p>
        <p><strong>Hours:</strong> ${branch.hours}</p>
        <div class="amenities">
          ${branch.amenities.map(a => `<span class="amenity-tag">${a}</span>`).join(' ')}
        </div>
        <button class="toggle-after-hours-btn" data-idx="${idx}">After-Hours Info</button>
        <div class="after-hours-info" id="afterHours${idx}" style="display:none;">${branch.afterHours}</div>
      </div>
    `;
    list.appendChild(card);
  });
  // Map modal event
  list.querySelectorAll('.open-map-btn').forEach(btn => {
    btn.onclick = function() {
      const idx = btn.getAttribute('data-idx');
      openMapModal(branches[idx]);
    };
  });
  // After-hours toggle
  list.querySelectorAll('.toggle-after-hours-btn').forEach(btn => {
    btn.onclick = function() {
      const idx = btn.getAttribute('data-idx');
      const info = document.getElementById('afterHours' + idx);
      info.style.display = info.style.display === 'none' ? 'block' : 'none';
    };
  });
}

function openMapModal(branch) {
  document.getElementById('modalBranchName').textContent = branch.name;
  document.getElementById('modalMapImg').src = branch.mapImg;
  document.getElementById('modalBranchAddress').textContent = branch.address;
  document.getElementById('mapModal').style.display = 'block';
}

document.getElementById('closeMapModal').onclick = function() {
  document.getElementById('mapModal').style.display = 'none';
};
window.onclick = function(event) {
  const modal = document.getElementById('mapModal');
  if (event.target === modal) modal.style.display = 'none';
};

// Search/filter logic
const searchInput = document.getElementById('branchSearchInput');
searchInput.addEventListener('input', function() {
  const q = searchInput.value.toLowerCase();
  const filtered = branches.filter(b =>
    b.name.toLowerCase().includes(q) ||
    b.city.toLowerCase().includes(q) ||
    b.airport.toLowerCase().includes(q)
  );
  renderBranches(filtered);
});

// Initial render
renderBranches(branches);