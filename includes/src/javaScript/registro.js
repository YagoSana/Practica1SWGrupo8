$(document).ready(function() {

	$("#correoOK").hide();
	$("#userOK").hide();
	$("#correoMal").hide();
	$("#userMal").hide();

	$("#email").change(function(){
		const campo = $("#email"); // referencia jquery al campo 
		// limpia validaciones previas
		campo[0].setCustomValidity(""); // limpia validaciones previas

		

		const esCorreoValido = campo[0].checkValidity();
		if (esCorreoValido && correoValidoUCM(campo.val())) {

			campo[0].setCustomValidity("");
			$("#correoOK").show();
			$("#correoMal").hide();
		} else {			
			campo[0].setCustomValidity("El correo debe ser válido y acabar por @ucm.es o @gmail.com");
			$("#correoOK").hide();
			$("#correoMal").show();
		}
		
	});

	
	$("#username").change(function(){
		/*const campo1 = $("#username");
		campo1[0].setCustomValidity("");
		if(nombreUsuarioValido(campo1.val())){
			campo1[0].setCustomValidity("");
			$("#userOK").show();
			$("#userMal").hide();
			
		}else{
			campo1[0].setCustomValidity("El nombre de usuario debe tener al menos 5 caracteres");
			$("#userOK").hide();
			$("#userMal").show();
		}*/
		var url = "../vistas/helpers/comprobarUsuario.php?user=" + $("#username").val();
		$.get(url,usuarioExiste);
	});
	


  	function nombreUsuarioValido(nombre) {
	
		return nombre.length >= 5;
  	}

	function correoValidoUCM(correo) {
		// Comprueba si el correo termina en @ucm.es

        return correo.endsWith("@ucm.es") || correo.endsWith("@gmail.es");
	}

	function usuarioExiste(data,status) {
		// tu codigo aqui
		// Por ejemplo, puedes verificar si el usuario ya existe
		console.log(data);
		if (data === "existe") {
			// Usuario ya existe, muestra un mensaje de error
			
			$("#userMal").show();
			$("#userOK").hide();
			alert("El nombre de usuario ya está en uso");

		} else {
			// Usuario no existe, oculta el mensaje de error
			$("#userOK").show();
			$("#userMal").hide();
		}
	}
})
