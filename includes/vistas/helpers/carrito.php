<?php
class Carrito {
    private $productos = array(); //Es un array con los productos
    private $estado = 'Pendiente';
    private $pedido;
    //Hacer un construct de la clase carrito???
    //Para hacer un new del pedido

    public function __construct($usuario){
        $this->usuario = $usuario; //el this hace referencia a la clase padre "Usuario"
        //$this->pedido = new Pedido($usuario); //Y hacemos el new del pedido
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
                echo "Producto: " . $producto->getNombre();
                echo "<button onclick='eliminarProducto(" . $producto->getID() . ")'>Eliminar</button>";
            }
            echo "<button onclick='confirmarPedido()'>Confirmar Pedido</button>";
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
?>
