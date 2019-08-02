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

// -- fecha ini-fin
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

// -- intro
$sql_v7 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=7";
$rs_v7 = mysqli_query($conn,$sql_v7);
if(mysqli_num_rows($rs_v7)>0){
	$row_v7 = mysqli_fetch_array($rs_v7);
	$v7 = $row_v7["opcion"];
}else{
	$v7 = "si";
}

// -- texto
$sql_v8 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=8";
$rs_v8 = mysqli_query($conn,$sql_v8);
if(mysqli_num_rows($rs_v8)>0){
	$row_v8 = mysqli_fetch_array($rs_v8);
	$v8 = $row_v8["opcion"];
}else{
	$v8 = "si";
}

// -- texto2
$sql_v9 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=9";
$rs_v9 = mysqli_query($conn,$sql_v9);
if(mysqli_num_rows($rs_v9)>0){
	$row_v9 = mysqli_fetch_array($rs_v9);
	$v9 = $row_v9["opcion"];
}else{
	$v9 = "no";
}

// -- firma
$sql_v10 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=10";
$rs_v10 = mysqli_query($conn,$sql_v10);
if(mysqli_num_rows($rs_v10)>0){
	$row_v10 = mysqli_fetch_array($rs_v10);
	$v10 = $row_v10["opcion"];
}else{
	$v10 = "no";
}

// -- etiquetas
$sql_v14 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=14";
$rs_v14 = mysqli_query($conn,$sql_v14);
if(mysqli_num_rows($rs_v14)>0){
	$row_v14 = mysqli_fetch_array($rs_v14);
	$v14 = $row_v14["opcion"];
}else{
	$v14 = "no";
}

// -- seo
$sql_v17 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=17";
$rs_v17 = mysqli_query($conn,$sql_v17);
if(mysqli_num_rows($rs_v17)>0){
	$row_v17 = mysqli_fetch_array($rs_v17);
	$v17 = $row_v17["opcion"];
}else{
	$v17 = "no";
}

// -- enlace
$sql_v20 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=20";
$rs_v20 = mysqli_query($conn,$sql_v20);
if(mysqli_num_rows($rs_v20)>0){
	$row_v20 = mysqli_fetch_array($rs_v20);
	$v20 = $row_v20["opcion"];
}else{
	$v20 = "no";
}

// -- target
$sql_v200 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=200";
$rs_v200 = mysqli_query($conn,$sql_v200);
if(mysqli_num_rows($rs_v200)>0){
	$row_v200 = mysqli_fetch_array($rs_v200);
	$v200 = $row_v200["opcion"];
}else{
	$v200 = "no";
}

// ----------------- FIN VARIABLES

if(isset($_POST["tipo"])){
	$tipo = intval($_POST["tipo"]);
}else{
	$tipo = 0;
}

if($v1!="no"){
	$fecha = cambiarf_a_mysql($_POST["fecha"]);
}else{
	$fecha = date("Y-m-d");
}

if(isset($_POST["fecha_ini"])&&($_POST["fecha_ini"]!="")){
	$fecha_ini = "'".cambiarf_a_mysql($_POST["fecha_ini"])."'";
}else{
	$fecha_ini = "NULL";
}

if(isset($_POST["fecha_fin"])&&($_POST["fecha_fin"]!="")){
	$fecha_fin = "'".cambiarf_a_mysql($_POST["fecha_fin"])."'";
}else{
	if(isset($_POST["fecha_ini"])&&($_POST["fecha_ini"]!="")){
		$fecha_fin = "'".cambiarf_a_mysql($_POST["fecha_ini"])."'";
	}else{
		$fecha_fin = "NULL";
	}
}

if(isset($_POST["firma"])){
	$firma = comillas($_POST["firma"]);
}else{
	$firma = "";
}

if(isset($_POST["enlace"])){
	$enlace = $_POST["enlace"];
}else{
	$enlace = "";
}

