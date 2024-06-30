var sidebar = document.querySelector(".sidebar");
var closeBtn = document.querySelector("#btn");

$(document).ready(() => {
  DeshabilitarMenu();
  closeBtn.addEventListener("click", () => {
    sidebar.classList.toggle("open");
    document.querySelector(".menu").classList.remove("open");

    menuBtnChange();
  });
});

function menuBtnChange() {
  if (sidebar.classList.contains("open")) {
    closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
  } else {
    closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
  }
}

//Deshabilita el Menu de navegacion del Museo
function DeshabilitarMenu() {
  const menu = document.querySelector("nav");
  if (menu) {
    menu.classList.add("disabled");
  }
}

//habilita el Menu de navegacion del Museo
function HabilitarMenu() {
  const menu = document.querySelector("nav");
  if (menu) {
    menu.classList.remove("disabled");
  }
}
