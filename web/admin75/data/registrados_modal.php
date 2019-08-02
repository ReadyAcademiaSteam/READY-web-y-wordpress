<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql = "SELECT * FROM registrados WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

$nombre_completo = $row["nombre"];
if($row["apellidos"]){ $nombre_completo.= " ".$row["apellidos"]; }

$resp['nombre'] = $nombre_completo;

echo json_encode($resp);
?>
