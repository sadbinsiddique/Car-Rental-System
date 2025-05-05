// --- Vehicle Diagram Annotation ---
function setupDiagramAnnotation(canvasId) {
  const canvas = document.getElementById(canvasId);
  const ctx = canvas.getContext('2d');
  // Draw simple car outline (placeholder)
  function drawOutline() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.strokeStyle = '#888';
    ctx.lineWidth = 2;
    if (canvasId === 'diagramTop') {
      ctx.strokeRect(40, 30, 160, 60); // top view rectangle
    } else if (canvasId === 'diagramFront') {
      ctx.strokeRect(60, 20, 120, 40); // front view rectangle
    } else if (canvasId === 'diagramSide') {
      ctx.strokeRect(30, 20, 180, 40); // side view rectangle
    }
  }
  // Store damage marks
  let marks = [];
  function drawMarks() {
    marks.forEach(({x, y}) => {
      ctx.beginPath();
      ctx.arc(x, y, 7, 0, 2 * Math.PI);
      ctx.fillStyle = 'rgba(220, 53, 69, 0.7)';
      ctx.fill();
      ctx.strokeStyle = '#b00';
      ctx.lineWidth = 2;
      ctx.stroke();
    });
  }
  function redraw() {
    drawOutline();
    drawMarks();
  }
  canvas.addEventListener('click', function(e) {
    const rect = canvas.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;
    marks.push({x, y});
    redraw();
  });
  // Expose for form submission
  canvas.getDamageMarks = () => marks;
  // Initial draw
  redraw();
}

['diagramTop', 'diagramFront', 'diagramSide'].forEach(setupDiagramAnnotation);

// --- Damage Photo Upload Preview ---
const damagePhotosInput = document.getElementById('damagePhotos');
const damagePhotoPreview = document.getElementById('damagePhotoPreview');
damagePhotosInput.addEventListener('change', function () {
  damagePhotoPreview.innerHTML = '';
  Array.from(damagePhotosInput.files).forEach(file => {
    const reader = new FileReader();
    reader.onload = function (e) {
      const img = document.createElement('img');
      img.src = e.target.result;
      img.className = 'damage-preview-img';
      damagePhotoPreview.appendChild(img);
    };
    reader.readAsDataURL(file);
  });
});

// --- Timestamp ---
const damageTimestamp = document.getElementById('damageTimestamp');
function updateTimestamp() {
  const now = new Date();
  damageTimestamp.textContent = now.toLocaleString();
}
updateTimestamp();

// --- Signature Pad ---
const signaturePad = document.getElementById('signaturePad');
const sigCtx = signaturePad.getContext('2d');
let drawing = false;
let last = null;
function getPos(e) {
  if (e.touches) {
    const rect = signaturePad.getBoundingClientRect();
    return {
      x: e.touches[0].clientX - rect.left,
      y: e.touches[0].clientY - rect.top
    };
  } else {
    const rect = signaturePad.getBoundingClientRect();
    return {
      x: e.clientX - rect.left,
      y: e.clientY - rect.top
    };
  }
}
signaturePad.addEventListener('mousedown', e => { drawing = true; last = getPos(e); });
signaturePad.addEventListener('touchstart', e => { drawing = true; last = getPos(e); });
signaturePad.addEventListener('mousemove', e => {
  if (!drawing) return;
  const pos = getPos(e);
  sigCtx.beginPath();
  sigCtx.moveTo(last.x, last.y);
  sigCtx.lineTo(pos.x, pos.y);
  sigCtx.strokeStyle = '#222';
  sigCtx.lineWidth = 2;
  sigCtx.stroke();
  last = pos;
});
signaturePad.addEventListener('touchmove', e => {
  if (!drawing) return;
  e.preventDefault();
  const pos = getPos(e);
  sigCtx.beginPath();
  sigCtx.moveTo(last.x, last.y);
  sigCtx.lineTo(pos.x, pos.y);
  sigCtx.strokeStyle = '#222';
  sigCtx.lineWidth = 2;
  sigCtx.stroke();
  last = pos;
}, {passive: false});
['mouseup', 'mouseleave', 'touchend', 'touchcancel'].forEach(evt => {
  signaturePad.addEventListener(evt, () => { drawing = false; last = null; });
});
document.getElementById('clearSignatureBtn').onclick = function() {
  sigCtx.clearRect(0, 0, signaturePad.width, signaturePad.height);
};

// --- Form Submission ---
document.getElementById('damageReportForm').addEventListener('submit', function(e) {
  e.preventDefault();
  // Collect data (for demo)
  const topMarks = document.getElementById('diagramTop').getDamageMarks();
  const frontMarks = document.getElementById('diagramFront').getDamageMarks();
  const sideMarks = document.getElementById('diagramSide').getDamageMarks();
  // You could also collect images and signature as needed
  alert('Damage report submitted!');
});