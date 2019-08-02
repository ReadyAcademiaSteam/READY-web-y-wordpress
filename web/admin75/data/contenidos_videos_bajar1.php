<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql_video = "SELECT * FROM contenidos_videos WHERE ref=".$ref;
$rs_video = mysql_query($conn,$sql_video);
$row_video = mysql_fetch_array($rs_video);

$ref_contenido = $row_video["ref_contenido"];

$ele = $row_video["orden"];
$ant = $ele+1;
$neg = ($ele)*(-1);

$sql1 = "UPDATE contenidos_videos SET orden=".$neg." WHERE ref_contenido=".$ref_contenido." AND orden=".$ele;
$rs1 = mysql_query($conn,$sql1);

$sql2 = "UPDATE contenidos_videos SET orden=".$ele." WHERE ref_contenido=".$ref_contenido." AND orden=".$ant;
$rs2 = mysql_query($conn,$sql2);

$sql3 = "UPDATE contenidos_videos SET orden=".$ant." WHERE ref_contenido=".$ref_contenido." AND orden=".$neg;
$rs3 = mysql_query($conn,$sql3);

//--- ORDENAR

$sql_colocar = "SELECT * FROM contenidos_videos WHERE ref_contenido=".$ref_contenido." ORDER BY orden";
$rs_colocar = mysqli_query($conn,$sql_colocar);
$cta = 1;
while ($row_colocar = mysqli_fetch_array($rs_colocar)){
	$sql_ordenar = "UPDATE contenidos_docs SET orden=".$cta." WHERE ref=".$row_colocar["ref"];
	$rs_ordenar = mysqli_query($conn,$sql_ordenar);
	$cta++;
}

echo json_encode($resp);
?>
