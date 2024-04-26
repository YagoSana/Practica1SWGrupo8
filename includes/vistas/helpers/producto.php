<?php
require_once "valoracion.php";
class Producto
{
    private $ID;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    private $Imagen;
    private $Valoracion;
    private $Visible;
    private $Stock;
    private $Tipo;
    private $Reacondicionado;

    public function __construct($ID, $Nombre, $Descripcion, $Precio, $Imagen, $Stock, $Visible, $Tipo, $Reacondicionado)
    {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Imagen = $Imagen;
        $this->Visible = 1;
        $this->Stock = $Stock;
        $this->Tipo = $Tipo;
        $this->Reacondicionado = $Reacondicionado;
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
            $producto['Imagen'], 
            $producto['Stock'], 
            $producto['Visible'],
            $producto['Tipo'],
            $producto['Reacondicionado']
        );
    }

    public static function getProductosPorTipo($tipo)
{
    // Obtener la instancia de la conexión a la base de datos
    $pdo = Aplicacion::getInstance()->getConexionBd();

    // Preparar la consulta SQL para seleccionar todos los productos de un tipo específico
    $stmt = $pdo->prepare('SELECT * FROM productos WHERE Tipo = :tipo ORDER BY Visible DESC');

    // Ejecutar la consulta
    $stmt->execute(['tipo' => $tipo]);

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

    public function getAllProductos()
    {
        // Obtener la instancia de la conexión a la base de datos
        $pdo = Aplicacion::getInstance()->getConexionBd();

        // Preparar la consulta SQL para seleccionar todos los Productos
        $stmt = $pdo->prepare('SELECT * FROM productos ORDER BY Visible DESC');

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

    public function createProducto($Nombre, $Descripcion, $Precio, $Imagen, $Stock, $Tipo)
    {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('INSERT INTO productos (Nombre, Descripcion, Precio, Imagen, Stock, Tipo) VALUES (:Nombre, :Descripcion, :Precio, :Imagen, :Stock, :Tipo)');
        $stmt->execute([
            'Nombre' => $Nombre,
            'Descripcion' => $Descripcion,
            'Precio' => $Precio,
            'Imagen' => $this->Imagen,
            'Stock' => $Stock,
            'Tipo' => $Tipo
        ]);

        $this->ID = $pdo->lastInsertId();
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Imagen = $this->$Imagen;
        $this->Stock = $Stock;
        $this->Tipo = $Tipo;
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


    public function deleteProducto($ID) //en realidad es ocultar un producto porque ya no se vende
    {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('UPDATE productos SET Visible = 0 WHERE ID_Producto = :ID');
        $stmt->execute(['ID' => $ID]);
        return true;
        /*
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
        */
    }

    public function reabastecerProducto()
    {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        if($this->Stock > 0) {
            $sql = 'UPDATE productos SET Visible = 1 WHERE ID_Producto = :ID';
        }
        else {
            $sql = 'UPDATE productos SET Visible = 1, Stock = 10 WHERE ID_Producto = :ID';
        }
    
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['ID' => $this->ID]);
        return true;
    }

    public function bajarCantidadStock($Cantidad) {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('UPDATE productos SET Stock = Stock - :Cantidad WHERE ID_Producto = :ID');
        $stmt->bindParam(':Cantidad', $Cantidad);
        $stmt->bindParam(':ID', $this->ID);
        $stmt->execute();
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function getStock()
    {
        return $this->Stock;
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

    public function getTipo()
    {
        return $this->Tipo;
    }
    public function getVisible()
    {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('SELECT Visible FROM productos WHERE ID_Producto = :ID');
        $stmt->execute(['ID' => $this->ID]);
        $visible = $stmt->fetch();
        return $visible['Visible'];
    }
    public function esReacondicionado($usuario){
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('SELECT Reacondicionado FROM productos WHERE ID_Producto = :ID');
        $stmt->execute(['ID' => $this->ID]);
        $reacondicionado = $stmt->fetch();
        return $reacondicionado['Reacondicionado'];
    }
}