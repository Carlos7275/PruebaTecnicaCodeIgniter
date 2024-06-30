$("#frmRegistro").validate({
  rules: {
    email: {
      required: true,
      email: true,
    },
    password: {
      required: true,
    },
    passwordAux: {
      required: true,
      equalTo: "#password",
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

$("#frmRegistro").on("submit", async function (event) {
  event.preventDefault();
  const formData = $(this).serializeArray();
  const data = formData.reduce((acc, current) => {
    if (current.name !== "passwordAux") {
      acc[current.name] = current.value;
    }
    return acc;
  }, {});

  if ($(this).valid()) {
    await $.post({
      url: url + "/crearUsuario",
      contentType: "application/json",
      data: JSON.stringify(data),
      dataType: "json",
      success: function (response) {
        Swal.fire(response.message, response.data, "success").then(() => {
          window.location.href = "/login";
        });
      },
      error: (error) => errorResponse(error),
    });
  }
});

$(document).ready(async () => {
  await cargarGeneros();
});

// Toggle password visibility
$("#passwordButton").on("click", () => {
  let password = $("#password");
  let hide = password.attr("type") == "password";
  password.attr("type", hide ? "text" : "password");
  $("#passwordButton").text(hide ? "visibility_off" : "visibility");
});

$("#passwordButtonAux").on("click", () => {
  let password = $("#passwordAux");
  let hide = password.attr("type") == "password";
  password.attr("type", hide ? "text" : "password");
  $("#passwordButtonAux").text(hide ? "visibility_off" : "visibility");
});

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
