<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql_del = "DELETE FROM registrados WHERE ref=".$ref;
$rs_del = mysqli_query($conn,$sql_del);

echo json_encode($resp);
?>
