<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];

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

// -- teléfono
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

$sql_esta = "SELECT * FROM registrados WHERE usuario='".$_POST["usuario"]."' AND ref!=".$ref;
$rs_esta = mysqli_query($conn,$sql_esta);

if(mysqli_num_rows($rs_esta)>0){

	$ref_act = -1;

}else{

	$sql_act = "UPDATE registrados SET";
	$sql_act.= " usuario='".$_POST["usuario"]."'";
	$sql_act.= ",nombre='".$_POST["nombre"]."'";
	$sql_act.= ",apellidos='".$_POST["apellidos"]."'";
	if($v0=="si"){
		$sql_act.= ",ref_tipo='".$_POST["tipo"]."'";
	}
	if($v1=="si" && $_POST["passw"]!=''){
		$sql_act.= ",passw='".md5($_POST["passw"])."'";
	}
	if($v3=="si"){
		$sql_act.= ",tlf='".$_POST["tlf"]."'";
	}
	if($v4=="si"){
		$sql_act.= ",nif='".$_POST["nif"]."'";
	}
	$sql_act.= " WHERE ref=".$ref;

	if($rs_act = mysqli_query($conn,$sql_act)){

		$ref_act = $ref;

		// ------------------ PASSW ------------------

		if($v1=="si" && $_POST["passw"]!=''){
			$sql_act = "UPDATE registrados_passw SET nombre='".$_POST["passw"]."' WHERE ref=".$ref;
			$rs_act = mysqli_query($conn,$sql_act);
		}

		// ------------------ ETIQUETAS ------------------

		if($v5=="si"){

			$sql_etiquetas = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
			$rs_etiquetas = mysqli_query($conn,$sql_etiquetas);
			while($row_etiquetas = mysqli_fetch_array($rs_etiquetas)){

				$sql_ctg = "SELECT * FROM registrados_rel_etiquetas WHERE ref_reg=".$ref." AND ref_etiqueta=".$row_etiquetas["ref"];
				$rs_ctg = mysqli_query($conn,$sql_ctg);

				$campo = "etiqueta".$row_etiquetas["ref"];

				if(mysqli_num_rows($rs_ctg)>0){
					if(!isset($_POST[$campo])){
						$sql_del = "DELETE FROM registrados_rel_etiquetas WHERE ref_reg=".$ref." AND ref_etiqueta=".$row_etiquetas["ref"];
						$rs_del = mysqli_query($conn,$sql_del);
					}
				}else{
					if(isset($_POST[$campo]) && $_POST[$campo]=='S'){
						$sql_ins = "INSERT INTO registrados_rel_etiquetas (ref_reg,ref_etiqueta) VALUES ('".$ref."','".$row_etiquetas["ref"]."')";
						$rs_ins = mysqli_query($conn,$sql_ins);
					}
				}
			}
		}


	}else{

		$ref_act = 0;
	}
}

$resp['act'] = $ref_act;

echo json_encode($resp);
?>
