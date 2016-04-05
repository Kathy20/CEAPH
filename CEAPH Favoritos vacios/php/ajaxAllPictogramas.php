<?php
    // Ajax para la busqueda de pictogramas segun la oración enviada por medio de GET
    
    // Conexión Base de Datos
    include("openConnection.php");    
    $conn = $_SESSION['conn']; 

    // GET y procesamiento de as palabras de la oración
    $sql = "SELECT imagen_id, imagen FROM Imagen";
    $result = mysqli_query($conn, $sql) or die(mysql_error());

    while ($row = mysqli_fetch_assoc($result)) {
        
        echo '<div class="col-sm-2 portfolio-item">';
        echo '  <a href="#'.$row['imagen_id'].'" class="portfolio-link" data-toggle="modal">';
        echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'" class="img-responsive" alt=""/><p>'.$row['palabraAsociada'].'</p>';
        echo '  </a>';
        echo '</div>'; 
    }
    mysqli_free_result($result);       
    mysqli_close($conn);    
?>