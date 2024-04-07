<?php

class Pedido
{
    private $idPedido;
    private $fechaEntrega;
    private $cliente;
    private $productos = array(); //Hay que guardarlos en la base de datos los productos y los productos entregados
    private $productosEntregados = array(); //Hay que implementar que cada vez que el pedido se entregue todos
                                            //los productos que habia en la variable producto se guarden aqui, para luego poder valorarlos y etc
    private $cantidad;
    private $estado;

    public function __construct($usuario) {
        
        $this->usuario = $usuario;
        $this->estado = 'Nulo';
    }

    public function agregarProducto($producto) {
        
        $this->productos[] = $producto;

        // Agregar el producto a la base de datos
        $db = new PDO('mysql:host=localhost;dbname=tu_base_de_datos', 'tu_usuario', 'tu_contraseña');
        $sql = "INSERT INTO productos_pedido (pedido_id, producto_id) VALUES (:pedido_id, :producto_id)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':pedido_id', $this->idPedido);
        $stmt->bindParam(':producto_id', $producto);
        $stmt->execute();
    }

    public function obtenerProductosDelUsuario($usuario_id) {
        // Conexión a la base de datos
        $db = new PDO('mysql:host=localhost;dbname=tu_base_de_datos', 'tu_usuario', 'tu_contraseña');

        // Consulta SQL para obtener todos los productos del usuario
        $sql = "SELECT * FROM productos_pedido WHERE usuario_id = :usuario_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        $productos = $stmt->fetchAll();

        // Devolvemos todos los productos del usuario
        return $productos;
    }


    public function entregarPedido() {
        if ($this->fechaEntrega <= date('Y-m-d')) {
            $this->estado = 'entregado';
        } else {
            echo "Aún no has recibido tu pedido.";
        }
    }

    public function mostrarPedidos() {
        $pedidos = $this->obtenerProductosDelUsuario($this->usuario->getId());
        foreach ($pedidos as $pedido) {
            echo "<p>Pedido ID: " . $pedido->ID_Pedido . "</p>";
            echo "<p>Cliente: " . $pedido->Cliente . "</p>";
            echo "<p>Producto: " . $pedido->Producto . "</p>";
            echo "<p>Cantidad: " . $pedido->Cantidad . "</p>";
            if ($pedido->Fecha <= date('Y-m-d')) {
                echo "<p>Estado: Entregado</p>";
                if (!$this->yaValorado($pedido->ID_Pedido)) {
                    echo "<p><button onclick='valorar(\"{$pedido->ID_Pedido}\")'>Valorar</button></p>";
                } else {
                    echo "<p>Ya has valorado este producto.</p>";
                }
            } else {
                echo "<p>Estado: Pendiente</p>";
                echo "<p>Fecha de Entrega: " . $pedido->Fecha . "</p>";
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
        // Cambiamos el estado del pedido a 'Pendiente'
        $this->estado = 'Pendiente';
    
        // Establecemos la fecha de entrega para dentro de un par de días
        $diasParaEntrega = rand(2, 5);
        $this->fechaEntrega = date('Y-m-d', strtotime("+$diasParaEntrega days"));
        
        echo "Pedido confirmado. Estado del pedido: " . $this->estado;
    }


    public function getEstado()
    {
        return $this->estado;
    }

}
?>