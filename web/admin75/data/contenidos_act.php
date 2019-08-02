<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];
if(isset($_GET["tipo"]) && $_GET["tipo"]=="fijo"){ $fijo = true; }else{ $fijo = false; }

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
	if(!$fijo){
		$v1 = "anno";
	}else{
		$v1 = "no";
	}
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

// -- intro
$sql_v7 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=7";
$rs_v7 = mysqli_query($conn,$sql_v7);
if(mysqli_num_rows($rs_v7)>0){
	$row_v7 = mysqli_fetch_array($rs_v7);
	$v7 = $row_v7["opcion"];
}else{
	if(!$fijo){
		$v7 = "si";
	}else{
		$v7 = "no";
	}
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

// -- título
$sql_v13 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=13";
$rs_v13 = mysqli_query($conn,$sql_v13);
if(mysqli_num_rows($rs_v13)>0){
	$row_v13 = mysqli_fetch_array($rs_v13);
	$v13 = $row_v13["opcion"];
}else{
	if(!$fijo){
		$v13 = "si";
	}else{
		$v13 = "no";
	}
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

$ref_act = 0;

$sql_act = "UPDATE contenidos SET ";

if($v1!="no"){
	$sql_act.= "fecha='".cambiarf_a_mysql($_POST["fecha"])."',";
}

if(isset($_POST["tipo"])){
	$sql_act.= "ref_tipo='".$_POST["tipo"]."',";
}

if(isset($_POST["firma"])){
	$sql_act.= "firma='".comillas($_POST["firma"])."',";
}

if(isset($_POST["fecha_ini"])&&($_POST["fecha_ini"]!="")){
	$sql_act.= "fecha_ini='".cambiarf_a_mysql($_POST["fecha_ini"])."',";
}else{
	$sql_act.= "fecha_ini=NULL,";
}

if(isset($_POST["fecha_fin"])&&($_POST["fecha_fin"]!="")){
	$sql_act.= "fecha_fin='".cambiarf_a_mysql($_POST["fecha_fin"])."',";
}else{
	if(isset($_POST["fecha_ini"])&&($_POST["fecha_ini"]!="")){
		$sql_act.= "fecha_fin='".cambiarf_a_mysql($_POST["fecha_ini"])."',";
	}else{
		$sql_act.= "fecha_fin=NULL,";
	}
}

if($v20=="si"){
	$sql_act.= "enlace='".$_POST["enlace"]."',";
	if($v200=="si"){
		$sql_act.= "target='".$_POST["target"]."',";
	}
}

$sql_act = substr($sql_act,0,-1);
$sql_act.= " WHERE ref=".$ref;

if($rs_act = mysqli_query($conn,$sql_act)){
	$ref_act = $ref;
}

$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

	if($v13=="si"){ $campo1 = "titulo_".$row_listaidiomas["ref"]; }
	if($v7=="si"){ $campo2 = "intro_".$row_listaidiomas["ref"]; }
	if($v8=="si"){ $campo3 = "texto_".$row_listaidiomas["ref"]; }
	if($v9=="si"){ $campo4 = "texto2_".$row_listaidiomas["ref"]; }
	if($v17=="si"){
		$campo5 = "title_".$row_listaidiomas["ref"];
		$campo6 = "descripcion_".$row_listaidiomas["ref"];
	}

	$sql_esta = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
	$rs_esta = mysqli_query($conn,$sql_esta);
	if(mysqli_num_rows($rs_esta)>0){
		$sql_actid = "UPDATE contenidos_info SET ";
		if($v13=="si"){ $sql_actid.= "titulo='".comillas($_POST[$campo1])."',"; }
		if($v7=="si"){ $sql_actid.= "intro='".comillas($_POST[$campo2])."',"; }
		if($v8=="si"){ $sql_actid.= "texto='".$_POST[$campo3]."',"; }
		if($v9=="si"){ $sql_actid.= "texto2='".$_POST[$campo4]."',"; }
		if($v17=="si"){
			$sql_actid.= "seo_title='".comillas($_POST[$campo5])."',";
			$sql_actid.= "seo_descripcion='".comillas($_POST[$campo6])."',";
		}
		$sql_actid = substr($sql_actid,0,-1);
		$sql_actid.= " WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
		if($rs_actid = mysqli_query($conn,$sql_actid)){
			$ref_act = $ref;
		}

	}else{

		if($v13=="si"){ $titulo = comillas($_POST[$campo1]); }else{ $titulo = ""; }
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
		$sql_ins = "INSERT INTO contenidos_info (ref_contenido,ref_idioma,titulo,intro,texto,texto2,seo_title,seo_descripcion) VALUES ('".$ref."','".$row_listaidiomas["ref"]."','".$titulo."','".$intro."','".$texto."','".$texto2."','".$title."','".$descripcion."')";
		if($rs_ins = mysqli_query($conn,$sql_ins)){
			$ref_act = $ref;
		}
	}
}

// ------------------ REORDENAR SI CAMBIA DE TIPO Y HAY ORDEN ------------------

if($v0=="si" && $v3=="si"){

	if($_POST["tipo"]!=$_POST["tipo_origen"]){

		$sql_cero = "UPDATE contenidos SET orden='0' WHERE ref=".$ref;
		$rs_cero = mysqli_query($conn,$sql_cero);

		$sql_ult = "SELECT * FROM contenidos WHERE ref_tipo=".$_POST["tipo"]." ORDER BY orden DESC";
		$rs_ult = mysqli_query($conn,$sql_ult);
		$row_ult = mysqli_fetch_array($rs_ult);
		$orden_nuevo = $row_ult["orden"]+1;

		$sql_act_orden = "UPDATE contenidos SET orden=".$orden_nuevo." WHERE ref=".$ref;
		$rs_act_orden = mysqli_query($conn,$sql_act_orden);

		$sql_selord = "SELECT * FROM contenidos WHERE ref_menu=".$mod." AND ref_tipo=".$_POST["tipo_origen"]." ORDER BY orden";
		$rs_selord = mysqli_query($conn,$sql_selord);
		$cta = 1;
		while($row_selord = mysqli_fetch_array($rs_selord)){
			$sql_ord = "UPDATE contenidos SET orden=".$cta." WHERE ref=".$row_selord["ref"];
			$rs_ord = mysqli_query($conn,$sql_ord);
			$cta++;
		}
	}
}

// ------------------ ETIQUETAS ------------------

if($v14=="si"){

	$sql_etiquetas = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
	$rs_etiquetas = mysqli_query($conn,$sql_etiquetas);
	while($row_etiquetas = mysqli_fetch_array($rs_etiquetas)){

		$sql_ctg = "SELECT * FROM contenidos_rel_etiquetas WHERE ref_contenido=".$ref." AND ref_etiqueta=".$row_etiquetas["ref"];
		$rs_ctg = mysqli_query($conn,$sql_ctg);

		$campo = "etiqueta".$row_etiquetas["ref"];

		if(mysqli_num_rows($rs_ctg)>0){
			if(!isset($_POST[$campo])){
				$sql_del = "DELETE FROM contenidos_rel_etiquetas WHERE ref_contenido=".$ref." AND ref_etiqueta=".$row_etiquetas["ref"];
				$rs_del = mysqli_query($conn,$sql_del);
			}
		}else{
			if(isset($_POST[$campo]) && $_POST[$campo]=='S'){
				$sql_ins = "INSERT INTO contenidos_rel_etiquetas (ref_contenido,ref_etiqueta) VALUES ('".$ref."','".$row_etiquetas["ref"]."')";
				$rs_ins = mysqli_query($conn,$sql_ins);
			}
		}
	}
}

$resp['act'] = $ref_act;

echo json_encode($resp);
?>
