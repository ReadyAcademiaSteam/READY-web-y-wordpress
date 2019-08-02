<?
include("../../include/conexion.php");
include("../../include/define.php");
include("../include/funciones.php");

$mod = $_GET["mod"];

$resp = array();

// ----------------- VARIABLES

// -- tipo
$sql_v0 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=0";
$rs_v0 = mysqli_query($conn,$sql_v0);
if(mysqli_num_rows($rs_v0)>0){
	$row_v0 = mysqli_fetch_array($rs_v0);
	$v0 = $row_v0["opcion"];
}else{
	$v0 = "no";
}

// -- fecha
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "anno";
}

// -- codificado
$sql_v4 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=4";
$rs_v4 = mysqli_query($conn,$sql_v4);
if(mysqli_num_rows($rs_v4)>0){
	$row_v4 = mysqli_fetch_array($rs_v4);
	$v4 = $row_v4["opcion"];
}else{
	$v4 = "no";
}

// -- etiquetas
$sql_v5 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=5";
$rs_v5 = mysqli_query($conn,$sql_v5);
if(mysqli_num_rows($rs_v5)>0){
	$row_v5 = mysqli_fetch_array($rs_v5);
	$v5 = $row_v5["opcion"];
}else{
	$v5 = "no";
}

// ----------------- FIN VARIABLES

if($_POST["fecha"]){
	$fecha = cambiarf_a_mysql($_POST["fecha"]);
}else{
	$fecha = date("Y-m-d");
}

if($_POST["tipo"]){
	$tipo = $_POST["tipo"];
}else{
	$tipo = 0;
}

$lista_etiquetas = explode(",", $_POST["etiquetas"]);

if(($v3=="si") && ($v1=="no")){

	$sql_ult = "SELECT * FROM contenidos WHERE ref_menu='".$mod."'";
	if($v0=="si"){ $sql_ult.= " AND ref_tipo=".$_POST["tipo"]; }
	$sql_ult.= " ORDER BY orden DESC";
	$rs_ult = mysqli_query($conn,$sql_ult);
	$row_ult = mysqli_fetch_array($rs_ult);
	$orden = $row_ult["orden"]+1;

}else{

	$orden = 0;
}

if(isset($_FILES['archivo'])){

	$sql_busca = 'SELECT * FROM contenidos ORDER BY ref DESC';
	$rs_busca = mysqli_query($conn,$sql_busca);
	$row_busca = mysqli_fetch_array($rs_busca);
	$ult = $row_busca["ref"];
	$ult++;
	if($v4=="si"){ $ult = md5($ult); }

	$archivo = $_FILES['archivo'];
	$ext = pathinfo($archivo['name'], PATHINFO_EXTENSION);
	$time = time();
	$nombre = "$ult.$ext";

	if($ext=='PDF' || $ext=='pdf' || $ext=='DOC' || $ext=='doc' || $ext=='DOCX' || $ext=='docx'){

		if(move_uploaded_file($archivo['tmp_name'], "../../archivos/contenidos/$nombre")){

			$sql_ins = "INSERT INTO contenidos (fecha,ref_menu,ref_tipo,archivo,orden) VALUES ('".$fecha."','".$mod."','".$tipo."','".$nombre."','".$orden."')";
			if($rs_ins = mysqli_query($conn,$sql_ins)){

				$sql_ult = 'SELECT * FROM contenidos ORDER BY ref DESC';
				$rs_ult = mysqli_query($conn,$sql_ult);
				$row_ult = mysqli_fetch_array($rs_ult);

				$ref_ins = $row_ult["ref"];

				if($ext=="pdf"){
					$strPDF = "../../archivos/contenidos/$nombre";
					exec("convert \"{$strPDF}[0]\" -geometry 400 \"../../archivos/contenidos/thumbs/".$ref_ins.".jpg\"");
				}

				$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
				$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
				while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){
					$campo1 = "titulo_".$row_listaidiomas["ref"];
					$campo2 = "intro_".$row_listaidiomas["ref"];
					$sql_ins_info = "INSERT INTO contenidos_info (ref_contenido,ref_idioma,titulo,intro) VALUES ('".$ref_ins."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."','".$_POST[$campo2]."')";
					$rs_ins_info = mysqli_query($conn,$sql_ins_info);
				}

		    //------------------ ETIQUETAS ------------------
		    if($v5=="si"){
		      foreach ($lista_etiquetas as $selectedOption){
		        $sql_ins = "INSERT INTO contenidos_rel_etiquetas (ref_contenido,ref_etiqueta) VALUES ('".$ref_ins."','".$selectedOption."')";
		        $rs_ins = mysqli_query($conn,$sql_ins);
		      }
		    }

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

}else{

	$ref_ins = -3; //---- El fichero no se envía
}

$resp["ins"] = $ref_ins;

echo json_encode($resp);
?>
