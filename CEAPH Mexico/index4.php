<!DOCTYPE html>

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

    // Scale de imágenes
    // http://talkerscode.com/webtricks/reduce%20the%20size%20and%20make%20thumbnail%20of%20any%20image%20before%20uploading%20using%20PHP.php

    include_once("php/connection.php");
    
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $conn = mysqli_connect($servername, $username, $password);


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($conn, $username) or die(mysql_error());

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
            
            $sql = "INSERT INTO Imagen (palabraAsociada, filename, id_categoria, imagen) VALUES('". strtolower($_POST["palabra"]) ."', '". strtolower($name) ."', '". $_POST["categoria"] ."', '{$out_image}')";
            
            $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
            if(isset($current_id)) {
                unlink($target);
                unlink($newname);
                //header("Refresh:0");
            }
        }
    }

?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CEAPH - Pictogramas</title>

    <link href="css/bootstrap.css" rel="stylesheet">

    <link href="css/freelancer.css?rand=1239" rel="stylesheet">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" class="index">

    <nav class="navbar navbar-default navbar-fixed-top">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
             <a class="navbar-brand" href="#page-top">Pictogramas</a>
            </div>
        
    
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li> 
                    <li class="page-scroll">
                        <a id="verGaleria">Galer&#237;a</a>
                    </li>
                    <li class="page-scroll">
                        <a id ="agregarPic">Agregar Pictograma</a>  
                    </li> 
                    <li class="page-scroll">
                        <a href="#about">Agregar Categor&#237;a</a>
                    </li> 
                </ul>
            </div>
            <!-- /.navbar-collapse -->

    </nav>

   <div  id="categorias" class="col-lg-3" style="background-color:#8cdf59;">
         <section>
                <div class="container"> 
                    <div class="row">
                        <div class="col-lg-3 text-center">
                            <h2 class = "tituloCategoria" class = "col-lg-3 text-center">Categor&#237a</h2>
                            <hr class="star-primary">
                        </div>
                    </div>
                    <div class="col-lg-3" role="group">
                                         
                        <?php           
                            $sql = "SELECT id_categoria, nombre, imagenCategoria FROM Categoria";
                            $result = mysqli_query($conn, $sql) or die(mysql_error());
                        
                            while ($row = mysqli_fetch_array($result)) {
                                
                                echo '<div class="btn-group btn-group-xs" role="group">';
                                echo '  <a onClick = "javascript:AjaxCategoria('.$row['id_categoria'].');" class="btn-group btn-group-xs">';
                                echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagenCategoria'] ).'" class="img-responsive" alt=""/><p>'.$row['nombre'].'</p>'; 
                                echo '  </a>';
                                echo '</div>'; 
                            }
                        ?>
                  </div> 
            </section> 
        </div>

    <div id= "agregarPictogramaContainer" class="col-sm-9" visibility: hidden>
            <header >
                    <div class="container">
                            <div class="col-lg-10 text-center">
                                <h2>Agregar Pictograma</h2>
                                <hr class="star-light">
                            </div>
                    </div>
                        <div class="row">
                            <form name="frmImage" enctype="multipart/form-data" action="" method="post" class="form-inline" role="form">
                                <input type="text" name="palabra" id="palabra" placeholder="Palabra asociada" class="form-control" required/>
                                <select class="form-control" id="categoria" name="categoria"> 
                                    <?php
                                        $sql = "SELECT id_categoria, nombre FROM Categoria ORDER BY nombre"; 
                                        $result = mysqli_query($conn, $sql) or die(mysql_error());
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo '<option value='.$row['id_categoria'].'>'. $row['nombre'] .'</option>';
                                        }                   
                                    ?>
                                </select>
                                <input name="userImage" type="file" class="form-control" accept="image/*" required/>
                                <input type="submit" value="Agregar" class="form-control" />
                                <input id = "esconder" type="button" value="Esconder" class="form-control" />

                            </form>
                            
                        </div>
                    </div>               

            </header>

            <section id="gallery col-md-9" visibility: hidden>
                <div id = "todo" class="container col-md-9">
                        <div class="col-md-9 text-center">
                            <h2>Galer&iacute;a</h2>
                            <hr class="star-primary">
                    </div>
                    <div id = "AjaxGaleria" name = "AjaxGaleria" class="col-md-9">
                        <?php           
                            $sql = "SELECT imagen_id, imagen, id_categoria FROM Imagen";
                            $result = mysqli_query($conn, $sql) or die(mysql_error());
                        
                            while ($row = mysqli_fetch_array($result)) {
                                
                                echo '<div class="col-sm-2 portfolio-item">';
                                echo '  <a href="edit.php?imagen_id='.$row['imagen_id'].'">';
                                echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'" class="img-responsive" alt=""/>';
                                echo '  </a>';
                                echo '</div>'; 
                            }
                        ?>
                </div> 
                <input id = "esconderGaleria" type="button" value="Esconder" class="form-control" />

            </section>
     </div>
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

   <!-- fin de la columna-->
   </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    
</body> 

</html> 

<script type="text/javascript">  
    /*Function to update the  pets  according to the options chosen 
      AJAX function that calls pet_search_result.php */
    function AjaxCategoria(id)
    {     

        var xmlhttp;
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
          }
         xmlhttp.onreadystatechange=function()
          {
          if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
            document.getElementById("AjaxGaleria").innerHTML=xmlhttp.responseText;
            }
          }
        xmlhttp.open("GET","searchCategoria.php?id_categoria=" +  id, true);
        xmlhttp.send();
    }   

</script>      
<script>   
$(document).ready(function(){
  $("#agregarPic").click(function(){
      $("#agregarPictogramaContainer").show();
   });  
  $("#esconder").click(function(){
      $("#agregarPictogramaContainer").hide();
   });  
  $("#verGaleria").click(function(){
      $("#gallery").show();
   });  
  $("#esconderGaleria").click(function(){
      $("#gallery").hide();
   }); 

 });

</script>                       