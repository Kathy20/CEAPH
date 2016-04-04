<!DOCTYPE html>

<?php

    $servername = "mysql.hostinger.es";
    $username = "u772402380_ceaph";
    $password = "proyecto";

    $conn = mysqli_connect($servername, $username, $password);


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($conn, "u772402380_ceaph") or die(mysql_error());

    if(count($_FILES) > 0) {
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        
            $imgData = addslashes(file_get_contents($_FILES['userImage']['tmp_name']));
            $imageProperties = getimageSize($_FILES['userImage']['tmp_name']);
            
            $sql = "INSERT INTO Imagen (palabraAsociada , id_categoria, imagen)
            VALUES('". $_POST["palabra"] ."', '". $_POST["categoria"] ."', '{$imgData}')";
            
            $current_id = mysqli_query($conn, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($conn));
            if(isset($current_id)) {
                header("Refresh:0");
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

    <title>Pictogramas</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/freelancer.css" rel="stylesheet">

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
        <div class="container">
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
        </div>
    </nav>

    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Agregar Pictograma</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <form name="frmImage" enctype="multipart/form-data" action="" method="post" class="form-inline" role="form">
                    <input type="text" name="palabra" id="palabra" placeholder="Palabra asociada" class="form-control" required/>
                    <select class="form-control" id="categoria" name="categoria"> 
                        <?php
                            $sql = "Select id_categoria, nombre from Categoria"; 
                            $result = mysqli_query($conn, $sql) or die(mysql_error());
                            while ($row = mysqli_fetch_array($result)) {
                                echo '<option value='.$row['id_categoria'].'>'. $row['nombre'] .'</option>';
                            }                   
                        ?>
                    </select>
                    <input name="userImage" type="file" class="form-control" accept="image/*" required/>
                    <input type="submit" value="Agregar" class="form-control" />
                
                </form>
                
            </div>
        </div>
    </header>

    <section id="portfolio">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Galer&iacute;a</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                
                <?php           
                    $sql = "SELECT imagen_id, imagen FROM Imagen";
                    $result = mysqli_query($conn, $sql) or die(mysql_error());
                
                    while ($row = mysqli_fetch_array($result)) {
                        
                        echo '<div class="col-sm-2 portfolio-item">';
                        echo '  <a href="#'.$row['imagen_id'].'" class="portfolio-link" data-toggle="modal">';
                        echo '      <div class="caption">
                                        <div class="caption-content">
                                            <i class="fa fa-search-plus fa-3x"></i>
                                        </div>
                                    </div>';
                        echo '      <img height="900" width="650" src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'" class="img-responsive" alt=""/>';
                        echo '  </a>
                              </div>'; 
                    } 
                ?>
        </div>
    </section>
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    
    <?php           
        $sql = "SELECT Imagen.imagen_id, Imagen.imagen, Categoria.nombre FROM Imagen, Categoria WHERE Imagen.id_categoria = Categoria.id_categoria";
        $result = mysqli_query($conn, $sql) or die(mysql_error());
        
        while ($row = mysqli_fetch_array($result)) {

        	$imagen_id= $row['imagen_id'];
        	$categoria= $row['nombre'];
        	$imagen= $row['imagen'];
        	$contador=0; //ver si se imprime el titulo

            echo '<div class="portfolio-modal modal fade" id="'.$imagen_id.'" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-content">
                        <div class="close-modal" data-dismiss="modal">
                            <div class="lr">
                                <div class="rl">
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <div class="modal-body">';

             ///Imprimir cada una de las palabras asociadas, se pone la 
             // primera como titulo

            $sqlPalabras = "SELECT  `PalabraAsociada-Imagen`.idPalabraAsociada,  `PalabraAsociada-Imagen`.idImagen, PalabraAsociada.Palabra FROM  `PalabraAsociada-Imagen` , PalabraAsociada WHERE  `PalabraAsociada-Imagen`.idImagen = ".$imagen_id ." AND PalabraAsociada.idPalabraAsociada = `PalabraAsociada-Imagen`.idPalabraAsociada";
        	$palabras = mysqli_query($conn, $sqlPalabras) or die(mysql_error());
        	$contador=0; //ver si se imprime el titulo
        	while ($palabra = mysqli_fetch_array($palabras)) {
        	
        		if($contador==0){
		            echo'<h2>'.$palabra['Palabra'].'</h2>
		                 <hr class="star-primary">
		                 <img height="350" width="350" src="data:image/jpeg;base64,'.base64_encode( $imagen ).'" class="img-responsive" alt=""/>
		                 <ul class="list-inline item-details">';
		        }// fin if contador ==0
		        echo '<li>Palabra Asociada:'.$palabra['Palabra'].'</li>';
		        $contador=$contador+1;
            }//fin while palabras
            echo '</ul>
		          <ul class="list-inline item-details">
		          <li>Categor&iacute;a: '.$categoria.'</li>
		          </ul>
		           <button type="submit" class="btn btn-success btn-lg" value="Editar" name="submit" id="submit">Editar</button>
		          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>

		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>';
       } // fin modal
    ?>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <script src="js/freelancer.js"></script>

</body>

</html>