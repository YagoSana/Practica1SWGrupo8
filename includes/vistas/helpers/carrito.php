<?php

namespace es\ucm\fdi\sw\vistas\helpers;
//require_once 'Producto.php';
use es\ucm\fdi\sw\vistas\helpers\Producto;
//require_once 'Pedido.php';
use es\ucm\fdi\sw\vistas\helpers\Pedido;
//require_once 'Database.php';
use es\ucm\fdi\sw\vistas\helpers\Database;
use PDO;

class Carrito {
    private $Productos = array(); //Es un array con los Productos
    private $estado = 'Pendiente';
    private $Pedido;
    private $total = 0;

    //Hacer un construct de la clase Carrito???
    //Para hacer un new del Pedido

    public function __construct($Usuario){
        $this->Usuario = $Usuario; //el this hace referencia a la clase padre "Usuario"
    }

    public function agregarProducto($Producto) {
        $this->Productos[] = $Producto;
        $pdo = Aplicacion::getInstance()->getConexionBd();
        try {
            if(!$this->comprobarProducto($Producto->getID())) {
                $sql = "INSERT INTO Carrito (Cliente, Producto, Cantidad) VALUES (:cliente, :Producto_id, :cantidad)";
                $stmt = $pdo->prepare($sql);

                // Asignar los resultados a variables
                $cliente = $this->Usuario->getId();
                $Producto_id = $Producto->getID();
                $cantidad = 1; // Asegúrate de definir $cantidad

                // Pasar las variables a bindParam
                $stmt->bindParam(':cliente', $cliente);
                $stmt->bindParam(':Producto_id', $Producto_id);
                $stmt->bindParam(':cantidad', $cantidad);

                $stmt->execute();
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

    }

    public function comprobarProducto($ProductoID) {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $sql = "UPDATE Carrito SET Cantidad = Cantidad + 1 WHERE Producto = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ID' => $ProductoID]);
        
        if($stmt->rowCount() > 0) {
            return true;
        }
        else {
            return false;
        }

    }
    //Revisar
    public function eliminarProducto($ProductoId) {
        $db = Aplicacion::getInstance()->getConexionBd();
        $stmt = $db->prepare('DELETE FROM Carrito WHERE Producto = :ID');
        $stmt->execute(['ID' => $ProductoId]);
    }

    public function restarCantidad($ProductoId) {
        $db = Aplicacion::getInstance()->getConexionBd();
        $sql = "UPDATE Carrito SET Cantidad = Cantidad - 1 WHERE Producto = :ID";
        $stmt = $db->prepare($sql);
        $stmt->execute(['ID' => $ProductoId]);

    }

    public function mostrarProductos() {
        $db = Aplicacion::getInstance()->getConexionBd();

        $Productos_id = $this->obtenerCarritoDelUsuario($this->Usuario->getId());
        $this->total = 0;
        if ($Productos_id == null) {
            echo "El Carrito está vacío.";
        } else {
            foreach ($Productos_id as $Producto_id) {
                echo $this->total;
                $Producto = Producto::getProducto($Producto_id['Producto']);
                echo "<div class='Producto'>";
                echo "<img src='" . RUTA_APP . $Producto->getImagen() . "' alt='Imagen del Producto'>";
                echo "<div>";
                echo "<h3>" . $Producto->getNombre() . "</h3>";
                // Aquí asumimos que el Producto tiene un método getDescripcion()
                echo "<p>Precio: " . $Producto->getPrecio() . " €</p>";
                $this->total += $Producto->getPrecio() * $Producto_id['Cantidad'];
               
                if (isset($_SESSION["login"])) {
                    // El Usuario ha iniciado sesión, muestra el botón "Eliminar"
                    echo '<div class="form-container">';
                        echo "<form action='" . RUTA_APP . "/includes/vistas/helpers/procesarProductoCarrito.php' method='post'>";
                            echo "<input type='hidden' name='ProductoId' value='" . $Producto->getID() . "'>";
                            echo '<button type="submit" class="btn" name="accion" value="decrementar">-</button>';
                            echo '<span id="contador">' .$Producto_id['Cantidad'].'</span>';
                            echo '<button type="submit" class="btn" name="accion" value="incrementar">+</button>';
                            echo "<button class='borrar' type='submit' name='accion' value='eliminar'>Eliminar</button>";
                        echo "</form>";
                    echo "</div>";
                }
                echo "</div>";
                echo "</div>";
            }
            if (isset($_SESSION["login"])) {
                // El Usuario ha iniciado sesión, muestra el botón "Confirmar Pedido"
                echo "<div class='cont'>";
                echo '<span class="total">Total: ' .$this->total.' €</span>';
                echo '<form action="' . RUTA_APP . '/includes/vistas/helpers/procesarCompra.php" method="POST">
                    <input type="submit" name="confirmar" value="Confirmar Pedido" class="boton-confirmar">
                </form>';
                echo '</div>';
            }
        }
    }

    public function obtenerCarritoDelUsuario($Usuario_id) {
        // Abrir la conexión a la base de datos
        $db = Aplicacion::getInstance()->getConexionBd();
    
        // Consulta SQL para obtener todos los Productos del Usuario
        $sql = "SELECT * FROM Carrito WHERE Cliente = :Usuario_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':Usuario_id', $Usuario_id);
        $stmt->execute();
        $Productos = $stmt->fetchAll();
    
        // Cerrar la conexión a la base de datos
    
        // Devolvemos todos los Productos del Usuario
        return $Productos;
    }


    public function confirmarPedido() {
        // Creamos un nuevo Pedido
        $this->Pedido = new Pedido($this->Usuario);
        // Establecemos la fecha de entrega para dentro de un par de dias
        $dias = rand(2, 5);
        $fecha = date('Y-m-d', strtotime("+$dias days"));

        //$fecha = date('Y-m-d'); //Para prueba con las Valoraciones (tema dias)
        $this->Pedido->setFecha($fecha);

        $db = Aplicacion::getInstance()->getConexionBd();$db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
    
        $Productos_id = $this->obtenerCarritoDelUsuario($this->Usuario->getId());

        $this->Pedido->setImporte($this->total);

        $this->Pedido->agregarPedido();
        // Agregamos los Productos al Pedido
        foreach($Productos_id as $ProductoID){
            $Producto = Producto::getProducto($ProductoID['Producto'], $db);
            $this->Pedido->agregarProducto($Producto, $ProductoID['Cantidad']);
        }
    
        $this->Productos = [];

        $this->vaciarCarrito();
    
        $this->Pedido->confirmarPedido();
        // Cambiamos el estado del Carrito a 'Enviado'
        $this->estado = 'Enviado';
        // Cerrar la conexión a la base de datos
    }

    public function vaciarCarrito() {
        $db = Aplicacion::getInstance()->getConexionBd();
        $stmt = $db->prepare('DELETE FROM Carrito');
        $stmt->execute();
    }

    public function getPedido() {

        return $this->Pedido;
    }

    public function getCantidadProducto($Producto_id) {
        $db = Aplicacion::getInstance()->getConexionBd();
        $stmt = $db->prepare('SELECT Cantidad FROM Carrito WHERE Producto = :ID');
        $stmt->execute(['ID' => $Producto_id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $cantidad = $resultado['Cantidad'];
        return $cantidad;
    }
}
?>