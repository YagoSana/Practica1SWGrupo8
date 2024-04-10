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

    public function agregarProducto($producto, $cantidad, $db) {
        $this->productos[] = $producto;

        // Agregar el producto a la base de datos
        try {
            $sql = "INSERT INTO pedidos (Fecha, Cliente, Producto, Cantidad) VALUES (:fecha, :cliente, :producto_id, :cantidad)";
            $stmt = $db->getConnection()->prepare($sql);

            // Asignar los resultados a variables
            $fecha = $this->fechaEntrega;
            $cliente = $this->cliente->getId();
            $producto_id = $producto->getID();
            
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
        // Abrir la conexión a la base de datos
        $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        $db->connect();

        $pedidos = $this->obtenerProductosDelUsuario($this->cliente->getId());
        if($pedidos != null) {
            foreach ($pedidos as $pedido) {
            // Consulta SQL para obtener los detalles del producto
                $sql = "SELECT * FROM productos WHERE ID = :producto_id";
                $stmt = $db->getConnection()->prepare($sql);
                $stmt->bindParam(':producto_id', $pedido['Producto']);
                $stmt->execute();
                $producto = $stmt->fetch();

                echo "<p>Producto: " . $producto['Nombre'] . "</p>";
                echo "<div class='producto'>";
                echo "<img src='" . RUTA_APP . $producto['Imagen'] . "' alt='Imagen del producto' id='imgPedidos'>";
                echo "</div>";
                echo "<p>Cantidad: " . $pedido['Cantidad'] . "</p>";
                echo "<p>Fecha: " . $pedido['Fecha'] . "</p>";
                if ($pedido['Fecha'] <= date('Y-m-d')) {
                    echo "<p>Estado: Entregado</p>";
                    if ($this->yaValorado($pedido['ID_Pedido'])) {
                        echo "<p><button onclick='window.location.href=\"" . RUTA_APP . "/includes/vistas/plantillas/mostrarValoracion.php?id={$pedido['ID_Pedido']}\"'>Valorar</button></p>";
                    } else {
                        echo "<p>Ya has valorado este producto.</p>";
                    }
                } else {
                    echo "<p>Estado: Pendiente</p>";
                }
            }
        } else {
            echo "<p>No existen pedidos.</p>";
        }
    }   
    


    private function yaValorado($pedidoId) {
        // Abrir la conexión a la base de datos
        $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        $db->connect();
    
        // Consulta SQL para obtener la valoración del usuario para el pedido
        $sql = "SELECT Valoracion FROM valoraciones WHERE Idusuario = :usuario_id AND ID = :pedido_id";
    
        // Preparar la consulta
        $stmt = $db->getConnection()->prepare($sql);
    
        // Vincular los parámetros
        $usuario_id = $this->cliente->getId();
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':pedido_id', $pedidoId);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $valoracion = $stmt->fetchColumn();
    
        // Cerrar la conexión a la base de datos
        $db->close();
    
        // Si la valoración es igual a 0, significa que el usuario no ha valorado el pedido
        return $valoracion == 0;
    }
    
    
    public function confirmarPedido() {
        // Cambiamos el estado del pedido a 'Pendiente'
        $this->estado = 'Pendiente';
        
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

    public function setFecha($fecha){

        $this->fechaEntrega = $fecha;
    }
}
?>