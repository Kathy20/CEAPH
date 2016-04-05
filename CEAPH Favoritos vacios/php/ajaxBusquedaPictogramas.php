<?php
    // Ajax para la busqueda de pictogramas segun la oración enviada por medio de GET
    
    // Conexión Base de Datos
    include("openConnection.php");    
    $conn = $_SESSION['conn']; 

    // GET y procesamiento de as palabras de la oración
    $oracion = $_GET['palabras'];
    
    $palabras = explode(" ", $oracion);
    
    // Iteración de las palabras en la oración
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
    
    mysqli_free_result($result);       
    mysqli_close($conn); 

?>