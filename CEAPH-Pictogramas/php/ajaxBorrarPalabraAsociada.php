<?php
    // Conexión.
    $servername = "mysql.hostinger.es";
    $username = "u772402380_ceaph";
    $password = "proyecto";

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($conn, "u772402380_ceaph") or die(mysql_error());

    // Actualizar las palabras
    // Guardar el id de la palabra, borrar la fila de la tabla intermedia y ver si la nueva palabra está y meterla o tomar el id si ya está en la tabla y agregar la fila
    $idPalabra = $_GET["idPalabra"];
    $imagen_id = $_GET["imagen_id"];

    $sql = "DELETE FROM `PalabraAsociada-Imagen` WHERE `idImagen` = ". $imagen_id ." AND `idPalabraAsociada` = ". $idPalabra;
    echo $sql;
    
    $result = mysqli_query($conn, $sql);
?>