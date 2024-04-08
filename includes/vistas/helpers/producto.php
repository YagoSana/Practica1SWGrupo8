<?php
require "valoracion.php";

class Producto {
    private $ID;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    private $pdo;
    private $Imagen;
    private $Valoracion;

    public function __construct($ID, $Nombre, $Descripcion, $Precio, $Imagen, $pdo) {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Imagen = $Imagen;
        $this->pdo = $pdo;
    
    }
    
   

    public function getProducto($ID) {
        $stmt = $this->pdo->prepare('SELECT * FROM productos WHERE ID = :ID');
        $stmt->execute(['ID' => $ID]);
        $producto = $stmt->fetch();
    
        return new Producto(
            $producto['ID'],
            $producto['Nombre'],
            $producto['Descripcion'],
            $producto['Precio'],
            $producto['Imagen'],
            $this->pdo
        );
    }
    

    public function createProducto($Nombre, $Descripcion, $Precio, $Imagen) {
        $stmt = $this->pdo->prepare('INSERT INTO productos (Nombre, Descripcion, Precio, Imagen) VALUES (:Nombre, :Descripcion, :Precio, :Imagen)');
        $stmt->execute([
            'Nombre' => $Nombre,
            'Descripcion' => $Descripcion,
            'Precio' => $Precio,
            'Imagen' => $this->Imagen 
        ]);
    
        $this->ID = $this->pdo->lastInsertId();
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Imagen = $this->$Imagen;
    }
    

    public function deleteProducto($ID) {
        $stmt = $this->pdo->prepare('DELETE FROM productos WHERE ID = :ID');
        $stmt->execute(['ID' => $ID]);
    }
}

?>