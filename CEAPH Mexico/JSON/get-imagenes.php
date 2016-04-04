<?php

    // JSON para obtener todos los ids de las imagenes
    
    include_once("../php/openConnection.php");    
    $conn = $_SESSION['conn'];

    // Query
    $sql = "SELECT `Imagen`.`imagen_id`, `Imagen`.`filename`, `Imagen`.`id_categoria`  FROM `Imagen`";
    
    // Ejecuta el query
    $result = mysqli_query($conn, $sql) or die(mysql_error());

    mysqli_close($conn);
    
    // Recorre el resultado del query y agrega cada fila a un array
    $rows = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    // imprime el array en formato JSON
    header('Content-type: application/json');
    print json_encode($rows);

?>