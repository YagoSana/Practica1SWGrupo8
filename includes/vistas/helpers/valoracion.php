<?php
namespace es\ucm\fdi\sw\vistas\helpers;
use es\ucm\fdi\sw\aplicacion;
class Valoracion {
    private $puntuacionMedia;
    private $numeroDeValoraciones;
    private $pdo;

    public function __construct() {
        $this->puntuacionMedia = 0;
        $this->numeroDeValoraciones = 0;
    }

    public function getPuntuacion() {
        return $this->puntuacionMedia;
    }

    public function calcularPuntuacionMedia($producto_id) {
        $stmt = $this->pdo->prepare('SELECT AVG(Valoracion) as media FROM valoraciones WHERE ID = :ID');
        $stmt->execute(['ID' => $producto_id]);
        $resultado = $stmt->fetch();

        $this->puntuacionMedia = $resultado['media'];
        return $this->puntuacionMedia;
    }

   
    public static function getValoracion($pedido_id) {
        // Obtener la conexión a la base de datos
        $db = Aplicacion::getInstance()->getConexionBd();
    
        // Preparar la consulta SQL
        $stmt = $db->prepare('SELECT * FROM valoraciones WHERE ID = :ID');
    
        // Ejecutar la consulta
        $stmt->execute(['ID' => $pedido_id]);
    
        // Obtener todas las valoraciones
        $valoraciones = $stmt->fetch();
    
        // Devolver las valoraciones
        return $valoraciones;
    }
    
    //Es la funcion para valorar un producto
    public static function setValoracion($pedido_id, $usuario_id, $valoracion, $comentario) {
        $db = Aplicacion::getInstance()->getConexionBd();

        $sql = "INSERT INTO valoraciones (Idusuario, ID, Valoracion, Comentario) VALUES (:usuario_id, :pedido_id, :valoracion, :comentario)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':pedido_id', $pedido_id);
        $stmt->bindParam(':valoracion', $valoracion);
        $stmt->bindParam(':comentario', $comentario);

        $stmt->execute();

    }
    
    
}

?>