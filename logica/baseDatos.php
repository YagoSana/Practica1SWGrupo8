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

    public function insertArticulo($articulo_id, $articulo_nombre, $articulo_descripcion, $articulo_precio) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO articulos (articulo_id, articulo_nombre, articulo_descripcion, articulo_precio) VALUES (?, ?, ?, ?)");
            $stmt->execute([$articulo_id, $articulo_nombre, $articulo_descripcion, $articulo_precio]);
            echo "Se ha subido el articulo a la BD de manera exitosa";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function close() {
        $this->connection = null;
    }
}

$db = new Database('127.0.0.1', 'username', 'password', 'bd');
$db->connect();

$articulo_id = $_POST['articulo_id'];
$articulo_nombre = $_POST['articulo_nombre'];
$articulo_descripcion = $_POST['articulo_descripcion'];
$articulo_precio = $_POST['articulo_precio'];

$db->insertArticulo($articulo_id, $articulo_nombre, $articulo_descripcion, $articulo_precio);

$db->close();

?>
