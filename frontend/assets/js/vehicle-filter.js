// Sample vehicle data
const vehicles = [
  {
    id: 1,
    name: 'Toyota Camry 2024',
    type: 'sedan',
    price: 65,
    features: ['gps', 'bluetooth', 'hybrid'],
    available: true,
    images: [
      'assets/img/vehicles/camry-1.jpg',
      'assets/img/vehicles/camry-2.jpg',
      'assets/img/vehicles/camry-3.jpg',
      'assets/img/vehicles/camry-4.jpg'
    ],
    description: 'A comfortable, fuel-efficient sedan perfect for city and highway driving.'
  },
  {
    id: 2,
    name: 'Ford Explorer 2023',
    type: 'suv',
    price: 90,
    features: ['gps', 'awd', 'bluetooth'],
    available: false,
    images: [
      'assets/img/vehicles/explorer-1.jpg',
      'assets/img/vehicles/explorer-2.jpg',
      'assets/img/vehicles/explorer-3.jpg',
      'assets/img/vehicles/explorer-4.jpg'
    ],
    description: 'Spacious SUV with AWD, perfect for family trips and off-road.'
  },
  {
    id: 3,
    name: 'Mazda MX-5 Miata',
    type: 'convertible',
    price: 120,
    features: ['bluetooth'],
    available: true,
    images: [
      'assets/img/vehicles/miata-1.jpg',
      'assets/img/vehicles/miata-2.jpg',
      'assets/img/vehicles/miata-3.jpg',
      'assets/img/vehicles/miata-4.jpg'
    ],
    description: 'Fun convertible for sunny days and scenic drives.'
  },
  // ...add more vehicles as needed...
];

// Fleet page logic
function renderFleetGrid(data) {
  const grid = document.getElementById('fleetGrid');
  const noResults = document.getElementById('noFleetResults');
  grid.innerHTML = '';
  if (!data.length) {
    noResults.style.display = 'block';
    return;
  } else {
    noResults.style.display = 'none';
  }
  data.forEach(vehicle => {
    const card = document.createElement('div');
    card.className = 'fleet-card';
    card.innerHTML = `
      <div class="fleet-card-img-wrapper">
        <img src="${vehicle.images[0]}" alt="${vehicle.name}" class="fleet-card-img">
        <span class="availability-badge ${vehicle.available ? 'available' : 'unavailable'}">
          ${vehicle.available ? 'Available' : 'Unavailable'}
        </span>
      </div>
      <div class="fleet-card-info">
        <h3>${vehicle.name}</h3>
        <div class="fleet-card-meta">
          <span class="fleet-card-type">${capitalize(vehicle.type)}</span>
          <span class="fleet-card-price">$${vehicle.price}/day</span>
        </div>
        <div class="fleet-card-features">
          ${vehicle.features.map(f => `<span class="feature-tag">${capitalize(f)}</span>`).join(' ')}
        </div>
      </div>
    `;
    card.onclick = () => {
      // Simulate navigation with vehicle id in localStorage
      localStorage.setItem('selectedVehicleId', vehicle.id);
      window.location.href = 'vehicle-details.html';
    };
    grid.appendChild(card);
  });
}

function capitalize(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function filterFleet() {
  const search = document.getElementById('searchInput').value.toLowerCase();
  const type = document.getElementById('typeFilter').value;
  const feature = document.getElementById('featureFilter').value;
  const maxPrice = parseInt(document.getElementById('priceRange').value, 10);
  let filtered = vehicles.filter(v => {
    const matchesType = type === 'all' || v.type === type;
    const matchesFeature = feature === 'all' || v.features.includes(feature);
    const matchesPrice = v.price <= maxPrice;
    const matchesSearch = v.name.toLowerCase().includes(search);
    return matchesType && matchesFeature && matchesPrice && matchesSearch;
  });
  renderFleetGrid(filtered);
}

// Fleet page event listeners
if (document.getElementById('fleetGrid')) {
  renderFleetGrid(vehicles);
  document.getElementById('searchInput').addEventListener('input', filterFleet);
  document.getElementById('typeFilter').addEventListener('change', filterFleet);
  document.getElementById('featureFilter').addEventListener('change', filterFleet);
  document.getElementById('priceRange').addEventListener('input', function() {
    document.getElementById('priceValue').textContent = `$${this.value}`;
    filterFleet();
  });
}

// Vehicle details page logic
if (document.getElementById('vehicle360Viewer')) {
  const id = parseInt(localStorage.getItem('selectedVehicleId'), 10) || 1;
  const vehicle = vehicles.find(v => v.id === id) || vehicles[0];
  // Set details
  document.getElementById('vehicleName').textContent = vehicle.name;
  document.getElementById('vehicleType').textContent = capitalize(vehicle.type);
  document.getElementById('vehiclePrice').textContent = `$${vehicle.price}/day`;
  document.getElementById('vehicleAvailability').textContent = vehicle.available ? 'Available' : 'Unavailable';
  document.getElementById('vehicleAvailability').className = 'vehicle-availability ' + (vehicle.available ? 'available' : 'unavailable');
  document.getElementById('vehicleDescription').textContent = vehicle.description;
  document.getElementById('vehicleFeatures').innerHTML = vehicle.features.map(f => `<li>${capitalize(f)}</li>`).join('');
  // 360° image slider
  let imgIdx = 0;
  const imgEl = document.getElementById('vehicle360Img');
  function updateImg() {
    imgEl.src = vehicle.images[imgIdx];
  }
  document.getElementById('galleryPrev').onclick = function() {
    imgIdx = (imgIdx - 1 + vehicle.images.length) % vehicle.images.length;
    updateImg();
  };
  document.getElementById('galleryNext').onclick = function() {
    imgIdx = (imgIdx + 1) % vehicle.images.length;
    updateImg();
  };
  updateImg();
}