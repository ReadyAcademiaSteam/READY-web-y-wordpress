<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

	$campo1 = "nombrepie_".$row_listaidiomas["ref"];
	if(!isset($_POST[$campo1]) || $_POST[$campo1]==''){ $titulo = ""; }else{ $titulo = $_POST[$campo1]; }

	$sql_esta = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
	$rs_esta = mysqli_query($conn,$sql_esta);
	if(mysqli_num_rows($rs_esta)>0){
		$sql_actid = "UPDATE contenidos_info SET ";
		$sql_actid.= "pie='".$_POST[$campo1]."'";
		$sql_actid.= " WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
		$rs_actid = mysqli_query($conn,$sql_actid);
	}else{
		$sql_ins = "INSERT INTO contenidos_info (ref_contenido,ref_idioma,pie) VALUES ('".$ref."','".$row_listaidiomas["ref"]."','".$titulo."')";
		$rs_ins = mysqli_query($conn,$sql_ins);
	}
}

echo json_encode($resp);
?>
