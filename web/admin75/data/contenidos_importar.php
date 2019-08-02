<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_POST["entrada"];

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

// -- intro
$sql_v5 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=5";
$rs_v5 = mysqli_query($sql_v5,$conn);
if(mysqli_num_rows($rs_v5)>0){
	$row_v5 = mysqli_fetch_array($rs_v5);
	$v5 = $row_v5["opcion"];
}else{
	$v5 = "si";
}

// -- inscripción
$sql_v6 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=6";
$rs_v6 = mysqli_query($sql_v6,$conn);
if(mysqli_num_rows($rs_v6)>0){
	$row_v6 = mysqli_fetch_array($rs_v6);
	$v6 = $row_v6["opcion"];
}else{
	$v6 = "no";
}

// -- enlace
$sql_v9 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=9";
$rs_v9 = mysqli_query($sql_v9,$conn);
if(mysqli_num_rows($rs_v9)>0){
	$row_v9 = mysqli_fetch_array($rs_v9);
	$v9 = $row_v9["opcion"];
}else{
	$v9 = "no";
}

// -- fecha ini / fecha fin
$sql_v2 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=2";
$rs_v2 = mysqli_query($conn,$sql_v2);
if(mysqli_num_rows($rs_v2)>0){
	$row_v2 = mysqli_fetch_array($rs_v2);
	$v2 = $row_v2["opcion"];
}else{
	$v2 = "no";
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

// -- etiquetas
$sql_v14 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=14";
$rs_v14 = mysqli_query($sql_v14,$conn);
if(mysqli_num_rows($rs_v14)>0){
	$row_v14 = mysqli_fetch_array($rs_v14);
	$v14 = $row_v14["opcion"];
}else{
	$v14 = "no";
}

// ----------------- FIN VARIABLES

$sql = "SELECT * FROM contenidos WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

if($v0=="si"){
	$tipo = $row["ref_tipo"];
}else{
	$tipo = 0;
}

if($v1!="no"){
	$fecha = cambiarf_a_mysql($_POST["fecha"]);
}else{
	$fecha = date("Y-m-d");
}

if(isset($_POST["target"])){
	$target = "'".$_POST["target"]."'";
}else{
	$target = "NULL";
}

if($v11=="si" && $_POST["marcado"]=="S"){
	$marcado = "S";
}else{
	$marcado = "N";
}

if(($v3=="si") && ($v1=="no")){
	$sql_ult = "SELECT * FROM contenidos WHERE ref_menu='".$mod."'";
	if($v0=="si"){
		$sql_ult = $sql_ult." AND ref_tipo=".$_POST["tipo"];
	}
	$sql_ult = $sql_ult." ORDER BY orden DESC";
	$rs_ult = mysqli_query($conn,$sql_ult);
	$row_ult = mysqli_fetch_array($rs_ult);
	$orden = intval($row_ult["orden"])+1;
}else{
	$orden = 0;
}

$sql_ins = "INSERT INTO contenidos ";
$sql_ins.= "(fecha,ref_menu,ref_tipo,firma,orden)";
$sql_ins.= " VALUES ('".$fecha."','".$mod."','".$tipo."','".$row["firma"]."','".$orden."'";
$sql_ins.= ")";

if($rs_ins = mysqli_query($conn,$sql_ins)){

  $sql_ult = "SELECT * FROM contenidos ORDER BY ref DESC";
  $rs_ult = mysqli_query($conn,$sql_ult);
  $row_ult = mysqli_fetch_array($rs_ult);

  $ref_ins = $row_ult["ref"];

  $sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
  $rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
  while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

		$sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
		$rs_info = mysqli_query($conn,$sql_info);
		$row_info = mysqli_fetch_array($rs_info);

    $sql_ins = "INSERT INTO contenidos_info
								(ref_contenido,
								ref_idioma,
								titulo,
								intro,
								texto,
								texto2,
								seo_title,
								seo_descripcion) ";

		$sql_ins.= "VALUES
								('".$ref_ins."',
								'".$row_listaidiomas["ref"]."',
								'".$row_info["titulo"]."',
								'".$row_info["intro"]."',
								'".$row_info["texto"]."',
								'".$row_info["texto2"]."',
								'".$row_info["seo_title"]."',
								'".$row_info["seo_descripcion"]."')";

    $rs_ins = mysqli_query($conn,$sql_ins);

  }

}else{

  $ref_ins = 0;
}

// ------------------ ETIQUETAS ------------------

if($v14!="no"){

	$sql_etiquetas = "SELECT * FROM contenidos_rel_etiquetas WHERE ref_contenido=".$ref." ORDER BY orden";
	$rs_etiquetas = mysqli_query($conn,$sql_etiquetas);
	while($row_etiquetas = mysqli_fetch_array($rs_etiquetas)){
		$sql_ins = "INSERT INTO contenidos_rel_etiquetas (ref_contenido,ref_etiqueta) VALUES ('".$ref_ins."','".$row_etiquetas["ref_etiqueta"]."')";
		$rs_ins = mysqli_query($conn,$sql_ins);
	}
}

$resp['ins'] = $ref_ins;

echo json_encode($resp);
?>
