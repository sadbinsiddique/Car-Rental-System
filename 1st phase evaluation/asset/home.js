function CarPrice() {
    const carType = document.getElementById('carType').value;
    const pickup = document.getElementById('pickupLocation').value;
    const carPriceInput = document.getElementById('carPrice');

    const availability = {
      abdullahpur: ['suv', 'sedan'],
      bashundhara: ['suv', 'sedan', 'electric', 'pickup'],
      gulshan: ['suv', 'sedan', 'electric'],
      motijheel: ['sedan', 'electric', 'pickup']
    };

    const prices = {
      suv: 60,
      sedan: 70,
      electric: 80,
      pickup: 90
    };

    if (pickup && !availability[pickup].includes(carType)) {
      alert(`The selected car type is not available in ${pickup.charAt(0).toUpperCase() + pickup.slice(1)}.`);
      document.getElementById('carType').value = '';
      carPriceInput.value = '';
      return;
    }

    carPriceInput.value = prices[carType] || '';
  }

  function prepareBooking() {
    const start = new Date(document.getElementById('startDate').value);
    const end = new Date(document.getElementById('endDate').value);
    const carType = document.getElementById('carType').value;
    const carPrice = document.getElementById('carPrice').value;

    if (!carType || !carPrice) {
      alert("Please select a valid car type and pickup location.");
      return false;
    }

    if (end <= start) {
      alert("End date must be after start date.");
      return false;
    }

    return true;
  }

  function filterCars(category) {
    const cards = document.querySelectorAll('.car-card');
    cards.forEach(card => {
      card.style.display = category === 'all' || card.classList.contains(category) ? 'block' : 'none';
    });
  }