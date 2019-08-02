<?
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

set_time_limit(200);

include("../../include/conexion.php");

session_start();
$id_admin = $_SESSION["id_admin"];

include("../../include/define.php");
include("../../include/plantilla_correo.php");

include('../../include/phpmailer/PHPMailer.php');
include('../../include/phpmailer/SMTP.php');
include('../../include/phpmailer/Exception.php');

include("../include/funciones.php");

$ref = $_GET["ref"];
$modo = $_GET["modo"];

$resp = array();

//------------------- Generación de CONTENIDO -------------------

$sql_contenido = "SELECT * FROM contenidos WHERE ref=".$ref;
$rs_contenido = mysqli_query($conn,$sql_contenido);
$row_contenido = mysqli_fetch_array($rs_contenido);

$sql_contenido_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=1";
$rs_contenido_info = mysqli_query($conn,$sql_contenido_info);
$row_contenido_info = mysqli_fetch_array($rs_contenido_info);

$asunto = $row_contenido_info["titulo"];

$contenido1 = "";
if($row_contenido["foto"]){
	$foto = "http://".dominio."/imagenes/contenidos/".$row_contenido["foto"];
	$contenido1 = "<img src='".$foto."' width='160' border='0' align='right' style='margin-left:15px;margin-bottom:10px'>";
	switch($row_contenido["align"]) {
		case "right":
			$contenido1 = "<img src='".$foto."' width='160' border='0' align='right' style='margin-left:15px;margin-bottom:10px'>";
			break;
		case "center":
			$contenido1 = "<img src='".$foto."' width='100%' border='0' style='margin-bottom:20px'>";
			break;
		case "left":
			$contenido1 = "<img src='".$foto."' width='160' border='0' align='left' style='margin-right:15px;margin-bottom:10px'>";
			break;
	}
}
$contenido2 = $row_contenido_info["texto"];

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

switch ($modo) {

	//-------------------------------------------------------------------------------------

	case "previa":

		$sql_usu = "SELECT * FROM usuarios WHERE id=".$id_admin;
		$rs_usu = mysqli_query($conn,$sql_usu);
		$row_usu = mysqli_fetch_array($rs_usu);

		$nombre = $row_usu["nombre"];
		if($row_usu["apellidos"]!=""){ $nombre.= " ".$row_usu["apellidos"]; }

		$contenido = $contenido1."<p>Hola <strong>".$row_usu["nombre"]."</strong>:</p>".$contenido2;

		$mail->addAddress($row_usu["email"],$nombre);

		$mensaje = html_mensaje($asunto,$contenido,'S');
		$mail->msgHTML($mensaje);

		if($mail->Send()){

			$enviado = $ref;

		}else{

			$enviado = 0;

		}

		break;

	//-------------------------------------------------------------------------------------

	case "todos":

		$enviado = -1;

		$sql = "SELECT * FROM registrados WHERE ref_menu IN (SELECT ref_menu FROM mail_destinatarios) AND usuario!='' GROUP BY usuario";
		$rs = mysqli_query($conn,$sql);

		$total = mysqli_num_rows($rs);
		$cta = 0;

		while($row = mysqli_fetch_array($rs)){

			$cta++;
			if($cta<$total){
				$porcentaje = round($cta*100/$total);
				$texto = $porcentaje."|".$cta." de ".$total;
				file_put_contents('progreso.txt',$texto);
			}else{
				$texto = "100|".$total." de ".$total;
				file_put_contents('progreso.txt',$texto);
				echo "OK";
			}

			$contenido = "";
			$nombre = $row["nombre"];
			$nombreapell = $row["nombre"]." ".$row["apellidos"];
			$mail->AddAddress($row["usuario"],$nombreapell);

			$contenido = $contenido1."<p>Hola <strong>".$row["nombre"]."</strong>:</p>".$contenido2;

			$mensaje = html_mensaje($asunto,$contenido,'S');
			$mail->msgHTML($mensaje);

			$exito = $mail->Send();

			if($exito){

				$sql_ins = "INSERT INTO mail_envios (fecha,nombre,mail,enviado) VALUES ('".date("Y-m-d H:i:s")."','".$nombreapell."','".$row["usuario"]."','S')";
				$rs_ins = mysqli_query($conn,$sql_ins);

			}else{

				$intentos = 1;
				while((!$exito)&&($intentos<=4)&&($mail->ErrorInfo!="SMTP Error: Data not accepted")){
					sleep(1);
					$exito = $mail->Send();
					$intentos++;
				}
				if($exito){
					$sql_ins = "INSERT INTO mail_envios (fecha,nombre,mail,enviado) VALUES ('".date("Y-m-d H:i:s")."','".$nombreapell."','".$row["usuario"]."','S')";
				}else{
					$sql_ins = "INSERT INTO mail_envios (fecha,nombre,mail,enviado) VALUES ('".date("Y-m-d H:i:s")."','".$nombreapell."','".$row["usuario"]."','N')";
				}
			}

			$mail->ClearAddresses();
		}

		//----------------------Envío el resumen del mailing

		$mail->ClearAttachments();
		$mail->addAddress(correo_destino,correo_organizacion);

		$reporte = "Enviado correctamente a:<br/>";

		$sql_ok = "SELECT * FROM mail_envios WHERE enviado='S'";
		$rs_ok = mysqli_query($conn,$sql_ok);
		if(mysqli_num_rows($rs_ok)>0){

			while ($row_ok = mysqli_fetch_array($rs_ok)){
			  $reporte.= "<br/>- ".$row_ok["nombre"]." (".$row_ok["mail"].")";
			}

		}else{

			$reporte.= "<br/>- NO hay ENVÍOS correctos";
		}

		$reporte.= "<br/><br/>------------------<br/><br/>";

		$reporte.= "ERROR al ser enviado a:<br/>";

		$sql_ko = "SELECT * FROM mail_envios WHERE enviado='N'";
		$rs_ko = mysqli_query($conn,$sql_ko);
		if(mysqli_num_rows($rs_ko)>0){

			while ($row_ko = mysqli_fetch_array($rs_ko)){
			  $reporte.= "<br/>- ".$row_ko["nombre"]." (".$row_ko["mail"].")";
			}

		}else{

			$reporte.= "<br/>- NO hay ERRORES de envío";
		}

		$mail->Body = $reporte;
		$mail->Subject = "Resultados del envío masivo (".date("d/m/Y")." a las ".date("H:i").")";

		$mail->Send();

		$sql_limpiar = "TRUNCATE TABLE mail_envios";
		$rs_limpiar = mysqli_query($conn,$sql_limpiar);

		break;
}

$resp["enviado"] = $enviado;

echo json_encode($resp);
?>
