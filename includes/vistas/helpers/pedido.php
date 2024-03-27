<?php

class Pedido {
    private $ID_Pedido;
    private $Fecha;
    private $Cliente;
    private $Producto;
    private $Cantidad;
    private $Estado;

    public function __construct($usuario) {
        $this->usuario = $usuario;
        $this->productos = [];
        $this->Fecha = date('Y-m-d', strtotime('+2 days'));
        $this->Estado = 'Pendiente';
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


    public function entregarPedido() {
        if ($this->fechaEntrega <= date('Y-m-d')) {
            $this->estado = 'entregado';
            foreach ($this->productos as $producto) {
                echo "<button onclick='valorar(\"{$producto->getID()}\")'>Valorar</button>";
            }
        } else {
            echo "Aún no has recibido tu pedido.";
        }
    }

    public function getEstado() {
        return $this->Estado;
    }
}



?>