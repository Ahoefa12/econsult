// Modals open/close
function openModal(id){ document.getElementById(id).style.display = 'flex'; document.getElementById(id).setAttribute('aria-hidden','false'); }
function closeModal(id){ document.getElementById(id).style.display = 'none'; document.getElementById(id).setAttribute('aria-hidden','true'); }
// Open modal shortcuts
document.querySelectorAll('[data-open-modal]').forEach(btn => {
  btn.addEventListener('click', e => { e.preventDefault(); openModal(btn.getAttribute('data-open-modal')); });
});