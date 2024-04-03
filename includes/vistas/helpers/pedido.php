<?php

class Pedido
{
    private $idPedido;
    private $fechaEntrega;
    private $cliente;
    private $productos = array();
    private $productosEntregados = array(); //Hay que implementar que cada vez que el pedido se entregue todos
                                            //los productos que habia en la variable producto se guarden aqui, para luego poder valorarlos y etc
    private $cantidad;
    private $estado;

    public function __construct($usuario)
    {
        $this->usuario = $usuario;
        $this->estado = 'Nulo';
    }

    public function agregarProducto($productoId)
    {
        $this->productos[] = $productoId;
    }

    public function obtenerProductosDelUsuario()
    {
        // En este ejemplo, simplemente devolvemos los productos agregados al pedido
        //Devolvemos el array con los productos del usuario
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

    public function confirmarPedido() {
        if($this->estado == 'Nulo') {

            $this->estado = 'Pendiente';

            //Se establece la fecha de entrega para dentro de un par de dias
            $diasParaEntrega = rand(2, 5);
            $this->fechaEntrega = date('Y-m-d', strtotime("+$diasParaEntrega days"));
            
            echo "Pedido confirmado. Estado del pedido: " . $this->estado;
        }
        else {

            echo "No se puede confirmar el pedido. Estado actual del pedido: " . $this->estado;
        }

    }

}
?>