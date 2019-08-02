<?
function cambiarf_a_normal($fecha){

  $piezas = explode("-", $fecha);
  $nueva_fecha = $piezas[2] . "/" . $piezas[1] . "/" . $piezas[0];
  return $nueva_fecha;
}

function cambiarf_a_mysql($fecha){

  $piezas = explode("/", $fecha);
  $nueva_fecha = $piezas[2] . "-" . $piezas[1] . "-" . $piezas[0];
  return $nueva_fecha;
}

function url_amigable($url){

	$url = strtolower($url);

	$find = array(',', '«', '»', '"', '"', '&laquo;', '&raquo', '&acute;', '&rdquo;', '&ldquo;', '&quot;', '&iexcl;', '&iquest;', '&lquest;', '?', '&#39', '&ordm;', '&lsquo;', '&rsquo;');
	$url = str_replace($find, '', $url);

  $find = array('&aacute;', '&eacute;', '&iacute;', '&oacute;', '&uacute;', '&Aacute;', '&Eacute;', '&Iacute;', '&Oacute;', '&Uacute;', '&ntilde;', '&Ntilde;');
	$repl = array('a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'n', 'n');
	$url = str_replace($find, $repl, $url);

  $find = array('á', 'é', 'í', 'ó', 'ú', 'Á', 'É', 'Í', 'Ó', 'Ú', 'ñ', 'Ñ');
	$repl = array('a', 'e', 'i', 'o', 'u', 'a', 'e', 'i', 'o', 'u', 'n', 'n');
	$url = str_replace($find, $repl, $url);

	$find = array(' ', '&', '\r\n', '\n', '+', '¿', '?', ',', '«', '»', '"', '"');
	$url = str_replace ($find, '-', $url);

	$find = array('/[^a-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
	$repl = array('', '-', '');
	$url = preg_replace($find, $repl, $url);

	return $url;
}

function url_completa(){

	$protocolo = $_SERVER['HTTPS'] == 'on' ? 'https' : 'http'; // Se extrae el protocolo (http o https)
	return $protocolo.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; // Se devuelve la URL completa
}

function tamano_archivo($peso, $decimales=0){

	$clase = array(" Bytes", " KB", " MB", " GB", " TB");
	return round($peso/pow(1024,($i = floor(log($peso, 1024)))),$decimales ).$clase[$i];
}

function contenido_idioma($campo,$ref_contenido,$idioma){

	include("conexion.php");

	$sql_idioma1 = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref_contenido." AND ref_idioma=1";
	if($idioma==1){
		$rs_idioma1 = mysqli_query($conn,$sql_idioma1);
		$row_idioma1 = mysqli_fetch_array($rs_idioma1);
		return $row_idioma1[$campo];
	}else{
		$sql_idioma2 = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref_contenido." AND ref_idioma=".$idioma;
		$rs_idioma2 = mysqli_query($conn,$sql_idioma2);
		$row_idioma2 = mysqli_fetch_array($rs_idioma2);
		if($row_idioma2[$campo]!=''){
			return $row_idioma2[$campo];
		}else{
			$rs_idioma1 = mysqli_query($conn,$sql_idioma1);
			$row_idioma1 = mysqli_fetch_array($rs_idioma1);
			return $row_idioma1[$campo];
		}
	}
}

function producto_idioma($campo,$ref_producto,$idioma){

	include("conexion.php");

	$sql_idioma1 = "SELECT * FROM ds_productos_info WHERE ref_prod=".$ref_producto." AND ref_idioma=1";
	if($idioma==1){
		$rs_idioma1 = mysqli_query($conn,$sql_idioma1);
		$row_idioma1 = mysqli_fetch_array($rs_idioma1);
		return $row_idioma1[$campo];
	}else{
		$sql_idioma2 = "SELECT * FROM ds_productos_info WHERE ref_prod=".$ref_producto." AND ref_idioma=".$idioma;
		$rs_idioma2 = mysqli_query($conn,$sql_idioma2);
		$row_idioma2 = mysqli_fetch_array($rs_idioma2);
		if($row_idioma2[$campo]!=''){
			return $row_idioma2[$campo];
		}else{
			$rs_idioma1 = mysqli_query($conn,$sql_idioma1);
			$row_idioma1 = mysqli_fetch_array($rs_idioma1);
			return $row_idioma1[$campo];
		}
	}
}

function categoria_idioma($campo,$ref_categoria,$idioma){

	include("conexion.php");

	$sql_idioma1 = "SELECT * FROM ds_categorias_info WHERE ref_categ=".$ref_categoria." AND ref_idioma=1";
	if($idioma==1){
		$rs_idioma1 = mysqli_query($conn,$sql_idioma1);
		$row_idioma1 = mysqli_fetch_array($rs_idioma1);
		return $row_idioma1[$campo];
	}else{
		$sql_idioma2 = "SELECT * FROM ds_categorias_info WHERE ref_categ=".$ref_categoria." AND ref_idioma=".$idioma;
		$rs_idioma2 = mysqli_query($conn,$sql_idioma2);
		$row_idioma2 = mysqli_fetch_array($rs_idioma2);
		if($row_idioma2[$campo]!=''){
			return $row_idioma2[$campo];
		}else{
			$rs_idioma1 = mysqli_query($conn,$sql_idioma1);
			$row_idioma1 = mysqli_fetch_array($rs_idioma1);
			return $row_idioma1[$campo];
		}
	}
}

function opcion_idioma($tabla,$ref_item,$idioma){

	include("conexion.php");

	$sql_idioma1 = "SELECT * FROM ".$tabla." WHERE ref_item=".$ref_item." AND ref_idioma=1";
	if($idioma==1){
		$rs_idioma1 = mysqli_query($conn,$sql_idioma1);
		$row_idioma1 = mysqli_fetch_array($rs_idioma1);
		return $row_idioma1["nombre"];
	}else{
		$sql_idioma2 = "SELECT * FROM ".$tabla." WHERE ref_item=".$ref_item." AND ref_idioma=".$idioma;
		$rs_idioma2 = mysqli_query($conn,$sql_idioma2);
		$row_idioma2 = mysqli_fetch_array($rs_idioma2);
		if($row_idioma2["nombre"]!=''){
			return $row_idioma2["nombre"];
		}else{
			$rs_idioma1 = mysqli_query($conn,$sql_idioma1);
			$row_idioma1 = mysqli_fetch_array($rs_idioma1);
			return $row_idioma1["nombre"];
		}
	}
}

function distancia_fechas($fecha_ini,$fecha_fin){

  $intfecha = mktime(0,0,0,substr($fecha_fin,5,2),substr($fecha_fin,8,10),substr($fecha_fin,0,4));
  $intfecha_ini = mktime(0,0,0,substr($fecha_ini,5,2),substr($fecha_ini,8,10),substr($fecha_ini,0,4));

  $respuesta = "";

  if($fecha_ini!=$fecha_fin){

    if($fecha_ini==date("Y-m-d")){
      $respuesta.= "Desde hoy hasta el ";
      switch (date("w",$intfecha)){case 0: $respuesta.= "Domingo "; break; case 1: $respuesta.= "Lunes "; break; case 2: $respuesta.= "Martes "; break; case 3: $respuesta.= "Mi&eacute;rcoles "; break; case 4: $respuesta.= "Jueves "; break; case 5: $respuesta.= "Viernes "; break; case 6: $respuesta.= "S&aacute;bado "; break;}
      $respuesta.= date("j",$intfecha);
      $respuesta.= " de ";
      switch (date("n",$intfecha)){case 1: $respuesta.= "Enero"; break; case 2: $respuesta.= "Febrero"; break; case 3: $respuesta.= "Marzo"; break; case 4: $respuesta.= "Abril"; break; case 5: $respuesta.= "Mayo"; break; case 6: $respuesta.= "Junio"; break; case 7: $respuesta.= "Julio"; break; case 8: $respuesta.= "Agosto"; break; case 9: $respuesta.= "Septiembre"; break; case 10: $respuesta.= "Octubre"; break; case 11: $respuesta.= "Noviembre"; break; case 12: $respuesta.= "Diciembre"; break;}
    }
    if($fecha_fin==date("Y-m-d")){
      $respuesta.= "Del ";
      switch (date("w",$intfecha_ini)){case 0: $respuesta.= "Domingo "; break; case 1: $respuesta.= "Lunes "; break; case 2: $respuesta.= "Martes "; break; case 3: $respuesta.= "Mi&eacute;rcoles "; break; case 4: $respuesta.= "Jueves "; break; case 5: $respuesta.= "Viernes "; break; case 6: $respuesta.= "S&aacute;bado "; break;}
      $respuesta.= date("j",$intfecha_ini);
      $respuesta.= " de ";
      switch (date("n",$intfecha_ini)){case 1: $respuesta.= "Enero"; break; case 2: $respuesta.= "Febrero"; break; case 3: $respuesta.= "Marzo"; break; case 4: $respuesta.= "Abril"; break; case 5: $respuesta.= "Mayo"; break; case 6: $respuesta.= "Junio"; break; case 7: $respuesta.= "Julio"; break; case 8: $respuesta.= "Agosto"; break; case 9: $respuesta.= "Septiembre"; break; case 10: $respuesta.= "Octubre"; break; case 11: $respuesta.= "Noviembre"; break; case 12: $respuesta.= "Diciembre"; break;}
      $respuesta.= " hasta hoy";
    }
    if(($fecha_ini!=date("Y-m-d"))&&($fecha_fin!=date("Y-m-d"))){
      $respuesta.= "Del ";
      switch (date("w",$intfecha_ini)){case 0: $respuesta.= "Domingo "; break; case 1: $respuesta.= "Lunes "; break; case 2: $respuesta.= "Martes "; break; case 3: $respuesta.= "Mi&eacute;rcoles "; break; case 4: $respuesta.= "Jueves "; break; case 5: $respuesta.= "Viernes "; break; case 6: $respuesta.= "S&aacute;bado "; break;}
      $respuesta.= date("j",$intfecha_ini);
      if(date("n",$intfecha_ini)!=date("n",$intfecha)){
        $respuesta.= " de ";
        switch (date("n",$intfecha_ini)){case 1: $respuesta.= "Enero"; break; case 2: $respuesta.= "Febrero"; break; case 3: $respuesta.= "Marzo"; break; case 4: $respuesta.= "Abril"; break; case 5: $respuesta.= "Mayo"; break; case 6: $respuesta.= "Junio"; break; case 7: $respuesta.= "Julio"; break; case 8: $respuesta.= "Agosto"; break; case 9: $respuesta.= "Septiembre"; break; case 10: $respuesta.= "Octubre"; break; case 11: $respuesta.= "Noviembre"; break; case 12: $respuesta.= "Diciembre"; break;}
      }
      $respuesta.= " al ";
      switch (date("w",$intfecha)){case 0: $respuesta.= "Domingo "; break; case 1: $respuesta.= "Lunes "; break; case 2: $respuesta.= "Martes "; break; case 3: $respuesta.= "Mi&eacute;rcoles "; break; case 4: $respuesta.= "Jueves "; break; case 5: $respuesta.= "Viernes "; break; case 6: $respuesta.= "S&aacute;bado "; break;}
      $respuesta.= date("j",$intfecha);
      $respuesta.= " de ";
      switch (date("n",$intfecha)){case 1: $respuesta.= "Enero"; break; case 2: $respuesta.= "Febrero"; break; case 3: $respuesta.= "Marzo"; break; case 4: $respuesta.= "Abril"; break; case 5: $respuesta.= "Mayo"; break; case 6: $respuesta.= "Junio"; break; case 7: $respuesta.= "Julio"; break; case 8: $respuesta.= "Agosto"; break; case 9: $respuesta.= "Septiembre"; break; case 10: $respuesta.= "Octubre"; break; case 11: $respuesta.= "Noviembre"; break; case 12: $respuesta.= "Diciembre"; break;}
    }

  }else{

    if($fecha_ini<=date("Y-m-d")){
      $respuesta.= "Hoy";
    }else{
      switch (date("w",$intfecha)){case 0: $respuesta.= "Domingo "; break; case 1: $respuesta.= "Lunes "; break; case 2: $respuesta.= "Martes "; break; case 3: $respuesta.= "Mi&eacute;rcoles "; break; case 4: $respuesta.= "Jueves "; break; case 5: $respuesta.= "Viernes "; break; case 6: $respuesta.= "S&aacute;bado "; break;}
      $respuesta.= date("j",$intfecha);
      $respuesta.= " de ";
      switch (date("n",$intfecha)){case 1: $respuesta.= "Enero"; break; case 2: $respuesta.= "Febrero"; break; case 3: $respuesta.= "Marzo"; break; case 4: $respuesta.= "Abril"; break; case 5: $respuesta.= "Mayo"; break; case 6: $respuesta.= "Junio"; break; case 7: $respuesta.= "Julio"; break; case 8: $respuesta.= "Agosto"; break; case 9: $respuesta.= "Septiembre"; break; case 10: $respuesta.= "Octubre"; break; case 11: $respuesta.= "Noviembre"; break; case 12: $respuesta.= "Diciembre"; break;}
    }
  }

  return $respuesta;
}

function nombre_fecha($fecha){

	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
	$intfecha = mktime(0,0,0,$mes,$dia,$anno);
	$nombre = date("j",$intfecha)." de ";
	switch (date("m",$intfecha)){
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

function nombre_fecha_corta($fecha){

	$dia = substr($fecha,8,2);
	$mes = substr($fecha,5,2);
  $anno = substr($fecha,0,4);
	$intfecha = mktime(0,0,0,$mes,$dia,$anno);
	$nombre = date("j",$intfecha)." ";
	switch (date("m",$intfecha)){
		case '01':
			$nombre.= "Ene";
			break;
		case '02':
			$nombre.= "Feb";
			break;
		case '03':
			$nombre.= "Mar";
			break;
		case '04':
			$nombre.= "Abr";
			break;
		case '05':
			$nombre.= "May";
			break;
		case '06':
			$nombre.= "Jun";
			break;
		case '07':
			$nombre.= "Jul";
			break;
		case '08':
			$nombre.= "Ago";
			break;
		case '09':
			$nombre.= "Sep";
			break;
		case '10':
			$nombre.= "Oct";
			break;
		case '11':
			$nombre.= "Nov";
			break;
		case '12':
			$nombre.= "Dic";
			break;
	}
	$nombre.= " ".$anno;
	return $nombre;
}

function nombre_fecha_en($fecha){

  $dia = substr($fecha,8,2);
  $mes = substr($fecha,5,2);
  $anno = substr($fecha,0,4);
  $intfecha = mktime(0,0,0,$mes,$dia,$anno);
  return date("F Y",$intfecha);
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

function nombre_fecha_completa_en($fecha){

  $dia = substr($fecha,8,2);
  $mes = substr($fecha,5,2);
  $anno = substr($fecha,0,4);
  $intfecha=mktime(0,0,0,$mes,$dia,$anno);
  return date("F jS Y",$intfecha);
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

function nombre_mes_corto($mes){

	switch($mes){
		case 1:
			$nombre_mes = "Ene";
			break;
	 	case 2:
			$nombre_mes = "Feb";
			break;
	 	case 3:
			$nombre_mes = "Mar";
			break;
	 	case 4:
			$nombre_mes = "Abr";
			break;
	 	case 5:
			$nombre_mes = "May";
			break;
	 	case 6:
			$nombre_mes = "Jun";
			break;
	 	case 7:
			$nombre_mes = "Jul";
			break;
	 	case 8:
			$nombre_mes = "Ago";
			break;
	 	case 9:
			$nombre_mes = "Sep";
			break;
	 	case 10:
			$nombre_mes = "Oct";
			break;
	 	case 11:
			$nombre_mes = "Nov";
			break;
	 	case 12:
			$nombre_mes = "Dic";
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

	switch(strlen($num)){
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

	switch(strlen($num)){
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
