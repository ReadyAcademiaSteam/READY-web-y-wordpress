<?
include("../../include/conexion.php");
include("../include/funciones.php");

$resp = array();

$sql_ins = "INSERT INTO boletin ";
$sql_ins = $sql_ins."(fecha,titulo)";
$sql_ins = $sql_ins." VALUES ('".cambiarf_a_mysql($_POST["fecha"])."','".$_POST["titulo"]."')";
if($rs_ins = mysqli_query($conn,$sql_ins)){

	$sql_ult = "SELECT * FROM boletin ORDER BY ref DESC";
	$rs_ult = mysqli_query($conn,$sql_ult);
	$row_ult = mysqli_fetch_array($rs_ult);
	$ref_ins = $row_ult["ref"];

	$sql_cont = "SELECT * FROM contenidos WHERE ref_menu IN (SELECT ref_menu FROM boletin_tipo) ORDER BY ref";
	$rs_cont = mysqli_query($conn,$sql_cont);
	while($row_cont = mysqli_fetch_array($rs_cont)){
		$campo = "contenido".$row_cont["ref"];
		if($_POST[$campo]=='S'){
			$sql_ins2 = "INSERT INTO boletin_contenido ";
			$sql_ins2.= "(ref_boletin,ref_contenido) ";
			$sql_ins2.= "VALUES ('".$ref_ins."','".$row_cont["ref"]."')";
			$rs_ins2 = mysqli_query($conn,$sql_ins2);
		}
	}

}else{

	$ref_ins = 0;
}

$resp['ins'] = $ref_ins;

echo json_encode($resp);
?>
