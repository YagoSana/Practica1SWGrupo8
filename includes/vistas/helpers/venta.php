<?php
class Venta {

    private $ID;
    private $ID_Usuario;
    private $Nombre;
    private $Descripcion;
    private $Imagen;
    private $Estado;

    public function __construct($ID, $ID_Usuario, $Nombre, $Descripcion, $Imagen, $Estado) {

        $this->ID = $ID;
        $this->ID_Usuario = $ID_Usuario;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Imagen = $Imagen;
        $this->Estado = $Estado;

    }

    public function createVenta($ID_Usuario, $Nombre, $Descripcion, $Imagen, $Estado)
{
    $pdo = Aplicacion::getInstance()->getConexionBd();
    $stmt = $pdo->prepare('INSERT INTO ventas (ID_Usuario, Nombre, Descripcion, Imagen, Estado) VALUES (:ID_Usuario, :Nombre, :Descripcion, :Imagen, :Estado)');
    $stmt->execute([
        'ID_Usuario' => $ID_Usuario,
        'Nombre' => $Nombre,
        'Descripcion' => $Descripcion,
        'Imagen' => $Imagen,
        'Estado' => $Estado
    ]);

    $this->ID_Venta = $pdo->lastInsertId();
    $this->ID_Usuario = $ID_Usuario;
    $this->Nombre = $Nombre;
    $this->Descripcion = $Descripcion;
    $this->Imagen = $Imagen;
    $this->Estado = $Estado;
}

}