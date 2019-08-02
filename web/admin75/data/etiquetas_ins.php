<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];

$resp = array();

$sql_orden = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden DESC";
$rs_orden = mysqli_query($conn,$sql_orden);
$row_orden = mysqli_fetch_array($rs_orden);
$orden = $row_orden["orden"]+1;

$sql_ins = "INSERT INTO etiquetas";
$sql_ins.= " (ref_menu,orden)";
$sql_ins.= " VALUES ('".$mod."','".$orden."')";
if($rs_ins = mysqli_query($conn,$sql_ins)){

  $sql_ult = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden DESC";
  $rs_ult = mysqli_query($conn,$sql_ult);
  $row_ult = mysqli_fetch_array($rs_ult);

  $ref_ins = $row_ult["ref"];

  $sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
	$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
	while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

		$campo1 = "nombre_".$row_listaidiomas["ref"];

		$sql_ins = "INSERT INTO etiquetas_info (ref_etiqueta,ref_idioma,nombre) VALUES ('".$ref_ins."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."')";
		$rs_ins = mysqli_query($conn,$sql_ins);

	}

}else{

  $ref_ins = 0;
}

$resp["ins"] = $ref_ins;

echo json_encode($resp);
?>
