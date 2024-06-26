$(document).ready(function () {
  var botonEnviar = document.getElementById("botonEnviar");
  botonEnviar.disabled = true;

  $("#correoOK").hide();
  $("#userOK").hide();
  $("#correoMal").hide();
  $("#userMal").hide();

  $("#email").change(function () {
    const campo = $("#email"); // referencia jquery al campo
    // limpia validaciones previas
    campo[0].setCustomValidity(""); // limpia validaciones previas

    const esCorreoValido = campo[0].checkValidity();
    if (esCorreoValido && correoValidoUCM(campo.val())) {
      campo[0].setCustomValidity("");
      $("#correoOK").show();
      $("#correoMal").hide();
      botonEnviar.disabled = false;
    } else {
      alert("El correo debe ser válido y acabar por @ucm.es o @gmail.com");
      $("#correoOK").hide();
      $("#correoMal").show();
      botonEnviar.disabled = true;
    }
  });

  $("#username").change(function () {
    const campo1 = $("#username");
    campo1[0].setCustomValidity("");
    const esUsernameValido = campo1[0].checkValidity();

    if (esUsernameValido && nombreUsuarioValido(campo1.val())) {
      //mirar si existe el usuario
      var url ="../vistas/helpers/comprobarUsuario.php?user=" + $("#username").val();
      $.get(url, usuarioExiste);
      campo1[0].setCustomValidity("");
      botonEnviar.disabled = false;
    } else {
      alert("El nombre de usuario es demasiado corto");
      $("#userOK").hide();
      $("#userMal").show();
      botonEnviar.disabled = true;
    }
  });

  function nombreUsuarioValido(nombre) {
    return nombre.length >= 5;
  }

  function correoValidoUCM(correo) {
    // Comprueba si el correo termina en @ucm.es
    if (correo.endsWith("@ucm.es") || correo.endsWith("@gmail.com")) {
      return true;
    }
    return false;
  }

  function usuarioExiste(data, status) {
    // tu codigo aqui
    // Por ejemplo, puedes verificar si el usuario ya existe
    if (data === "existe") {
      // Usuario ya existe, muestra un mensaje de error
      alert("El nombre de usuario no está disponible");
      $("#userMal").show();
      $("#userOK").hide();
    } else {
      // Usuario no existe, oculta el mensaje de error
      $("#userOK").show();
      $("#userMal").hide();
    }
  }
});
