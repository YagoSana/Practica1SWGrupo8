<?php
namespace es\ucm\fdi\sw\vistas\helpers;

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

    public function calcularPuntuacionMedia($Producto_id) {
        $stmt = $this->pdo->prepare('SELECT AVG(Valoracion) as media FROM Valoraciones WHERE ID = :ID');
        $stmt->execute(['ID' => $Producto_id]);
        $resultado = $stmt->fetch();

        $this->puntuacionMedia = $resultado['media'];
        return $this->puntuacionMedia;
    }

   
    public static function getValoracion($Producto_id, $pdo) {
        $stmt = $pdo->prepare('SELECT * FROM Valoraciones WHERE ID = :ID');
        $stmt->execute(['ID' => $Producto_id]);
        $Valoraciones = $stmt->fetchAll();
    
        return $Valoraciones;
    }
    
    //Es la funcion para valorar un Producto
    public static function setValoracion($Producto_id, $Usuario_id, $Valoracion, $comentario) {
        $db = Aplicacion::getInstance()->getConexionBd();

        $sql = "INSERT INTO Valoraciones (IdUsuario, ID, Valoracion, Comentario) VALUES (:Usuario_id, :Producto_id, :Valoracion, :comentario)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':Usuario_id', $Usuario_id);
        $stmt->bindParam(':Producto_id', $Producto_id);
        $stmt->bindParam(':Valoracion', $Valoracion);
        $stmt->bindParam(':comentario', $comentario);

        $stmt->execute();

    }
    
    
}

?>