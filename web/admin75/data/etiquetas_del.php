<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];

$resp = array();

$sql_del = "DELETE FROM etiquetas WHERE ref=".$ref;
$rs_del = mysqli_query($conn,$sql_del);

//--- ORDENAR

$sql_colocar = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
$rs_colocar = mysqli_query($conn,$sql_colocar);
$cta = 1;
while ($row_colocar = mysqli_fetch_array($rs_colocar)){
	$sql_ordenar = "UPDATE etiquetas SET orden=".$cta." WHERE ref=".$row_colocar["ref"];
	$rs_ordenar = mysqli_query($conn,$sql_ordenar);
	$cta++;
}

echo json_encode($resp);
?>
