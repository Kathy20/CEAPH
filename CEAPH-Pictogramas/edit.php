<!DOCTYPE html>

<?php
    // Conexión.
    $servername = "mysql.hostinger.es";
    $username = "u772402380_ceaph";
    $password = "proyecto";

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($conn, "u772402380_ceaph") or die(mysql_error());  
?> 


<?php
    
    $imagen_id = $_GET["imagen_id"];
    
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pictogramas</title>

    <link href="css/bootstrap.css" rel="stylesheet">
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
        <div class="container success">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Editar Pictograma</h2>
                    <hr class="star-light">
                </div>
            </div>  
  
            <div id = "Imagen" name = "Imagen" >
                        <?php    
                            $sql = "SELECT imagen FROM Imagen WHERE imagen_id = ".$imagen_id;
                            $result = mysqli_query($conn, $sql) or die(mysql_error());
                            $row = mysqli_fetch_array($result);            
                            echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'" class="img-responsive" alt=""/><p>'.$row['palabraAsociada'].'</p>';
                        ?>                         
            </div>  
    
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2"> 
                    <div class="row control-group">
                        <div class="form-group col-xs-12 controls">
                            <label>Imagen</label>
                                <input name="userImage" type="file" class="form-control" accept="image/*" required/>
                        </div> 
                        <div class="form-group col-xs-12">
                            <button type="submit" class="btn btn-success btn-lg" value="EditarImagen" name="submit" id="submit">Editar Imagen </button>
                        </div>
                    </div>   

              
                    <form action="php/agregarPictograma.php" id="agregarPictogramaForm" enctype="multipart/form-data" action="" method="post" class="form-inline" role="form">
                        <div class="row control-group">
                               <div class="row control-group">
                                 <div class="form-group col-xs-12 controls">
                                  <label>Palabra Asociada</label> 

                                  <input type="text" name="palabra" id="palabra" placeholer="Palabra asociada" class="form-control" required/>
                                </div>
                              </div> 
                            
                            <br>
                            <div class="row">
                                <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg" value="EditarPalabras" name="submit" id="submit">Editar Palabras Asociadas</button>
                                </div>
                            </div>
                            <br>
                              <div class="row control-group">
                                 <div class="form-group col-xs-12 controls">
                                  <label>Categor&#237a</label>
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
`
                      
                            
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg" value="EditarCategoria" name="submit" id="submit">Editar Categor&#237a</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>


    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    
</body>
-->

</html>