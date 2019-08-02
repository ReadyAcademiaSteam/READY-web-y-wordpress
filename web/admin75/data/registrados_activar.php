<?
include("../../include/conexion.php");
include("../../include/define.php");
include("../include/funciones.php");

use PHPMailer\PHPMailer\PHPMailer;

$ref = $_GET["ref"];
$opcion = $_GET["opcion"];
$enviar = $_GET["enviar"];

$sql = "SELECT * FROM registrados WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

$sql_psw = "SELECT * FROM registrados_passw WHERE ref=".$ref;
$rs_psw = mysqli_query($conn,$sql_psw);
$row_psw = mysqli_fetch_array($rs_psw);

// ----------------- VARIABLES

// -- passw
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$row["ref_menu"]." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "no";
}

// ----------------- FIN VARIABLES

$sql_act = "UPDATE registrados SET ";
if($opcion=="S"){
	$sql_act.= "activo='S'";
}else{
	$sql_act.= "activo='N'";
}
$sql_act.= " WHERE ref=".$ref;

if($rs_act = mysqli_query($conn,$sql_act)){

	$actualizado = $ref;

	if($enviar=="S"){

		include('../../include/phpmailer/PHPMailer.php');
		include('../../include/phpmailer/SMTP.php');
		include('../../include/phpmailer/Exception.php');

		include("../../include/plantilla_correo.php");

		//------------------- Generación de CONTENIDO -------------------

		$nombre_completo = $row["nombre"];
		if($row["apellidos"]){ $nombre_completo.= " ".$row["apellidos"]; }

		$asunto = "Registro en la web ".organizacion;

		$contenido = "<p>Hola <b>".$row["nombre"]."</b>:</p>";
		$contenido.= "<p>Tu correo ha sido añadido a nuestra base de datos correctamente.</p>";
		if($v1=="si"){
			$contenido.= "<p>Para acceder a la zona privada de la web <a href='https://".dominio."'>www.".dominio."</a>, debes usar estos datos:</p>";
			$contenido.= "<ul>";
				$contenido.= "<li>Usuario: <b>".$row["usuario"]."</b></li>";
				$contenido.= "<li>Contraseña: <b>".$row_psw["nombre"]."</b></li>";
			$contenido.= "</ul></p>";
		}
		$contenido.= "<p>Gracias por usar este servicio.</p>";
		$contenido.= "<p><b><i>".organizacion."</i></b></p>";

		//------------------- Proceso de ENVÍO -------------------

		$mail = new PHPMailer;

		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPDebug = 2;

		$mail->Host = correo_servidor;
		$mail->Username = correo_usuario;
		$mail->Password = correo_psw;
		if(correo_seguridad!=""){ $mail->SMTPSecure = correo_seguridad; }
		$mail->Port = correo_puerto;

		$mail->setFrom(correo_origen, "Web ".correo_organizacion);

		$mail->Subject = $asunto;

		$mail->addAddress($row["usuario"],$nombre_completo);

		$mensaje = html_mensaje($asunto,$contenido,'S');
		$mail->msgHTML($mensaje);

		if($mail->Send()){

			$enviado = $ref;

		}else{

			$enviado = 0;

		}

		$mail->ClearAddresses();

	}

}else{

	$actualizado = 0;

}

$resp["actualizado"] = $actualizado;
$resp["enviado"] = $enviado;

echo json_encode($resp);
?>
