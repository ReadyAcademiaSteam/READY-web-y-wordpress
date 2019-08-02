archivos/<?
include("../../include/conexion.php");
include("../../include/define.php");
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

// -- codificado
$sql_v52 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=52";
$rs_v52 = mysqli_query($conn,$sql_v52);
if(mysqli_num_rows($rs_v52)>0){
	$row_v52 = mysqli_fetch_array($rs_v52);
	$v52 = $row_v52["opcion"];
}else{
	$v52 = "no";
}

// ----------------- FIN VARIABLES

if(isset($_FILES['archivo'])){

	$sql_busca = 'SELECT * FROM contenidos_docs ORDER BY ref DESC';
	$rs_busca = mysqli_query($conn,$sql_busca);
	$row_busca = mysqli_fetch_array($rs_busca);
	$ult = $row_busca["ref"];
	$ult++;
	if($v52=="si"){ $cta = md5($ult); }else{ $cta = $ult; }

  $archivo = $_FILES['archivo'];
  $ext = pathinfo($archivo['name'], PATHINFO_EXTENSION);
	$time = time();
  $nombre = "$cta.$ext";

	if($ext=='PDF' || $ext=='pdf' || $ext=='DOC' || $ext=='doc' || $ext=='DOCX' || $ext=='docx'){

	  if(move_uploaded_file($archivo['tmp_name'], "../../archivos/contenidos/documentos/$nombre")) {

			$sql_orden = "SELECT * FROM contenidos_docs WHERE ref_contenido=".$ref." ORDER BY orden DESC";
			$rs_orden = mysqli_query($conn,$sql_orden);
			$row_orden = mysqli_fetch_array($rs_orden);
			$orden = intval($row_orden["orden"])+1;

			$sql_ins = "INSERT INTO contenidos_docs (ref_contenido,archivo,orden) VALUES ('".$ref."','".$nombre."','".$orden."')";
			if($rs_ins = mysqli_query($conn,$sql_ins)){

				$sql_ultimo = 'SELECT * FROM contenidos_docs ORDER BY ref DESC';
				$rs_ultimo = mysqli_query($conn,$sql_ultimo);
				$row_ultimo = mysqli_fetch_array($rs_ultimo);
				$ref_ins = $row_ultimo["ref"];

				if($ext=="pdf"){
					$strPDF = "../../archivos/contenidos/documentos/$nombre";
					exec("convert \"{$strPDF}[0]\" -geometry 400 \"../../archivos/contenidos/documentos/thumbs/".$ref_ins.".jpg\"");
				}

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
					$sql_ins = "INSERT INTO contenidos_docs_info (ref_doc,ref_idioma,nombre,texto) VALUES ('".$ref_ins."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."','".$texto."')";
					$rs_ins = mysqli_query($conn,$sql_ins);
				}

			}else{

				$ref_ins = 0; //---- No se ha grabado en la BDD
				unlink("../../archivos/contenidos/documentos/$nombre");
			}

		}else{

			$ref_ins = -1; //---- El fichero no ha subido
		}

	}else{

		$ref_ins = -2; //---- Extensión no permitida
	}

}else{

	$ref_ins = -3; //---- El fichero no se envía
}

$resp["ins"] = $ref_ins;

echo json_encode($resp);
?>
