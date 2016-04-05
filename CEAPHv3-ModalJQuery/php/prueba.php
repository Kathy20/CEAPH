<?php
	include_once("connection.php");
	$servername = $_SESSION['servername'];
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	echo $servername;
    $conn = mysqli_connect($servername, $username, $password);
    if (!$conn) {
        die("No se pudo conectar con la base de datos, error No. : " . mysqli_connect_error());
    }
    mysqli_select_db($conn, $username) or die(mysql_error());

 ?>