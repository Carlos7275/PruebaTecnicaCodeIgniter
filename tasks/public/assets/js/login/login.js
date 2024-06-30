$("#frmLogin").validate({
  rules: {
    email: {
      required: true,
      email: true,
    },
    password: {
      required: true,
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
/**
 * Cambia el icono y el tipo del input
 */
$("#passwordButton").on("click", () => {
  let password = $("#password");
  let hide = password.attr("type") == "password";
  $("#password").attr("type", hide ? "text" : "password");
  $("#passwordButton").text(hide ? "visibility_off" : "visibility");
});

$(document).ready(function () {
  $("#frmLogin").on("submit", function (e) {
    e.preventDefault();
    var email = $("#email").val();
    var password = $("#password").val();

    if ($(this).valid()) {
      $.post(
        url + "/iniciarsesion", // Asegúrate de que esta URL es correcta
        {
          email: email,
          password: password,
        }
      )
        .done(() => {
          window.location.reload();
        })
        .fail((error) => errorResponse(error));
    }
  });
});
