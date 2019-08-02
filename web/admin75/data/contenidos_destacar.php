<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];

$resp = array();

$sql_limpia = "UPDATE contenidos SET destacado='N' WHERE ref_menu=".$mod;
$rs_limpia = mysqli_query($conn,$sql_limpia);

$sql_dest = "UPDATE contenidos SET destacado='S' WHERE ref=".$ref;
$rs_dest = mysqli_query($conn,$sql_dest);

echo json_encode($resp);
?>
