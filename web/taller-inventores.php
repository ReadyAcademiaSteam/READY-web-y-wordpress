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

<? $menu = 3; ?>

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="<? echo autor; ?>" />
<meta name="description" content="<? echo descripcion; ?>">

<title>Taller de inventores - <? echo titulo; ?></title>

<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:600&display=swap" rel="stylesheet">
<link href="css/plugins.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/style-hijo.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">
<link href="css/fonts.css" rel="stylesheet">

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

<section id="page-title" class="page-title-center background-overlay-dark text-light" style="background-image:url(images/taller/fondo2.jpg);  background-repeat: no-repeat; background-size:100%;">
  <div class="container">
    <div class="page-title">
      <h1>Taller de Inventores</h1>
    </div>
    <div class="breadcrumb">
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Servicios</a></li>
        <li class="active"><a href="#">Taller de Inventores</a></li>
      </ul>
    </div>
  </div>
</section>

<section>
  <div class="container">
    <div class="row" data-animation="fadeInUp">

        <h2>Un lugar donde aprender <u>de todo</u> <span style="background-color:#ed6d6b" class="badge">En construccion</span></h2>
      <p>Estamos construyendo esta página, pero en breves estará terminada.</p>
      <p>Si quieres más información suscríbete a nuestra mailing list mas abajo, ¡y serás el/la primero/a en enterarte!<p>

      <img alt="" src="images/inventores.jpg" class="img-responsive">

    </div>
  </div>
</section>

<? include("include/pie.php"); ?>

</div>

<a id="goToTop"><i class="fa fa-angle-up top-icon"></i><i class="fa fa-angle-up"></i></a>

<script src="js/jquery.js"></script>
<script src="js/plugins.js"></script>
<script src="js/functions.js"></script>

<? include("include/comun.php"); ?>

</body>
</html>
