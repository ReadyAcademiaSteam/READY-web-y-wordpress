<?
include("../../include/conexion.php");
date_default_timezone_set('Europe/Madrid');

$resp = array();

$username = $_POST["username"];
$psw = md5($_POST["password"]);

$ip = $_SERVER["REMOTE_ADDR"];

$fecha = new DateTime();
date_modify($fecha,'-30 minute');
$media_hora = date_format($fecha,'Y-m-d H:i:s');

$sql = "SELECT id,usuario,nivel FROM usuarios WHERE usuario=? AND passw=?";
$rs = mysqli_prepare($conn,$sql);

mysqli_stmt_bind_param($rs, "ss", $username, $psw);
mysqli_stmt_execute($rs);
mysqli_stmt_store_result($rs);

mysqli_stmt_bind_result($rs, $id, $usuario, $nivel);
mysqli_stmt_fetch($rs);

$login_status = 'invalid';

if(mysqli_stmt_num_rows($rs)>0){

	$sql_errores = "SELECT * FROM usuarios_error WHERE ip='".$ip."' AND fecha>'".$media_hora."'";
	$rs_errores = mysqli_query($conn,$sql_errores);

	if(mysqli_num_rows($rs_errores)<3){

		$id_admin = $id;
		$nivel_admin = $nivel;

		$sql_ins = "INSERT INTO usuarios_acceso ";
		$sql_ins.= "(id_usu,ip,fecha) ";
		$sql_ins.= "VALUES ('".$id_admin."','".$ip."','".date("Y-m-d H:i:s")."')";
		$rs_ins = mysqli_query($conn,$sql_ins);

		session_start();
	  $_SESSION["permiso_admin"] = "si";
		$_SESSION["id_admin"] = $id_admin;
		$_SESSION["nivel_admin"] = $nivel_admin;

		$login_status = "success";
	}

}else{

	$sql_errores = "SELECT * FROM usuarios_error WHERE ip='".$ip."' AND fecha>'".$media_hora."'";
	$rs_errores = mysqli_query($conn,$sql_errores);

	if(mysqli_num_rows($rs_errores)<3){

		$sql_usu_error = "SELECT * FROM usuarios WHERE usuario='".$username."'";
		$rs_usu_error = mysqli_query($conn,$sql_usu_error);
		if(mysqli_num_rows($rs_usu_error)>0){
			$row_usu_error = mysqli_fetch_array($rs_usu_error);
			$id_usu_error = $row_usu_error["id"];
		}else{
			$id_usu_error = 0;
		}

		$sql_ins = "INSERT INTO usuarios_error ";
		$sql_ins.= "(ip,fecha,id_usu) ";
		$sql_ins.= "VALUES ('".$ip."','".date("Y-m-d H:i:s")."','".$id_usu_error."')";
		$rs_ins = mysqli_query($conn,$sql_ins);
	}
}

mysqli_stmt_close($rs);

if($login_status=="success"){

	$resp["redirect_url"] = "admin.php";
}

$resp['login_status'] = $login_status;

echo json_encode($resp);
