<?php

class Producto {
    private $ID;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    private $pdo;
    private $Imagen;

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

        $this->ID = $producto['ID'];
        $this->Nombre = $producto['Nombre'];
        $this->Descripcion = $producto['Descripcion'];
        $this->Precio = $producto['Precio'];
        $this->Imagen = $producto['Imagen'];
    }

    public function createProducto($ID, $Nombre, $Descripcion, $Precio) {
        $stmt = $this->pdo->prepare('INSERT INTO productos (ID, Nombre, Descripcion, Precio, Imagen) VALUES (:ID, :Nombre, :Descripcion, :Precio, :Imagen)');
        $stmt->execute([
            'ID' => $ID,
            'Nombre' => $Nombre,
            'Descripcion' => $Descripcion,
            'Precio' => $Precio,
            'Imagen' => $this->Imagen 
        ]);
    
        $this->ID = $this->pdo->lastInsertId();
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Imagen = $this->Imagen;
    }

    public function deleteProducto($ID) {
        $stmt = $this->pdo->prepare('DELETE FROM productos WHERE ID = :ID');
        $stmt->execute(['ID' => $ID]);
    }
}

?>