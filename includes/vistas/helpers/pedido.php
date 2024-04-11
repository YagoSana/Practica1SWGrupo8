<?php
namespace es\ucm\fdi\sw\vistas\helpers;
use es\ucm\fdi\sw\aplicacion;
class Pedido
{
    private $idPedido;
    private $fechaEntrega;
    private $cliente;
    //Hay que implementar que cada vez que el pedido se entregue todos
    private $total;
    private $productos = array(); //Hay que guardarlos en la base de datos los Productos y los Productos entregados
    private $productosEntregados = array(); //Hay que implementar que cada vez que el Pedido se entregue todos
                                            //los Productos que habia en la variable Producto se guarden aqui, para luego poder valorarlos y etc
    private $cantidad;
    private $estado;

    public function __construct($usuario) {
        
        $this->cliente = $usuario;
        $this->estado = 'Nulo';
    }

    public function agregarPedido() {
        $db = Aplicacion::getInstance()->getConexionBd();
        $sql = "INSERT INTO pedidos (Fecha, Cliente, Importe) VALUES (:fecha, :cliente, :importe)";
        $stmt = $db->prepare($sql);

        $fecha = $this->fechaEntrega;
        $cliente = $this->cliente->getId();
        $importe = $this->total;

        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':cliente', $cliente);
        $stmt->bindParam(':importe', $importe);

        $stmt->execute();

        return $db->lastInsertid();
    }

    public function agregarProducto($pedidoId, $producto, $cantidad) {
        $this->productos[] = $producto;
        $db = Aplicacion::getInstance()->getConexionBd();
        // Agregar el producto a la base de datos
        try {
            // Finalmente, insertamos el producto en la tabla 'productos_pedidos'
            $sqlProducto = "INSERT INTO productos_pedidos (ID_Pedido, ID_Producto, Cantidad) VALUES (:pedido_id, :producto_id, :cantidad)";
            $stmtProducto = $db->prepare($sqlProducto);
    
            // Asignar los resultados a variables
            $producto_id = $producto->getID();
    
            // Pasar las variables a bindParam
            $stmtProducto->bindParam(':pedido_id', $pedidoId);
            $stmtProducto->bindParam(':producto_id', $producto_id);
            $stmtProducto->bindParam(':cantidad', $cantidad);
    
            $stmtProducto->execute();
    
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    public function obtenerPedidosDelUsuario($usuario_id) {
        // Abrir la conexión a la base de datos
        $db = Aplicacion::getInstance()->getConexionBd();
    
        // Consulta SQL para obtener todos los productos del usuario
        $sql = "SELECT * FROM pedidos WHERE Cliente = :usuario_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        $productos = $stmt->fetchAll();
    
        // Devolvemos todos los productos del usuario
        return $productos;
    }

    public function obtenerProductosDelPedido($pedido) {
        $db = Aplicacion::getInstance()->getConexionBd();

        $sql = "SELECT * FROM productos_pedidos WHERE ID_Pedido = :pedido_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':pedido_id', $pedido);
        $stmt->execute();
        $productos = $stmt->fetchAll();

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
        $db = Aplicacion::getInstance()->getConexionBd();

        $pedidos = $this->obtenerPedidosDelUsuario($this->cliente->getId());
        if($pedidos != null) {
            foreach ($pedidos as $pedido) {
                echo "<div class='pedido'>";
                echo "<div class='infoPedido'>";
                echo "<p class='ped'>Pedido: #" .$pedido['ID_Pedido']. "</p>";
                echo "<p class='info'>Total: " .$pedido['Importe']. " €</p>";
                echo "<p class='info'>Fecha: " . $pedido['Fecha'] . "</p>";
                echo "<div class='estado'>";
                    if ($pedido['Fecha'] <= date('Y-m-d')) {
                        echo "<p class='entregado'>Entregado</p>";
                        if ($this->yaValorado($pedido['ID_Pedido'])) {
                            echo "<button class='valorar-btn' onclick='window.location.href=\"" . RUTA_APP . "/includes/vistas/plantillas/mostrarValoracion.php?id={$producto['ID_Producto']}\"'>Valorar</button>";
                        } else {
                            echo "<p>Ya has valorado este producto.</p>";
                        }
                    } else {
                        echo "<p class='pend'>Pendiente</p>";
                    }
                echo "</div>";    
                echo "</div>";
                $productos = $this->obtenerProductosDelPedido($pedido['ID_Pedido']);
                echo "<div class='productosPedido'>";
                foreach($productos as $producto) {
                    $sql = "SELECT * FROM productos WHERE ID_Producto = :producto_id";
                    $stmt = $db->prepare($sql);
                    $stmt->bindParam(':producto_id', $producto['ID_Producto']);
                    $stmt->execute();
                    $prod = $stmt->fetch();

                    echo "<div class='prodPedido'>";
                    //echo "<p>Producto: " . $prod['Nombre'] . "</p>";
                    echo "<p><img src='" . RUTA_APP . $prod['Imagen'] . "' alt='Imagen del producto' id='imgPedidos'>x" . $producto['Cantidad'] . "</p>";
                    //echo "<img src='" . RUTA_APP . $prod['Imagen'] . "' alt='Imagen del producto' id='imgPedidos'>";
                    echo "</div>";
                    //echo "<p>Cantidad: " . $producto['Cantidad'] . "</p>";
                }
                echo "</div>";
                
                echo "</div>";
            }
        } else {
            echo "<p>No existen pedidos.</p>";
        }
    }   
    


    private function yaValorado($pedidoId) {
        // Abrir la conexión a la base de datos
        $db = Aplicacion::getInstance()->getConexionBd();
    
        // Consulta SQL para obtener la valoración del usuario para el pedido
        $sql = "SELECT Valoracion FROM valoraciones WHERE Idusuario = :usuario_id AND ID = :pedido_id";
    
        // Preparar la consulta
        $stmt = $db->prepare($sql);
    
        // Vincular los parámetros
        $usuario_id = $this->cliente->getId();
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':pedido_id', $pedidoId);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $valoracion = $stmt->fetchColumn();
    
        // Cerrar la conexión a la base de datos
    
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

    public function setImporte($totalPedido){

        $this->total = $totalPedido;
    }
}
?>