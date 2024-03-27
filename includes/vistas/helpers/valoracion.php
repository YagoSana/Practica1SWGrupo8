<?php
class Valoracion {
    private $puntuacionMedia;

    public function setPuntuacion($puntuacionMedia) {
        $this->puntuacionMedia = $puntuacionMedia;
    }

    public function getPuntuacion() {
        return $this->puntuacionMedia;
    }
}