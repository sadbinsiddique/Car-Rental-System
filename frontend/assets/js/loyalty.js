// --- Loyalty & Rewards System ---
const userPoints = 1850;
const tiers = [
  { name: 'Silver', min: 0, benefits: ['5% discount on rentals', 'Birthday bonus'] },
  { name: 'Gold', min: 2000, benefits: ['10% discount', 'Priority support', 'Free upgrade (1/year)'] },
  { name: 'Platinum', min: 5000, benefits: ['15% discount', 'Unlimited upgrades', 'VIP lounge access'] }
];
const rewards = [
  { id: 1, name: 'Free Car Wash', cost: 500, desc: 'Redeem for a complimentary car wash.' },
  { id: 2, name: 'Rental Day Discount', cost: 1200, desc: 'Get $20 off your next rental.' },
  { id: 3, name: 'Gift Card', cost: 2500, desc: '$50 gift card for fuel or accessories.' }
];

// Animate points tracker
function animatePoints(target) {
  const el = document.getElementById('pointsValue');
  let current = 0;
  const step = Math.ceil(target / 40);
  function tick() {
    current += step;
    if (current > target) current = target;
    el.textContent = current;
    if (current < target) requestAnimationFrame(tick);
  }
  tick();
}

// Set tier and benefits
function setTier(points) {
  let tier = tiers[0];
  for (let i = tiers.length - 1; i >= 0; i--) {
    if (points >= tiers[i].min) {
      tier = tiers[i];
      break;
    }
  }
  document.getElementById('tierName').textContent = tier.name;
  const list = document.getElementById('tierBenefitsList');
  list.innerHTML = tier.benefits.map(b => `<li>${b}</li>`).join('');
}

// Render rewards catalog
function renderRewards(points) {
  const catalog = document.getElementById('rewardsCatalog');
  catalog.innerHTML = '';
  rewards.forEach(r => {
    const card = document.createElement('div');
    card.className = 'reward-card';
    card.innerHTML = `
      <h4>${r.name}</h4>
      <p>${r.desc}</p>
      <div class="reward-cost">${r.cost} pts</div>
      <button class="btn-secondary redeem-btn" data-id="${r.id}" ${points < r.cost ? 'disabled' : ''}>Redeem</button>
    `;
    catalog.appendChild(card);
  });
}

// Redeem modal logic
let selectedReward = null;
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('redeem-btn')) {
    const id = +e.target.getAttribute('data-id');
    selectedReward = rewards.find(r => r.id === id);
    document.getElementById('redeemRewardInfo').innerHTML = `<strong>${selectedReward.name}</strong><br>${selectedReward.desc}<br>Cost: ${selectedReward.cost} pts`;
    document.getElementById('redeemConfirmModal').style.display = 'block';
  }
});
document.getElementById('closeRedeemModal').onclick = function() {
  document.getElementById('redeemConfirmModal').style.display = 'none';
};
document.getElementById('confirmRedeemBtn').onclick = function() {
  document.getElementById('redeemConfirmModal').style.display = 'none';
  document.getElementById('redeemSuccessMsg').style.display = 'block';
  setTimeout(() => {
    document.getElementById('redeemSuccessMsg').style.display = 'none';
    // Optionally, update points and re-render
    // location.reload();
  }, 1800);
};
window.onclick = function(event) {
  const modal = document.getElementById('redeemConfirmModal');
  if (event.target === modal) modal.style.display = 'none';
};

// Init
animatePoints(userPoints);
setTier(userPoints);
renderRewards(userPoints);