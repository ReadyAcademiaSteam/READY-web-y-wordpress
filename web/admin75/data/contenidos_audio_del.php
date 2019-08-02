archivos/<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql = "SELECT * FROM contenidos WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

if(file_exists("../../archivos/contenidos/".$row["audio"])){
  unlink("../../archivos/contenidos/".$row["audio"]);
}

$sql_del = "UPDATE contenidos SET audio=NULL WHERE ref=".$ref;
$rs_del = mysqli_query($conn,$sql_del);

echo json_encode($resp);
?>
