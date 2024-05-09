$(document).ready(function () {
  $("#nombreOK").hide();
  $("#precioOK").hide();
  $("#nombreMal").hide();
  $("#precioMal").hide();

  $("#producto_nombre").change(function () {
    const campo = $("#producto_nombre"); // referencia jquery al campo
    // limpia validaciones previas
    campo[0].setCustomValidity(""); // limpia validaciones previas

    const esNombreValido = campo[0].checkValidity();
    if (esNombreValido && nombreValido(campo.val())) {
      campo[0].setCustomValidity("");
      $("#nombreOK").show();
      $("#nombreMal").hide();
      $("#botonLogin").show();
    } else {
      alert("El nombre debe tener al menos 5 caracteres");
      $("#nombreOK").hide();
      $("#nombreMal").show();
      $("#botonLogin").hide();
    }
  });

  $("#producto_precio").change(function () {
    const campo1 = $("#producto_precio");
    campo1[0].setCustomValidity("");

    const esPrecioValido = campo1[0].checkValidity();
    if (esPrecioValido && precioValido(campo1.val())) {
      campo1[0].setCustomValidity("");
      $("#precioOK").show();
      $("#precioMal").hide();
      $("#botonLogin").show();
    } else {
      $("#precioOK").hide();
      $("#precioMal").show();
      $("#botonLogin").hide();
    }
  });

  function nombreValido(nombre) {
    return nombre.length >= 5;
  }

  function precioValido(precio) {
    if (isNaN(precio)) {
      alert("El precio debe ser un número");
    } else if (precio <= 0) {
      alert("El precio debe ser positivo");
    } else return true;
  }
});
