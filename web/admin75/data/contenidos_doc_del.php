<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

//--- ELIMINAR

$sql = "SELECT * FROM contenidos_docs WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

if(file_exists("../../archivos/contenidos/documentos/".$row["archivo"])){
	unlink("../../archivos/contenidos/documentos/".$row["archivo"]);
}

if(file_exists("../../archivos/contenidos/documentos/thumbs/".$ref.".jpg")){
	unlink("../../archivos/contenidos/documentos/thumbs/".$ref.".jpg");
}

$sql_del = "DELETE FROM contenidos_docs WHERE ref=".$ref;
$rs_del = mysqli_query($conn,$sql_del);

//--- ORDENAR

$sql_colocar = "SELECT * FROM contenidos_docs WHERE ref_contenido=".$row["ref_contenido"]." ORDER BY orden";
$rs_colocar = mysqli_query($conn,$sql_colocar);
$cuenta = 1;
while ($row_colocar = mysqli_fetch_array($rs_colocar)){
	$sql_ordenar = "UPDATE contenidos_docs SET orden=".$cuenta." WHERE ref=".$row_colocar["ref"];
	$rs_ordenar = mysqli_query($conn,$sql_ordenar);
	$cuenta++;
}

echo json_encode($resp);
?>
