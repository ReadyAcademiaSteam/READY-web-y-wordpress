<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql_ult = "SELECT * FROM contenidos_videos WHERE ref_contenido=".$ref." ORDER BY orden DESC";
$rs_ult = mysql_query($conn,$sql_ult);
$row_ult = mysql_fetch_array($rs_ult);

$orden = intval($row_ult["orden"])+1;

$sql_ins = "INSERT INTO contenidos_videos (ref_contenido,codigo,orden) VALUES ('".$ref."','".$_POST["codigo"]."','".$orden."')";
if($rs_ins = mysql_query($conn,$sql_ins)){

  $sql_ult = "SELECT * FROM contenidos_videos WHERE ref_contenido=".$ref." ORDER BY orden DESC";
  $rs_ult = mysql_query($conn,$sql_ult);
  $row_ult = mysql_fetch_array($rs_ult);

  $ref_ins = $row_ult["ref"];

  $sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
  $rs_listaidiomas = mysql_query($conn,$sql_listaidiomas);
  while($row_listaidiomas = mysql_fetch_array($rs_listaidiomas)){

    $campo1 = "nombrevideo_".$row_listaidiomas["ref"];

    $sql_ins = "INSERT INTO contenidos_videos_info (ref_video,ref_idioma,nombre) VALUES ('".$ref_ins."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."')";
    $rs_ins = mysql_query($conn,$sql_ins);
  }

}else{

  $ref_ins = 0;

}

$resp['ins'] = $ref_ins;

echo json_encode($resp);
?>
