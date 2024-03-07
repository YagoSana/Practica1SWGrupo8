<?php
    $db = new mysqli('127.0.0.1', 'root', '', 'registro');

    if($db->connect_errno) {
        echo "Error al conectarse con la base de datos: " . $db -> connect_error;
        exit();
    }

    $nombre = $db -> real_escape_string($_POST['nombre']);
    $apellido = $db -> real_escape_string($_POST['apellido']);
    $email = $db -> real_escape_string($_POST['email']);
    $usuario = $db -> real_escape_string($_POST['usuario']);
    $contraseña = $db -> real_escape_string($_POST['contraseña']);

    $sql = "INSERT INTO articulos (articulo_id, articulo_nombre, articulo_descripcion, articulo_precio) VALUES ('$articulo_id', '$articulo_nombre', '$articulo_descripcion', '$articulo_precio')";

    if (!$db -> query($sql)) {
        printf("%d Row inserted.\n", $db->affected_rows);
    }

    $db->close();
?>