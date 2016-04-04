<!-- 
Instituto Tecnológico de Costa Rica
Ingeniería en Computación
Proyecto de Ingeniería de Software
I Semestre 2016

Autores
Kathy Brenes Guerrero
Benjamin Lewis Mora
Miuyin Yong Wong

Fecha: 01/03/2016
-->

<?php

    include_once("connection.php");
    
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $conn = mysqli_connect($servername, $username, $password);
    if (!$conn) {
        die("No se pudo conectar con la base de datos, error No. : " . mysqli_connect_error());
    }
    mysqli_select_db($conn, "u772402380_ceaph") or die(mysql_error());
       
    if(count($_FILES) > 0) {
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
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
            $newwidth = 350;
            $newheight = 350;
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
            
            /// Crea la Imagen
            
            $sql = "UPDATE `Imagen` SET `imagen` = '{$out_image}' WHERE `imagen_id`= ".$_POST['actImagenId'];
            //echo $sql;
            //echo '<img src="data:image/jpeg;base64,'.base64_encode( $out_image ).'" class="img-responsive" alt=""/><p>'.$row['palabraAsociada'].'</p>';
            $current_id_imagen = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
            //$imagen =mysqli_insert_id($conn);
              
            unlink($target);
            unlink($newname);

        }

        $redirect = "refresh:0;url=/prototipo1/edit2.php?imagen_id=".$_POST['actImagenId'];
        echo $redirect;
        header($redirect);
    }
?>








