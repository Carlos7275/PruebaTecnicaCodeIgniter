estaRegistrando = false;
var idUsuario = null;
function crearFormulario() {
  $("#frmModal").validate({
    rules: {
      email: {
        required: true,
        email: true,
      },
      nombres: {
        required: true,
      },
      apellidos: {
        required: true,
      },
      id_genero: {
        required: true,
      },
      fechanacimiento: {
        required: true,
        date: true,
      },
      id_rol: {
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
    url: url + "/crearUsuario",
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

async function editarDatos() {
  const formData = $("#frmModal").serializeArray();
  const data = formData.reduce((acc, current) => {
    if (current.name !== "passwordAux" && current.name !== "password") {
      acc[current.name] = current.value;
    }
    return acc;
  }, {});

  $.ajax({
    type: "PUT",
    url: `${url}/editarusuario/${idUsuario}`,
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
/**
 * Metodo inicial
 */
$(document).ready(async function () {
  crearFormulario();
  await cargarGeneros();
  await cargarRoles();
  actualizarDatos();
});
let debounceTimeout;

/**Crea la tabla con los datos de la BD */
function actualizarDatos() {
  $("#usuarios").DataTable({
    destroy: true,
    processing: true,
    serverSide: true,
    ordering: false,
    language: {
      search: "Buscar",
    },
    ajax: function (data, callback, settings) {
      // Parámetros de paginación y búsqueda
      console.log(data);
      var page = Math.ceil(data.start / data.length) + 1;
      var limit = data.length;
      var search = data.search.value;

      // Debounce implementation
      if (debounceTimeout) {
        clearTimeout(debounceTimeout);
      }

      debounceTimeout = setTimeout(function () {
        $.ajax({
          url: url + "/usuarios",
          method: "POST",
          contentType: "application/json",
          data: JSON.stringify({
            pagina: page,
            limite: limit,
            busqueda: search,
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
      { data: "nombres" },
      { data: "apellidos" },
      { data: "email" },
      {
        data: "foto",
        render: function (data) {
          return `<img class="rounded-circle img-responsive mt-2" src="${urlServidor}/${data}" width="50" height="50" />`;
        },
      },
      { data: "fechanacimiento" },
      { data: "genero" },
      { data: "rol" },
      {
        data: "estatus",
        render: function (data) {
          return data == 1 ? "Activo" : "Inactivo";
        },
      },
      {
        data: "acciones",
        render: function (data, type, row) {
          datos = JSON.stringify(row);
          return `
              <button class="btn yellow btn-sm" onclick="editarUsuario(${row.id})">
                <i class="material-icons">edit</i>
              </button>
              <button class="btn red btn-sm" onclick="cambiarEstatus(${row.id})">
                <i class="material-icons">toggle_on</i>
              </button>
            `;
        },
      },
    ],
    lengthChange: false,
    pageLength: 20, // Número de filas por página
  });
}

/**
 * Carga generos en el select
 */
async function cargarGeneros() {
  await $.get(url + "/generos")
    .done(function (response) {
      var select = $("#id_genero");
      response.data.forEach((genero) => {
        select.append(
          $("<option></option>")
            .attr("value", genero.id)
            .text(genero.descripcion)
        );
      });
      select.formSelect();
    })
    .fail((error) => errorResponse(error));
}
/**
 * Cargar roles al select
 */
async function cargarRoles() {
  await $.get(url + "/roles")
    .done(function (response) {
      var select = $("#id_rol");
      response.data.forEach((rol) => {
        select.append(
          $("<option></option>").attr("value", rol.id).text(rol.descripcion)
        );
      });
      select.formSelect();
    })
    .fail((error) => errorResponse(error));
}

$("#btnAgregar").on("click", function () {
  estaRegistrando = true;
  if (estaRegistrando) {
    var validator = $("#frmModal").validate();
    validator.settings.rules.password = {
      required: true,
    };
    validator.settings.rules.passwordAux = {
      required: true,
      equalTo: "#password",
    };
  }
  $("#registroModalLabel").text("Registrar Usuario");

  limpiarModal();
  $("#registroModal").removeClass("edit-mode");
  $("#registroModal").modal("show");
});

/**
 *
 * @param {*} id id del usuario a editar
 */
function editarUsuario(id) {
  estaRegistrando = false;
  limpiarModal();
  idUsuario = id;
  $("#registroModalLabel").text("Editar Usuario");
  $("#registroModal").addClass("edit-mode");

  const myTable = $("#usuarios").DataTable();
  const filteredData = myTable
    .rows()
    .data()
    .filter(function (row) {
      return row.id == id;
    })
    .map(function (row) {
      return Object.assign({}, row);
    });

  $("#nombres").val(filteredData[0].nombres);
  $("label[for='nombres']").addClass("active");

  $("#apellidos").val(filteredData[0].apellidos);
  $("label[for='apellidos']").addClass("active");

  $("#fechanacimiento").val(filteredData[0].fechanacimiento);
  $("label[for='fechanacimiento']").addClass("active");

  $("#email").val(filteredData[0].email);
  $("label[for='email']").addClass("active");

  $('select[id="id_genero"]').val(filteredData[0].id_genero);

  $('select[id="id_rol"]').val(Number(filteredData[0].id_rol));

  $("#registroModal").modal("show");
}

/**
 * Limpia el formulario y reconstruye los selects
 */
function limpiarModal() {
  $("#frmModal").trigger("reset");
  $("#id_rol,#id_genero").formSelect();
}

/**
 * Cierra el modal
 */
function cerrarModal() {
  $("#registroModal").modal("hide");
}
/**
 *
 * @param {*} id  Id del usuario a cambiar el estatus
 */
function cambiarEstatus(id) {
  if (idUsuario != id)
    Swal.fire({
      title: "¿Estás seguro?",
      text: "¿Quieres cambiar el estatus?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Sí",
      cancelButtonText: "Cancelar",
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          type: "delete",
          url: url + `/cambiarestatus/${id}`,
          data: { id: id },
          success: function (data) {
            actualizarDatos();
          },
          error: (error) => errorResponse(error),
        });
      }
    });
}
