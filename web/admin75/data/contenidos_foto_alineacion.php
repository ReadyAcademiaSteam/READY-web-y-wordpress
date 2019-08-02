<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];
$align = $_GET["align"];

$resp = array();

$sql_act = "UPDATE contenidos SET ";
$sql_act.= "align='".$align."' ";
$sql_act.= "WHERE ref='".$ref."'";
$rs_act = mysqli_query($conn,$sql_act);

echo json_encode($resp);
?>
