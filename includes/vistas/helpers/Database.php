<?php
namespace es\ucm\fdi\sw\vistas\helpers;
use PDO;

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

    public function insertProducto($Producto_id, $Producto_nombre, $Producto_descripcion, $Producto_precio, $Producto_imagen) {
        try {
            $stmt = $this->connection->prepare("INSERT INTO Productos (ID, Nombre, Descripcion, Precio, Imagen) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$Producto_id, $Producto_nombre, $Producto_descripcion, $Producto_precio, $Producto_imagen]);
            echo "Se ha subido el Producto a la BD de manera exitosa";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function agregarValoracion($ProductoID, $nuevaPuntuacion) {
        // Recuperar la puntuación media y el número de Valoraciones actuales de la base de datos
        $stmt = $this->connection->prepare('SELECT puntuacionMedia, numeroDeValoraciones FROM Valoraciones WHERE Producto_id = :ID');
        $stmt->execute(['ID' => $ProductoID]);
        $Valoracion = $stmt->fetch();
    
        $puntuacionMedia = $Valoracion['puntuacionMedia'];
        $numeroDeValoraciones = $Valoracion['numeroDeValoraciones'];
    
        // Calcular la nueva puntuación media
        $puntuacionMedia = ($puntuacionMedia * $numeroDeValoraciones + $nuevaPuntuacion) / ($numeroDeValoraciones + 1);
        $numeroDeValoraciones++;
    
        // Actualizar la puntuación media y el número de Valoraciones en la base de datos
        $stmt = $this->connection->prepare('UPDATE Valoraciones SET puntuacionMedia = :puntuacionMedia, numeroDeValoraciones = :numeroDeValoraciones WHERE Producto_id = :ID');
        $stmt->execute([
            'ID' => $ProductoID,
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