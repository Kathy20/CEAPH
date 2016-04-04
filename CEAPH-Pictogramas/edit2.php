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

        // Actualizar las palabras
        // Guardar el id de la palabra, borrar la fila de la tabla intermedia y ver si la nueva palabra está y meterla o tomar el id si ya está en la tabla y agregar la fila
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

                    <div id="Imagen" name="Imagen">
                        <?php    
                            $sql = "SELECT imagen FROM Imagen WHERE imagen_id = ".$imagen_id;
                            $result = mysqli_query($conn, $sql) or die(mysql_error());
                            $row = mysqli_fetch_array($result);            
                            echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['imagen'] ).'" class="img-responsive" alt=""/><p>'.$row['palabraAsociada'].'</p>';
                        ?>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <label>Imagen</label>
                            <div class="row form-inline">
                                <form action="php/actualizarImagen.php" method="post" id="agregarCategoriaForm" enctype="multipart/form-data" class="form-inline" role="form">
                                    <input name="userImage" type="file" class="form-control" accept="image/*" required/>
                                    <?php
                                        echo '<input type="hidden" id="actImagenId" name="actImagenId"  value='. $imagen_id .'></input>';
                                    ?>
                                    <button type="submit" class="btn btn-success btn-lg" value="EditarImagen" name="submit" id="submit">Editar Imagen</button>
                                </form>
                            </div>

                            <div class="row control-group">
                                <label>Palabra Asociada</label>
                                <div class="row control-group">
                                    <?php    
                                        // SELECT `PalabraAsociada`.`Palabra`, `PalabraAsociada`.`idPalabraAsociada` FROM `PalabraAsociada`, `PalabraAsociada-Imagen` WHERE `PalabraAsociada`.`idPalabraAsociada` = `PalabraAsociada-Imagen`.`idPalabraAsociada` AND `PalabraAsociada-Imagen`.`idImagen` = 146
                                        $sql = "SELECT `PalabraAsociada`.`Palabra`, `PalabraAsociada`.`idPalabraAsociada` FROM `PalabraAsociada`, `PalabraAsociada-Imagen` WHERE `PalabraAsociada`.`idPalabraAsociada` = `PalabraAsociada-Imagen`.`idPalabraAsociada` AND `PalabraAsociada-Imagen`.`idImagen` = " . $imagen_id;
                                        $result = mysqli_query($conn, $sql) or die(mysql_error());
                                        while($row = mysqli_fetch_array($result)){
                                            echo '<div class="form-inline col-xs-12 controls" id="divPalabra'.$row['idPalabraAsociada'].'">';
                                            echo '  <input type="text" name="palabra" id="palabra'.$row['idPalabraAsociada'].'" placeholer="Palabra asociada" class="form-control" value="'.$row['Palabra'].'" required/>';
                                            echo '  <a class="btn btn-success btn-lg" onClick="javascript:ajaxActualizarPalabraAsociada('.$row['idPalabraAsociada'].','.$imagen_id.');" name="actualizar" id="actualizar"> Actualizar </a>';
                                            echo '  <a class="btn btn-danger btn-lg" onClick="javascript:ajaxBorrarPalabraAsociada('.$row['idPalabraAsociada'].','.$imagen_id.');" name="borrar" id="borrar"> Borrar </a>';
                                            echo '</div>';
                                            echo '<br><br/><br><br/>';
                                        }            
                                    ?>
                                </div>
                                <div class="row control-group">
                                        <label>Palabra Asociada</label>
                                        <div class="row" id ="palabras">
                                            <a id = "btnAgregarPalabra" class="btn btn-success btn-lg">Agregar Palabra</a>
                                        </div>
                                </div>

                                <br/>
                                <div class="row control-group">
                                    <label>Categor&#237a</label>
                                    <div class="form-inline col-xs-12 controls">
                                        <select class="form-control" id="categoria" name="categoria">
                                            <?php
                                                $sql = "SELECT id_categoria, nombre FROM Categoria ORDER BY nombre"; 
                                                $result = mysqli_query($conn, $sql) or die(mysql_error());
                                                while ($row = mysqli_fetch_array($result)) {
                                                    echo '<option value='.$row['id_categoria'].'>'. $row['nombre'] .'</option>';
                                                }                   
                                            ?>
                                        </select>
                                        <button type="submit" class="btn btn-success btn-lg" value="EditarCategoria" name="submit" id="submit">Editar Categor&#237a</button>
                                    </div>
                                </div>
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>
            </header>
            
            <div id="divAjax"></div>


            <div class="scroll-top page-scroll visible-xs visible-sm">
                <a class="btn btn-primary" href="#page-top">
                    <i class="fa fa-chevron-up"></i>
                </a>
            </div>

            <script src="js/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

        </body>
            
        <script type="text/javascript">
            /*Function to update the  pets  according to the options chosen 
                 AJAX function that calls pet_search_result.php */
            function ajaxActualizarPalabraAsociada(idPalabra,imagen_id) {
                var id = "palabra"+idPalabra;
                var palabra = document.getElementById(id).value
                //alert(palabra);
                
                var xmlhttp;
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("divAjax").innerHTML = xmlhttp.responseText;
                        alert("Palabra Actualizada");
                    }
                }
                xmlhttp.open("GET", "php/ajaxActualizarPalabraAsociada.php?idPalabra=" + idPalabra + "&palabra=" + palabra + "&imagen_id="+imagen_id, true);
                xmlhttp.send();
            }
            
            function ajaxBorrarPalabraAsociada(idPalabra, imagen_id) {
                
                var xmlhttp;
                if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp = new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange = function () {
                    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                        document.getElementById("divAjax").innerHTML = xmlhttp.responseText;
                        alert("Palabra Eliminada");
                        location.reload();
                    }
                }
                xmlhttp.open("GET", "php/ajaxBorrarPalabraAsociada.php?idPalabra=" + idPalabra + "&imagen_id="+imagen_id, true);
                xmlhttp.send();
            }
            
            function ajaxBorrarPictograma(id){
                if (confirm('Desea Borrar el Pictograma?')) {
                    alert("Sí");
                } else {
                    alert("No");
                }
            }
        </script>

        <script>
            $(document).ready(function () {
                var wrapper = $('#palabras'); //Input field wrapper
                var fieldHTML = '<div class="row control-group"><div class="form-group col-xs-12 floating-label-form-group controls"><input type="text" name="palabra[]" id="palabra" class="form-control" placeholder="Palabra Asociada" required/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div></div>'; //New input field html 
                $("#btnAgregarPalabra").click(function(){ //Once add button is clicked
                    $(wrapper).append(fieldHTML); // Add field html
                });
                $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
                    e.preventDefault();
                    $(this).parent('div').remove(); //Remove field html
                });
            });
        </script>

        </html>