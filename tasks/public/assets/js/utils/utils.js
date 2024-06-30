/**
 * En ese archivo encontraras utilerias , constantes reutilizables
 */

//Convierte el urlbase para consultar al Backend de CI4
const url = `${window.location.origin}/api`;

document.addEventListener("DOMContentLoaded", function () {
  M.AutoInit();
});

function errorResponse(error) {
  Swal.fire(
    error.responseJSON?.message || "Error Critico",
    error.responseJSON?.data?.toString() || "Hubo un error intente de nuevo",
    "error"
  );
}
