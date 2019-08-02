<?
include("../../include/conexion.php");
include("../../include/define.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

$resp = array();

$archivo = $_FILES['audio'];
$ext = pathinfo($archivo['name'], PATHINFO_EXTENSION);
$nombre = "$ref.$ext";

if($ext=='MP3' || $ext=='mp3'){

	if(move_uploaded_file($archivo['tmp_name'], "../../archivos/contenidos/$nombre")) {

		$sql_del = "UPDATE contenidos SET audio='".$nombre."' WHERE ref=".$ref;
		if($rs_del = mysqli_query($conn,$sql_del)){

			$ref_ins = $ref;

		}else{

			$ref_ins = 0; //---- No se ha grabado en la BDD
			unlink("../../archivos/contenidos/$nombre");
		}

	}else{

		$ref_ins = -1; //---- El fichero no ha subido
	}
}else{

	$ref_ins = -2; //---- Extensión no permitida
}

$resp['ins'] = $ref_ins;

echo json_encode($resp);
?>
