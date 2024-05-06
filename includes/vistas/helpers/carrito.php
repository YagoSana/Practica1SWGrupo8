<?php
ob_start(); // Start output buffering
require_once 'producto.php';
require_once 'pedido.php';
require_once '../../src/usuarios/usuario.php';

class Carrito
{
    private $productos = array(); //Es un array con los productos
    private $estado = 'Pendiente';
    private $pedido;

    //Hacer un construct de la clase carrito???
    //Para hacer un new del pedido

    public function __construct($usuario)
    {
        $this->usuario = $usuario; //el this hace referencia a la clase padre "Usuario"
    }

    public function agregarProducto($producto)
    {
        $this->productos[] = $producto;
        $pdo = Aplicacion::getInstance()->getConexionBd();
        try {
            if (!$this->comprobarProducto($producto->getID())) {
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

    public function comprobarProducto($productoID)
    {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $sql = "UPDATE carrito SET Cantidad = Cantidad + 1 WHERE Producto = :ID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ID' => $productoID]);

        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
    //Revisar
    public function eliminarProducto($productoId)
    {
        $db = Aplicacion::getInstance()->getConexionBd();
        $stmt = $db->prepare('DELETE FROM carrito WHERE Producto = :ID');
        $stmt->execute(['ID' => $productoId]);
    }

    public function restarCantidad($productoId)
    {
        $db = Aplicacion::getInstance()->getConexionBd();
        $sql = "UPDATE carrito SET Cantidad = Cantidad - 1 WHERE Producto = :ID";
        $stmt = $db->prepare($sql);
        $stmt->execute(['ID' => $productoId]);
    }

    public function getProductos()
    {
        $db = Aplicacion::getInstance()->getConexionBd();

        $productos_id = $this->obtenerCarritoDelUsuario($this->usuario->getId());
        return $productos_id;
    }

    public function obtenerCarritoDelUsuario($usuario_id)
    {
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


    public function confirmarPedido($total) {
        // Creamos un nuevo pedido
        $productos_id = $this->obtenerCarritoDelUsuario($this->usuario->getId());
        $productosCarrito = array();

        foreach ($productos_id as $productoID) {
            $producto = Producto::getProducto($productoID['Producto']);

            $stock = $producto->getStock();

            if ($productoID['Cantidad'] > $stock) {
                return false;
            } else {
                $productosCarrito[] = $productoID;
            }
        }

        $this->pedido = new Pedido($this->usuario);

        $fecha = date('Y-m-d'); //Para prueba con las valoraciones (tema dias)
        $this->pedido->setFecha($fecha);

        $db = Aplicacion::getInstance()->getConexionBd();
        $this->pedido->setImporte($total);
        $idPedido = $this->pedido->agregarPedido();
        // Agregamos los Productos al Pedido
        foreach ($productosCarrito as $productoID) {
            $producto = Producto::getProducto($productoID['Producto']);
            $this->pedido->agregarProducto($idPedido, $producto, $productoID['Cantidad']);
            $stock = $producto->getStock();
            $producto->bajarCantidadStock($productoID['Cantidad']);

            if ($productoID['Cantidad'] == $stock) {
                $producto->deleteProducto($producto->getID());
            }
        }

        $this->productos = [];
        // Aquí es donde ajustamos los puntos del wallet
        $puntos = Usuario::getPuntos($this->usuario->getId());
        if ($total <= $puntos) {
            // Si el total es menor o igual que los puntos del wallet, restamos el total de los puntos
            Usuario::quitarWalletPoints($total, $this->usuario->getId());
        } else {
            // Si el total es mayor que los puntos del wallet, eliminamos todos los puntos del wallet
            Usuario::quitarWalletPoints($puntos, $this->usuario->getId());
        }
        $this->vaciarCarrito();
        $this->pedido->confirmarPedido();
        // Cambiamos el estado del carrito a 'Enviado'
        $this->estado = 'Enviado';

        return true;
    }

    public function vaciarCarrito()
    {
        $db = Aplicacion::getInstance()->getConexionBd();
        $stmt = $db->prepare('DELETE FROM carrito');
        $stmt->execute();
    }

    public function getPedido()
    {

        return $this->pedido;
    }

    public function getCantidadProducto($producto_id)
    {
        $db = Aplicacion::getInstance()->getConexionBd();
        $stmt = $db->prepare('SELECT Cantidad FROM carrito WHERE Producto = :ID');
        $stmt->execute(['ID' => $producto_id]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        $cantidad = $resultado['Cantidad'];
        return $cantidad;
    }
}

ob_end_flush();
