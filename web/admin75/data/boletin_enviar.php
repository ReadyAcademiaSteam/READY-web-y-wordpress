<?
session_start();
$id_admin = $_SESSION["id_admin"];

include("../../include/conexion.php");
include("../../include/define.php");
include("../include/funciones.php");

use PHPMailer\PHPMailer\PHPMailer;

include('../../include/phpmailer/PHPMailer.php');
include('../../include/phpmailer/SMTP.php');
include('../../include/phpmailer/Exception.php');

include("../../include/plantilla_correo.php");

$ref = $_GET["ref"];
$modo = $_GET["modo"];

$resp = array();

//------------------- Generación de CONTENIDO -------------------

$sql_boletin = "SELECT * FROM boletin WHERE ref=".$ref;
$rs_boletin = mysqli_query($conn,$sql_boletin);
$row_boletin = mysqli_fetch_array($rs_boletin);

$asunto = $row_boletin["titulo"];

$i = 1;
$contenido = "";

$sql_lista = "SELECT * FROM boletin_contenido WHERE ref_boletin=".$ref." ORDER BY ref_contenido DESC";
$rs_lista = mysqli_query($conn,$sql_lista);
$total_lista = mysqli_num_rows($rs_lista);
while($row_lista = mysqli_fetch_array($rs_lista)){

	$sql_contenido = "SELECT * FROM contenidos WHERE ref=".$row_lista["ref_contenido"];
	$rs_contenido = mysqli_query($conn,$sql_contenido);
	$row_contenido = mysqli_fetch_array($rs_contenido);

	$sql_contenido_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row_lista["ref_contenido"]." AND ref_idioma=1";
	$rs_contenido_info = mysqli_query($conn,$sql_contenido_info);
	$row_contenido_info = mysqli_fetch_array($rs_contenido_info);

	$enlace = "https://".dominio."/noticias_ver.php?ref=".$row_contenido["ref"];
	$foto = "https://".dominio."/imagenes/contenidos/1/";
	if($row_contenido["foto"]){ $foto.= $row_contenido["foto"]; }else{ $foto.= "0.jpg"; }

	$contenido.= "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
	$contenido.= "<tr><td>";
		$contenido.= "<a href='".$enlace."' title='".$row_contenido_info["titulo"]."'><img src='".$foto."' width='160' border='0' align='right' style='margin-left:15px;margin-bottom:10px'></a>";
		$contenido.= "<a href='".$enlace."' title='".$row_contenido_info["titulo"]."' style='text-decoration: none;'><h2 style='font-size:24px; font-weight:lighter; color:#6f6f6f; margin:0 0 20px 0;'>".$row_contenido_info["titulo"]."</h2></a>";
		if($row_contenido_info["intro"]!=''){
			$contenido.= "<p style='font-size:12px;'>".$row_contenido_info["intro"]."</p>";
		}
	$contenido.= "</td></tr>";
	if($i<$total_lista){
		$contenido.= "<tr>";
		$contenido.= "<td style='padding:20px 0'><img src='https://onirics.es/mailing/template_horizontal_rule.jpg' width='540' height='2' alt='' border='0' style='display:block;'></td>";
		$contenido.= "</tr>";
	}
	$contenido.= "</table>";
	$i++;
}

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

		while ($row = mysqli_fetch_array($rs)){

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

			$nombre = $row["nombre"];
			$nombreapell = $row["nombre"]." ".$row["apellidos"];
			$mail->addAddress($row["usuario"],$nombreapell);

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
