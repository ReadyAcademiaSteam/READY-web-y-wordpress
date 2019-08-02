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

<? $menu = 2; ?>

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

<section id="page-title" class="page-title-center background-overlay-dark text-light" style="background-image:url(images/parallax/2.jpg);">
  <div class="container">
    <div class="page-title">
      <h1>Nuestro Concepto</h1>
    </div>
    <div class="breadcrumb">
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Sobre nosotros</a></li>
        <li class="active"><a href="#">Nuestro concepto</a></li>
      </ul>
    </div>
  </div>
</section>

<section class="p-b-0">
  <div class="container">

    <div class="heading heading-center m-b-40" data-animation="fadeInUp">
      <h2>SOMOS UN NUEVO CONCEPTO DE ACADEMIA</h2>
      <!--<span class="lead">READY Academia Steam ¿De dónde surge este proyecto?</span>-->
    </div>

    <div class="row" data-animation="fadeInUp">
      <div class="col-md-5">
        <img alt="" src="images/pizarra_inicio.jpg" class="img-responsive">
      </div>
      <div class="col-md-7 text-left">
        <p class="lead">Nuestro concepto en el refuerzo escolar es muy parecido. READY Academia STEAM tiene en cuenta la frustración y ansiedad que en ocasiones el estudiante siente cuando no es capaz de alcanzar unos resultados impuestos como obligatorios en materias cuya necesidad y sentido no entiende.</p>
        <p class="lead">STEAM es el uso y la integración de disciplinas científicas, tecnológicas, ingeniería, artes y matemáticas en el diseño de un modelo de enseñanza y aprendizaje efectivo y agradable para el estudiante.</p>
        <p class="lead">A través de materias como nuestros talleres de robótica o programación, en centro de estudios READY conseguimos que los alumnos apliquen, de una forma lúdica y satisfactoria, conceptos que de otro modo suelen encontrar tediosos y difíciles de comprender y desde luego carentes de utilidad.</p>
        <p class="lead">En Ready Academia STEAM podemos garantizar que no sólo los comprenden sino que, aún más, los disfrutan.</p>
        <p class="lead">Academia READY se compromete, en este sentido, con el bienestar de nuestros alumnos trabajando conjuntamente con profesionales de la psicología en la reducción y la adecuada gestión del estrés ante los examenes y el trabajo diario.</p>
        <p class="lead">En READY Academia STEAM creemos en la creatividad y fomentamos el descubrimiento y el uso de las habilidades, capacidades y talentos de cada uno de nuestros estudiantes para diseñar y definir una única, personalizada y propia manera de enfocar el estudio.</p>
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
