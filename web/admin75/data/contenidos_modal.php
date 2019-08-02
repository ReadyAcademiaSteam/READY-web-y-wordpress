<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=1";
$rs_info = mysqli_query($conn,$sql_info);
$row_info = mysqli_fetch_array($rs_info);

$resp['titulo'] = $row_info["titulo"];

echo json_encode($resp);
?>
