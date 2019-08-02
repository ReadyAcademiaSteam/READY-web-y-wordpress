<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

  $sql_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
  $rs_info = mysqli_query($conn,$sql_info);
  $row_info = mysqli_fetch_array($rs_info);

  $campo1 = "nombre_".$row_listaidiomas["ref"];

  $resp[$campo1] = $row_info["nombre"];
}

echo json_encode($resp);
?>
