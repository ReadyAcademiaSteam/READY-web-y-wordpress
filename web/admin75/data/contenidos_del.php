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

// ----------------- FIN VARIABLES

$sql = "SELECT * FROM contenidos WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

$tipo_contenido = $row["ref_tipo"];

//----- FOTO PRINCIPAL

if($row["foto"]!=''){

	if(file_exists("../../imagenes/contenidos/".$row["foto"])){ unlink("../../imagenes/contenidos/".$row["foto"]); }
	if(file_exists("../../imagenes/contenidos/0/".$row["foto"])){ unlink("../../imagenes/contenidos/0/".$row["foto"]); }
	$sql_copias = "SELECT * FROM menu_admin_dimensiones WHERE ref_menu=".$mod." AND clase!=11";
	$rs_copias = mysqli_query($conn,$sql_copias);
	while($row_copias = mysqli_fetch_array($rs_copias)){
		if(file_exists("../../imagenes/contenidos/".$row_copias["ref"]."/".$row["foto"])){ unlink("../../imagenes/contenidos/".$row_copias["ref"]."/".$row["foto"]); }
	}
}

//----- ARCHIVO

if($row["archivo"]!=''){

	if(file_exists("../../archivos/contenidos/".$row["archivo"])){ unlink("../../archivos/contenidos/".$row["archivo"]); }
	if(file_exists("../../archivos/contenidos/thumbs/".substr($row["archivo"],0,-4).".jpg")){ unlink("../../archivos/contenidos/thumbs/".substr($row["archivo"],0,-4).".jpg"); }

}

//----- AUDIO

if($row["audio"]!=''){

	if(file_exists("../../archivos/contenidos/".$row["audio"])){ unlink("../../archivos/contenidos/".$row["audio"]); }

}

//----- DOCUMENTOS

$sql = "SELECT * FROM contenidos_docs WHERE ref_contenido=".$ref;
$rs = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($rs)){
	if(file_exists("../../archivos/contenidos/documentos/".$row["archivo"])){ unlink("../../archivos/contenidos/documentos/".$row["archivo"]); }
	if(file_exists("../../archivos/contenidos/documentos/thumbs/".substr($row["archivo"],0,-4).".jpg")){ unlink("../../archivos/contenidos/documentos/thumbs/".substr($row["archivo"],0,-4).".jpg"); }
}

//----- GALERÍA DE FOTOS

$sql = "SELECT * FROM contenidos_fotos WHERE ref_contenido=".$ref;
$rs = mysqli_query($conn,$sql);
while ($row = mysqli_fetch_array($rs)){
	if(file_exists("../../imagenes/contenidos/".$row["foto"])){ unlink("../../imagenes/contenidos/".$row["foto"]); }
	if(file_exists("../../imagenes/contenidos/0/".$row["foto"])){ unlink("../../imagenes/contenidos/0/".$row["foto"]); }
	$sql_copias = "SELECT * FROM menu_admin_dimensiones WHERE ref_menu=".$mod." AND clase=11";
	$rs_copias = mysqli_query($conn,$sql_copias);
	while($row_copias = mysqli_fetch_array($rs_copias)){
		if(file_exists("../../imagenes/contenidos/galerias/".$row_copias["ref"]."/".$row["foto"])){ unlink("../../imagenes/contenidos/galerias/".$row_copias["ref"]."/".$row["foto"]); }
	}
}

//----- CONTENIDOS

$sql_del = "DELETE FROM contenidos WHERE ref=".$ref;
$rs_del = mysqli_query($conn,$sql_del);

//----- REORDENAR SI PRICEDE

if(($v3=="si") && ($v1=="no")){
	$sql_selord = "SELECT * FROM contenidos WHERE ref_menu=".$mod;
	if($v0=="si"){ $sql_selord.= " AND ref_tipo=".$tipo_contenido; }
	$sql_selord.= " ORDER BY orden";
	$rs_selord = mysqli_query($conn,$sql_selord);
	$cta = 1;
	while ($row_selord = mysqli_fetch_array($rs_selord)){
		$sql_ord = "UPDATE contenidos SET orden=".$cta." WHERE ref=".$row_selord["ref"];
		$rs_ord = mysqli_query($conn,$sql_ord);
		$cta++;
	}
}

echo json_encode($resp);
?>
