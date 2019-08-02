<?
include("../../include/conexion.php");
include("../include/funciones.php");

$resp = array();

$sql_ins = "INSERT INTO usuarios ";
$sql_ins.= "(usuario,passw,nombre,apellidos,email,nivel)";
$sql_ins.= " VALUES ('".$_POST["usuario"]."','".md5($_POST["passw"])."','".$_POST["nombre"]."','".$_POST["apellidos"]."','".$_POST["email"]."','".$_POST["nivel"]."')";

if($rs_ins = mysqli_query($conn,$sql_ins)){

	$sql_ultimo = "SELECT * FROM usuarios ORDER BY id DESC";
	$rs_ultimo = mysqli_query($conn,$sql_ultimo);
	$row_ultimo = mysqli_fetch_array($rs_ultimo);

	$ref_ins = $row_ultimo["id"];

	if($_POST["nivel"]==2){

		$sql_tipos = "SELECT * FROM menu_admin WHERE ref<>1 AND ref<>999 ORDER BY orden";
		$rs_tipos = mysqli_query($conn,$sql_tipos);
		while($row_tipos = mysqli_fetch_array($rs_tipos)){
			$num = $row_tipos["ref"];
			$campo = "tipo".$num;
			if($_POST[$campo]=='S'){
				$sql_ins = "INSERT INTO usuarios_permisos (id_usu,ref_menu) VALUES ('".$row_usuins["id"]."','".$num."')";
				$rs_ins = mysqli_query($conn,$sql_ins);
			}
		}
	}

}else{

	$ref_ins = 0;
}

$resp['ins'] = $ref_ins;

echo json_encode($resp);
?>
