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
       xmlhttp.open("GET","php/searchCategoria.php?id_categoria=" +  id, true);
       xmlhttp.send();
   } //end AjaxCategoria  

    function ajaxFavoritos() {
            var xmlhttp;
            var palabras = document.getElementById('palabras').value
            if (palabras == "" || palabras==" "){
              $("#favoritos").hide();
            }else{
              $("#favoritos").show();
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function () {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("imagenes").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "php/ajaxBusquedaPictogramas.php?palabras=" + palabras, true);
            xmlhttp.send();
            }
            
    }//end AjaxBusquedaPictogramas

    function ajaxBusquedaPictogramas() {
      var xmlhttp;
      var palabras = document.getElementById('busqueda').value
      if (palabras == "" || palabras==" "){
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
       xmlhttp.open("GET", "php/ajaxAllPictogramas.php", true);
       xmlhttp.send();
    }else {
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
      xmlhttp.open("GET", "php/ajaxBusquedaPictogramas.php?palabras=" + palabras, true);
        xmlhttp.send();
      }//end palabras empty
    }//end AjaxBusquedaPictogramas

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
                    <li class="page-scroll">
                        <!--onkeyup onkeyup-->
                        <input type="search" name="busqueda" id="busqueda" placeholder="Buscar..." class="form-control" />
                        <button class="btn btn-success btn-xs" type="submit" value="Agregar" name="submit" id="submit"  onclick="ajaxBusquedaPictogramas()">Buscar</button> 
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
                         <input type="text" name="palabras" id="palabras" placeholder="Ingrese la frase que desea almacenar." class="form-control" onkeyup="ajaxFavoritos()" />
                        <!--<button type="submit" class="btn btn-success btn-lg">Buscar</button>-->
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Favoritos -->
    <section  id="favoritos" visibility: hidden>                   
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2" id="imagenes">                  
                    
                </div>
                <button type="submit" class="btn btn-success btn-lg" value="Guardar Favorito" name="submit" id="submit">Guardar Favorito </button>
            </div>      
    </section>


    
    <section  id="Galeria">

    <table class="container">  	
        <tr>
        	<th style="text-align: center;"><h2>Categor&#237as</h2> <hr class="star-primary"></th>
        	<th style="text-align: center;"><h2>Galer&#237a</h2> <hr class="star-primary"></th>
        </tr>
                            
            <!--Categorias -->
        		<tr>
        		<td valign="top"><div name = "AjaxGaleria"> 
                		
                        <?php    
                             include("php/openConnection.php");    
                             $conn = $_SESSION['conn']; 
                               
                            $sql = "SELECT id_categoria, imagenCategoria, nombre FROM Categoria";
                            $result = mysqli_query($conn, $sql) or die(mysql_error());
                        	
                            while ($row = mysqli_fetch_assoc($result)) {
                               echo ' <a onClick = "javascript:AjaxCategoria('.$row['id_categoria'].');">';
                                echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagenCategoria'] ).'" class="img-responsive" alt=""/><p>'.$row['nombre'].'</p>';
                                echo '  </a>';
                                //echo '</div>'; 
                            }

                            //Refrescar
                            echo ' <a onClick = "javascript:AjaxCategoria(0);">';
                            echo '      <img src="img/portfolio/update.png" class="img-responsive" alt=""/><p>Actualizar</p>';
                                echo '  </a>';
                            mysqli_free_result($result);       
                          ?>
                       
                </div> </td>
                <td>
                <!-- Imagenes -->
                <div id = "AjaxGaleria" name = "AjaxGaleria" >
                        <?php           
                            $sql = "SELECT imagen_id, imagen FROM Imagen";
                            $result = mysqli_query($conn, $sql) or die(mysql_error());
                        
                            while ($row = mysqli_fetch_assoc($result)) {
                                
                                echo '<div class="col-sm-2 portfolio-item">';
                                echo '  <a href="#'.$row['imagen_id'].'" class="portfolio-link" data-toggle="modal">';
                                echo '      <img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'" class="img-responsive" alt=""/><p>'.$row['palabraAsociada'].'</p>';
                                echo '  </a>';
                                echo '</div>'; 
                            }
                            mysqli_free_result($result);       
                            mysqli_close($conn); 
                        ?>
                </div> 
              </td></tr>        
         
     </table> 
   <!-- end gallery-->
    
    </section>
    
    
    <!-- Agregar Categoría -->
    <section  class="success" id="agregarCategoria">
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
                                <input type="text" name="nombre" id="nombre" placeholder="Nombre categoria" class="form-control" required data-validation-required-message="Por favor introduzca el nombre de la categoría."/>
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
                               <button class="btn btn-success btn-lg" type="submit" value="Agregar" name="submit" id="submit" >Agregar</button>                                                            
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


