<?php
class Carrito {
    private $productos = array();
    private $estado = 'pendiente';

    public function agregarProducto($producto) {
        $this->productos[] = $producto;
    }

    public function eliminarProducto($productoID) {
        foreach ($this->productos as $key => $producto) {
            if ($producto->getID() == $productoID) {
                unset($this->productos[$key]);
            }
        }
    }

    public function mostrarProductos() {
        if (empty($this->productos)) {
            echo "El carrito está vacío.";
        } else {
            foreach ($this->productos as $producto) {
                echo "Producto: " . $producto->getNombre();
                echo "<button onclick='eliminarProducto(" . $producto->getID() . ")'>Eliminar</button>";
            }
            echo "<button onclick='confirmarPedido()'>Confirmar Pedido</button>";
        }
    }

    public function confirmarPedido() {
        $this->estado = 'enviado';
        echo "Pedido confirmado. Estado del pedido: " . $this->estado;
    }
}
?>
