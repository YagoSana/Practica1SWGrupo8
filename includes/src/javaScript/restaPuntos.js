window.onload = function() {
    // Obtén la casilla de verificación, el elemento del total y el campo oculto del total
    var checkbox = document.getElementById('usarPuntos');
    var totalElement = document.querySelector('.total');
    var totalInput = document.querySelector('input[name="total"]');

    // Lee el total y los puntos del wallet de los atributos de datos
    var totalOriginal = Number(totalElement.dataset.total);
    var puntosWallet = Number(checkbox.dataset.puntos);

    // Agrega un controlador de eventos para la casilla de verificación
    checkbox.addEventListener('change', function() {
        if (checkbox.checked) {
            // Si la casilla está marcada, resta los puntos del wallet al total
            var nuevoTotal = Math.max(totalOriginal - puntosWallet, 0);
            totalElement.textContent = 'Total: ' + nuevoTotal + ' €';
            totalInput.value = nuevoTotal; // Actualiza el valor del campo oculto
        } else {
            // Si la casilla no está marcada, restablece el total a su valor original
            totalElement.textContent = 'Total: ' + totalOriginal + ' €';
            totalInput.value = totalOriginal; // Actualiza el valor del campo oculto
        }
    });
};
