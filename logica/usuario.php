<?php

class Usuario {
    private $conexion;

    public function __construct() {
        // Establecer la conexión con la base de datos
        $this->conexion = new PDO("mysql:host=localhost;dbname=nombre_base_de_datos", "usuario", "contraseña");
    }

    public function obtenerUsuario($id) {
        // Consultar la información del usuario en la base de datos
        $consulta = $this->conexion->prepare("SELECT * FROM usuarios WHERE id = :id");
        $consulta->bindParam(":id", $id);
        $consulta->execute();

        // Obtener el resultado de la consulta
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        return $usuario;
    }
}

?>