<?php
class Venta {

    private $ID;
    private $ID_Usuario;
    private $Nombre;
    private $Descripcion;
    private $Imagen;
    private $Estado;
    private $Precio;
    private $Categoria;

    public function __construct($ID, $ID_Usuario, $Nombre, $Descripcion, $Imagen, $Precio, $Categoria, $Estado) {

        $this->ID = $ID;
        $this->ID_Usuario = $ID_Usuario;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Imagen = $Imagen;
        $this->Estado = $Estado;
        $this->Precio = $Precio;
        $this->Categoria = $Categoria;

    }

    public function createVenta() {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('INSERT INTO ventas (ID_Usuario, Nombre, Descripcion, Imagen, Precio, Categoria, Estado) VALUES (:ID_Usuario, :Nombre, :Descripcion, :Imagen, :Precio, :Categoria, :Estado)');
        $stmt->execute([
            'ID_Usuario' => $this->ID_Usuario,
            'Nombre' => $this->Nombre,
            'Descripcion' => $this->Descripcion,
            'Imagen' => $this->Imagen,
            'Precio' => $this->Precio,
            'Categoria' => $this->Categoria,
            'Estado' => $this->Estado
        ]);
    
        $this->ID = $pdo->lastInsertId();
    }

    public static function getAllVentas() {
        // Obtener la instancia de la conexión a la base de datos
        $pdo = Aplicacion::getInstance()->getConexionBd();

        // Preparar la consulta SQL para seleccionar todas las Ventas con estado "Pendiente"
        $stmt = $pdo->prepare('SELECT * FROM ventas WHERE Estado = :Estado');

        // Ejecutar la consulta
        $stmt->execute(['Estado' => 'Pendiente']);

        // Obtener todos los resultados como un array asociativo
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Verificar si se obtuvieron resultados
        if ($result === false) {
            // Si no hay resultados, mostrar un mensaje de error
            return NULL;   
        }

        // Devolver el resultado
        return $result;
    }

    public static function getVentaById($ID_Venta) {

        $pdo = Aplicacion::getInstance()->getConexionBd();
    
        $stmt = $pdo->prepare('SELECT * FROM ventas WHERE ID_Venta = :ID_Venta');

        $stmt->execute(['ID_Venta' => $ID_Venta]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verificar si se obtuvo un resultado
        if ($result === false) {
            die('Error al obtener la venta de la base de datos');
        }
    
        $venta = new Venta($result['ID_Venta'], $result['ID_Usuario'], $result['Nombre'], $result['Descripcion'], $result['Imagen'], $result['Precio'], $result['Categoria'], $result['Estado']);
        // Devolver el objeto Venta
        return $venta;
    }
    

    public function setEstado($estado) {
        // Obtener la instancia de la conexión a la base de datos
        $pdo = Aplicacion::getInstance()->getConexionBd();
    
        // Preparar la consulta SQL para actualizar el estado de la venta
        $stmt = $pdo->prepare('UPDATE ventas SET Estado = :Estado WHERE ID_Venta = :ID_Venta');
    
        // Ejecutar la consulta
        $stmt->execute(['Estado' => $estado, 'ID_Venta' => $this->ID]);
    }

    public static function editVenta($viejouser, $Nombre, $Descripcion, $Precio, $Categoria, $Estado) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $stmt = $conn->prepare('UPDATE ventas SET Nombre = :Nombre, Descripcion = :Descripcion, Precio = :Precio, Categoria = :Categoria, Estado = :Estado  WHERE ID_Usuario = '.$viejouser);
        $stmt->execute([
            'Nombre' => $Nombre,
            'Descripcion' => $Descripcion,
            'Precio' => $Precio,
            'Categoria' => $Categoria,
            'Estado' => $Estado
        ]);
    }

    
    public function getID() {
        return $this->ID;
    }

    public function getIDUsuario() {
        return $this->ID_Usuario;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getImagen() {
        return $this->Imagen;
    }

    public function getEstado() {
        return $this->Estado;
    }

    public function getPrecio() {
        return $this->Precio;
    }

    public function getCategoria() {
        return $this->Categoria;
    }
    
}