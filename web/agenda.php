<!DOCTYPE html>
<html lang="es">
<head>
	
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-141795019-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-141795019-2');
</script>

<? include("include/define.php"); ?>
<? include("include/conexion.php"); ?>
<? include("include/funciones.php"); ?>

<? $menu = 4; ?>

<?
if(!isset($_GET["anno"]) || $_GET["anno"]==''){
	$anno = date("Y");
}else{
	$anno = intval($_GET["anno"]);
}

if(!isset($_GET["mes"]) || $_GET["mes"]==''){
	$mes = date("m");
}else{
	$mes = $_GET["mes"];
}
?>

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="<? echo autor; ?>" />
<meta name="description" content="<? echo descripcion; ?>">

<title><? echo titulo; ?></title>

<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,800,700,600|Montserrat:400,500,600,700|Raleway:100,300,600,700,800" rel="stylesheet" type="text/css" />
<link href="css/plugins.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

<link href="css/responsive-calendar.css" rel="stylesheet" type="text/css">

<script src="js/jquery.js"></script>

<link rel="icon" href="imagenes/favicon.ico">
<link rel="apple-touch-icon" sizes="57x57" href="imagenes/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="72x72" href="imagenes/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="imagenes/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="144x144" href="imagenes/apple-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

</head>
<body>

<div id="wrapper">

<? include("include/cabecera.php"); ?>

<section class="p-b-0">
  <div class="container">

    <div class="row">
      <?
			require("include/agenda.php");
			mostrar_calendario($mes,$anno,date("Y-m-j"),0,'agenda');
			?>
    </div>

  </div>
</section>

<? include("include/pie.php"); ?>

</div>

<a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a>

<script src="js/plugins.js"></script>
<script src="js/functions.js"></script>

<? include("include/comun.php"); ?>

</body>
</html>
