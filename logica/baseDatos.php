<?php

class Database {
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    public function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public function connect() {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->database}";
            $this->connection = new PDO($dsn, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("No se ha podido conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function insertProducto($producto_id, $producto_nombre, $producto_descripcion, $producto_precio, $producto_imagen) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO productos (ID, Nombre, Descripcion, Precio, Imagen) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$producto_id, $producto_nombre, $producto_descripcion, $producto_precio, $producto_imagen]);
            echo "Se ha subido el producto a la BD de manera exitosa";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function close() {
        $this->connection = null;
    }

    public function getConnection() {
        return $this->connection;
    }
}


?>