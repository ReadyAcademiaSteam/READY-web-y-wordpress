<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql = "SELECT * FROM contenidos_docs WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

$resp['archivo'] = $row["archivo"];

$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

  $sql_info = "SELECT * FROM contenidos_docs_info WHERE ref_doc=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
  $rs_info = mysqli_query($conn,$sql_info);
  $row_info = mysqli_fetch_array($rs_info);

  $campo1 = "nombredoc_".$row_listaidiomas["ref"];
  $campo2 = "textodoc_".$row_listaidiomas["ref"];

  $resp[$campo1] = $row_info["nombre"];
  $resp[$campo2] = $row_info["texto"];
}

echo json_encode($resp);
?>
