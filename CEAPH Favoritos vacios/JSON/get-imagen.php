<?php

    // Obtener imagen dado un id por medio de GET
    
    include_once("../php/openConnection.php");    
    $conn = $_SESSION['conn']; 

    // Query
    $sql = "SELECT  `Imagen`.`imagen` FROM `Imagen` WHERE `Imagen`.`imagen_id` = ". $_GET['id'];
    
    // Ejecuta el query
    $result = mysqli_query($conn, $sql) or die(mysql_error());
    
    mysqli_close($conn);

    // El contenido de la pag es una imagen
    header('Content-Type: image/jpeg');

    // Recorre el resultado del query y agrega cada fila a un array
    if ($row = mysqli_fetch_assoc($result)) {
        echo $row['imagen'];
    }
?>