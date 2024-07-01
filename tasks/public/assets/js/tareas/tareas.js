let debounceTimeout;

/**Crea la tabla con los datos de la BD */
async function actualizarDatos() {
  $("#tareas").DataTable({
    destroy: true,
    processing: true,
    serverSide: true,
    ordering: false,
    language: {
      search: "Buscar",
    },
    ajax: function (data, callback, settings) {
      // Parámetros de paginación y búsqueda
      var page = Math.ceil(data.start / data.length) + 1;
      var limit = data.length;
      var search = data.search.value;

      let idPrioridad = $("#prioridad").val();
      let estatus = $("#estatus").val();
      let fechaInicial = $("#fechaInicial").val() || null;
      let fechaFinal = $("#fechaFinal").val() || null;

      // Debounce implementation
      if (debounceTimeout) {
        clearTimeout(debounceTimeout);
      }

      debounceTimeout = setTimeout(async function () {
        await $.ajax({
          url: url + "/tareas",
          method: "POST",
          contentType: "application/json",
          data: JSON.stringify({
            pagina: page,
            limite: limit,
            busqueda: search,
            fechaInicial,
            fechaFinal,
            idPrioridad,
            estatus,
          }),
          success: function (response) {
            callback({
              draw: data.draw,
              recordsTotal: response.data.totalRegistros,
              recordsFiltered: response.data.totalRegistrosFiltrados,
              data: response.data.datos,
            });
          },
        });
      }, debounceDelay);
    },
    columns: [
      { data: "id" },
      { data: "nombretarea" },
      { data: "descripcion" },
      { data: "fecha" },
      {
        data: "prioridad",
      },
      { data: "estadotarea" },
      { data: "estatus" },
      { data: "created_at" },
      {
        data: "acciones",
        render: function (data, type, row) {
          datos = JSON.stringify(row);
          return `
              <button class="btn yellow btn-sm" onclick="editarTarea(${row.id})">
                <i class="material-icons">edit</i>
              </button>
              <button class="btn red btn-sm" onclick="eliminarTarea(${row.id})">
                <i class="material-icons">delete</i>
              </button>
            `;
        },
      },
    ],
    lengthChange: false,
    pageLength: 20, // Número de filas por página
  });
}

$(document).ready(async function () {
  actualizarDatos();
});
