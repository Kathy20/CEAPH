<?

include_once("connection.php");

$servername = $_SESSION['servername'];
$username = $_SESSION['username'];
$password = $_SESSION['password'];

$_SESSION['conn'] = mysqli_connect($servername, $username, $password);
if (!$_SESSION['conn']) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_select_db($_SESSION['conn'], $username) or die(mysql_error());

?>