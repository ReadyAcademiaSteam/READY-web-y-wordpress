<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];
$opcion = $_GET["opcion"];

$resp = array();

$sql_act = "UPDATE contenidos SET ";
if($opcion=="S"){
	$sql_act.= "marcado='S'";
}else{
	$sql_act.= "marcado='N'";
}
$sql_act.= " WHERE ref=".$ref;
$rs_act = mysqli_query($conn,$sql_act);

echo json_encode($resp);
?>
