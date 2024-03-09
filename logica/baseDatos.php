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

    public function insertProducto($producto_id, $producto_nombre, $producto_descripcion, $producto_precio) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO productos (producto_id, producto_nombre, producto_descripcion, producto_precio) VALUES (?, ?, ?, ?)");
            $stmt->execute([$producto_id, $producto_nombre, $producto_descripcion, $producto_precio]);
            echo "Se ha subido el producto a la BD de manera exitosa";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function close() {
        $this->connection = null;
    }
}

$db = new Database('127.0.0.1', 'username', 'password', 'bd_def');
$db->connect();

$producto_id = $_POST['producto_id'];
$producto_nombre = $_POST['producto_nombre'];
$producto_descripcion = $_POST['producto_descripcion'];
$producto_precio = $_POST['producto_precio'];

$db->insertProducto($producto_id, $producto_nombre, $producto_descripcion, $producto_precio);

$db->close();

?>