if(isset($_POST["target"])){
	$target = "'".$_POST["target"]."'";
}else{
	$target = "NULL";
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
$sql_ins.= "(fecha,ref_menu,ref_tipo,firma,fecha_ini,fecha_fin";
$sql_ins.= ",enlace,target,orden";
$sql_ins.= ")";
$sql_ins.= " VALUES ('".$fecha."','".$mod."','".$tipo."','".$firma."',".$fecha_ini.",".$fecha_fin.",";
$sql_ins.= "'".$enlace."',".$target.",'".$orden."'";
$sql_ins.= ")";

if($rs_ins = mysqli_query($conn,$sql_ins)){

  $sql_ult = "SELECT * FROM contenidos ORDER BY ref DESC";
  $rs_ult = mysqli_query($conn,$sql_ult);
  $row_ult = mysqli_fetch_array($rs_ult);

  $ref_ins = $row_ult["ref"];

  $sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
  $rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
  while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

    $campo1 = "titulo_".$row_listaidiomas["ref"];
    if($v7=="si"){ $campo2 = "intro_".$row_listaidiomas["ref"]; }
    if($v8=="si"){ $campo3 = "texto_".$row_listaidiomas["ref"]; }
    if($v9=="si"){ $campo4 = "texto2_".$row_listaidiomas["ref"]; }
    if($v17=="si"){
      $campo5 = "title_".$row_listaidiomas["ref"];
      $campo6 = "descripcion_".$row_listaidiomas["ref"];
    }

		$titulo = comillas($_POST[$campo1]);
    if($v7=="si"){ $intro = comillas($_POST[$campo2]); }else{ $intro = ""; }
    if($v8=="si"){ $texto = $_POST[$campo3]; }else{ $texto = ""; }
    if($v9=="si"){ $texto2 = $_POST[$campo4]; }else{ $texto2 = ""; }
    if($v17=="si"){
      $title = comillas($_POST[$campo5]);
      $descripcion = comillas($_POST[$campo6]);
    }else{
      $title = "";
      $descripcion = "";
    }

    $sql_ins = "INSERT INTO contenidos_info (ref_contenido,ref_idioma,titulo,intro,texto,texto2,seo_title,seo_descripcion) VALUES ('".$row_ult["ref"]."','".$row_listaidiomas["ref"]."','".$titulo."','".$intro."','".$texto."','".$texto2."','".$title."','".$descripcion."')";
    $rs_ins = mysqli_query($conn,$sql_ins);

  }

}else{

  $ref_ins = 0;
}

// ------------------ ETIQUETAS ------------------

if($v14=="si"){

	$sql_etiquetas = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
	$rs_etiquetas = mysqli_query($conn,$sql_etiquetas);
	while($row_etiquetas = mysqli_fetch_array($rs_etiquetas)){

		$sql_ctg = "SELECT * FROM contenidos_rel_etiquetas WHERE ref_contenido=".$ref_ins." AND ref_etiqueta=".$row_etiquetas["ref"];
		$rs_ctg = mysqli_query($conn,$sql_ctg);

		$campo = "etiqueta".$row_etiquetas["ref"];

		if(mysqli_num_rows($rs_ctg)>0){
			if($_POST[$campo]!='S'){
				$sql_del = "DELETE FROM contenidos_rel_etiquetas WHERE ref_contenido=".$ref_ins." AND ref_etiqueta=".$row_etiquetas["ref"];
				$rs_del = mysqli_query($conn,$sql_del);
			}
		}else{
			if($_POST[$campo]=='S'){
				$sql_ins = "INSERT INTO contenidos_rel_etiquetas (ref_contenido,ref_etiqueta) VALUES ('".$ref_ins."','".$row_etiquetas["ref"]."')";
				$rs_ins = mysqli_query($conn,$sql_ins);
			}
		}
	}
}

$resp['ins'] = $ref_ins;

echo json_encode($resp);
?>
