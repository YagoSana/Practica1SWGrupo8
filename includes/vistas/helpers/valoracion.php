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
}