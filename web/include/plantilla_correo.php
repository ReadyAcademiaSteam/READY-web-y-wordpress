<?
function html_mensaje($asunto,$contenido,$externo){

	$mensaje = "<html>";

	$mensaje.= "<head>";
	$mensaje.= "<title>".$asunto."</title>";
	$mensaje.= "<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />";
	$mensaje.= "<meta name='viewport' content='initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,width=device-width,height=device-height,target-densitydpi=device-dpi,user-scalable=no'>";
	$mensaje.= "<body style='padding:0; margin:0; background:#f2f2f2;'>";

	$mensaje.= "<table width='100%' border='0' cellpadding='0' cellspacing='0'>";
	  $mensaje.= "<tbody>";
			$mensaje.= "<tr>";

				$mensaje.= "<td align='center' valign='top' style='padding:0; margin:0; background:#f2f2f2;'>";

				  $mensaje.= "<table width='600' border='0' cellpadding='0' cellspacing='0' align='center'>";
					$mensaje.= "<tbody>";

					  // MARGEN SUPERIOR -->
					  $mensaje.= "<tr>";
						  $mensaje.= "<td>";
							$mensaje.= "<table width='100%' border='0' cellpadding='0' cellspacing='0' align='center'>";
							  $mensaje.= "<tbody>";
								$mensaje.= "<tr>";
									$mensaje.= "<td width='100%' style='padding:0; font-family:Helvetica,Arial,sans-serif;  -webkit-font-smoothing: antialiased; font-size:12px;'>&nbsp;</td>";
								$mensaje.= "</tr>";
							  $mensaje.= "</tbody>";
							$mensaje.= "</table>";
						  $mensaje.= "</td>";
					  $mensaje.= "</tr>";
					  // / MARGEN SUPERIOR -->

					  // BORDE SUPERIOR -->
					  $mensaje.= "<tr>";
						$mensaje.= "<td>";
						  $mensaje.= "<table width='600' border='0' cellpadding='0' cellspacing='0' align='center'>";
							$mensaje.= "<tbody>";
							  $mensaje.= "<tr>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_top_left_1px.jpg' width='1' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_top_left_3px.jpg' width='3' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_top_312px.jpg' width='312' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_top_160px.jpg' width='160' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_top_220px.jpg' width='120' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_top_right_3px.jpg' width='3' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_top_right_1px.jpg' width='1' height='20' alt='' border='0' style='display:block;'></td>";
							  $mensaje.= "</tr>";
							$mensaje.= "</tbody>";
						  $mensaje.= "</table>";
						$mensaje.= "</td>";
					  $mensaje.= "</tr>";
					  // / BORDE SUPERIOR -->

					  // CUERPO -->
					  $mensaje.= "<tr>";
						$mensaje.= "<td style='background:#f2f2f2;'>";
						  $mensaje.= "<table width='600' border='0' cellpadding='0' cellspacing='0' align='center' style='background:#f2f2f2;'>";

							$mensaje.= "<tbody>";
							  $mensaje.= "<tr>";
								$mensaje.= "<td style='background:#e3e3e3;'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='1' border='0' style='display:block;'></td>";
								$mensaje.= "<td style='background:#fff;'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='598' border='0' style='display:block;'></td>";
								$mensaje.= "<td style='background:#e3e3e3;'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='1' border='0' style='display:block;'></td>";
							  $mensaje.= "</tr>";

							  // LOGO -->
							  $mensaje.= "<tr>";
								$mensaje.= "<td style='background:#e3e3e3;'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='1' border='0' style='display:block;'></td>";
								$mensaje.= "<td align='left' valign='top' style='background:#fff;'>";

									$mensaje.= "<table width='598' border='0' cellpadding='0' cellspacing='0' align='center' style='background:#fff;'>";
									  $mensaje.= "<tbody>";
										$mensaje.= "<tr>";
											$mensaje.= "<td width='29'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='29' border='0' style='display:block;'></td>";
											$mensaje.= "<td>";
												$mensaje.= "<table width='390' border='0' cellpadding='0' cellspacing='0' align='center' style='background:#fff;'>";
												  $mensaje.= "<tbody>";
													$mensaje.= "<tr>";
													  $mensaje.= "<td>";

														// LOGO -->
														$mensaje.= "<a href='http://".dominio."/".carpeta."' target='_blank'><img src='https://".dominio."/".carpeta."imagenes/logo-mailing.jpg' alt='".organizacion."' border='0' style='display:block;margin:0 0 20px 0'></a>";
														// / LOGO -->

													  $mensaje.= "</td>";
													$mensaje.= "</tr>";
												  $mensaje.= "</tbody>";
												$mensaje.= "</table>";
											$mensaje.= "</td>";
											$mensaje.= "<td valign='top'>";
												$mensaje.= "<table width='150' border='0' cellpadding='0' cellspacing='0' style='background:#fff;'>";
												  $mensaje.= "<tbody>";
													$mensaje.= "<tr>";
													  $mensaje.= "<td align='right'>";

														// RRSS -->
														//$mensaje.= "<a href='https://www.facebook.com/' target='_blank'><img src='https://onirics.es/mailing/template_facebook_icon.gif' width='18' height='18' alt='Facebook' border='0' style='display:block;margin-left:20px;'></a>";
														// / RRSS -->

													  $mensaje.= "</td>";
													$mensaje.= "</tr>";
												  $mensaje.= "</tbody>";
												$mensaje.= "</table>";
											$mensaje.= "</td>";
											$mensaje.= "<td width='29'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='29' border='0' style='display:block;'></td>";
										$mensaje.= "</tr>";
									  $mensaje.= "</tbody>";
									$mensaje.= "</table>";

								$mensaje.= "</td>";
								$mensaje.= "<td style='background:#e3e3e3;'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='1' border='0' style='display:block;'></td>";
							  $mensaje.= "</tr>";
							  // / LOGO -->

							  $mensaje.= "<tr>";
								$mensaje.= "<td style='background:#e3e3e3;'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='1' border='0' style='display:block;'></td>";
								$mensaje.= "<td align='left' valign='top' style='background:#fff; font-family:Helvetica,Arial,sans-serif;  -webkit-font-smoothing: antialiased; font-size:13px; color:#666; padding-bottom:9px;'>";

									$mensaje.= "<table width='598' border='0' cellpadding='0' cellspacing='0' align='center' style='background:#fff;'>";
									  $mensaje.= "<tbody>";
										$mensaje.= "<tr>";
										  $mensaje.= "<td width='540' style='background:#fff;'>";

											// BODY CONTENT HERE -->

											$mensaje.= "<table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#e3e3e3'>";
											  $mensaje.= "<tbody>";
												$mensaje.= "<tr>";
													$mensaje.= "<td style='background:#e3e3e3;'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='1' border='0' style='display:block;'></td>";
												$mensaje.= "</tr>";
											  $mensaje.= "</tbody>";
											$mensaje.= "</table>";

											$mensaje.= "<table border='0' cellspacing='0' cellpadding='0' width='100%' bgcolor='#F5F5F5'>";
											  $mensaje.= "<tbody>";
												$mensaje.= "<tr>";
													$mensaje.= "<td width='29' align='left' valign='top'><img style='display:block;' src='https://onirics.es/mailing/spacer50.gif' border='0' alt='' width='29' height='1'></td>";
													$mensaje.= "<td align='left' valign='top'>";
													  $mensaje.= "<table border='0' cellspacing='0' cellpadding='0' width='100%'>";
														$mensaje.= "<tbody>";
														  $mensaje.= "<tr>";
															$mensaje.= "<td colspan='2' align='left' valign='top'><img style='display:block;' src='https://onirics.es/mailing/spacer50.gif' width='1' height='15' border='0'></td>";
														  $mensaje.= "</tr>";
														  $mensaje.= "<tr>";
															$mensaje.= "<td valign='top'>";

															// TITULAR -->
															  $mensaje.= "<span><font style='font-family: Arial, Helvetica, sans-serif; font-size: 24px; color: #a3b142; text-decoration: none; line-height: 26px;'>";
																$mensaje.= $asunto;
															  $mensaje.= "</font></span>";
															// / TITULAR -->

															$mensaje.= "</td>";
														  $mensaje.= "</tr>";
														  $mensaje.= "<tr>";
															$mensaje.= "<td colspan='2' align='left' valign='top'><img style='display:block;' src='https://onirics.es/mailing/spacer50.gif' width='1' height='15' border='0'></td>";
														  $mensaje.= "</tr>";
														$mensaje.= "</tbody>";
													  $mensaje.= "</table>";
													$mensaje.= "</td>";
													$mensaje.= "<td width='29' align='left' valign='top'><img style='display:block;' src='https://onirics.es/mailing/spacer50.gif' border='0' alt='' width='29' height='1'></td>";
												$mensaje.= "</tr>";
											  $mensaje.= "</tbody>";
											$mensaje.= "</table>";

											$mensaje.= "<table width='100%' border='0' cellpadding='0' cellspacing='0' bgcolor='#e3e3e3'>";
											  $mensaje.= "<tbody>";
												$mensaje.= "<tr>";
													$mensaje.= "<td style='background:#e3e3e3;'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='1' border='0' style='display:block;'></td>";
												$mensaje.= "</tr>";
											  $mensaje.= "</tbody>";
											$mensaje.= "</table>";

											$mensaje.= "<table width='598' border='0' cellpadding='0' cellspacing='0' align='center' style='background:#fff;'>";
											  $mensaje.= "<tbody>";
												$mensaje.= "<tr>";
													$mensaje.= "<td width='29'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='29' border='0' style='display:block;'></td>";
													$mensaje.= "<td style='padding: 25px 0 0 0;'>";
														$mensaje.= "<table width='540' border='0' cellpadding='0' cellspacing='0' align='center' style='background:#fff;'>";
														  $mensaje.= "<tbody>";
															$mensaje.= "<tr>";
															  $mensaje.= "<td style='font-family:Helvetica,Arial,sans-serif; color:#717074; font-size:13px; -webkit-font-smoothing: antialiased;'>";

																	// -------------------------------------------------------- CONTENIDO --------------------------------------------------------

																	$mensaje.= $contenido;

																	// -------------------------------------------------------- FIN CONTENIDO --------------------------------------------------------

															  $mensaje.= "</td>";
															$mensaje.= "</tr>";
														  $mensaje.= "</tbody>";
														$mensaje.= "</table>";
													$mensaje.= "</td>";
													$mensaje.= "<td width='29'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='29' border='0' style='display:block;'></td>";
												$mensaje.= "</tr>";
											  $mensaje.= "</tbody>";
											$mensaje.= "</table>";

										  $mensaje.= "</td>";
										$mensaje.= "</tr>";
									  $mensaje.= "</tbody>";
									$mensaje.= "</table>";
								$mensaje.= "</td>";
								$mensaje.= "<td style='background:#e3e3e3;'><img src='https://onirics.es/mailing/spacer10.gif' height='1' width='1' border='0' style='display:block;'></td>";
							  $mensaje.= "</tr>";

							$mensaje.= "</tbody>";
						  $mensaje.= "</table>";
						$mensaje.= "</td>";
					  $mensaje.= "</tr>";
					  // / TEMPLATE: BODY -->

					  // BORDE INFERIOR -->
					  $mensaje.= "<tr>";
						$mensaje.= "<td>";
						  $mensaje.= "<table width='600' border='0' cellpadding='0' cellspacing='0' align='center'>";
							$mensaje.= "<tbody>";
							  $mensaje.= "<tr>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_bot_left_1px.jpg' width='1' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_bot_left_3px.jpg' width='3' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_bot_312px.jpg' width='312' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_bot_160px.jpg' width='160' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_bot_220px.jpg' width='120' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_bot_right_3px.jpg' width='3' height='20' alt='' border='0' style='display:block;'></td>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_bot_right_1px.jpg' width='1' height='20' alt='' border='0' style='display:block;'></td>";
							  $mensaje.= "</tr>";
							$mensaje.= "</tbody>";
						  $mensaje.= "</table>";
						$mensaje.= "</td>";
					  $mensaje.= "</tr>";
					  // / BORDE INFERIOR -->

					  // PIE -->
					  $mensaje.= "<tr>";
							$mensaje.= "<td>";

							  $mensaje.= "<table width='600' border='0' cellpadding='0' cellspacing='0' align='center'>";
									$mensaje.= "<tbody>";
									  $mensaje.= "<tr>";
											$mensaje.= "<td>";

											  $mensaje.= "<table width='600' border='0' cellpadding='0' cellspacing='0' align='center' style='padding:20px 0'>";
													$mensaje.= "<tbody>";
													  $mensaje.= "<tr>";

															$mensaje.= "<td width='480' style='padding:0 29px; font-family:Helvetica,Arial,sans-serif;  -webkit-font-smoothing: antialiased; font-size:11px; color:#666; text-align:left;'>";
																$mensaje.= "&copy; ".date("Y")." ".organizacion."&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;<a href='http://".dominio."/".carpeta."' style='color:#666; text-decoration:underline;'>www.".dominio."/".carpeta."</a><br />";
																if($externo=="S"){
																	$mensaje.= "Para darse de baja, enviar un correo a <a href='mailto:".correo_visible."' style='color:#666; text-decoration:underline;'>".correo_visible."</a> solicit&aacute;ndolo.";
																	$mensaje.= "<br />Todos los derechos reservados.";
																}
															$mensaje.= "</td>";
															$mensaje.= "<td width='120' align='right' valign='top'>";

															// RRSS -->
															//$mensaje.= "<a href='https://www.facebook.com/' target='_blank'><img src='https://onirics.es/mailing/template_facebook_icon.gif' width='18' height='18' alt='Facebook' border='0' style='display:block;padding-right:29px;'></a>";
															// / RRSS -->

															$mensaje.= "</td>";
													  $mensaje.= "</tr>";
													$mensaje.= "</tbody>";
											  $mensaje.= "</table>";

											$mensaje.= "</td>";
									  $mensaje.= "</tr>";
									$mensaje.= "</tbody>";
							  $mensaje.= "</table>";
							$mensaje.= "</td>";
					  $mensaje.= "</tr>";
					  // / PIE -->

	          if($externo=="S"){
						  // SEPARADOR PIE -->
						  $mensaje.= "<tr>";
								$mensaje.= "<td><img src='https://onirics.es/mailing/template_horizontal_rule.jpg' width='600' height='2' alt='' border='0' style='display:block;'></td>";
						  $mensaje.= "</tr>";
						  // / SEPARADOR PIE  -->

						  // PIE 2 -->
						  $mensaje.= "<tr>";
							$mensaje.= "<td style='padding:19px 29px; font-family:Helvetica,Arial,sans-serif;  -webkit-font-smoothing: antialiased; font-size:11px; color:#666; text-align:left;'>";
								$mensaje.= "<b><u>Protecci&oacute;n de datos</u></b><br />";
								$mensaje.= organizacion." le informa que su direcci&oacute;n de correo electr&oacute;nico, as&iacute; como el resto de los datos de car&aacute;cter personal de su tarjeta de visita que nos facilite, ser&aacute;n objeto de tratamiento automatizado en nuestros ficheros, con la finalidad de gestionar la agenda de contactos de nuestra organizaci&oacute;n, para el env&iacute;o de comunicaciones profesionales y/o personales por v&iacute;a electr&oacute;nica. Vd. podr&aacute; en cualquier momento ejercer el derecho de acceso, rectificaci&oacute;n, cancelaci&oacute;n y oposici&oacute;n en los t&eacute;rminos establecidos en la Ley Org&aacute;nica 15/1999 de 13 de diciembre. Siendo el responsable del tratamiento ".organizacion."<br /><br />";
								$mensaje.= "<b><u>Confidencialidad</u></b><br />";
								$mensaje.= "El contenido de esta comunicaci&oacute;n, as&iacute; como el de toda la documentaci&oacute;n anexa, es confidencial y va dirigida al destinatario del mismo. En el supuesto de que usted no fuera el destinatario, le solicitamos que nos lo indique y no comunique su contenido a terceros, procediendo a su destrucci&oacute;n. Muchas gracias.<br /><br />";
								$mensaje.= "<b><u>Confidenciality</u></b><br />";
								$mensaje.= "This content of this communication and any attached information is confidential and exclusively for use of the addressee. If you are not the addressee, we ask you notify to the sender and do not pass its content to another person, and please be sure you destroy it. Thank you.";
							$mensaje.= "</td>";
						  $mensaje.= "</tr>";
						  // / PIE 2 -->
						}

					$mensaje.= "</tbody>";
				  $mensaje.= "</table>";
				$mensaje.= "</td>";

			$mensaje.= "</tr>";
	  $mensaje.= "</tbody>";
	$mensaje.= "</table>";

	$mensaje.= "</body>";

	return $mensaje;
}
?>
