let debounceTimeout;
let idTarea = null;
function obtenerEstatus(estatus) {
  const opciones = [
    { value: "N", text: "Sin empezar" },
    { value: "P", text: "En proceso" },
    { value: "C", text: "Completado" },
  ];

  const opcionEncontrada = opciones.find((opcion) => opcion.value === estatus);
  return opcionEncontrada ? opcionEncontrada.text : null;
}
function crearFormulario() {
  $("#frmModal").validate({
    rules: {
      nombretarea: {
        required: true,
      },
      descripcion: {
        required: true,
      },
      fechaentrega: {
        required: true,
      },
      idprioridad: {
        required: true,
      },
      estatus: {
        required: true,
      },
    },
    errorElement: "span",
    errorPlacement: function (error, element) {
      if (element.prop("tagName") === "SELECT") {
        error.insertAfter(element.next("span"));
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element) {
      $(element).addClass("error");
    },
    unhighlight: function (element) {
      $(element).removeClass("error");
    },
  });
}

$("#frmModal").on("submit", async function (event) {
  event.preventDefault();

  if ($(this).valid()) {
    _ = estaRegistrando ? await guardarDatos() : await editarDatos();
  }
});

async function guardarDatos() {
  const formData = $("#frmModal").serializeArray();
  const data = formData.reduce((acc, current) => {
    if (current.name !== "passwordAux") {
      acc[current.name] = current.value;
    }
    return acc;
  }, {});
  await $.post({
    url: url + "/creartarea",
    contentType: "application/json",
    data: JSON.stringify(data),
    dataType: "json",
    success: function (response) {
      Swal.fire(response.message, response.data, "success").then(() => {
        actualizarDatos();
        cerrarModal();
      });
    },
    error: (error) => errorResponse(error),
  });
}

async function editarTarea(id) {
  estaRegistrando = false;
  limpiarModal();
  idTarea = id;
  $("#registroModalLabel").text("Editar Usuario");

  const myTable = $("#tareas").DataTable();
  const filteredData = myTable
    .rows()
    .data()
    .filter(function (row) {
      return row.id == id;
    })
    .map(function (row) {
      return Object.assign({}, row);
    });
  $("#nombretarea").val(filteredData[0].nombretarea);
  $("label[for='nombretarea']").addClass("active");

  $("#descripcion").val(filteredData[0].descripcion);
  $("label[for='descripcion']").addClass("active");
  $("#fechaentrega").val(filteredData[0].fechaentrega);
  $("label[for='fechaentrega']").addClass("active");

  $("#idprioridad").val(filteredData[0].idprioridad);
  $("label[for='idprioridad']").addClass("active");
  $("#estatus").val(filteredData[0].estatus);
  $("label[for='estatus']").addClass("active");
  $("#registroModal").modal("show");
}

async function editarDatos() {
  const formData = $("#frmModal").serializeArray();
  const data = formData.reduce((acc, current) => {
    acc[current.name] = current.value;

    return acc;
  }, {});

  $.ajax({
    type: "PUT",
    url: `${url}/editartarea/${idTarea}`,
    data: JSON.stringify(data),
    contentType: "application/json",
    dataType: "json",
    success: function (response) {
      Swal.fire(response.message, response.data, "success").then(() => {
        actualizarDatos();
        cerrarModal();
      });
    },
    error: (error) => errorResponse(error),
  });
}
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
      let estatus = $("#estatusFiltro").val();
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
      { data: "fechaentrega" },
      {
        data: "prioridad",
      },
      {
        data: "estadotarea",
        render: function (data, type, row) {
          const hoy = new Date();
          const fechaEntrega = new Date(row.fechaentrega);
          const fechaActualizacion = new Date(row.updated_at);

          console.log(hoy < fechaEntrega);

          if (hoy > fechaEntrega && row.estatus != "C")
            return "Retrasada";
          else if (hoy < fechaEntrega && row.estatus != "C") return "A tiempo";
          else if (fechaActualizacion < fechaEntrega && row.estatus == "C")
            return "Finalizada con retraso";
          else return "Finalizada a tiempo";
        },
      },
      {
        data: "estatus",
        render: function (data, type, row) {
          return obtenerEstatus(data);
        },
      },
      { data: "created_at" },
      { data:"updated_at"},
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

$("#btnAgregar").on("click", function () {
  estaRegistrando = true;

  $("#registroModalLabel").text("Registrar Tarea");
  limpiarModal();
  $("#registroModal").modal("show");
});

/**
 * Limpia el formulario y reconstruye los selects
 */
function limpiarModal() {
  $("#frmModal").trigger("reset");
  $("#frmModal").validate().resetForm();
  $("#idprioridad,#estatus").formSelect();
}

async function obtenerPrioridades() {
  await $.get(url + "/prioridades")
    .done(function (response) {
      var select = $("#prioridad,#idprioridad");
      response.data.forEach((prioridad) => {
        select.append(
          $("<option></option>")
            .attr("value", prioridad.id)
            .text(prioridad.descripcion)
        );
      });
      select.formSelect();
    })
    .fail((error) => errorResponse(error));
}
$(document).ready(async function () {
  crearFormulario();
  M.textareaAutoResize($("#descripcion"));
  $("#fechaentrega").datetimepicker({ format: "Y-m-d H:i" });
  $("#idprioridad,#estatus,#estatusFiltro").formSelect();
  obtenerPrioridades();
  actualizarDatos();
});

/**
 *
 * @param {*} id  Id del usuario a eliminar
 */
function eliminarTarea(id) {
  Swal.fire({
    title: "¿Estás seguro?",
    text: "¿Quieres eliminar la tarea?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonText: "Sí",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "delete",
        url: url + `/eliminartarea/${id}`,
        data: { id: id },
        success: function (data) {
          actualizarDatos();
        },
        error: (error) => errorResponse(error),
      });
    }
  });
}

function cerrarModal() {
  $("#registroModal").modal("hide");
}
