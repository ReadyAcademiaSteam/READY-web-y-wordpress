<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql_act = "UPDATE boletin SET ";
$sql_act = $sql_act."fecha='".cambiarf_a_mysql($_POST["fecha"])."'";
$sql_act = $sql_act.",titulo='".$_POST["titulo"]."'";
$sql_act = $sql_act." WHERE ref=".$ref;
if($rs_act = mysqli_query($conn,$sql_act)){

	$ref_act = $ref;

	$sql_cont = "SELECT * FROM contenidos WHERE ref_menu IN (SELECT ref_menu FROM boletin_tipo) ORDER BY ref DESC";
	$rs_cont = mysqli_query($conn,$sql_cont);
	while($row_cont = mysqli_fetch_array($rs_cont)){
		$num = $row_cont["ref"];
		$sql_esta = "SELECT * FROM boletin_contenido WHERE ref_boletin=".$ref." AND ref_contenido=".$num;
		$rs_esta = mysqli_query($conn,$sql_esta);
		$campo = "contenido".$num;
		if(mysqli_num_rows($rs_esta)>0){
			if($_POST[$campo]!='S'){
				$sql_del = "DELETE FROM boletin_contenido WHERE ref_boletin=".$ref." AND ref_contenido=".$num;
				$rs_del = mysqli_query($conn,$sql_del);
			}
		}else{
			if($_POST[$campo]=='S'){
				$sql_ins = "INSERT INTO boletin_contenido (ref_boletin,ref_contenido) VALUES ('".$ref."','".$num."')";
				$rs_ins = mysqli_query($conn,$sql_ins);
			}
		}
	}

}else{

	$ref_act = 0;
}

$resp['act'] = $ref_act;

echo json_encode($resp);
?>
