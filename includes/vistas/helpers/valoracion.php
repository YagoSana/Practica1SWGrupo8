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
}

?>