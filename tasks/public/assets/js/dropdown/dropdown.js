function toggleDropdown() {
  let menu = document.getElementById("menu");
  let clase = document.getElementById("chevron");
  menu?.classList.toggle("open");

  clase.innerHTML = !menu?.classList.contains("open") ? "expand_more" : "close";
}
function disableDropdown() {
  let menu = document.getElementById("menu");
  let clase = document.getElementById("chevron");
  menu.classList.remove("open");

  clase.innerHTML = !menu?.classList.contains("open") ? "expand_more" : "close";
}

function handleMenuButtonClicked() {
  this.toggleDropdown();
}

function logout() {
  window.location.replace("/api/cerrarsesion");
}

function configuracion() {
  window.location.replace("/usuario/configuracion");
}
