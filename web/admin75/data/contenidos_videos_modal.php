<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql = "SELECT * FROM contenidos_videos WHERE ref=".$ref;
$rs = mysql_query($conn,$sql);
$row = mysql_fetch_array($rs);

//------------------------ código ---------------------------
$resp['codigo'] = $row["codigo"];

$sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
$rs_idiomas = mysql_query($conn,$sql_idiomas);
while($row_idiomas = mysql_fetch_array($rs_idiomas)){

	$sql_info = "SELECT * FROM contenidos_videos_info WHERE ref_video=".$ref." AND ref_idioma=".$row_idiomas["ref"];
	$rs_info = mysql_query($conn,$sql_info);
	$row_info = mysql_fetch_array($rs_info);

	$campo = "nombrevideo_".$row_idiomas["ref"];

	//------------------------ nombre ----------------------
	$resp[$campo] = $row_info["nombre"];
}

echo json_encode($resp);
?>
