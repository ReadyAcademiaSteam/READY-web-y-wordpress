<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$ref_act = 0;

$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

	$campo1 = "nombre_".$row_listaidiomas["ref"];

	$sql_esta = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
	$rs_esta = mysqli_query($conn,$sql_esta);

	if(mysqli_num_rows($rs_esta)>0){
		$sql_actid = "UPDATE etiquetas_info SET";
		$sql_actid.= " nombre='".$_POST[$campo1]."'";
		$sql_actid.= " WHERE ref_etiqueta=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
		if($rs_actid = mysqli_query($conn,$sql_actid)){
      $ref_act = $ref;
    }
	}else{
		$sql_ins = "INSERT INTO etiquetas_info (ref_etiqueta,ref_idioma,nombre) VALUES ('".$ref."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."')";
		if($rs_ins = mysqli_query($conn,$sql_ins)){
      $ref_act = $ref;
    }
	}

}

$resp["act"] = $ref_act;

echo json_encode($resp);
?>
