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

    public function createVenta() {
        $pdo = Aplicacion::getInstance()->getConexionBd();
        $stmt = $pdo->prepare('INSERT INTO ventas (ID_Usuario, Nombre, Descripcion, Imagen, Estado) VALUES (:ID_Usuario, :Nombre, :Descripcion, :Imagen, :Estado)');
        $stmt->execute([
            'ID_Usuario' => $this->ID_Usuario,
            'Nombre' => $this->Nombre,
            'Descripcion' => $this->Descripcion,
            'Imagen' => $this->Imagen,
            'Estado' => $this->Estado
        ]);
    
        $this->ID_Venta = $pdo->lastInsertId();
    }

    public function getAllVentas() {
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
            die('Error al obtener las ventas pendientes de la base de datos');
        }

        // Devolver el resultado
        return $result;
    }

}