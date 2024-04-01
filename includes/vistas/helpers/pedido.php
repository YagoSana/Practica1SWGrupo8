<?php

class Pedido
{
    private $ID_Pedido;
    private $Fecha;
    private $Cliente;
    private $Producto;
    private $Cantidad;
    private $Estado;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
        $this->productos = [];
        $this->Fecha = date('Y-m-d', strtotime('+2 days'));
        $this->Estado = 'Pendiente';
    }

    public function agregarProducto($productoId)
    {
        $this->productos[] = $productoId;
    }

    public function obtenerProductosDelUsuario()
    {
        // Aquí puedes implementar la lógica para obtener los ids de los productos relacionados con el usuario
        // Por ejemplo, puedes consultar una base de datos o hacer alguna otra operación

        // En este ejemplo, simplemente devolvemos los productos agregados al pedido
        return $this->productos;
    }


    public function entregarPedido()
    {
        if ($this->fechaEntrega <= date('Y-m-d')) {
            $this->estado = 'entregado';
            foreach ($this->productos as $producto) {
                echo "<button onclick='valorar(\"{$producto->getID()}\")'>Valorar</button>";
            }
        } else {
            echo "Aún no has recibido tu pedido.";
        }
    }

    public function getEstado()
    {
        return $this->Estado;
    }

    public function mostrarPedidos()
    {
        $pedidos = $this->obtenerProductosDelUsuario();
        foreach ($pedidos as $pedido) {
            echo "<p>Pedido ID: " . $pedido->ID_Pedido . "</p>";
            echo "<p>Fecha: " . $pedido->Fecha . "</p>";
            echo "<p>Cliente: " . $pedido->Cliente . "</p>";
            echo "<p>Producto: " . $pedido->Producto . "</p>";
            echo "<p>Cantidad: " . $pedido->Cantidad . "</p>";
            echo "<p>Estado: " . $pedido->Estado . "</p>";
            if ($pedido->Estado == 'Entregado') {
                if (!$this->yaValorado($pedido->ID_Pedido)) {
                    echo "<p><button onclick='valorar(\"{$pedido->ID_Pedido}\")'>Valorar</button></p>";
                } else {
                    echo "<p>Ya has valorado este producto.</p>";
                }
            }
            echo "<hr>";
        }
    }


    //Funcion que aun hay que editar
    private function yaValorado($pedidoId)
    {
        // Conexión a la base de datos
        $db = new PDO('mysql:host=localhost;dbname=tu_base_de_datos', 'tu_usuario', 'tu_contraseña');

        // Consulta SQL para verificar si el usuario ya ha valorado el pedido
        $sql = "SELECT COUNT(*) FROM valoraciones WHERE usuario_id = :usuario_id AND pedido_id = :pedido_id";

        // Preparar la consulta
        $stmt = $db->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':usuario_id', $this->usuario->getId());
        $stmt->bindParam(':pedido_id', $pedidoId);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $count = $stmt->fetchColumn();

        // Si el conteo es mayor que 0, significa que el usuario ya ha valorado el pedido
        return $count > 0;
    }

}
?>