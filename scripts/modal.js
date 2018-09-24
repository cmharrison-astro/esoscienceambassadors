// const creditsModal = document.getElementById('credits-modal');

const modalOpen = thisModal => {
  document.getElementById(thisModal).style.display = 'block';
};

const modalClose = thisModal => {
  document.getElementById(thisModal).style.display = 'none';
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = event => {
  if (event.target == document.getElementById('credits-modal')) {
    document.getElementById('credits-modal').style.display = 'none';
  }
  if (event.target == document.getElementById('privacy-policy-modal')) {
    document.getElementById('privacy-policy-modal').style.display = 'none';
  }
};
