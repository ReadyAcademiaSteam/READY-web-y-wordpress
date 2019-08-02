<?
session_start();

$mod = $_POST["mod"];
$ref = $_POST["ref"];
$tabla = $_POST["tabla"];
$campo = $_POST["campo"];

$uploadDir = $_POST["directorio"];

$fileTypes = array('jpg', 'jpeg', 'gif', 'png');

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if(!empty($_FILES) && $_POST['token'] == $verifyToken){

	$tempFile   = $_FILES['Filedata']['tmp_name'];
	$uploadDir  = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
	$targetFile = $uploadDir . "tmp/" . $_FILES['Filedata']['name'];

	$fileParts = pathinfo($_FILES['Filedata']['name']);
	if (in_array(strtolower($fileParts['extension']), $fileTypes)) {

		move_uploaded_file($tempFile, $targetFile);

		include("../../include/conexion.php");

		$info = new SplFileInfo($_FILES['Filedata']['name']);
		$ext = $info->getExtension();

		$ord = 0;
		$sql = "SELECT * FROM ".$tabla." ORDER BY ref DESC";
		$rs = mysqli_query ($conn,$sql);
		$row = mysqli_fetch_array ($rs);
		$ult = $row[0];
		$ult++;

		$img = $ult.".".$ext;

		$original = $targetFile;
		$copia = $uploadDir.$img;
		$admin = $uploadDir."0/".$img;

		$dimensiones = getimagesize($targetFile);

		//---------- GRANDE

		if($dimensiones[0]>$dimensiones[1]){
			exec("convert \"$original\" -geometry '1024' \"$copia\"");
		}else{
			exec("convert \"$original\" -geometry 'x1024' \"$copia\"");
		}

		//---------- MINIATURA ADMIN

		if($dimensiones[0]>$dimensiones[1]){
			exec("convert \"$original\" -geometry 'x200' \"$admin\"");
		}else{
			exec("convert \"$original\" -geometry '200' \"$admin\"");
		}
		exec("convert \"$admin\" -gravity center -crop 200x200+0+0! \"$admin\"");

		//---------- MINIATURAS CONFIGURADAS

		$sql_copias = "SELECT * FROM menu_admin_dimensiones WHERE ref_menu=".$mod." AND clase=11";
		$rs_copias = mysqli_query($conn,$sql_copias);
		while($row_copias = mysqli_fetch_array($rs_copias)){

			$destino = $uploadDir.$row_copias["ref"]."/".$img;

			if(!file_exists($uploadDir.$row_copias["ref"])){
				mkdir ($uploadDir.$row_copias["ref"]);
			}

			if($row_copias["max"]!=0){

				$resolucion = $row_copias["max"];
				if($dimensiones[0]>$dimensiones[1]){
					exec("convert \"$original\" -geometry '$resolucion' \"$destino\"");
				}else{
					exec("convert \"$original\" -geometry 'x$resolucion' \"$destino\"");
				}

			}else{

				$ancho = $row_copias["ancho"];
				$alto = $row_copias["alto"];

				if($row_copias["crop"]=="N"){

					exec("convert \"$original\" -resize '$ancho'x'$alto' -size '$ancho'x'$alto' xc:white +swap -gravity center -composite \"$destino\"");

				}else{

					if($row_copias["ancho"]!=0 && $row_copias["alto"]!=0){

						$proporcion_dada = $ancho/$alto;
						$proporcion_foto = $dimensiones[0]/$dimensiones[1];
						if($proporcion_dada<$proporcion_foto){
							exec("convert \"$original\" -resize 'x$alto' -gravity center -crop '$ancho'x'$alto'+0+0! \"$destino\"");
						}else{
							exec("convert \"$original\" -resize '$ancho' -gravity center -crop '$ancho'x'$alto'+0+0! \"$destino\"");
						}

					}else{

						if($row_copias["ancho"]!=0){
							exec("convert \"$original\" -geometry '$ancho' \"$destino\"");
						}else{
							exec("convert \"$original\" -geometry 'x$alto' \"$destino\"");
						}

					}

				}
			}

			if($row_copias["marca_agua"]=='S'){
				exec("composite -dissolve 25% -gravity south ../../imagenes/marca_agua.png  $destino $destino");
			}

		}

		$sql_ult = "SELECT * FROM ".$tabla." WHERE ".$campo."=".$ref." ORDER BY orden DESC";
		$rs_ult = mysqli_query($conn,$sql_ult);
		$row_ult = mysqli_fetch_array($rs_ult);
		if($row_ult["orden"]){ $orden = $row_ult["orden"]+1; }else{ $orden = 1; }

		$sql_ins = "INSERT INTO ".$tabla." (".$campo.",foto,orden) VALUES ('".$ref."','".$img."','".$orden."')";
		$rs_ins = mysqli_query($conn,$sql_ins);

		echo 1;

		unlink($targetFile);

	}else{

		echo 'Tipo de fichero inv&aacute;lido.';

	}
}
?>
