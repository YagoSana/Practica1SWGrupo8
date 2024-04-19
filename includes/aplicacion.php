<?php
/**
 * Clase que mantiene el estado global de la aplicación.
 */
class Aplicacion
{
	private static $instancia;
	
	/**
	 * Devuele una instancia de {@see Aplicacion}.
	 * 
	 * @return Aplicacion Obtiene la única instancia de la <code>Aplicacion</code>
	 */
	public static function getInstance() {
		if (  !self::$instancia instanceof self) {
			self::$instancia = new self();
		}
		return self::$instancia;
	}

	/**
	 * @var array Almacena los datos de configuración de la BD
	 */
	private $bdDatosConexion;
	
	/**
	 * Almacena si la Aplicacion ya ha sido inicializada.
	 * 
	 * @var boolean
	 */
	private $inicializada = false;
	
	/**
	 * @var \PDO Conexión de BD.
	 */
	private $conn;
	
	/**
	 * Evita que se pueda instanciar la clase directamente.
	 */
	private function __construct()
	{
	}
	
	/**
	 * Inicializa la aplicación.
	 * 
	 * @param array $bdDatosConexion datos de configuración de la BD
	 */
	public function init($bdDatosConexion)
	{
        if ( ! $this->inicializada ) {
    	    $this->bdDatosConexion = $bdDatosConexion;
    		$this->inicializada = true;
        }
	}
	
	/**
	 * Cierre de la aplicación.
	 */
	public function shutdown()
	{
	    $this->compruebaInstanciaInicializada();
	    if ($this->conn !== null) {
	        $this->conn = null;
	    }
	}
	
	/**
	 * Comprueba si la aplicación está inicializada. Si no lo está muestra un mensaje y termina la ejecución.
	 */
	private function compruebaInstanciaInicializada()
	{
	    if (! $this->inicializada ) {
	        echo "Aplicacion no inicializa";
	        exit();
	    }
	}
	
	/**
	 * Devuelve una conexión a la BD. Se encarga de que exista como mucho una conexión a la BD por petición.
	 * 
	 * @return \PDO Conexión a MySQL.
	 */
	public function getConexionBd()
	{
	    $this->compruebaInstanciaInicializada();
		if (! $this->conn ) {
			$bdHost = $this->bdDatosConexion['host'];
			$bdUser = $this->bdDatosConexion['user'];
			$bdPass = $this->bdDatosConexion['pass'];
			$bd = $this->bdDatosConexion['bd'];
			
			try {
			    $dsn = "mysql:host={$bdHost};dbname={$bd}";
			    $this->conn = new PDO($dsn, $bdUser, $bdPass);
			    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
			    die("Error de conexión a la BD: " . $e->getMessage());
			}
		}
		return $this->conn;
	}
}

?>
