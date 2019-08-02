<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];

$resp = array();

$sql_etiqueta = "SELECT * FROM etiquetas WHERE ref=".$ref;
$rs_etiqueta = mysqli_query($conn,$sql_etiqueta);
$row_etiqueta = mysqli_fetch_array($rs_etiqueta);

$ele = $row_etiqueta["orden"];
$ant = $ele+1;
$neg = ($ele)*(-1);

$sql1 = "UPDATE etiquetas SET orden=".$neg." WHERE orden=".$ele." AND ref_menu=".$mod;
$rs1 = mysqli_query($conn,$sql1);

$sql2 = "UPDATE etiquetas SET orden=".$ele." WHERE orden=".$ant." AND ref_menu=".$mod;
$rs2 = mysqli_query($conn,$sql2);

$sql3 = "UPDATE etiquetas SET orden=".$ant." WHERE orden=".$neg." AND ref_menu=".$mod;
$rs3 = mysqli_query($conn,$sql3);

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
