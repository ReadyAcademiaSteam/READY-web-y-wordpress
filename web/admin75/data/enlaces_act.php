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
	$v0 = "si";
}

// -- descripcion
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "no";
}

// -- orden
$sql_v3 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=3";
$rs_v3 = mysqli_query($conn,$sql_v3);
if(mysqli_num_rows($rs_v3)>0){
	$row_v3 = mysqli_fetch_array($rs_v3);
	$v3 = $row_v3["opcion"];
}else{
	$v3 = "si";
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

// -- etiquetas
$sql_v5 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=5";
$rs_v5 = mysqli_query($conn,$sql_v5);
if(mysqli_num_rows($rs_v5)>0){
	$row_v5 = mysqli_fetch_array($rs_v5);
	$v5 = $row_v5["opcion"];
}else{
	$v5 = "no";
}

// ----------------- FIN VARIABLES

$sql_act = "UPDATE contenidos SET ";
$sql_act.= "enlace='".$_POST["enlace"]."'";
if($v0=="si"){ $sql_act.= ",ref_tipo='".$_POST["tipo"]."'"; }
if($v4=="si"){ $sql_act.= ",target='".$_POST["target"]."'"; }
$sql_act.= " WHERE ref=".$ref;
if($rs_act = mysqli_query($conn,$sql_act)){

	$ref_act = $ref;

	$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
	$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
	while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

		$campo1 = "titulo_".$row_listaidiomas["ref"];
		if($v1=="si"){ $campo2 = "intro_".$row_listaidiomas["ref"]; }

		$sql_esta = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
		$rs_esta = mysqli_query($conn,$sql_esta);
		if(mysqli_num_rows($rs_esta)>0){
			$sql_actid = "UPDATE contenidos_info SET ";
			$sql_actid.= "titulo='".$_POST[$campo1]."'";
			if($v1=="si"){ $sql_actid.= ",intro='".$_POST[$campo2]."'"; }
			$sql_actid.= " WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
			$rs_actid = mysqli_query($conn,$sql_actid);

		}else{

			if($v1=="si"){ $intro = $_POST[$campo2]; }else{ $intro = ""; }

			$sql_ins = "INSERT INTO contenidos_info (ref_contenido,ref_idioma,titulo,intro) VALUES ('".$ref."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."','".$intro."')";
			$rs_ins = mysqli_query($conn,$sql_ins);
		}

	}

	// ------------------ ORDENAR SI PROCEDE ------------------

	if($v0=="si"){
		if($_POST["tipo"]!=$_POST["tipo_origen"]){

			$sql_cero = "UPDATE contenidos SET orden='0' WHERE ref=".$ref;
			$rs_cero = mysqli_query($conn,$sql_cero);

			$sql_ult = "SELECT * FROM contenidos WHERE ref_tipo=".$_POST["tipo"]." ORDER BY orden DESC";
			$rs_ult = mysqli_query($conn,$sql_ult);
			$row_ult = mysqli_fetch_array($rs_ult);
			$orden_nuevo = $row_ult["orden"]+1;

			$sql_act = "UPDATE contenidos SET orden=".$orden_nuevo." WHERE ref=".$ref;
			$rs_act = mysqli_query($conn,$sql_act);

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

	// ------------------ ETIQUETAS ------------------

	if($v5=="si"){

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

}else{

	$ref_act = 0;
}

$resp['act'] = $ref_act;

echo json_encode($resp);
?>
