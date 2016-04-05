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
    mysqli_select_db($conn, $username) or die(mysql_error());
       
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
            $sql2 = "INSERT INTO Imagen ( filename, id_categoria, imagen) VALUES('". strtolower($name) ."', '". $_POST["categoria"] ."', '{$out_image}')";

            $current_id_imagen = mysqli_query($conn, $sql2) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));

            $imagen =mysqli_insert_id($conn);
            
            foreach ($_POST['palabra'] as $palabra){
                
                $sql = "SELECT  idPalabraAsociada FROM PalabraAsociada WHERE Palabra = '". strtolower($palabra) ."'";
                $result = mysqli_query($conn, $sql);
                $rowcount=mysqli_num_rows($result);


                echo '<div id="error">'."rowcount:".$rowcount.'</div>';
                ?>
                <!--<script>
                    alert(<? //printf($rowcount);?>);

                </script>-->

                <?

                if (mysqli_num_rows($result) == false) {

                    $sql1 = "INSERT INTO PalabraAsociada (Palabra) VALUES('". strtolower($palabra) ."')";            
                    $current_id_palabra = mysqli_query($conn, $sql1) or die("<b>Error:</b> No se pudo agregar la palabra asociada.<br/>" . mysqli_error($conn));

                    $palabraAsociada =mysqli_insert_id($conn);
                    ?>


                     <!--<script>
                    alert("No existe");

                    </script>-->
                   <?

                } else {

                    $row = mysqli_fetch_array($result);
                    $palabraAsociada= $row['idPalabraAsociada'];

                    ?>
                    <!-- <script>
                    alert("Ya existe");

                    </script>-->
                    <?    
                }
                
                
                //Conectar la imagen con la categoria

                $sql3 = "INSERT INTO `PalabraAsociada-Imagen` (idImagen, idPalabraAsociada) VALUES(". $imagen.", ". $palabraAsociada.")";

                $current_id = mysqli_query($conn, $sql3) or die("<b>Error:</b> No se pudo unir la palabra asociada a la imagen.<br/>" . mysqli_error($conn));

            }
            mysqli_free_result($result);        
            unlink($target);
            unlink($newname);
            mysqli_close($conn);
          // return false;
        }
        //return false;

        header( "refresh:1;url=http://ceaph-pictogramas.esy.es/prototipo1/agregarPalabras.php#agregarPic" );
        exit;
    }
?>