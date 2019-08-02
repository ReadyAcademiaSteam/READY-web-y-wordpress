<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$sql_act = "UPDATE contenidos_videos SET ";
$sql_act.= "codigo='".$_POST["codigo"]."' ";
$sql_act.= "WHERE ref=".$ref;

if($rs_act = mysql_query($conn,$sql_act)){

  $resp['act'] = $ref;

  $sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
  $rs_listaidiomas = mysql_query($conn,$sql_listaidiomas);
  while($row_listaidiomas = mysql_fetch_array($rs_listaidiomas)){

  	$campo1 = "nombrevideo_".$row_listaidiomas["ref"];

  	$sql_esta = "SELECT * FROM contenidos_videos_info WHERE ref_video=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
  	$rs_esta = mysql_query($conn,$sql_esta);
  	if(mysql_num_rows($rs_esta)>0){
  		$sql_actid = "UPDATE contenidos_videos_info SET ";
  		$sql_actid.= "nombre='".$_POST[$campo1]."' ";
  		$sql_actid.= "WHERE ref_video=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
  		$rs_actid = mysql_query($conn,$sql_actid);
  	}else{
  		$sql_ins = "INSERT INTO contenidos_videos_info (ref_video,ref_idioma,nombre) VALUES ('".$ref."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."')";
  		$rs_ins = mysql_query($conn,$sql_ins);
  	}
  }

}else{

  $resp["act"] = 0;
}

echo json_encode($resp);
?>
