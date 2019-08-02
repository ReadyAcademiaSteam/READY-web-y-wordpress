<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["foto"];

$resp = array();

$sql_gal = "SELECT * FROM contenidos_fotos WHERE ref=".$ref;
$rs_gal = mysqli_query($conn,$sql_gal);
$row_gal = mysqli_fetch_array($rs_gal);

$ref_contenido = $row_gal["ref_contenido"];
$foto = $row_gal["foto"];

if(file_exists("../../imagenes/contenidos/galerias/".$foto)){ unlink("../../imagenes/contenidos/galerias/".$foto); }
if(file_exists("../../imagenes/contenidos/galerias/0/".$foto)){ unlink("../../imagenes/contenidos/galerias/0/".$foto); }

$sql_copias = "SELECT * FROM menu_admin_dimensiones WHERE ref_menu=".$mod." AND clase=11";
$rs_copias = mysqli_query($conn,$sql_copias);
while($row_copias = mysqli_fetch_array($rs_copias)){
	if(file_exists("../../imagenes/contenidos/galerias/".$row_copias["ref"]."/".$foto)){
		unlink("../../imagenes/contenidos/galerias/".$row_copias["ref"]."/".$foto);
	}
}

$sql_del = "DELETE FROM contenidos_fotos WHERE ref=".$ref;
$rs_del = mysqli_query($conn,$sql_del);

//--- ORDENAR

$sql_colocar = "SELECT * FROM contenidos_fotos WHERE ref_contenido=".$ref_contenido." ORDER BY orden";
$rs_colocar = mysqli_query($conn,$sql_colocar);
$cuenta = 1;
while ($row_colocar = mysqli_fetch_array($rs_colocar)){
	$sql_ordenar = "UPDATE contenidos_fotos SET orden=".$cuenta." WHERE ref=".$row_colocar["ref"];
	$rs_ordenar = mysqli_query($conn,$sql_ordenar);
	$cuenta++;
}

echo json_encode($resp);
?>
