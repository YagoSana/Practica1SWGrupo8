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
        
        $this->cliente = $usuario;
        $this->estado = 'Nulo';
    }

    public function agregarProducto($producto, $db) {
        $this->productos[] = $producto;

        // Agregar el producto a la base de datos
        try {
            $sql = "INSERT INTO pedidos (Fecha, Cliente, Producto, Cantidad) VALUES (:fecha, :cliente, :producto_id, :cantidad)";
            $stmt = $db->getConnection()->prepare($sql);

            // Asignar los resultados a variables
            $fecha = date('Y-m-d');
            $cliente = $this->cliente->getId();
            $producto_id = $producto->getID();
            $cantidad = 1; // Asegúrate de definir $cantidad

            // Pasar las variables a bindParam
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->bindParam(':producto_id', $producto_id);
            $stmt->bindParam(':cantidad', $cantidad);

            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


    public function obtenerProductosDelUsuario($usuario_id) {
        // Abrir la conexión a la base de datos
        $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        $db->connect();
    
        // Consulta SQL para obtener todos los productos del usuario
        $sql = "SELECT * FROM pedidos WHERE Cliente = :usuario_id";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        $productos = $stmt->fetchAll();
    
        // Cerrar la conexión a la base de datos
        $db->close();
    
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
        $pedidos = $this->obtenerProductosDelUsuario($this->cliente->getId());
        foreach ($pedidos as $pedido) {
            echo "<p>Pedido ID: " . $pedido['ID_Pedido'] . "</p>";
            echo "<p>Cliente: " . $pedido['Cliente'] . "</p>";
            echo "<p>Producto: " . $pedido['Producto'] . "</p>";
            echo "<p>Cantidad: " . $pedido['Cantidad'] . "</p>";
            if ($pedido['Fecha'] <= date('Y-m-d')) {
                echo "<p>Estado: Entregado</p>";
                if (!$this->yaValorado($pedido['ID_Pedido'])) {
                    echo "<p><button onclick='valorar(\"{$pedido['ID_Pedido']}\")'>Valorar</button></p>";
                } else {
                    echo "<p>Ya has valorado este producto.</p>";
                }
            } else {
                echo "<p>Estado: Pendiente</p>";
                echo "<p>Fecha de Entrega: " . $pedido['Fecha'] . "</p>";
            }
            echo "<hr>";
        }
    }
    


    private function yaValorado($pedidoId) {
        // Abrir la conexión a la base de datos
        $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        $db->connect();
    
        // Consulta SQL para verificar si el usuario ya ha valorado el pedido
        $sql = "SELECT COUNT(*) FROM valoraciones WHERE usuario_id = :usuario_id AND pedido_id = :pedido_id";
    
        // Preparar la consulta
        $stmt = $db->getConnection()->prepare($sql);
    
        // Vincular los parámetros
        $stmt->bindParam(':usuario_id', $this->cliente->getId());
        $stmt->bindParam(':pedido_id', $pedidoId);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $count = $stmt->fetchColumn();
    
        // Cerrar la conexión a la base de datos
        $db->close();
    
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
        echo "Su pedido llegara el: " . $this->fechaEntrega;
    }


    public function getEstado()
    {
        return $this->estado;
    }

    public function getCliente(){

        return $this->cliente;
    }

    public function setCliente($usuario){

        $this->cliente = $usuario;
    }
}
?>