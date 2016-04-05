<?php
    
    include_once("../php/openConnection.php");    
    $conn = $_SESSION['conn']; 
    
    // Query
    $sql = "SELECT `Categoria`.`id_categoria`, `Categoria`.`nombre`, `Categoria`.`filename` FROM `Categoria`";
    
    // Ejecuta el query
    $result = mysqli_query($conn, $sql) or die(mysql_error());
    
    // Recorre el resultado del query y agrega cada fila a un array
    $rows = array();
    while ($row = mysqli_fetch_array($result)) {
        $rows[] = $row;
    }

    // imprime el array en formato JSON
    header('Content-type: application/json');
    echo json_encode($rows);

    mysqli_close($conn);
?>