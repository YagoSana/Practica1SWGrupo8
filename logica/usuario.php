<?php
    include("carrito.php");
class Usuario {
    private $nombre;
    private $carrito;

    public function __construct($nombre) {
        $this->nombre = $nombre;
        $this->carrito = new Carrito();
    }

    public function getCarrito() {
        return $this->carrito;
    }
}

?>