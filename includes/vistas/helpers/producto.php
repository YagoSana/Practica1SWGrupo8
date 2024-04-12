<?php
require_once "valoracion.php";
class Producto
{
    private $ID;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    //private $pdo;
    private $Imagen;
    private $Valoracion;

    public function __construct($ID, $Nombre, $Descripcion, $Precio, $Imagen)
    {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Imagen = $Imagen;
    }

    public static function getProducto($ID)
    {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('SELECT * FROM productos WHERE ID_Producto = :ID');
        $stmt->execute(['ID' => $ID]);
        $producto = $stmt->fetch();

        return new Producto(
            $producto['ID_Producto'],
            $producto['Nombre'],
            $producto['Descripcion'],
            $producto['Precio'],
            $producto['Imagen']
        );
    }

    public function getAllProductos()
    {
        // Obtener la instancia de la conexión a la base de datos
        $pdo = Aplicacion::getInstance()->getConexionBd();

        // Preparar la consulta SQL para seleccionar todos los Productos
        $stmt = $pdo->prepare('SELECT * FROM productos');

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener todos los resultados como un array asociativo
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verificar si se obtuvieron resultados
        if ($result === false) {
            // Si no hay resultados, mostrar un mensaje de error
            die('Error al obtener los productos de la base de datos');
        }

        // Devolver el resultado
        return $result;
    }

    public function createProducto($Nombre, $Descripcion, $Precio, $Imagen)
    {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('INSERT INTO productos (Nombre, Descripcion, Precio, Imagen) VALUES (:Nombre, :Descripcion, :Precio, :Imagen)');
        $stmt->execute([
            'Nombre' => $Nombre,
            'Descripcion' => $Descripcion,
            'Precio' => $Precio,
            'Imagen' => $this->Imagen
        ]);

        $this->ID = $pdo->lastInsertId();
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Imagen = $this->$Imagen;
    }

    public static function obtenerPedidosDeProducto($producto)
    {
        $db = Aplicacion::getInstance()->getConexionBd();

        $sql = "SELECT * FROM productos_pedidos WHERE ID_Producto = :producto_id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':producto_id', $producto);
        $stmt->execute();
        $pedidos = $stmt->fetchAll();

        return $pedidos;
    }


    public function deleteProducto($ID)
    {
        $cancelar = false;
        $pdo = Aplicacion::getInstance()->getConexionBd();

        // Comprobar si el producto está en la tabla 'productos_pedidos'
        $stmt = $pdo->prepare('SELECT * FROM productos_pedidos WHERE ID_Producto = :ID');
        $stmt->execute(['ID' => $ID]);
        if ($stmt->fetch()) {
            $cancelar = true;
        }

        // Comprobar si el producto está en la tabla 'carrito'
        $stmt = $pdo->prepare('SELECT * FROM carrito WHERE Producto = :ID');
        $stmt->execute(['ID' => $ID]);
        if ($stmt->fetch()) {
            $cancelar = true;
        }

        // Comprobar si el producto está en la tabla 'valoraciones'
        $stmt = $pdo->prepare('SELECT * FROM valoraciones WHERE ID = :ID');
        $stmt->execute(['ID' => $ID]);
        if ($stmt->fetch()) {
            $cancelar = true;
        }
        if ($cancelar == false) {
        
        //buscar si esta en otras tablas
        $stmt = $pdo->prepare('DELETE FROM productos WHERE ID_Producto = :ID');
        $stmt->execute(['ID' => $ID]);
        return true ;
        }
        else{
            $contenido = <<<EOS
            <h2> No se puede eliminar este producto, esta siendo procesado </h2>
            EOS;
            require_once RAIZ_APP . '/includes/vistas/plantillas/plantilla.php';
        }
        

    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function getID()
    {
        return $this->ID;
    }

    public function getImagen()
    {
        return $this->Imagen;
    }

    public function getPrecio()
    {
        return $this->Precio;
    }

    public function getDescripcion()
    {
        return $this->Descripcion;
    }
}