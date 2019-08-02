<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql_video = "SELECT * FROM contenidos_videos WHERE ref=".$ref;
$rs_video = mysql_query($conn,$sql_video);
$row_video = mysql_fetch_array($rs_video);

$ref_contenido = $row_video["ref_contenido"];

//----- ELIMINAR REGISTRO

$sql_del = "DELETE FROM contenidos_videos WHERE ref=".$ref;
$rs_del = mysql_query($conn,$sql_del);

//----- REORDENAR

$sql_selord = "SELECT * FROM contenidos_videos WHERE ref_contenido='".$ref_contenido."' ORDER BY orden";
$rs_selord = mysql_query($conn,$sql_selord);
$cta = 1;
while ($row_selord = mysql_fetch_array($rs_selord)){
  $sql_ord = "UPDATE contenidos_videos SET orden=".$cta." WHERE ref=".$row_selord["ref"];
  $rs_ord = mysql_query($conn,$sql_ord);
  $cta++;
}

echo json_encode($resp);
?>
