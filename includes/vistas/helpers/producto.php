<?php
require_once "valoracion.php";

class Producto {
    private $ID;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    //private $pdo;
    private $Imagen;
    private $Valoracion;

    public function __construct($ID, $Nombre, $Descripcion, $Precio, $Imagen) {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Imagen = $Imagen;
     }

    public static function getProducto($ID) {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('SELECT * FROM productos WHERE ID = :ID');
        $stmt->execute(['ID' => $ID]);
        $producto = $stmt->fetch();
    
        return new Producto(
            $producto['ID'],
            $producto['Nombre'],
            $producto['Descripcion'],
            $producto['Precio'],
            $producto['Imagen']
        );
    }
    
    public function getAllProductos() {
        // Obtener la instancia de la conexión a la base de datos
        $pdo = Aplicacion::getInstance()->getConexionBd();
    
        // Preparar la consulta SQL para seleccionar todos los productos
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
    
    

    public function createProducto($Nombre, $Descripcion, $Precio, $Imagen) {
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
    

    public function deleteProducto($ID) {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('DELETE FROM productos WHERE ID = :ID');
        $stmt->execute(['ID' => $ID]);
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getID() {
        return $this->ID;
    }

    public function getImagen(){
        return $this->Imagen;
    }

    public function getPrecio(){
        return $this->Precio;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }
}