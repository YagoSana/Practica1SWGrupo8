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

    public static function getVentaById($venta_id) {

        $pdo = Aplicacion::getInstance()->getConexionBd();
    
        $stmt = $pdo->prepare('SELECT * FROM ventas WHERE ID = :ID');

        $stmt->execute(['ID' => $venta_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verificar si se obtuvo un resultado
        if ($result === false) {
            die('Error al obtener la venta de la base de datos');
        }
    
        $venta = new Venta($result['ID'], $result['ID_Usuario'], $result['Nombre'], $result['Descripcion'], $result['Imagen'], $result['Estado']);
        // Devolver el objeto Venta
        return $venta;
    }
    

    public function setEstado($estado) {
        // Obtener la instancia de la conexión a la base de datos
        $pdo = Aplicacion::getInstance()->getConexionBd();
    
        // Preparar la consulta SQL para actualizar el estado de la venta
        $stmt = $pdo->prepare('UPDATE ventas SET Estado = :Estado WHERE ID = :ID');
    
        // Ejecutar la consulta
        $stmt->execute(['Estado' => $estado, 'ID' => $this->ID]);
    }
    
    
    
}