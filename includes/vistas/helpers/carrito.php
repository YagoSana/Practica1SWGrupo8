<?php
require_once 'producto.php';

class Carrito {
    private $productos = array(); //Es un array con los productos
    private $estado = 'Pendiente';
    private $pedido;
    //Hacer un construct de la clase carrito???
    //Para hacer un new del pedido

    public function __construct($usuario){
        $this->usuario = $usuario; //el this hace referencia a la clase padre "Usuario"
    
    }

    public function agregarProducto($producto) {
        $this->productos[] = $producto;
    }

    //Revisar
    public function eliminarProducto($productoId) {
        foreach ($this->productos as $key => $producto) {
            if ($producto->getID() == $productoId) {
                unset($this->productos[$key]);
            }
        }
    }

    public function mostrarProductos() {
        if (empty($this->productos)) {
            echo "El carrito está vacío.";
        } else {
            foreach ($this->productos as $producto) {
                echo "<div class='producto'>";
                echo "<img src='" . RUTA_APP . $producto->getImagen() . "' alt='Imagen del producto'>";
                echo "<div>";
                echo "<h3>" . $producto->getNombre() . "</h3>";
                // Aquí asumimos que el producto tiene un método getDescripcion()
                echo "<p>" . $producto->getPrecio() . "</p>";
                if (isset($_SESSION["login"])) {
                    // El usuario ha iniciado sesión, muestra el botón "Eliminar"
                    echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarEliminacionCarrito.php' method='post'>";
                    echo "<input type='hidden' name='productoId' value='" . $producto->getID() . "'>";
                    echo "<button type='submit' name='eliminar'>Eliminar</button>";
                    echo "</form>";
                }
                echo "</div>";
                echo "</div>";
            }
            if (isset($_SESSION["login"])) {
                // El usuario ha iniciado sesión, muestra el botón "Confirmar Pedido"
                echo '<form action="' . RUTA_APP . '/includes/vistas/helpers/procesarCompra.php" method="POST">
                    <input type="submit" name="confirmar" value="Confirmar Pedido">
                </form>';
            }
        }
    }

    public function confirmarPedido() {
        // Creamos un nuevo pedido
        $this->pedido = new Pedido($this->usuario);
    
        // Agregamos los productos al pedido
        foreach($this->productos as $productoID){
            $this->pedido->agregarProducto($productoID);
        }
    
        // Vaciamos el carrito
        $this->productos = [];
    
        // Cambiamos el estado del carrito a 'Enviado'
        $this->estado = 'Enviado';
    
        echo "Pedido confirmado. Estado del pedido: " . $this->estado;
    }

    public function getPedido() {

        return $this->pedido;
    }
}
?>
