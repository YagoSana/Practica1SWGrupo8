function redireccionar() {
    var seleccion = document.getElementById("filtrotipocompras").value;
    if (seleccion == 'Todos') window.location.href = ruta_app + "/includes/vistas/plantillas/compras.php";
    else if (seleccion != '') window.location.href = ruta_app + "/includes/vistas/plantillas/BuscarPorTipo.php?tipo=" + seleccion;
}