<?php
    // Conexi�n.
    $servername = "mysql.hostinger.es";
    $username = "u772402380_ceaph";
    $password = "proyecto";

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($conn, "u772402380_ceaph") or die(mysql_error());

    // Actualizar las palabras
    // Guardar el id de la palabra, borrar la fila de la tabla intermedia y ver si la nueva palabra est� y meterla o tomar el id si ya est� en la tabla y agregar la fila
    $idPalabra = $_GET["idPalabra"];
    $palabra = $_GET["palabra"];
    $imagen_id = $_GET["imagen_id"];

    $sql = "SELECT idPalabraAsociada FROM PalabraAsociada WHERE Palabra = '". strtolower($palabra) ."'";
    $result = mysqli_query($conn, $sql);
    $rowcount=mysqli_num_rows($result);

    if (mysqli_num_rows($result) == false) {
        $sql1 = "INSERT INTO PalabraAsociada (Palabra) VALUES('". strtolower($palabra) ."')";            
        $current_id_palabra = mysqli_query($conn, $sql1) or die("<b>Error:</b> No se pudo agregar la palabra asociada.<br/>" . mysqli_error($conn));
        $palabraAsociada =mysqli_insert_id($conn);
    } else {
        $row = mysqli_fetch_array($result);
        $palabraAsociada= $row['idPalabraAsociada'];
    }
    
    //Conectar la imagen con la categoria
    $sql3 = "UPDATE `PalabraAsociada-Imagen` SET `idPalabraAsociada` = ".$palabraAsociada." WHERE `idPalabraAsociada`= ".$idPalabra." AND `idImagen` = ".$imagen_id;
    $current_id = mysqli_query($conn, $sql3) or die("<b>Error:</b> No se pudo unir la palabra asociada a la imagen.<br/>" . mysqli_error($conn));
    
?>