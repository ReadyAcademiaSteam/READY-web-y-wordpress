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
	$v0 = "si";
}

// -- descripción
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

if($v0=="si"){
	$tipo = $_POST["tipo"];
}else{
	$tipo = 0;
}

if($v4=="si"){
	$target = "'".$_POST["target"]."'";
}else{
	$target = "NULL";
}

if($v3=="si"){
	$sql_ult = "SELECT * FROM contenidos WHERE ref_menu='".$mod."'";
	if($v0=="si"){ $sql_ult.= " AND ref_tipo=".$_POST["tipo"]; }
	$sql_ult.= " ORDER BY orden DESC";
	$rs_ult = mysqli_query($conn,$sql_ult);
	$row_ult = mysqli_fetch_array($rs_ult);
	$orden = intval($row_ult["orden"])+1;
}else{
	$orden = 0;
}

$sql_ins = "INSERT INTO contenidos ";
$sql_ins.= "(ref_menu,ref_tipo,enlace,target,orden) ";
$sql_ins.= "VALUES ('".$mod."','".$tipo."',";
$sql_ins.= "'".$_POST["enlace"]."',".$target.",'".$orden."')";

if($rs_ins = mysqli_query($conn,$sql_ins)){

  $sql_ult = "SELECT * FROM contenidos ORDER BY ref DESC";
  $rs_ult = mysqli_query($conn,$sql_ult);
  $row_ult = mysqli_fetch_array($rs_ult);

  $ref_ins = $row_ult["ref"];

  $sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
  $rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
  while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

    $campo1 = "titulo_".$row_listaidiomas["ref"];
    if($v1=="si"){
			$campo2 = "intro_".$row_listaidiomas["ref"];
			$intro = $_POST[$campo2];
		}else{
			$intro = "";
		}

    $sql_ins = "INSERT INTO contenidos_info (ref_contenido,ref_idioma,titulo,intro) VALUES ('".$row_ult["ref"]."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."','".$intro."')";
    $rs_ins = mysqli_query($conn,$sql_ins);

  }

	// ------------------ ETIQUETAS ------------------

	if($v5=="si"){

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

}else{

  $ref_ins = 0;
}

$resp['ins'] = $ref_ins;

echo json_encode($resp);
?>
