<!DOCTYPE html>
<html lang="es">
    <head>
        <?php include("../header.php"); ?>
        <title>Compras Back Music</title>
    </head>
    <body>
        <div id="contenedor">
            <?php include("../cabecera.php"); ?>
            <?php include("../lateralIzq.php"); ?>

            <main>
                <article>
                    <section>
                        <h2>Compras Back Music</h2>
                        <p>
                        Esta el la sección de compras de Back Music. Aquí podrís encontrar las compras de nuestros clientes.
                        </p>

                        <?php
                        $serverName = "localhost";
                        $userName = "username";
                        $password = "password";
                        $dbName = "BDsw24";


                        //Hacemos conexion con la base de datos
                        $conexion = new mysqli($serverName, $userName, $password); //añadir nombres de variables globales
                        
                        if ($conexion->connect_error) {

                            die("Database connection failed: " . $conn->connect_error);
                        }

                        //Create DataBase
                        $sql = "CREATE DATABASE BDsw24";
                        if ($conexion->query($sql) === TRUE) {

                            echo "DataBase created successfully";
                        }
                        else {

                            echo "Error creating DataBase: " . $conexion->error;
                        }
                        
                        //Hacemos una consulta para obtener productos

                        ?>
                    </section>
                </article>
            </main>
            <?php include("../pieDePagina.php"); ?>
        </div>
    </body>
</html>