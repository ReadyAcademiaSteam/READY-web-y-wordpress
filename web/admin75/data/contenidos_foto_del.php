<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];
$ppal = $_GET["ppal"];

$resp = array();

$rs = mysqli_query("SELECT * FROM contenidos WHERE ref=".$ref,$conn);
$row = mysqli_fetch_array($rs);

switch ($ppal) {
	case 1:
		$foto = $row["foto"];
		break;
	case 2:
		$foto = $row["foto2"];
		break;
	case 3:
		$foto = $row["foto3"];
		break;
}

if(file_exists("../../imagenes/contenidos/".$foto)){ unlink("../../imagenes/contenidos/".$foto); }
if(file_exists("../../imagenes/contenidos/0/".$foto)){ unlink("../../imagenes/contenidos/0/".$foto); }

$sql_copias = "SELECT * FROM menu_admin_dimensiones WHERE ref_menu=".$mod." AND clase=".$ppal;
$rs_copias = mysqli_query($conn,$sql_copias);
while($row_copias = mysqli_fetch_array($rs_copias)){
	if(file_exists("../../imagenes/contenidos/".$row_copias["ref"]."/".$foto)){ unlink("../../imagenes/contenidos/".$row_copias["ref"]."/".$foto); }
}

if($ppal==1){
	$sql_act = "UPDATE contenidos SET foto='' WHERE ref=".$ref;
	$rs_act = mysqli_query($conn,$sql_act);
}else{
	$sql_act = "UPDATE contenidos SET foto".$ppal."='' WHERE ref=".$ref;
	$rs_act = mysqli_query($conn,$sql_act);
}

$sql_pie = "UPDATE contenidos_info SET pie='' WHERE ref_contenido=".$ref;
$rs_pie = mysqli_query($conn,$sql_pie);

echo json_encode($resp);
?>
