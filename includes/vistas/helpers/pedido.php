<?php
namespace es\ucm\fdi\sw\vistas\helpers;

class Pedido
{
    private $idPedido;
    private $fechaEntrega;
    private $cliente;
    //Hay que implementar que cada vez que el pedido se entregue todos
    private $total;
    private $Productos = array(); //Hay que guardarlos en la base de datos los Productos y los Productos entregados
    private $ProductosEntregados = array(); //Hay que implementar que cada vez que el Pedido se entregue todos
                                            //los Productos que habia en la variable Producto se guarden aqui, para luego poder valorarlos y etc
    private $cantidad;
    private $estado;

    public function __construct($Usuario) {
        
        $this->cliente = $Usuario;
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

        $idPedido = $db->lastInsertid();
    }

    public function agregarProducto($producto, $cantidad) {
        $this->productos[] = $producto;
        $db = Aplicacion::getInstance()->getConexionBd();
        // Agregar el Producto a la base de datos
        try {
            $sql = "INSERT INTO Pedidos (Fecha, Cliente, Producto, Cantidad) VALUES (:fecha, :cliente, :Producto_id, :cantidad)";
            $stmt = $db->prepare($sql);

            // Asignar los resultados a variables
            $fecha = $this->fechaEntrega;
            $cliente = $this->cliente->getId();
            $Producto_id = $Producto->getID();
            
            // Pasar las variables a bindParam
            $stmt->bindParam(':fecha', $fecha);
            $stmt->bindParam(':cliente', $cliente);
            $stmt->bindParam(':Producto_id', $Producto_id);
            $stmt->bindParam(':cantidad', $cantidad);

            $stmt->execute();
            
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function obtenerProductosDelUsuario($Usuario_id) {
        // Abrir la conexión a la base de datos
        $db = Aplicacion::getInstance()->getConexionBd();
    
        // Consulta SQL para obtener todos los Productos del Usuario
        $sql = "SELECT * FROM Pedidos WHERE Cliente = :Usuario_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':Usuario_id', $Usuario_id);
        $stmt->execute();
        $Productos = $stmt->fetchAll();
    
        // Devolvemos todos los Productos del Usuario
        return $Productos;
    }
    


    public function entregarPedido() {
        if ($this->fechaEntrega <= date('Y-m-d')) {
            $this->estado = 'entregado';
        } else {
            echo "Aún no has recibido tu Pedido.";
        }
    }

    public function mostrarPedidos() {
        // Abrir la conexión a la base de datos
        $db = Aplicacion::getInstance()->getConexionBd();

        $Pedidos = $this->obtenerProductosDelUsuario($this->cliente->getId());
        if($Pedidos != null) {
            foreach ($Pedidos as $Pedido) {
            // Consulta SQL para obtener los detalles del Producto
                $sql = "SELECT * FROM Productos WHERE ID_Producto = :Producto_id";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(':Producto_id', $Pedido['Producto']);
                $stmt->execute();
                $Producto = $stmt->fetch();

                echo "<p>Producto: " . $Producto['Nombre'] . "</p>";
                echo "<div class='Producto'>";
                echo "<img src='" . RUTA_APP . $Producto['Imagen'] . "' alt='Imagen del Producto' id='imgPedidos'>";
                echo "</div>";
                echo "<p>Cantidad: " . $Pedido['Cantidad'] . "</p>";
                echo "<p>Fecha: " . $Pedido['Fecha'] . "</p>";
                if ($Pedido['Fecha'] <= date('Y-m-d')) {
                    echo "<p>Estado: Entregado</p>";
                    if ($this->yaValorado($Pedido['ID_Pedido'])) {
                        echo "<p><button onclick='window.location.href=\"" . RUTA_APP . "/includes/vistas/plantillas/mostrarValoracion.php?id={$Pedido['Producto']}\"'>Valorar</button></p>";
                    } else {
                        echo "<p>Ya has valorado este Producto.</p>";
                    }
                } else {
                    echo "<p>Estado: Pendiente</p>";
                }
            }
        } else {
            echo "<p>No existen Pedidos.</p>";
        }
    }   
    


    private function yaValorado($PedidoId) {
        // Abrir la conexión a la base de datos
        $db = Aplicacion::getInstance()->getConexionBd();
    
        // Consulta SQL para obtener la valoración del Usuario para el Pedido
        $sql = "SELECT Valoracion FROM Valoraciones WHERE IdUsuario = :Usuario_id AND ID = :Pedido_id";
    
        // Preparar la consulta
        $stmt = $db->prepare($sql);
    
        // Vincular los parámetros
        $Usuario_id = $this->cliente->getId();
        $stmt->bindParam(':Usuario_id', $Usuario_id);
        $stmt->bindParam(':Pedido_id', $PedidoId);
    
        // Ejecutar la consulta
        $stmt->execute();
    
        // Obtener el resultado
        $Valoracion = $stmt->fetchColumn();
    
        // Cerrar la conexión a la base de datos
    
        // Si la valoración es igual a 0, significa que el Usuario no ha valorado el Pedido
        return $Valoracion == 0;
    }
    
    
    public function confirmarPedido() {
        // Cambiamos el estado del Pedido a 'Pendiente'
        $this->estado = 'Pendiente';
        
        echo "Pedido confirmado. Estado del Pedido: " . $this->estado;
        echo "Su Pedido llegara el: " . $this->fechaEntrega;
    }


    public function getEstado()
    {
        return $this->estado;
    }

    public function getCliente(){

        return $this->cliente;
    }

    public function setCliente($Usuario){

        $this->cliente = $Usuario;
    }

    public function setFecha($fecha){

        $this->fechaEntrega = $fecha;
    }

    public function setImporte($totalPedido){

        $this->total = $totalPedido;
    }
}
?>