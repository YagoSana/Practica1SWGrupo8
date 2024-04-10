<?php
require_once 'producto.php';
require_once 'pedido.php';
require_once 'baseDatos.php';

class Carrito {
    private $productos = array(); //Es un array con los productos
    private $estado = 'Pendiente';
    private $pedido;

    //Hacer un construct de la clase carrito???
    //Para hacer un new del pedido

    public function __construct($usuario){
        $this->usuario = $usuario; //el this hace referencia a la clase padre "Usuario"
    }

    public function agregarProducto($producto, $pdo) {
        $this->productos[] = $producto;
        
        try {
            if(!$this->comprobarProducto($pdo, $producto->getID())) {
            $sql = "INSERT INTO carrito (Cliente, Producto, Cantidad) VALUES (:cliente, :producto_id, :cantidad)";
            $stmt = $pdo->prepare($sql);

            // Asignar los resultados a variables
            $cliente = $this->usuario->getId();
            $producto_id = $producto->getID();
            $cantidad = 1; // Asegúrate de definir $cantidad

            // Pasar las variables a bindParam
            $stmt->bindParam(':cliente', $cliente);
            $stmt->bindParam(':producto_id', $producto_id);
            $stmt->bindParam(':cantidad', $cantidad);

            $stmt->execute();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    public function comprobarProducto($pdo, $productoID) {
        $sql = "UPDATE carrito SET Cantidad = Cantidad + 1 WHERE Producto = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ID' => $productoID]);
        
        if($stmt->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }

    }
    //Revisar
    public function eliminarProducto($productoId, $db) {
        $stmt = $db->getConnection()->prepare('DELETE FROM carrito WHERE Producto = :ID');
        $stmt->execute(['ID' => $productoId]);
    }

    public function restarCantidad($productoId, $db) {
        $sql = "UPDATE carrito SET Cantidad = Cantidad - 1 WHERE Producto = :ID";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->execute(['ID' => $productoId]);

    }

    public function mostrarProductos() {
        $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        $db->connect();

        $productos_id = $this->obtenerCarritoDelUsuario($this->usuario->getId());

        if ($productos_id == null) {
            echo "El carrito está vacío.";
        } else {
            foreach ($productos_id as $producto_id) {
                $producto = Producto::getProducto($producto_id['Producto'], $db->getConnection());
                echo "<div class='producto'>";
                echo "<img src='" . RUTA_APP . $producto->getImagen() . "' alt='Imagen del producto'>";
                echo "<div>";
                echo "<h3>" . $producto->getNombre() . "</h3>";
                // Aquí asumimos que el producto tiene un método getDescripcion()
                echo "<p>Unidades: " . $producto_id['Cantidad'] . "</p>";
                echo "<p>Precio: " . $producto->getPrecio() . " €</p>";
                
                if (isset($_SESSION["login"])) {
                    // El usuario ha iniciado sesión, muestra el botón "Eliminar"
                    echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarEliminacionCarrito.php' method='post'>";
                    echo "<input type='hidden' name='productoId' value='" . $producto->getID() . "'>";
                    echo "<button type='submit' name='eliminar'>Eliminar</button>";
                    echo "</form>";
                }
                echo "</div>";
                echo "</div>";
            }
            if (isset($_SESSION["login"])) {
                // El usuario ha iniciado sesión, muestra el botón "Confirmar Pedido"
                echo '<form action="' . RUTA_APP . '/includes/vistas/helpers/procesarCompra.php" method="POST">
                    <input type="submit" name="confirmar" value="Confirmar Pedido">
                </form>';
            }
        }
    }

    public function obtenerCarritoDelUsuario($usuario_id) {
        // Abrir la conexión a la base de datos
        $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        $db->connect();
    
        // Consulta SQL para obtener todos los productos del usuario
        $sql = "SELECT * FROM carrito WHERE Cliente = :usuario_id";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        $productos = $stmt->fetchAll();
    
        // Cerrar la conexión a la base de datos
        $db->close();
    
        // Devolvemos todos los productos del usuario
        return $productos;
    }


    public function confirmarPedido() {
        // Creamos un nuevo pedido
        $this->pedido = new Pedido($this->usuario);
        // Establecemos la fecha de entrega para dentro de un par de días
        $dias = rand(2, 5);
        $fecha = date('Y-m-d', strtotime("+$dias days"));

        $this->pedido->setFecha($fecha);

        // Abrir la conexión a la base de datos
        $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        $db->connect();
    
        $productos_id = $this->obtenerCarritoDelUsuario($this->usuario->getId());

        // Agregamos los productos al pedido
        foreach($productos_id as $productoID){
            $producto = Producto::getProducto($productoID['Producto'], $db->getConnection());
            $this->pedido->agregarProducto($producto, $productoID['Cantidad'], $db);
        }
    
        // Vaciamos el carrito
        $this->productos = [];

        $this->vaciarCarrito($db);
    
        $this->pedido->confirmarPedido();
        // Cambiamos el estado del carrito a 'Enviado'
        $this->estado = 'Enviado';
        // Cerrar la conexión a la base de datos
        $db->close();
    }

    public function vaciarCarrito($db) {
        $stmt = $db->getConnection()->prepare('DELETE FROM carrito');
        $stmt->execute();
    }

    public function getPedido() {

        return $this->pedido;
    }
}
?>