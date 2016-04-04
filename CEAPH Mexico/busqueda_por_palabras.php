<?php

     include_once("php/connection.php");
    
    $servername = $_SESSION['servername'];
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_select_db($conn, $username) or die(mysql_error());

    // 
    
?>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Pictogramas</title>

    <link href="css/bootstrap.min.css?rand=1237" rel="stylesheet">

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

    <script type="text/javascript">
        function ajaxBusquedaPictogramas() {
            var xmlhttp;
            var palabras = document.getElementById('palabras').value
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
    </script>
    
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
                    <h2>Favoritos</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <input type="text" name="palabras" id="palabras" placeholder="palabras" class="form-control" onkeyup="ajaxBusquedaPictogramas()" />
            </div>
        </div>
    </header>
    
    <section id="portfolio">
        <div class="container">
            <div id="imagenes" class="row">
            </div>
        </div>
    </section>

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