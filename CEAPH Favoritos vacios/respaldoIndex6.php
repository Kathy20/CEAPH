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

?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CEAPH - Pictogramas</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
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

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
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
                        <a id="verGaleria" href="#Galeria">Galer&#237a</a>
                    </li>
                    <li class="page-scroll">
                        <a id="verAPictograma" href="#agregarPic">Agregar Pictograma</a>
                    </li>
                    <li class="page-scroll">
                        <a id="verACategoria" href="#agregarCategoria">Agregar Categor&#237a</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!--<div class="intro-text">
                        <span class="name">Pictogramas</span>-->
                        <h1>Pictogramas</h1>
                        <hr class="star-light">
                        <input type="search" rows="1" class="form-control" placeholder="Buscar pictogramas" id="Favorito"/>
                        <button type="submit" class="btn btn-success btn-lg">Buscar</button>
                   <!-- </div>-->
                </div>
            </div>
        </div>
    </header>

    <!-- Galería -->
    <section id="Galeria">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Galer&#237a</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div id = "AjaxGaleria" name = "AjaxGaleria" >
                        <?php           
                            $sql = "SELECT imagen_id, imagen, id_categoria FROM Imagen";
                            $result = mysqli_query($conn, $sql) or die(mysql_error());
                        
                            while ($row = mysqli_fetch_array($result)) {
                                
                                echo '<div class="col-sm-2 portfolio-item">';
                                echo '  <a href="edit.php?imagen_id='.$row['imagen_id'].'">';
                                echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'" class="img-responsive" alt=""/><p>'.$row['palabraAsociada'].'</p>';
                                echo '  </a>';
                                echo '</div>'; 
                            }
                        ?>
                </div> 
              
            </div> 
           <button id = "esconderGaleria" type="button" class="btn btn-success btn-lg">Esconder</button>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="agregarPic" visibility: hidden>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Agregar Pictograma</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
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

                            </form>
                            
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Agregar</button>
                                <button id = "esconderAPic" type="button" class="btn btn-success btn-lg">Esconder</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Agregar Categoría -->
    <section id="agregarCategoria" visibility: hidden>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Agregar Categor&#237a</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
                    <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Agregar</button> 
                                <button id = "esconderACategoria" type="button" class="btn btn-success btn-lg">Esconder</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>




    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html> 

<script>   
$(document).ready(function(){
  $("#verGaleria").click(function(){
      $("#Galeria").show();
   });  
  $("#esconderGaleria").click(function(){
      $("#Galeria").hide();
   });  

  $("#verAPictograma").click(function(){
     $("#agregarCategoria").hide();
      $("#agregarPic").show();
   });  
  $("#esconderAPic").click(function(){
      $("#agregarPic").hide();
   }); 

  $("#verACategoria").click(function(){
       $("#agregarPic").hide();
      $("#agregarCategoria").show();

   });  
  $("#esconderACategoria").click(function(){
      $("#agregarCategoria").hide();
   }); 


 });

</script>  
