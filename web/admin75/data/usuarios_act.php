<?
include("../../include/conexion.php");
include("../include/funciones.php");

$ref = $_GET["ref"];

session_start();
$nivel_admin = $_SESSION["nivel_admin"];

$resp = array();

$sql_act = "UPDATE usuarios SET ";
$sql_act.= "usuario='".$_POST["usuario"]."'";
if($_POST["passw"]!=""){
	$sql_act.= ",passw='".md5($_POST["passw"])."'";
}
$sql_act.= ",nombre='".$_POST["nombre"]."'";
$sql_act.= ",apellidos='".$_POST["apellidos"]."'";
$sql_act.= ",email='".$_POST["email"]."'";
if($nivel_admin==1){
	$sql_act.= ",nivel='".$_POST["nivel"]."'";
}
$sql_act.= " WHERE id=".$ref;

if($rs_act = mysqli_query($conn,$sql_act)){

	$ref_act = $ref;

	if($nivel_admin==1){

		if($_POST["nivel"]==1){

			$sql_deltipos = "DELETE FROM usuarios_permisos WHERE id_usu=".$ref;
			$rs_deltipos = mysqli_query($conn,$sql_deltipos);

		}else{

			$sql_tipos = "SELECT * FROM menu_admin WHERE ref!=1 AND ref!=999 ORDER BY orden";
			$rs_tipos = mysqli_query($conn,$sql_tipos);
			while($row_tipos = mysqli_fetch_array($rs_tipos)){
				$num = $row_tipos["ref"];
				$sql_ctg = "SELECT * FROM usuarios_permisos WHERE id_usu=".$ref." AND ref_menu=".$num;
				$rs_ctg = mysqli_query($conn,$sql_ctg);
				$campo = "tipo".$num;
				if(mysqli_num_rows($rs_ctg)>0){
					if($_POST[$campo]!="S"){
						$sql_del = "DELETE FROM usuarios_permisos WHERE id_usu=".$ref." AND ref_menu=".$num;
						$rs_del = mysqli_query($conn,$sql_del);
					}
				}else{
					if($_POST[$campo]=="S"){
						$sql_ins = "INSERT INTO usuarios_permisos (id_usu,ref_menu) VALUES ('".$ref."','".$num."')";
						$rs_ins = mysqli_query($conn,$sql_ins);
					}
				}
			}
		}
	}

}else{

	$ref_act = 0;
}

$resp['act'] = $ref_act;

echo json_encode($resp);
?>
