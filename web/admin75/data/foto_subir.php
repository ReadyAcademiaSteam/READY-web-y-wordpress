<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];
$campo = "foto".$_POST["ppal"];
$archivo = $_FILES[$campo];
$carpeta = $_POST["carpeta"];
$tabla = $_POST["tabla"];
$ppal = $_POST["ppal"];

$ext = pathinfo($archivo['name'], PATHINFO_EXTENSION);
$time = time();
$nombre = $archivo['name'];

if(($ext=="jpg")||($ext=="JPG")||($ext=="jpeg")||($ext=="JPEG")||($ext=="png")||($ext=="PNG")||($ext=="gif")||($ext=="GIF")){

	if(move_uploaded_file($archivo['tmp_name'], "$carpeta/tmp/$nombre")){

		switch($ppal){
			case 1:
				if($row_elim["foto"]!=""){
					unlink($carpeta."/".$row_elim["foto"]);
					$sql_copias = "SELECT * FROM menu_admin_dimensiones WHERE ref_menu=".$mod." AND clase=".$ppal;
					$rs_copias = mysqli_query($conn,$sql_copias);
					while($row_copias = mysqli_fetch_array($rs_copias)){
						unlink($carpeta."/".$row_copias["ref"]."/".$row_elim["foto"]);
					}
				}
				break;
			case 2:
				if($row_elim["foto2"]!=""){
					unlink($carpeta."/".$row_elim["foto2"]);
					$sql_copias = "SELECT * FROM menu_admin_dimensiones WHERE ref_menu=".$mod." AND clase=".$ppal;
					$rs_copias = mysqli_query($conn,$sql_copias);
					while($row_copias = mysqli_fetch_array($rs_copias)){
						unlink($carpeta."/".$row_copias["ref"]."/".$row_elim["foto2"]);
					}
				}
				break;
			case 3:
				if($row_elim["foto3"]!=""){
					unlink($carpeta."/".$row_elim["foto3"]);
					$sql_copias = "SELECT * FROM menu_admin_dimensiones WHERE ref_menu=".$mod." AND clase=".$ppal;
					$rs_copias = mysqli_query($conn,$sql_copias);
					while($row_copias = mysqli_fetch_array($rs_copias)){
						unlink($carpeta."/".$row_copias["ref"]."/".$row_elim["foto3"]);
					}
				}
				break;
		}

		if($ppal==1){
			$img = "$ref.$ext";
		}else{
			$img = $ref."_".$ppal.".".$ext;
		}

		$sql_del = "SELECT * FROM ".$tabla." WHERE ref=".$ref;
		$rs_del = mysqli_query($conn,$sql_del);
		$row_del= mysqli_fetch_array($rs_del);

		$temporal = "$carpeta/tmp/$nombre";
		$original = "$carpeta/$img";
		$admin = "$carpeta/0/$img";

		$dimensiones = getimagesize($carpeta."/tmp/".$archivo['name']);

		//---------- GRANDE

		if($dimensiones[0]>$dimensiones[1]){
			exec("convert \"$temporal\" -geometry '1024' \"$original\"");
		}else{
			exec("convert \"$temporal\" -geometry 'x1024' \"$original\"");
		}

		//---------- MINIATURA ADMIN

		exec("convert \"$temporal\" -geometry '400' \"$admin\"");

		//---------- MINIATURAS CONFIGURADAS

		$sql_copias = "SELECT * FROM menu_admin_dimensiones WHERE ref_menu=".$mod." AND clase=".$ppal;
		$rs_copias = mysqli_query($conn,$sql_copias);
		while($row_copias = mysqli_fetch_array($rs_copias)){

			$destino = $carpeta."/".$row_copias["ref"]."/".$img;

			if(!file_exists($carpeta."/".$row_copias["ref"])){
				mkdir ($carpeta."/".$row_copias["ref"]);
			}

			if($row_copias["max"]!=0){

				$resolucion = $row_copias["max"];
				if($dimensiones[0]>$dimensiones[1]){
					exec("convert \"$temporal\" -geometry '$resolucion' \"$destino\"");
				}else{
					exec("convert \"$temporal\" -geometry 'x$resolucion' \"$destino\"");
				}

			}else{

				$ancho = $row_copias["ancho"];
				$alto = $row_copias["alto"];

				if($row_copias["crop"]=="N"){

					exec("convert \"$temporal\" -resize '$ancho'x'$alto' -size '$ancho'x'$alto' xc:white +swap -gravity center -composite \"$destino\"");

				}else{

					if($row_copias["ancho"]!=0 && $row_copias["alto"]!=0){
						$proporcion_dada = $ancho/$alto;
						$proporcion_foto = $dimensiones[0]/$dimensiones[1];
						if($proporcion_dada<$proporcion_foto){
							exec("convert \"$temporal\" -resize 'x$alto' -gravity center -crop '$ancho'x'$alto'+0+0! \"$destino\"");
						}else{
							exec("convert \"$temporal\" -resize '$ancho' -gravity center -crop '$ancho'x'$alto'+0+0! \"$destino\"");
						}
					}else{
						if($row_copias["ancho"]!=0){
							exec("convert \"$temporal\" -geometry '$ancho' \"$destino\"");
						}else{
							exec("convert \"$temporal\" -geometry 'x$alto' \"$destino\"");
						}
					}
				}
			}

			if($row_copias["marca_agua"]=='S'){
				exec ("composite -dissolve 25% -gravity south ../../imagenes/marca_agua.png  $destino $destino");
			}
		}

		//---------- ELIMINAR TEMPORAL

		unlink($carpeta."/tmp/$nombre");

		if($ppal==1){
			$sql = "UPDATE $tabla SET foto='$img' WHERE ref=$ref";
		}else{
			$sql = "UPDATE $tabla SET foto".$ppal."='".$img."' WHERE ref=".$ref;
		}
		$rs = mysqli_query($conn,$sql);

	}
}

echo json_encode($resp);
?>
