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

    public function agregarValoracion($productoID, $nuevaPuntuacion) {
        // Recuperar la puntuación media y el número de valoraciones actuales de la base de datos
        $stmt = $this->connection->prepare('SELECT puntuacionMedia, numeroDeValoraciones FROM valoraciones WHERE producto_id = :ID');
        $stmt->execute(['ID' => $productoID]);
        $valoracion = $stmt->fetch();
    
        $puntuacionMedia = $valoracion['puntuacionMedia'];
        $numeroDeValoraciones = $valoracion['numeroDeValoraciones'];
    
        // Calcular la nueva puntuación media
        $puntuacionMedia = ($puntuacionMedia * $numeroDeValoraciones + $nuevaPuntuacion) / ($numeroDeValoraciones + 1);
        $numeroDeValoraciones++;
    
        // Actualizar la puntuación media y el número de valoraciones en la base de datos
        $stmt = $this->connection->prepare('UPDATE valoraciones SET puntuacionMedia = :puntuacionMedia, numeroDeValoraciones = :numeroDeValoraciones WHERE producto_id = :ID');
        $stmt->execute([
            'ID' => $productoID,
            'puntuacionMedia' => $puntuacionMedia,
            'numeroDeValoraciones' => $numeroDeValoraciones
        ]);
    }

    public function close() {
        $this->connection = null;
    }

    public function getConnection() {
        return $this->connection;
    }
}