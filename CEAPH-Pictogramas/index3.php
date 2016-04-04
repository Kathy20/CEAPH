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

    mysqli_select_db($conn, "u772402380_ceaph") or die(mysql_error());

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

    <link href="css/freelancer.css?rand=1237" rel="stylesheet">

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <!--<script>
        $('#agregarPictogramaForm').submit(function () {
         //business logics here
         return false;//to avoid page reload
        });


         $('#agregarCategoriaForm').submit(function () {
         //business logics here
         return false;//to avoid page reload
        });
    </script>-->
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
             <a class="navbar-brand" href="#page-top">Pictogramas</a>
            </div>
        
    
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#gallery">Galer&#237;a</a>
                    </li> 
                    <li class="page-scroll">
                        <a href="#contact">Agregar Pictograma</a> 
                    </li> 
                    <li class="page-scroll">
                        <a href="#about">Agregar Categor&#237;a</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>

    </nav>


    <!-- ******************************************************************************************** -->
    <!-- Barra de categorias -->
    <!-- ******************************************************************************************* -->

   <div class="col-sm-2" style="background-color:#81F79F;">
         <section id="categorias">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2 text-center" >
                            <h2>Categor&#237a</h2>
                            <hr class="star-primary">
                        </div>
                    </div>
                    <div class="col-sm-3" role="group">
                                         
                        <?php           
                            $sql = "SELECT id_categoria,imagenCategoria, nombre FROM Categoria";
                            $result = mysqli_query($conn, $sql) or die(mysql_error());
                        
                            while ($row = mysqli_fetch_array($result)) {
                                
                                echo '<div  role="group">';
                                echo '  <a href="edit.php?id_categoria='.$row['id_categoria'].'" >';
                                echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagenCategoria'] ).'" alt=""/><p>'.$row['nombre'].'</p>';
                                echo '  </a>';
                                echo '</div>'; 
                            }
                        ?>
                </div>
            </section>
  </div>

  <!-- /********************************************************************************************* -->
  <!-- Division mayor -->
  <!-- ********************************************************************************************* -->

    <div class="col-sm-10">
            <header>



                    <!-- Agregar Pictograma-->
                    <div class="container">
                            <div class="col-lg-9 text-center">
                                <h2>Agregar Pictograma</h2>
                                <hr class="star-light">
                            </div>
                        </div>
                        <div class="row">
                           
                           <!--<form action="pagina2.php" method="post">-->
                            <!--<form name="frmImage" enctype="multipart/form-data" action="" method="post" class="form-inline" role="form">-->
                            <form action="php/agregarPictograma.php" method="post" id="agregarPictogramaForm" enctype="multipart/form-data" class="form-inline" role="form">
                           <!-- <form action="" method="post" id="agregarPictogramaForm" enctype="multipart/form-data" class="form-inline" role="form">-->
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
                                <input type="submit" value="Agregar" name="submit" id="submit" class="form-control" />                            
                            </form>
                            
                        </div>

                        <!-- Agregar Categoria -->
                    <div class="container">
                            <div class="col-lg-9 text-center">
                                <h2>Agregar Categoria</h2>
                                <hr class="star-light">
                            </div>
                        </div>
                        <div class="row">
                           
                            <form action="php/agregarCategoria.php" method="post" id="agregarCategoriaForm" enctype="multipart/form-data" class="form-inline" role="form">
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre categoria" class="form-control" required/>
                                
                                <input name="userImage" type="file" class="form-control" accept="image/*" required/>
                                <input type="submit" value="Agregar" name="submit" id="submit" class="form-control" />                            
                            </form>
                            
                        </div>
                                
              
            </header>
            </div>

            <section id="gallery">
                <div class="container">
                        <div class="col-lg-9 text-center">
                            <h2>Galer&iacute;a</h2>
                            <hr class="star-primary">
                    </div>
                    <div class="row">
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
            </section>


            <section id="error" style="background-color:#81F79F;">
                <div class="container">
                        <div class="col-lg-9 text-center">
                            <h2>Errores</h2>
                            <hr class="star-primary">
                    </div>
                    <div class="col-sm-9">
                        
                </div>
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