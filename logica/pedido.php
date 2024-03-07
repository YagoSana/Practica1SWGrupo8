<?php

class Pedido {
    private $usuario;
    private $productos;

    public function __construct($usuario) {
        $this->usuario = $usuario;
        $this->productos = [];
    }

    public function agregarProducto($productoId) {
        $this->productos[] = $productoId;
    }

    public function obtenerProductosDelUsuario() {
        // Aquí puedes implementar la lógica para obtener los ids de los productos relacionados con el usuario
        // Por ejemplo, puedes consultar una base de datos o hacer alguna otra operación

        // En este ejemplo, simplemente devolvemos los productos agregados al pedido
        return $this->productos;
    }
}



?>