<?php
namespace es\ucm\fdi\sw\src\usuarios;
//require_once '../../config.php';
//require_once '../../aplicacion.php';
use es\ucm\fdi\sw\Aplicacion;
//include RAIZ_APP . '/includes/vistas/helpers/Carrito.php';
use es\ucm\fdi\sw\vistas\helpers\Carrito;

use PDO;

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

    private $roles;

    private $valoracion;

    private function __construct($nombreUsuario, $password, $nombre, $apellido, $email, $roles, $id)
    {
        $this->id = $id;
        $this->nombreUsuario = $nombreUsuario;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->roles = $roles;
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
            $result = new Usuario($fila['User'], $fila['Pass'], $fila['Nombre'], $fila['Apellido'], $fila['Email'], $fila['rol'], $fila['Idusuario']);
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
                $result = new Usuario($fila['User'], $fila['Pass'], $fila['Nombre'], $fila['Apellido'], $fila['Email'], $fila['rol'], $fila['Idusuario']);
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

    private function inicializarCarrito()
    {
        $this->carrito = new Carrito($this);
    }

    //Funcion para valorar el producto
    public static function valorarProducto($producto_id, $usuario_id, $valoracion, $comentario) {

        $valoracionProducto = new Valoracion();
        $valoracionProducto->setValoracion($producto_id, $usuario_id, $valoracion, $comentario);
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
        //la funcion password_verify no está funcionando correctamente y no nos comprueba las contraseñas hasheadas
        //return password_verify($password, $this->password);
        if  ($password == $this->password) {
            return true;
        }
        else {
            return false;
        }
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

    public static function insertaUsuario($Nombre, $Apellido, $Email, $User, $Pass, $rol){
        $conn = Aplicacion::getInstance()->getConexionBd();
        $stmt = $conn->prepare('INSERT INTO usuario (Apellido, Nombre, User, Pass, Email, Rol) VALUES (:Apellido, :Nombre, :User, :Pass, :Email, :Rol)');
        $stmt->execute([
            'Apellido' => $Apellido,
            'Nombre' => $Nombre,
            'User' => $User,
            'Pass' => /*self::hashPassword($Pass)*/ $Pass, //debido a que no nos está verificando bien las contraseñas, quitamos el hash muy a nuestro pesar
            'Email' => $Email,
            'Rol' => $rol
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
            "roles" => $this->roles
        );
    }
}