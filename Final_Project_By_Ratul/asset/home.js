function updatePrice() {
  const carSelect = document.getElementById('carId');
  const selectedOption = carSelect.options[carSelect.selectedIndex];
  const price = selectedOption.getAttribute('data-price');
  document.getElementById('carPrice').value = price;
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


  
