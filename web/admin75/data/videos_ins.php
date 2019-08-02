<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];

$resp = array();

// ----------------- VARIABLES

// -- tipo
$sql_v0 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=0";
$rs_v0 = mysqli_query($conn,$sql_v0);
if(mysqli_num_rows($rs_v0)>0){
	$row_v0 = mysqli_fetch_array($rs_v0);
	$v0 = $row_v0["opcion"];
}else{
	$v0 = "no";
}

// -- fecha
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "anno";
}

// -- orden
$sql_v3 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=3";
$rs_v3 = mysqli_query($conn,$sql_v3);
if(mysqli_num_rows($rs_v3)>0){
	$row_v3 = mysqli_fetch_array($rs_v3);
	$v3 = $row_v3["opcion"];
}else{
	$v3 = "no";
}

// -- descripcion
$sql_v4 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=4";
$rs_v4 = mysqli_query($conn,$sql_v4);
if(mysqli_num_rows($rs_v4)>0){
	$row_v4 = mysqli_fetch_array($rs_v4);
	$v4 = $row_v4["opcion"];
}else{
	$v4 = "no";
}

// ----------------- FIN VARIABLES

if($_POST["tipo"]){
	$tipo = $_POST["tipo"];
}else{
	$tipo = 0;
}

if($v1!='no'){
	$fecha = cambiarf_a_mysql($_POST["fecha"]);
}else{
	$fecha = date("Y-m-d");
}

if($v3=="si"){
	$sql_ult = "SELECT * FROM contenidos WHERE ref_menu='".$mod."'";
	if($v0=="si"){
		$sql_ult.= " AND ref_tipo=".$_POST["tipo"];
	}
	$sql_ult.= " ORDER BY orden DESC";
	$rs_ult = mysqli_query($conn,$sql_ult);
	$row_ult = mysqli_fetch_array($rs_ult);
	$orden = $row_ult["orden"]+1;
}else{
	$orden = 0;
}

$sql_ins = "INSERT INTO contenidos ";
$sql_ins.= "(ref_menu,ref_tipo,fecha,codigo,orden)";
$sql_ins.= " VALUES ('".$mod."','".$tipo."','".$fecha."'";
$sql_ins.= ",'".$_POST["codigo"]."','".$orden."')";
if($rs_ins = mysqli_query($conn,$sql_ins)){

	$sql_ult = "SELECT * FROM contenidos  WHERE ref_menu='".$mod."' ORDER BY ref DESC";
	$rs_ult = mysqli_query($conn,$sql_ult);
	$row_ult = mysqli_fetch_array($rs_ult);

	$ref_ins = $row_ult["ref"];

	$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
	$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
	while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

		$campo1 = "titulo_".$row_listaidiomas["ref"];
		if($v4=="si"){
			$campo2 = "intro_".$row_listaidiomas["ref"];
			$intro = $_POST[$campo2];
		}else{
			$intro = "";
		}

		$sql_ins = "INSERT INTO contenidos_info (ref_contenido,ref_idioma,titulo,intro) VALUES ('".$ref_ins."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."','".$intro."')";
		$rs_ins = mysqli_query($conn,$sql_ins);

	}

}else{

	$ref_ins = 0;
}

$resp['ins'] = $ref_ins;

echo json_encode($resp);
?>
