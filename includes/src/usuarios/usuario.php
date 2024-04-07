<?php
require_once '../../config.php';
require_once '../../aplicacion.php';
include RAIZ_APP . '/includes/vistas/helpers/carrito.php';
class Usuario
{

    public const ADMIN_ROLE = 1;

    public const USER_ROLE = 2;

    public static function login($nombreUsuario, $password)
    {
        $usuario = self::buscaUsuario($nombreUsuario);
        if ($usuario && $usuario->compruebaPassword($password)) {
            return self::cargaRoles($usuario);
        }
        return false;
    }

    public static function crea($nombreUsuario, $password, $nombre, $rol)
    {
        $user = new Usuario($nombreUsuario, self::hashPassword($password), $nombre);
        $user->añadeRol($rol);
        return $user->guarda();
    }

    public static function buscaUsuario($nombreUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario U WHERE U.Nombre=%s", $conn->quote($nombreUsuario));
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

    public static function buscaPorId($idUsuario)
    {
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf("SELECT * FROM usuario WHERE id=%d", $idUsuario);
        $rs = $conn->query($query);
        $result = false;
        if ($rs) {
            $fila = $rs->fetch(PDO::FETCH_ASSOC);
            if ($fila) {
                $result = new Usuario($fila['nombreUsuario'], $fila['password'], $fila['nombre'], $fila['id']);
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
        $roles = [];

        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "SELECT RU.rol FROM RolesUsuario RU WHERE RU.usuario=%d"
            ,
            $usuario->id
        );
        $rs = $conn->query($query);
        if ($rs) {
            $roles = $rs->fetchAll(PDO::FETCH_ASSOC);

            $usuario->roles = [];
            foreach ($roles as $rol) {
                $usuario->roles[] = $rol['rol'];
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
            "UPDATE Usuarios U SET nombreUsuario = %s, nombre=%s, password=%s WHERE U.id=%d"
            ,
            $conn->quote($usuario->nombreUsuario)
            ,
            $conn->quote($usuario->nombre)
            ,
            $conn->quote($usuario->password)
            ,
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
            "DELETE FROM RolesUsuario RU WHERE RU.usuario = %d"
            ,
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
        /* Los roles se borran en cascada por la FK
         * $result = self::borraRoles($usuario) !== false;
         */
        $conn = Aplicacion::getInstance()->getConexionBd();
        $query = sprintf(
            "DELETE FROM Usuarios U WHERE U.id = %d"
            ,
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

    private $id;

    private $nombreUsuario;

    private $password;

    private $nombre;

    private $apellido;

    private $email;

    private $carrito;

    private $roles;

    private function __construct($nombreUsuario, $password, $nombre, $apellido, $email, $roles, $id)
    {
        $this->$id = $id;
        $this->$nombreUsuario = $nombreUsuario;
        $this->$password = $password;
        $this->$nombre = $nombre;
        $this->$apellido = $apellido;
        $this->$email = $email; // Aquí estaba el error, debería ser $this->email en lugar de $this->$email
        $this->$roles = $roles;

        $this->$carrito = new Carrito();
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

    public function añadeRol($role)
    {
        $this->roles[] = $role;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function tieneRol($role)
    {
        if ($this->roles == null) {
            self::cargaRoles($this);
        }
        return array_search($role, $this->roles) !== false;
    }

    public function compruebaPassword($password)
    {
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
            "roles" => $this->roles
        );
    }
}
