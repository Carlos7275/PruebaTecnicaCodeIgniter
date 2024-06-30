var reader = new FileReader();
var imagePath;
var imgUrl = null;

$("#frmConfiguracion").validate({
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
    },
    fotoUsuario: {
      required: false,
    },
  },
  errorElement: "span",
  errorPlacement: function (error, element) {
    error.insertAfter(element);
  },
  highlight: function (element) {
    $(element).addClass("error");
  },
  unhighlight: function (element) {
    $(element).removeClass("error");
  },
});

$("#frmConfiguracion").on("submit", function (e) {
  e.preventDefault();
  const formData = $(this).serializeArray();
  const data = formData.reduce((acc, current) => {
    acc[current.name] = current.value;
    return acc;
  }, {});
  if (imgUrl) data["foto"] = imgUrl;

  if ($(this).valid()) {
    $.ajax({
      type: "PUT",
      url: `${url}/editarusuario/${idUsuario}`,
      data: JSON.stringify(data),
      contentType: "application/json",
      dataType: "json",
      success: function (response) {
        Swal.fire(response.message, response.data, "success").then(() => {
          window.location.reload();
        });
      },
      error: (error) => errorResponse(error),
    });
  }
});

$(document).ready(async () => {
  $("#generos").formSelect();
});

function preview(files) {
  imgUrl = null;
  if (files.length === 0) return;
  //Si el archivo tiene longitud verificaremos su MIME  y en caso de que no sea imagen termimos el proceso
  var mimeType = files[0].type;
  if (mimeType.match(/image\/*/) == null) {
    $("#errorArchivo").text("Solo Soportamos Imagenes.");
    return;
  }

  //Instanciamos el lector de archivos

  imagePath = files;
  reader.readAsDataURL(files[0]);

  reader.onloadend = (_event) => {
    $("#fotoUsuario").attr("src", reader.result);
    imgUrl = reader.result;
  };
}
