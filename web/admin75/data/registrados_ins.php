<?
include("../../include/conexion.php");
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

// -- passw
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "no";
}

// -- teléfonos
$sql_v3 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=3";
$rs_v3 = mysqli_query($conn,$sql_v3);
if(mysqli_num_rows($rs_v3)>0){
	$row_v3 = mysqli_fetch_array($rs_v3);
	$v3 = $row_v3["opcion"];
}else{
	$v3 = "no";
}

// -- nif
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

$sql_esta = "SELECT * FROM registrados WHERE usuario='".$_POST["usuario"]."'";
$rs_esta = mysqli_query($conn,$sql_esta);

if(mysqli_num_rows($rs_esta)>0){

	$ref_ins = -1;

}else{

	$sql_ins = "INSERT INTO registrados (ref_menu,usuario,nombre,apellidos,fecha_alta";
	if($v0=="si"){
		$sql_ins.= ",ref_tipo";
	}
	if($v1=="si"){
		$sql_ins.= ",passw";
	}
	if($v3=="si"){
		$sql_ins.= ",tlf";
	}
	if($v4=="si"){
		$sql_ins.= ",nif";
	}
	$sql_ins.= ") ";
	$sql_ins.= "VALUES ('".$mod."','".$_POST["usuario"]."','".$_POST["nombre"]."','".$_POST["apellidos"]."','".date("Y-m-d")."'";
	if($v0=="si"){
		$sql_ins.= ",'".$_POST["tipo"]."'";
	}
	if($v1=="si"){
		$sql_ins.= ",'".md5($_POST["passw"])."'";
	}
	if($v3=="si"){
		$sql_ins.= ",'".$_POST["tlf"]."'";
	}
	if($v4=="si"){
		$sql_ins.= ",'".$_POST["nif"]."'";
	}
	$sql_ins.= ")";

	if($rs_ins = mysqli_query($conn,$sql_ins)){

		$sql_ult = "SELECT * FROM registrados ORDER BY ref DESC";
		$rs_ult = mysqli_query($conn,$sql_ult);
		$row_ult = mysqli_fetch_array($rs_ult);

		$ref_ins = $row_ult["ref"];

		// ------------------ PASSW ------------------

		if($v1=="si"){

			$sql_ins_passw = "INSERT INTO registrados_passw (ref,nombre) VALUES ('".$ref_ins."','".$_POST["passw"]."')";
			$rs_ins_passw = mysqli_query($conn,$sql_ins_passw);
		}

		// ------------------ ETIQUETAS ------------------

		if($v5=="si"){

			$sql_etiquetas = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
			$rs_etiquetas = mysqli_query($conn,$sql_etiquetas);
			while($row_etiquetas = mysqli_fetch_array($rs_etiquetas)){

				$sql_ctg = "SELECT * FROM registrados_rel_etiquetas WHERE ref_reg=".$ref_ins." AND ref_etiqueta=".$row_etiquetas["ref"];
				$rs_ctg = mysqli_query($conn,$sql_ctg);

				$campo = "etiqueta".$row_etiquetas["ref"];

				if(mysqli_num_rows($rs_ctg)>0){
					if($_POST[$campo]!='S'){
						$sql_del = "DELETE FROM registrados_rel_etiquetas WHERE ref_reg=".$ref_ins." AND ref_etiqueta=".$row_etiquetas["ref"];
						$rs_del = mysqli_query($conn,$sql_del);
					}
				}else{
					if($_POST[$campo]=='S'){
						$sql_ins = "INSERT INTO registrados_rel_etiquetas (ref_reg,ref_etiqueta) VALUES ('".$ref_ins."','".$row_etiquetas["ref"]."')";
						$rs_ins = mysqli_query($conn,$sql_ins);
					}
				}
			}
		}

	}else{

		$ref_ins = 0;
	}
}

$resp['ins'] = $ref_ins;

echo json_encode($resp);
?>
