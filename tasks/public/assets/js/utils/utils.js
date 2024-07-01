/**
 * En ese archivo encontraras utilerias , constantes reutilizables
 */
const debounceDelay = 500;

//Convierte el urlbase para consultar al Backend de CI4
const urlServidor=window.location.origin.trim();
const url = `${urlServidor}/api`;

document.addEventListener("DOMContentLoaded", function () {
  M.AutoInit();
  AOS.init();

});

function errorResponse(error) {
  Swal.fire(
    error.responseJSON?.message || "Error Critico",
    error.responseJSON?.data?.toString() || "Hubo un error intente de nuevo",
    "error"
  );
}