<!-- Agregar Pictograma -->
    <section  id="agregarPic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Agregar Pictograma</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
              
                    <form action="php/agregarPictograma.php" id="agregarPictogramaForm" enctype="multipart/form-data" action="" method="post" class="form-inline" role="form">
                        <div class="row control-group">
                               <div class="row control-group">
                                 <div class="form-group col-xs-12 floating-label-form-group controls">
                                  <label>Palabra Asociada</label>
                                  <input type="text" name="palabra" id="palabra" placeholder="Palabra asociada" class="palabraAsociada" required/>
                                </div>
                              </div>

                              <div class="row control-group">
                                 <div class="form-group col-xs-12 floating-label-form-group controls">
                                  <label>Categoría</label>
                                  <select class="form-control" id="categoria" name="categoria"> 
                                      <?php
                                          include("php/openConnection.php");    
                                          $conn = $_SESSION['conn']; 

                                          $sql = "SELECT id_categoria, nombre FROM Categoria ORDER BY nombre"; 
                                          $result = mysqli_query($conn, $sql) or die(mysql_error());
                                          while ($row = mysqli_fetch_array($result)) {
                                              echo '<option value='.$row['id_categoria'].'>'. $row['nombre'] .'</option>';
                                          }
                                          mysqli_free_result($result);       
                                          mysqli_close($conn);                    
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
                        <br>
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


<!-- Modal -->

<!--modal -->
<?php   
    include("php/openConnection.php");    
    $conn = $_SESSION['conn'];         

    $sql = "SELECT Imagen.imagen_id, Imagen.imagen, Categoria.nombre FROM Imagen, Categoria WHERE Imagen.id_categoria = Categoria.id_categoria";
    $result = mysqli_query($conn, $sql) or die(mysql_error());
    
    while ($row = mysqli_fetch_assoc($result)) {

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
      while ($palabra = mysqli_fetch_assoc($palabras)) {
      
        if($contador==0){
            echo'<h2>'.$palabra['Palabra'].'</h2>
                 <hr class="star-primary">
                 <img height="350" width="350" src="data:image/jpeg;base64,'.base64_encode( $imagen ).'" class="img-responsive" alt=""/>
                 <ul class="list-inline item-details">';
                 echo '<li>Palabras Asociadas:'.$palabra['Palabra'].'</li>';
        }// fin if contador ==0
        echo '<li>, '.$palabra['Palabra'].'</li>';
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
    mysqli_free_result($result);       
    mysqli_close($conn); 
?>



     <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

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
      $("#favoritos").hide();
      $("#agregarPic").hide();
      $("#agregarCategoria").hide();
      $("#Galeria").show();

   });  
  $("#esconderGaleria").click(function(){
      $("#Galeria").hide();
   });  

  $("#verAPictograma").click(function(){
     $("#agregarCategoria").hide();
     $("#favoritos").hide();
      $("#agregarPic").show();
   });  
  $("#esconderAPic").click(function(){
      $("#agregarPic").hide();
   }); 

  $("#verACategoria").click(function(){
       $("#agregarPic").hide();
       $("#favoritos").hide();
      $("#agregarCategoria").show();

   });  
  $("#esconderACategoria").click(function(){
      $("#agregarCategoria").hide();
   }); 


 });

</script>  
