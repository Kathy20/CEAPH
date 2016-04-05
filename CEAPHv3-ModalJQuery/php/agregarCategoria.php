<?php

    include_once("php/openConnection.php");    
    $conn = $_SESSION['conn']; 
           
    if(count($_FILES) > 0) {
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        
            $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
            //$imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
            
            // Extensión
            $name = $_FILES["userImage"]["name"];
            $ext = strtolower(end((explode(".", $name))));
            
            // Guardar Archivo
            $target = 'temp/'.$_FILES["userImage"]["name"];
            move_uploaded_file( $_FILES['userImage']['tmp_name'], $target);
            // ## ---------------------------

            $newfile = fopen('temp/'.$name."_temp.".$ext, "w") or die("Unable to open file!");
            
            
            $uploadimage = $target;
            $newname = 'temp/'.$name."_temp.".$ext;

            // Set the resize_image name
            $resize_image = $newname;
            $actual_image = $uploadimage;

            list( $width,$height ) = getimagesize( $uploadimage );

            $newwidth = 100;
            $newheight = 100;
            
            $thumb = imagecreatetruecolor( $newwidth, $newheight );
            
            if($ext=="jpg" || $ext=="jpeg" )
            {
                 $source = imagecreatefromjpeg( $uploadimage );
            }
            else if($ext=="png")
            {
                $source = imagecreatefrompng( $uploadimage );
            }
            else if($ext=="gif")
            {
                $src = imagecreatefromgif($uploadimage);
            }

            imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
            imagejpeg( $thumb, $resize_image, 100 ); 

            $out_image=addslashes(file_get_contents($resize_image));


            $sql = "SELECT  id_categoria FROM Categoria WHERE nombre = '". strtolower($_POST["nombre"]) ."'";
            $result = mysqli_query($conn, $sql);
            $rowcount=mysqli_num_rows($result);
            ?>
            <script>
                alert(<? printf($rowcount);?>);
                
            </script>
            
            <?

            if (mysqli_num_rows($result) == false) {

                $sql = "INSERT INTO Categoria (nombre, filename, imagenCategoria) VALUES('". strtolower($_POST["nombre"]) ."', '". strtolower($name) ."',  '{$out_image}')";
            
                $current_id_categoria = mysqli_query($conn, $sql) or die("<b>Error:</b> No se pudo crear la categoría. Vuelva a intentarlo porfavor.<br/>" . mysqli_error($conn));
                if(isset($current_id_categoria)) {
                              unlink($target);
                              unlink($newname);
                              //header("Refresh:0");
                       }
                
                 ?>
                 <script>
                alert("No existe");                
                </script>
               <?
            
            } else {

               ?>
               <script>
                alert("Ya existe la categoria.");            
               
                alert("Ya existe la categoria: " + <?printf($_POST["nombre"]);?>);            
                </script>
            <?    
            }                   
                       
        }
        mysqli_free_result($result);       
        mysqli_close($conn);
        header( "refresh:1;url=http://ceaph-pictogramascr.esy.es/CEAPH/index6.php" );
        exit;
    }

?>