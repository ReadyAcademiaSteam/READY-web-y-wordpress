<!DOCTYPE html>
<html lang="es">
<head>

<? include("include/define.php"); ?>

<? $menu = 0; ?>

<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="author" content="<? echo autor; ?>" />
<meta name="description" content="<? echo descripcion; ?>">

<title><? echo titulo; ?></title>

<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,800,700,600|Montserrat:400,500,600,700|Raleway:100,300,600,700,800" rel="stylesheet" type="text/css" />
<link href="css/plugins.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/responsive.css" rel="stylesheet">

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

<section class="m-t-80 p-b-150">
  <div class="container">
    <div class="row">

      <div class="col-md-6">
        <div class="page-error-404">404</div>
      </div>

      <div class="col-md-6">
        <div class="text-left">
          <h1 class="text-medium">Ooops, la página no puede ser encontrada!</h1>
          <p class="lead">La página que buscas o ha sido eliminada, ha cambiado, o temporalmente no está disponible.</p>
          <div class="seperator m-t-20 m-b-20"></div>
          <div class="search-form">
            <button onclick="window.location.href='https://<? echo dominio; ?>';" type="button" class="btn">Volver al inicio</button>
          </div>
        </div>
      </div>

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
