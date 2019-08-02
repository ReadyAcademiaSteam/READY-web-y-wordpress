<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql = "SELECT * FROM contenidos_fotos WHERE ref_contenido=".$ref;
$rs = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($rs)){
	$campo = "orden".$row["ref"];
	$sql_act = "UPDATE contenidos_fotos SET orden=".$_POST[$campo]." WHERE ref=".$row["ref"];
	$rs_act = mysqli_query($conn,$sql_act);
}

$sql_colocar = "SELECT * FROM contenidos_fotos WHERE ref_contenido=".$ref." ORDER BY orden";
$rs_colocar = mysqli_query($conn,$sql_colocar);
$cuenta = 1;
while ($row_colocar = mysqli_fetch_array($rs_colocar)){
	$sql_ordenar = "UPDATE contenidos_fotos SET orden=".$cuenta." WHERE ref=".$row_colocar["ref"];
	$rs_ordenar = mysqli_query($conn,$sql_ordenar);
	$cuenta++;
}

echo json_encode($resp);
?>
