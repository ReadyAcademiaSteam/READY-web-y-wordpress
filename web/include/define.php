<?
/*
if(!isset($_SERVER["HTTPS"]) || $_SERVER["HTTPS"]!="on"){
  header("Location: https://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]);
  exit;
}
*/
define("titulo", "READY - Academia STEAM", true);
define("organizacion", "Academia Ready", true);
define("dominio", "academiaready.es", true);
define("carpeta", "", true); //terminado en barra si hay carpeta
define("anyo", 2019, true);

define("descripcion", "Ready Academia STEAM es una academia de refuerzo y apoyo escolar, inglés para niños y adultos, robótica educativa y programación de videojuegos. Para que vuestros hijos e hijas aprendan las profesiones del futuro y estén preparados. ", true);
define("autor", "onirics.es", true);

define("titulo_admin", "Academia Ready", true);
define("raiz_admin", "admin.php", true);
define("organizacion_admin", "Onirics Comunicación", true);

define("correo_destino", "hola@academiaready.es", true);
define("correo_visible", "hola@academiaready.es", true);

define("correo_origen", "no-reply@onirics.net", true);
define("correo_servidor", "smtp-relay.gmail.com", true);
define("correo_usuario", "no-reply@onirics.net", true);
define("correo_psw", "onirics1580", true);
define("correo_seguridad", "tls", true);
define("correo_puerto", 587, true);

define("correo_masivo_origen", "no-reply@onirics.net", true);
define("correo_masivo_servidor", "smtp-relay.gmail.com", true);
define("correo_masivo_usuario", "no-reply@onirics.net", true);
define("correo_masivo_psw", "onirics1580", true);
define("correo_masivo_seguridad", "tls", true);
define("correo_masivo_puerto", 587, true);

define("correo_organizacion", "Academia READY", true);

define("titular_legal", "Roobik SC", true);
define("direccion", "c/ Ignacio Monturiol, 2", true);
define("cp_poblacion_provincia", "02005 Albacete", true);
define("tlf", "696060363", true);
define("nif", "J02609139", true);
?>
