<?php
    // Ajax para la busqueda de pictogramas segun la oraci�n enviada por medio de GET
    
    // Conexi�n Base de Datos
    include_once("connection.php");
    
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($conn, "u772402380_ceaph") or die(mysql_error());

    // GET y procesamiento de as palabras de la oraci�n
    $oracion = $_GET['palabras'];
    $palabras = explode(" ", $oracion);
    
    // Iteraci�n de las palabras en la oraci�n
    foreach ($palabras as &$palabra) {
        // Query: SELECT `Imagen`.`imagen` FROM `Imagen`, `PalabraAsociada`, `PalabraAsociada-Imagen` WHERE `PalabraAsociada`.`Palabra` = 'andadera' AND `PalabraAsociada`.`idPalabraAsociada` = `PalabraAsociada-Imagen`.`idPalabraAsociada` AND `Imagen`.`imagen_id` = `PalabraAsociada-Imagen`.`idImagen`
        $sql = "SELECT `Imagen`.`imagen`, `PalabraAsociada`.`palabra` FROM `Imagen`, `PalabraAsociada`, `PalabraAsociada-Imagen` WHERE `PalabraAsociada`.`Palabra` = '".$palabra."' AND `PalabraAsociada`.`idPalabraAsociada` = `PalabraAsociada-Imagen`.`idPalabraAsociada` AND `Imagen`.`imagen_id` = `PalabraAsociada-Imagen`.`idImagen`";
        
        $result = mysqli_query($conn, $sql) or die(mysql_error());
                        
        while ($row = mysqli_fetch_array($result)) {
            echo '<div class="col-sm-2 portfolio-item">';
            echo '  <a class="portfolio-link" data-toggle="modal">';
            echo '      <img src="data:image/jpeg;base64,'.base64_encode($row['imagen']).'" class="img-responsive" alt=""/><p>'.$row['palabra'].'</p>';
            echo '  </a>';
            echo '</div>'; 
        }

    }

?>