<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql = "SELECT * FROM contenidos WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

$resp['fecha'] = $row["fecha"];

$resp['tipo'] = $row["ref_tipo"];

$resp['archivo'] = $row["archivo"];

$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

  $sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row["ref"]." AND ref_idioma=".$row_listaidiomas["ref"];
  $rs_info = mysqli_query($conn,$sql_info);
  $row_info = mysqli_fetch_array($rs_info);

  $campo1 = "titulo_".$row_listaidiomas["ref"];
  $campo2 = "intro_".$row_listaidiomas["ref"];

  $resp[$campo1] = $row_info["titulo"];
  $resp[$campo2] = $row_info["intro"];
}

$array_etiquetas = array();
$sql_etiquetas = "SELECT ref_etiqueta FROM contenidos_rel_etiquetas WHERE ref_contenido=".$ref;
$rs_etiquetas = mysqli_query($conn,$sql_etiquetas);
while($row_etiquetas = mysqli_fetch_array($rs_etiquetas)){
  array_push($array_etiquetas,$row_etiquetas[0]);
}
$resp["etiquetas"] = $array_etiquetas;

echo json_encode($resp);
?>
