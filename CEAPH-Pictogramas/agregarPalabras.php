<!DOCTYPE html>
<!-- 
Instituto Tecnol�gico de Costa Rica
Ingenier�a en Computaci�n
Proyecto de Ingenier�a de Software
I Semestre 2016

Autores
Kathy Brenes Guerrero
Benjamin Lewis Mora
Miuyin Yong Wong

Fecha: 01/03/2016
-->

<?php

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

        <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/freelancer.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

        <script type="text/javascript">
            /*Function to update the  pets  according to the options chosen 
                 AJAX function that calls pet_search_result.php */
            function AjaxCategoria(id) {

                var xmlhttp;
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("AjaxGaleria").innerHTML = xmlhttp.responseText;
                    }
                }
                xmlhttp.open("GET", "php/searchCategoria.php?id_categoria=" + id, true);
                xmlhttp.send();
            }
        </script>

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
                        <div class="intro-text">
                            <span class="name">Pictogramas</span>
                            <hr class="star-light">
                            <textarea rows="1" class="form-control" placeholder="Buscar pictogramas" id="Favorito" required data-validation-required-message="Por favor ingrese su busqueda de favoritos."></textarea>
                            <button type="submit" class="btn btn-success btn-lg">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </header>




        <section id="Galeria">

            <table class="container">
                <tr>
                    <th style="text-align: center;">
                        <h2>Categor&#237as</h2>
                        <hr class="star-primary">
                    </th>
                    <th style="text-align: center;">
                        <h2>Galer&#237a</h2>
                        <hr class="star-primary">
                    </th>
                </tr>


                <tr>
                    <td valign="top">
                        <div name="AjaxGaleria">
                            <?php           
                                $sql = "SELECT id_categoria, imagenCategoria, nombre FROM Categoria";
                                $result = mysqli_query($conn, $sql) or die(mysql_error());
                                while ($row = mysqli_fetch_array($result)) {
                                    //echo '<div class="col-sm-1 portfolio-item">';
                                    echo '  <a onClick = "javascript:AjaxCategoria('.$row['id_categoria'].');">';
                                    echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagenCategoria'] ).'" class="img-responsive" alt=""/><p>'.$row['nombre'].'</p>';
                                    echo '  </a>';
                                    //echo '</div>'; 
                                }
                            ?>
                        </div>
                    </td>
                    <td>

                        <div id="AjaxGaleria" name="AjaxGaleria">
                            <?php           
                                $sql = "SELECT imagen_id, imagen, id_categoria FROM Imagen";
                                $result = mysqli_query($conn, $sql) or die(mysql_error());

                                while ($row = mysqli_fetch_array($result)) {
                                    echo '<div class="col-sm-2 portfolio-item">';
                                    echo '  <a href="edit2.php?imagen_id='.$row['imagen_id'].'">';
                                    echo '      <img src="data:image/jpeg;base64,'.base64_encode($row['imagen']).'" class="img-responsive" alt=""/><p>'.$row['palabraAsociada'].'</p>';
                                    echo '  </a>';
                                    echo '</div>'; 
                                }
                            ?>
                        </div>
                    </td>
                </tr>

            </table>
            <!-- end gallery-->

        </section>


        <!-- Agregar Categor�a -->
        <section class="success" id="agregarCategoria" visibility: hidden>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Agregar Categor&#237a</h2>
                        <hr class="star-light">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">

                        <form action="php/agregarCategoria.php" method="post" id="agregarCategoriaForm" enctype="multipart/form-data" class="form-inline" role="form">
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" id="nombre" placeholder="Nombre categoria" class="form-control" required data-validation-required-message="Por favor introduzca el nombre de la categor�a." />
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="row control-group">
                                <div class="form-group col-xs-12 floating-label-form-group controls">
                                    <label>Imagen</label>
                                    <input name="userImage" type="file" class="form-control" accept="image/*" required/>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>

                            <br>
                            <div id="success"></div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <button class="btn btn-success btn-lg" type="submit" value="Agregar" name="submit" id="submit">Agregar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>


        <!-- About Section -->
        <section class="success" id="agregarPic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2>Agregar Pictograma</h2>
                        <hr class="star-light">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <form action="php/agregarPictograma2.php" id="agregarPictogramaForm" enctype="multipart/form-data" action="" method="post" class="form-inline" role="form">
                            <div class="row control-group">
                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label>Palabra Asociada</label>
                                        <div class="row" id ="palabras">
                                            <input type="text" name="palabra[]" id="palabra" placeholder="Palabra asociada" class="form-control" required/><a id = "btnAgregarPalabra" class="btn btn-success btn-lg">Agregar Palabra</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label>Categor�a</label>
                                        <select class="form-control" id="categoria" name="categoria">
                                            <?php
                                                $sql = "SELECT id_categoria, nombre FROM Categoria ORDER BY nombre"; 
                                                $result = mysqli_query($conn, $sql) or die(mysql_error());
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '<option value='.$row['id_categoria'].'>'. $row['nombre'] .'</option>';
                                                }                
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="row control-group">
                                    <div class="form-group col-xs-12 floating-label-form-group controls">
                                        <label>Imagen</label>
                                        <input name="userImage" type="file" class="form-control" accept="image/*" required/>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div id="success"></div>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                    <button type="submit" class="btn btn-success btn-lg" value="Agregar" name="submit" id="submit">Agregar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <div class="scroll-top page-scroll visible-xs visible-sm">
            <a class="btn btn-primary" href="#page-top">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div>

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
        $(document).ready(function () {
            
            $("#verGaleria").click(function () {
                $("#Galeria").show();
            });
            $("#esconderGaleria").click(function () {
                $("#Galeria").hide();
            });

            $("#verAPictograma").click(function () {
                $("#agregarCategoria").hide();
                $("#agregarPic").show();
            });
            $("#esconderAPic").click(function () {
                $("#agregarPic").hide();
            });

            $("#verACategoria").click(function () {
                $("#agregarPic").hide();
                $("#agregarCategoria").show();

            });
            $("#esconderACategoria").click(function () {
                $("#agregarCategoria").hide();
            });

            
            var wrapper = $('#palabras'); //Input field wrapper
            var fieldHTML = '<div><input type="text" name="palabra[]" id="palabra" placeholder="Palabra Asociada" required/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>'; //New input field html 
            $("#btnAgregarPalabra").click(function(){ //Once add button is clicked
                $(wrapper).append(fieldHTML); // Add field html
            });
            $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
            });
        });
    </script>