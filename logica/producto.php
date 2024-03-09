<?php

class Producto {
    private $ID;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    private $pdo;

    public function __construct($ID, $Nombre, $Descripcion, $Precio, $pdo) {
        $this->ID = $ID;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
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
    }

    public function createProducto($ID, $Nombre, $Descripcion, $Precio) {
        $stmt = $this->pdo->prepare('INSERT INTO productos (ID, Nombre, Descripcion, Precio) VALUES (:ID, :Nombre, :Descripcion, :Precio)');
        $stmt->execute([
            'ID' => $ID,
            'Nombre' => $Nombre,
            'Descripcion' => $Descripcion,
            'Precio' => $Precio
        ]);

        $this->ID = $this->pdo->lastInsertId();
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
    }

    public function deleteProducto($ID) {
        $stmt = $this->pdo->prepare('DELETE FROM productos WHERE ID = :ID');
        $stmt->execute(['ID' => $ID]);
    }
}

?>