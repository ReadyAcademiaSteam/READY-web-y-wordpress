<?
function cambiarf_a_normal($fecha) {
  $piezas = explode("-", $fecha);
  $nueva_fecha = $piezas[2]."/".$piezas[1]."/".$piezas[0];
  return $nueva_fecha;
}

function cambiarf_a_mysql($fecha) {
  $piezas = explode("/", $fecha);
  $nueva_fecha = $piezas[2]."-".$piezas[1]."-".$piezas[0];
  return $nueva_fecha;
}

function url_amigable($url) {

	$url = strtolower($url);

	$url = htmlentities($url);

	$find = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', '&ntilde;', '&Ntilde;');
	$repl = array('a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'n', 'n');
	$url = str_replace ($find, $repl, $url);

	$find = array(' ', '&', '\r\n', '\n', '+');
	$url = str_replace ($find, '-', $url);

	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$repl = array('', '-', '');
	$url = preg_replace ($find, $repl, $url);

	return $url;
}

function comillas($cadena) {

  $find = array("'", '«', '»', '“', '”', '‘', '’');
	$repl = array('&#39', '&laquo;', '&raquo;', '&ldquo;', '&rdquo;', '&lsquo;', '&rsquo;');
	$cadena = str_replace ($find, $repl, $cadena);

	return $cadena;
}

function nombre_fecha($fecha){
	$dia = substr($fecha,8,10);
	$mes = substr($fecha,5,7);
	$intfecha = mktime(0,0,0,$mes,$dia,$anno);
	$nombre = date("j",$intfecha)." de ";
	switch(date("m",$intfecha)){
		case '01':
			$nombre.= "Enero";
			break;
		case '02':
			$nombre.= "Febrero";
			break;
		case '03':
			$nombre.= "Marzo";
			break;
		case '04':
			$nombre.= "Abril";
			break;
		case '05':
			$nombre.= "Mayo";
			break;
		case '06':
			$nombre.= "Junio";
			break;
		case '07':
			$nombre.= "Julio";
			break;
		case '08':
			$nombre.= "Agosto";
			break;
		case '09':
			$nombre.= "Septiembre";
			break;
		case '10':
			$nombre.= "Octubre";
			break;
		case '11':
			$nombre.= "Noviembre";
			break;
		case '12':
			$nombre.= "Diciembre";
			break;
	}
	return $nombre;
}

function nombre_fecha_completa($fecha){
	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$anno = substr($fecha,0,4);
	$intfecha = mktime(0,0,0,$mes,$dia,$anno);
	$nombre = date("j",$intfecha)." de ";
	switch(date("m",$intfecha)){
		case '01':
			$nombre.= "Enero";
			break;
		case '02':
			$nombre.= "Febrero";
			break;
		case '03':
			$nombre.= "Marzo";
			break;
		case '04':
			$nombre.= "Abril";
			break;
		case '05':
			$nombre.= "Mayo";
			break;
		case '06':
			$nombre.= "Junio";
			break;
		case '07':
			$nombre.= "Julio";
			break;
		case '08':
			$nombre.= "Agosto";
			break;
		case '09':
			$nombre.= "Septiembre";
			break;
		case '10':
			$nombre.= "Octubre";
			break;
		case '11':
			$nombre.= "Noviembre";
			break;
		case '12':
			$nombre.= "Diciembre";
			break;
	}
	$nombre.= " de ".$anno;
	return $nombre;
}

function nombre_mes($mes){
	switch($mes){
		case 1:
			$nombre_mes = "Enero";
			break;
	 	case 2:
			$nombre_mes = "Febrero";
			break;
	 	case 3:
			$nombre_mes = "Marzo";
			break;
	 	case 4:
			$nombre_mes = "Abril";
			break;
	 	case 5:
			$nombre_mes = "Mayo";
			break;
	 	case 6:
			$nombre_mes = "Junio";
			break;
	 	case 7:
			$nombre_mes = "Julio";
			break;
	 	case 8:
			$nombre_mes = "Agosto";
			break;
	 	case 9:
			$nombre_mes = "Septiembre";
			break;
	 	case 10:
			$nombre_mes = "Octubre";
			break;
	 	case 11:
			$nombre_mes = "Noviembre";
			break;
	 	case 12:
			$nombre_mes = "Diciembre";
			break;
	}
	return $nombre_mes;
}

function nombre_mes_curso($mes){
	 switch($mes){
	 	case 5:
			$nombre_mes = "Enero";
			break;
	 	case 6:
			$nombre_mes = "Febrero";
			break;
	 	case 7:
			$nombre_mes = "Marzo";
			break;
	 	case 8:
			$nombre_mes = "Abril";
			break;
	 	case 9:
			$nombre_mes = "Mayo";
			break;
	 	case 10:
			$nombre_mes = "Junio";
			break;
	 	case 11:
			$nombre_mes = "Julio";
			break;
	 	case 12:
			$nombre_mes = "Agosto";
			break;
	 	case 1:
			$nombre_mes = "Septiembre";
			break;
	 	case 2:
			$nombre_mes = "Octubre";
			break;
	 	case 3:
			$nombre_mes = "Noviembre";
			break;
	 	case 4:
			$nombre_mes = "Diciembre";
			break;
	}
	return $nombre_mes;
}

function completa2($num){
	switch (strlen($num)){
		case 1:
			return "0".$num;
			break;
		default:
			return $num;
	}
}

function completa3($num){
	switch (strlen($num)){
		case 1:
			return "00".$num;
			break;
		case 2:
			return "0".$num;
			break;
		default:
			return $num;
	}
}

function completa4($num){
	switch (strlen($num)){
		case 1:
			return "000".$num;
			break;
		case 2:
			return "00".$num;
			break;
		case 3:
			return "0".$num;
			break;
		default:
			return $num;
	}
}
?>
