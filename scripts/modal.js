const creditsModal = document.getElementById('credits-modal');

const modalOpen = () => {
  creditsModal.style.display = 'block';
};

const modalClose = () => {
  creditsModal.style.display = 'none';
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == creditsModal) {
    creditsModal.style.display = "none";
  }
}
