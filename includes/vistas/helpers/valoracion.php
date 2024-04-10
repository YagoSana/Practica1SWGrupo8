<?php
class Valoracion {
    private $puntuacionMedia;
    private $numeroDeValoraciones;
    private $pdo;

    public function __construct($pdo) {
        $this->puntuacionMedia = 0;
        $this->numeroDeValoraciones = 0;
        $this->pdo = $pdo;
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

   
      
    
    public static function getValoracion($producto_id, $pdo) {
        $stmt = $pdo->prepare('SELECT * FROM valoraciones WHERE ID = :ID');
        $stmt->execute(['ID' => $producto_id]);
        $valoraciones = $stmt->fetchAll();
    
        return $valoraciones;
    }
    
    //Es la funcion para valorar un producto
    public static function setValoracion($producto_id, $usuario_id, $valoracion, $comentario) {
        $db = new Database(BD_HOST, BD_USER, BD_PASS, BD_NAME);
        $db->connect();

        $sql = "INSERT INTO valoraciones (Idusuario, ID, Valoracion, Comentario) VALUES (:usuario_id, :producto_id, :valoracion, :comentario)";

        $stmt = $db->getConnection()->prepare($sql);

        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':producto_id', $producto_id);
        $stmt->bindParam(':valoracion', $valoracion);
        $stmt->bindParam(':comentario', $comentario);

        $stmt->execute();

        $db->close();
    }
    
    
}

?>