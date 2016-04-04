<?php   
    include_once("connection.php");
    
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $conn = mysqli_connect($servername, $username, $password);


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($conn, "u772402380_ceaph") or die(mysql_error());

    if($_GET['id_categoria']==0){
         $sql = "SELECT imagen_id, imagen, id_categoria FROM Imagen";
    }else{
        $sql = "SELECT imagen_id,imagen, id_categoria FROM Imagen WHERE id_categoria = ".$_GET['id_categoria'];        
    }
    $result = mysqli_query($conn, $sql) or die(mysql_error());
                            
         while ($row = mysqli_fetch_array($result)) {
                                    
                echo '<div class="col-sm-2 portfolio-item">';
                echo '  <a href="edit.php?imagen_id='.$row['imagen_id'].'">';
                echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'" class="img-responsive" alt=""/></p>';
                echo '  </a>';
                echo '</div>'; 
            } 
?>