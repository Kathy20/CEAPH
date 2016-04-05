<?php
    // Conexión.
    include("php/openConnection.php");    
    $conn = $_SESSION['conn']; 

    // Actualizar las palabras
    // Guardar el id de la palabra, borrar la fila de la tabla intermedia y ver si la nueva palabra está y meterla o tomar el id si ya está en la tabla y agregar la fila
    $idPalabra = $_GET["idPalabra"];
    $imagen_id = $_GET["imagen_id"];

    $sql = "DELETE FROM `PalabraAsociada-Imagen` WHERE `idImagen` = ". $imagen_id ." AND `idPalabraAsociada` = ". $imagen_id;
    
    $result = mysqli_query($conn, $sql);
    $rowcount = mysqli_num_rows($result);
    
?>