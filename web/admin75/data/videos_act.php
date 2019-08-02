<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];

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

// -- target
$sql_v4 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=4";
$rs_v4 = mysqli_query($conn,$sql_v4);
if(mysqli_num_rows($rs_v4)>0){
	$row_v4 = mysqli_fetch_array($rs_v4);
	$v4 = $row_v4["opcion"];
}else{
	$v4 = "no";
}

// ----------------- FIN VARIABLES

$sql_act = "UPDATE contenidos SET ";
$sql_act.= "codigo='".$_POST["codigo"]."'";
if($v0!='no'){
	$sql_act.= ",ref_tipo='".$_POST["tipo"]."'";
}
if($v1!='no'){
	$sql_act.= ",fecha='".cambiarf_a_mysql($_POST["fecha"])."'";
}
$sql_act.= " WHERE ref=".$ref;
if($rs_act = mysqli_query($conn,$sql_act)){

	$ref_act = $ref;

	$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
	$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
	while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

		$campo1 = "titulo_".$row_listaidiomas["ref"];
		if($v4!="no"){ $campo2 = "intro_".$row_listaidiomas["ref"]; }

		$sql_esta = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
		$rs_esta = mysqli_query($conn,$sql_esta);
		if(mysqli_num_rows($rs_esta)>0){
			$sql_actid = "UPDATE contenidos_info SET ";
			$sql_actid.= "titulo='".$_POST[$campo1]."'";
			if($v4!="no"){ $sql_actid.= ",intro='".$_POST[$campo2]."'"; }
			$sql_actid.= " WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
			$rs_actid = mysqli_query($conn,$sql_actid);

		}else{

			if($v4!="no"){ $intro = $_POST[$campo2]; }else{ $intro = ""; }

			$sql_ins = "INSERT INTO contenidos_info (ref_contenido,ref_idioma,titulo,intro) VALUES ('".$ref."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."','".$intro."')";
			$rs_ins = mysqli_query($conn,$sql_ins);
		}
	}

	if($v0=="si"){
		if($_POST["tipo"]!=$_POST["tipo_origen"]){

			$sql_cero = "UPDATE contenidos SET orden='0' WHERE ref=".$ref;
			$rs_cero = mysqli_query($conn,$sql_cero);

			$sql_ult = "SELECT * FROM contenidos WHERE ref_tipo=".$_POST["tipo"]." ORDER BY orden DESC";
			$rs_ult = mysqli_query($conn,$sql_ult);
			$row_ult = mysqli_fetch_array($rs_ult);
			$orden_nuevo = $row_ult["orden"]+1;

			$sql_orden_nuevo = "UPDATE contenidos SET orden=".$orden_nuevo." WHERE ref=".$ref;
			$rs_orden_nuevo = mysqli_query($conn,$sql_orden_nuevo);

			$sql_selord = "SELECT * FROM contenidos WHERE ref_menu=".$mod." AND ref_tipo=".$_POST["tipo_origen"]." ORDER BY orden";
			$rs_selord = mysqli_query($conn,$sql_selord);
			$cta = 1;
			while ($row_selord = mysqli_fetch_array($rs_selord)){
				$sql_ord = "UPDATE contenidos SET orden=".$cta." WHERE ref=".$row_selord["ref"];
				$rs_ord = mysqli_query($conn,$sql_ord);
				$cta++;
			}
		}
	}

}else{

	$ref_act = 0;

}

$resp['act'] = $ref_act;

echo json_encode($resp);
?>
