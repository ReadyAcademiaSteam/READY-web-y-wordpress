<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];

$resp = array();

// ----------------- VARIABLES

// -- descripcion texto
$sql_v51 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=51";
$rs_v51 = mysqli_query($conn,$sql_v51);
if(mysqli_num_rows($rs_v51)>0){
	$row_v51 = mysqli_fetch_array($rs_v51);
	$v51 = $row_v51["opcion"];
}else{
	$v51 = "no";
}

// ----------------- FIN VARIABLES

$ref_act = $ref;

$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

	$campo1 = "nombredoc_".$row_listaidiomas["ref"];
	if($v51=="si"){
		$campo2 = "textodoc_".$row_listaidiomas["ref"];
	 	$texto = $_POST[$campo2];
	}else{
		$texto = "";
	}

	$sql_esta = "SELECT * FROM contenidos_docs_info WHERE ref_doc=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
	$rs_esta = mysqli_query($conn,$sql_esta);
	if(mysqli_num_rows($rs_esta)>0){

		$sql_actid = "UPDATE contenidos_docs_info SET ";
		$sql_actid.= "nombre='".$_POST[$campo1]."'";
		$sql_actid.= ",texto='".$texto."'";
		$sql_actid.= " WHERE ref_doc=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
		if($rs_actid = mysqli_query($conn,$sql_actid)){
			$ref_act = $ref;
		}else{
			$ref_act = 0;
		}

	}else{

		$sql_ins = "INSERT INTO contenidos_docs_info (ref_doc,ref_idioma,nombre,texto) VALUES ('".$ref."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."','".$texto."')";
		if($rs_ins = mysqli_query($conn,$sql_ins)){
			$ref_act = $ref;
		}else{
			$ref_act = 0;
		}
	}
}

$resp["act"] = $ref_act;

echo json_encode($resp);
?>
