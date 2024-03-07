<?php

class Producto {
    private $id;
    private $nombre;
    private $precio;
    private $conexion;

    public function __construct($id, $nombre, $precio) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;

        // Establecer la conexión a la base de datos
        $this->conexion = new PDO("mysql:host=localhost;dbname=nombre_base_datos", "usuario", "contraseña");
        $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function guardar() {
        try {
            // Preparar la consulta SQL
            $consulta = $this->conexion->prepare("INSERT INTO productos (id, nombre, precio) VALUES (:id, :nombre, :precio)");

            // Asignar los valores a los parámetros de la consulta
            $consulta->bindParam(':id', $this->id);
            $consulta->bindParam(':nombre', $this->nombre);
            $consulta->bindParam(':precio', $this->precio);

            // Ejecutar la consulta
            $consulta->execute();

            echo "Producto guardado correctamente.";
        } catch (PDOException $e) {
            echo "Error al guardar el producto: " . $e->getMessage();
        }
    }

    public function actualizar() {
        try {
            // Preparar la consulta SQL
            $consulta = $this->conexion->prepare("UPDATE productos SET nombre = :nombre, precio = :precio WHERE id = :id");

            // Asignar los valores a los parámetros de la consulta
            $consulta->bindParam(':id', $this->id);
            $consulta->bindParam(':nombre', $this->nombre);
            $consulta->bindParam(':precio', $this->precio);

            // Ejecutar la consulta
            $consulta->execute();

            echo "Producto actualizado correctamente.";
        } catch (PDOException $e) {
            echo "Error al actualizar el producto: " . $e->getMessage();
        }
    }
}

