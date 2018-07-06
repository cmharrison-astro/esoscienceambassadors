// Tabbed Menu
function openMenu2(evt, menuName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("menu2");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks2 = document.getElementsByClassName("tablink2");
  for (i = 0; i < x.length; i++) {
     tablinks2[i].className = tablinks2[i].className.replace(" w3-dark-grey", "");
  }
  document.getElementById(menuName).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-dark-grey";
}
document.getElementById("myLink2").click();