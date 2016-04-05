<?php   
    include_once("openConnection.php");    
    $conn = $_SESSION['conn']; 

    $sql = "SELECT imagen_id,imagen FROM Imagen WHERE id_categoria = ".$_GET['id_categoria'];
    $result = mysqli_query($conn, $sql) or die(mysql_error());
     while ($row = mysqli_fetch_assoc($result)) {
                                
            echo '<div class="col-sm-2 portfolio-item">';
            echo '  <a href="imagen_id='.$row['imagen_id'].'">';
            echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'" class="img-responsive" alt=""/></p>';
            echo '  </a>';
            echo '</div>'; 
        } 

    mysqli_free_result($result);       
    mysqli_close($conn);
?>