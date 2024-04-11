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

    public function agregarProducto($producto) {
        $this->productos[] = $producto;
        $pdo = Aplicacion::getInstance()->getConexionBd();
        try {
            if(!$this->comprobarProducto($producto->getID())) {
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

    public function comprobarProducto($productoID) {
        $pdo = Aplicacion::getInstance()->getConexionBd();
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
    public function eliminarProducto($productoId) {
        $db = Aplicacion::getInstance()->getConexionBd();
        $stmt = $db->prepare('DELETE FROM carrito WHERE Producto = :ID');
        $stmt->execute(['ID' => $productoId]);
    }

    public function restarCantidad($productoId) {
        $db = Aplicacion::getInstance()->getConexionBd();
        $sql = "UPDATE carrito SET Cantidad = Cantidad - 1 WHERE Producto = :ID";
        $stmt = $db->prepare($sql);
        $stmt->execute(['ID' => $productoId]);

    }

    public function mostrarProductos() {
        $db = Aplicacion::getInstance()->getConexionBd();

        $productos_id = $this->obtenerCarritoDelUsuario($this->usuario->getId());
        $total = 0;
        if ($productos_id == null) {
            echo "El carrito está vacío.";
        } else {
            foreach ($productos_id as $producto_id) {
                $producto = Producto::getProducto($producto_id['Producto']);
                echo "<div class='producto'>";
                echo "<img src='" . RUTA_APP . $producto->getImagen() . "' alt='Imagen del producto'>";
                echo "<div>";
                echo "<h3>" . $producto->getNombre() . "</h3>";
                // Aquí asumimos que el producto tiene un método getDescripcion()
                echo "<p>Precio: " . $producto->getPrecio() . " €</p>";
                $total += $producto->getPrecio() * $producto_id['Cantidad'];
                if (isset($_SESSION["login"])) {
                    // El usuario ha iniciado sesión, muestra el botón "Eliminar"
                    echo '<div class="form-container">';
                        echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarProductoCarrito.php' method='post'>";
                            echo "<input type='hidden' name='productoId' value='" . $producto->getID() . "'>";
                            echo '<button type="submit" class="btn" name="accion" value="decrementar">-</button>';
                            echo '<span id="contador">' .$producto_id['Cantidad'].'</span>';
                            echo '<button type="submit" class="btn" name="accion" value="incrementar">+</button>';
                            echo "<button class='borrar' type='submit' name='accion' value='eliminar'>Eliminar</button>";
                        echo "</form>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
            }
            if (isset($_SESSION["login"])) {
                // El usuario ha iniciado sesión, muestra el botón "Confirmar Pedido"
                echo "<div class='cont'>";
                echo '<span class="total">Total: ' .$total.' €</span>';
                echo '<form action="' . RUTA_APP . '/includes/vistas/helpers/procesarCompra.php" method="POST">
                    <input type="submit" name="confirmar" value="Confirmar Pedido" class="boton-confirmar">
                </form>';
                echo '</div>';
            }
        }
    }

    public function obtenerCarritoDelUsuario($usuario_id) {
        // Abrir la conexión a la base de datos
        $db = Aplicacion::getInstance()->getConexionBd();
    
        // Consulta SQL para obtener todos los productos del usuario
        $sql = "SELECT * FROM carrito WHERE Cliente = :usuario_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->execute();
        $productos = $stmt->fetchAll();
    
        // Cerrar la conexión a la base de datos
    
        // Devolvemos todos los productos del usuario
        return $productos;
    }


    public function confirmarPedido() {
        // Creamos un nuevo pedido
        $this->pedido = new Pedido($this->usuario);
        // Establecemos la fecha de entrega para dentro de un par de dias
        $dias = rand(2, 5);
        $fecha = date('Y-m-d', strtotime("+$dias days"));

        //$fecha = date('Y-m-d'); //Para prueba con las valoraciones (tema dias)
        $this->pedido->setFecha($fecha);

        $db = Aplicacion::getInstance()->getConexionBd();$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
    
        $productos_id = $this->obtenerCarritoDelUsuario($this->usuario->getId());

        // Agregamos los productos al pedido
        foreach($productos_id as $productoID){
            $producto = Producto::getProducto($productoID['Producto'], $db);
            $this->pedido->agregarProducto($producto, $productoID['Cantidad']);
        }
    
        $this->productos = [];

        $this->vaciarCarrito();
    
        $this->pedido->confirmarPedido();
        // Cambiamos el estado del carrito a 'Enviado'
        $this->estado = 'Enviado';
        // Cerrar la conexión a la base de datos
    }

    public function vaciarCarrito() {
        $db = Aplicacion::getInstance()->getConexionBd();
        $stmt = $db->prepare('DELETE FROM carrito');
        $stmt->execute();
    }

    public function getPedido() {

        return $this->pedido;
    }

    public function getCantidadProducto($producto_id) {
        $db = Aplicacion::getInstance()->getConexionBd();
        $stmt = $db->prepare('SELECT Cantidad FROM carrito WHERE Producto = :ID');
        $stmt->execute(['ID' => $producto_id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $cantidad = $resultado['Cantidad'];
        return $cantidad;
    }
}
?>