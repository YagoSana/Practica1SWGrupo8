<?php
    $db = new mysqli('127.0.0.1', 'username', 'password', 'bd_def');

    if($db->connect_errno) {
        echo "Error al conectarse con la base de datos: " . $db -> connect_error;
        exit();
    }

    $Nombre = $db -> real_escape_string($_POST['Nombre']);
    $Apellido = $db -> real_escape_string($_POST['Apellido']);
    $Email = $db -> real_escape_string($_POST['Email']);
    $User = $db -> real_escape_string($_POST['User']);
    $Pass = $db -> real_escape_string($_POST['Pass']);

    $sql = "INSERT INTO usuario (Nombre, Apellido, Email, User, Pass) VALUES ('$Nombre', '$Apellido', '$Email', '$User', '$Pass')";

    if (!$db -> query($sql)) {
        printf("%d Row inserted.\n", $db->affected_rows);
    }

    $db->close();
?>