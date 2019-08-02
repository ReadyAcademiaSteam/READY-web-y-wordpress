<?
$nombre_BD = "academiaready_bdd";
$servidor_BD = "localhost:3306";
$usuario_BD = "root";
$password_BD = "root";

$conn = mysqli_connect($servidor_BD, $usuario_BD, $password_BD, $nombre_BD) or die('Error de conexión a la Base de Datos');

mysqli_set_charset($conn, 'utf8');
?>
