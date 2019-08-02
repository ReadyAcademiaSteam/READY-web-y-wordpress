<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql = "SELECT * FROM boletin WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

$resp['titulo'] = $row["titulo"];

echo json_encode($resp);
?>
