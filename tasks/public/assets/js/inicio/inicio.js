$(document).ready(async function () {
  await Promise.all([
    obtenerActividadesRetrasadas(),
    obtenerTotalActividades(),
  ]);
});

async function obtenerTotalActividades() {
  await $.get(url + "/totalactividades").done((response) => {
    $("#totalActividades").text(response.data);
  });
}

async function obtenerActividadesRetrasadas() {
  await $.get(url + "/actividadesretrasadas").done((response) => {
    $("#totalActividadesRetrasadas").text(response.data);
  });
}
