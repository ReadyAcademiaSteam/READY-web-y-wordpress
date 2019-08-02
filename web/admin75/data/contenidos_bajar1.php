<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];
if(isset($_GET["tipo"]) && $_GET["tipo"]!=''){ $tipo = $_GET["tipo"]; }else{ $tipo = 0; }

$resp = array();

$sql_subir1 = "SELECT * FROM contenidos WHERE ref=".$ref;
$rs_subir1 = mysqli_query($conn,$sql_subir1);
$row_subir1 = mysqli_fetch_array($rs_subir1);

$ele = $row_subir1["orden"];
$ant = $ele+1;
$neg = ($ele)*(-1);

$sql1 = "UPDATE contenidos SET orden=".$neg." WHERE ref_menu=".$mod;
if($tipo!=0){ $sql1.= " AND ref_tipo=".$tipo; }
$sql1.= " AND orden=".$ele;
$rs1 = mysqli_query($conn,$sql1);

$sql2 = "UPDATE contenidos SET orden=".$ele." WHERE ref_menu=".$mod;
if($tipo!=0){ $sql2.= " AND ref_tipo=".$tipo; }
$sql2.= " AND orden=".$ant;
$rs2 = mysqli_query($conn,$sql2);

$sql3 = "UPDATE contenidos SET orden=".$ant." WHERE ref_menu=".$mod;
if($tipo!=0){ $sql3.= " AND ref_tipo=".$tipo; }
$sql3.= " AND orden=".$neg;
$rs3 = mysqli_query($conn,$sql3);

//--- ORDENAR

$sql_colocar = "SELECT * FROM contenidos WHERE ref_menu=".$mod;
if($tipo!=0){ $sql_colocar.= " AND ref_tipo=".$tipo; }
$sql_colocar.= " ORDER BY orden";
$rs_colocar = mysqli_query($conn,$sql_colocar);
$cta = 1;
while ($row_colocar = mysqli_fetch_array($rs_colocar)){
	$sql_ordenar = "UPDATE contenidos SET orden=".$cta." WHERE ref=".$row_colocar["ref"];
	$rs_ordenar = mysqli_query($conn,$sql_ordenar);
	$cta++;
}

echo json_encode($resp);
?>
