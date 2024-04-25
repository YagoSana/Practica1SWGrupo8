<?php
//require_once '../../config.php';
//require_once '../../aplicacion.php';
include RAIZ_APP . '/includes/vistas/helpers/carrito.php';

class Usuario
{

    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 2;

    private $id;

    private $nombreUsuario;

    private $password;

    private $nombre;

    private $apellido;

    private $email;

    private $carrito;

    private $Roles;

    private $valoracion;

    private function __construct($nombreUsuario, $password, $nombre, $apellido, $email, $Roles, $id)
    {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->Roles = $Roles;
    }

    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);

        if ($usuario && $usuario->compruebaPassword($password)) {
            return $usuario;
        }
        return false;
    }

    public static function crea($nombreUsuario, $password, $nombre, $apellido, $email)
    {
        //esta mal
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre, $apellido, $email, "clinete", null);
        $_SESSION["usuario"] = $user;
        $user->añadeRol("cliente");
        return $user->guarda();
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT * FROM usuario U WHERE U.User=:nombreUsuario";
        $stmt = $conn->prepare($query);
        $stmt->execute(['nombreUsuario' => $nombreUsuario]);
        $result = false;
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($fila) {
            $result = new Usuario($fila['User'], $fila['Pass'], $fila['Nombre'], $fila['Apellido'], $fila['Email'], $fila['Rol'], $fila['Idusuario']);
            $result->inicializarCarrito();
            $_SESSION['usuario'] = $result; //Se guarda la variable de tipo usuario
        }

        return $result;
    }

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE Idusuario=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch(PDO::FETCH_ASSOC);
            if ($fila) {
                $result = new Usuario($fila['User'], $fila['Pass'], $fila['Nombre'], $fila['Apellido'], $fila['Email'], $fila['Rol'], $fila['Idusuario']);
            }
        } else {
            error_log("Error BD ({$conn->errorCode()}): {$conn->errorInfo()}");
        }
        return $result;
    }


    private static function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private static function cargaRoles($usuario)
    {
        $Roles = [];

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT RU.Rol FROM RolesUsuario RU WHERE RU.usuario=%d",
            $usuario->id
        );
        $rs = $conn->query($query);
        if ($rs) {
            $Roles = $rs->fetchAll(PDO::FETCH_ASSOC);

            $usuario->Roles = [];
            foreach ($Roles as $Rol) {
                $usuario->Roles[] = $Rol['Rol'];
            }
            return $usuario;
        } else {
            error_log("Error BD ({$conn->errorCode()}): {$conn->errorInfo()}");
        }
        return false;
    }

    private static function actualiza($usuario)
    {
        $result = false;
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "UPDATE Usuarios U SET nombreUsuario = %s, nombre=%s, password=%s WHERE U.id=%d",
            $conn->quote($usuario->nombreUsuario),
            $conn->quote($usuario->nombre),
            $conn->quote($usuario->password),
            $usuario->id
        );
        if ($conn->exec($query)) {
            $result = self::borraRoles($usuario);
            if ($result) {
                $result = self::insertaRoles($usuario);
            }
        } else {
            error_log("Error BD ({$conn->errorCode()}): {$conn->errorInfo()}");
        }

        return $result;
    }

    private static function borraRoles($usuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "DELETE FROM RolesUsuario RU WHERE RU.usuario = %d",
            $usuario->id
        );
        if (!$conn->exec($query)) {
            error_log("Error BD ({$conn->errorCode()}): {$conn->errorInfo()}");
            return false;
        }
        return $usuario;
    }

    private static function borra($usuario)
    {
        return self::borraPorId($usuario->id);
    }

    private static function borraPorId($idUsuario)
    {
        if (!$idUsuario) {
            return false;
        }
        /* Los Roles se borran en cascada por la FK
         * $result = self::borraRoles($usuario) !== false;
         */
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "DELETE FROM Usuarios U WHERE U.id = %d",
            $idUsuario
        );
        if (!$conn->exec($query)) {
            error_log("Error BD ({$conn->errorCode()}): {$conn->errorInfo()}");
            return false;
        }
        return true;
    }

    public function obtenerProductosDelUsuario()
    {
        foreach ($this->pedidos as $pedido) {
            foreach ($pedido->getProductos() as $producto) {
                echo "Nombre del producto: " . $producto->getNombre() . "\n";
                echo "Estado del pedido: " . $pedido->getEstado() . "\n";
                if ($pedido->getEstado() === 'entregado') {
                    echo "<button onclick='valorar(\"{$producto->getID()}\")'>Valorar</button>\n";
                }
                echo "------------------------\n";
            }
        }
    }

    private function inicializarCarrito()
    {
        $this->carrito = new Carrito($this);
    }

    //Funcion para valorar el producto
    public static function valorarProducto($pedido_id, $usuario_id, $valoracion, $comentario)
    {

        $valoracionProducto = new Valoracion();
        $valoracionProducto->setValoracion($pedido_id, $usuario_id, $valoracion, $comentario);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCarrito()
    {
        return $this->carrito;
    }

    public function añadeRol($Role)
    {
        $this->Roles[] = $Role;
    }

    public function getRoles()
    {
        return $this->Roles;
    }

    public function tieneRol($Role)
    {
        if ($this->Roles == null) {
            self::cargaRoles($this);
        }
        return array_search($Role, $this->Roles) !== false;
    }

    public function compruebaPassword($password)
    {
        // Ahora sí podemos usar password_verify para comprobar las contraseñas hasheadas
        return password_verify($password, $this->password);
    }

    public function cambiaPassword($nuevoPassword)
    {
        $this->password = self::hashPassword($nuevoPassword);
    }

    public function guarda()
    {
        if ($this->id !== null) {
            return self::actualiza($this);
        }
        return self::inserta($this);
    }

    public static function insertaUsuario($Nombre, $Apellido, $Email, $User, $Pass, $Rol, $Puntos)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $stmt = $conn->prepare('INSERT INTO usuario (Apellido, Nombre, User, Pass, Email, Rol, Puntos) VALUES (:Apellido, :Nombre, :User, :Pass, :Email, :Rol, :Puntos)');
        $stmt->execute([
            'Apellido' => $Apellido,
            'Nombre' => $Nombre,
            'User' => $User,
            'Pass' => password_hash($Pass, PASSWORD_DEFAULT), // Hasheamos la contraseña
            'Email' => $Email,
            'Rol' => $Rol,
            'Puntos' => $Puntos
        ]);
    }

    public function borrate()
    {
        if ($this->id !== null) {
            return self::borra($this);
        }
        return false;
    }

    public function getUsuarioCompleto()
    {
        return array(
            "id" => $this->id,
            "nombreUsuario" => $this->nombreUsuario,
            "nombre" => $this->nombre,
            "apellido" => $this->apellido,
            "email" => $this->email,
            "carrito" => $this->carrito,
            "Roles" => $this->Roles
        );
    }

    public function getVentasUsuario() {
        // Obtener la instancia de la conexión a la base de datos
        $pdo = Aplicacion::getInstance()->getConexionBd();
    
        // Preparar la consulta SQL para seleccionar todas las Ventas del usuario
        $stmt = $pdo->prepare('SELECT * FROM ventas WHERE ID_Usuario = :ID_Usuario');
    
        // Ejecutar la consulta
        $stmt->execute(['ID_Usuario' => $this->id]);
    
        // Obtener todos los resultados como un array asociativo
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Verificar si se obtuvieron resultados
        if ($result === false) {
            // Si no hay resultados, mostrar un mensaje de error
            die('Error al obtener las ventas del usuario de la base de datos');
        }
    
        // Devolver el resultado
        return $result;
    }
    
    public static function getPuntos($usuario) {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = "SELECT Puntos FROM usuario WHERE User=:nombreUsuario";
        $stmt = $conn->prepare($query);
        $stmt->execute(['nombreUsuario' => $usuario->getNombreUsuario()]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['Puntos'];
    }
}
