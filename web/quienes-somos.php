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

<title>Quienes somos - <? echo titulo; ?></title>

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
      <h1>Quiénes somos</h1>
    </div>
    <div class="breadcrumb">
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="#">Sobre nosotros</a></li>
        <li class="active"><a href="#">Quiénes somos</a></li>
      </ul>
    </div>
  </div>
</section>

<section class="p-b-0">
  <div class="container">

    <div class="heading heading-center m-b-40" data-animation="fadeInUp">
      <h2>Somos READY Academia STEAM. Somos formadores. Somos Makers...</h2>
        <h3>Y amamos nuestra profesión.</h3>
    </div>

      <div class="row team-members team-members-circle m-b-40">
        <!-- Antonio Reverte -->
        <div class="col-lg-4" data-animation="fadeInLeft">
        <div class="team-member">
        <div class="team-image">
        <img src="images/team/8.jpg">
        </div>
        <div class="team-desc">
        <h3>Antonio Reverte</h3>
        <span>COO y formador</span>
        <p>Docente de refuerzo escolar y universitario. </p>
        <div class="align-center">
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fab fa-twitter"></i>
        <span>Twitter</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
        <i class="fab fa-instagram"></i>
        <span>Instagram</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
        <i class="far fa-envelope"></i>
        <span>Mail</span>
        </a>
        </div>
        </div>
        </div>
        </div>
          
        <!-- Carlos Díaz -->
        <div class="col-lg-4" data-animation="fadeInDown">
        <div class="team-member">
        <div class="team-image">
        <img src="images/team/6.jpg">
        </div>
        <div class="team-desc">
        <h3>Carlos Díaz</h3>
        <span>CEO y Formador</span>
        <p>Robótica educativa, programación de videojuegos, talleres STEAM </p>
        <div class="align-center">
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fab fa-linkedin"></i>
        <span>Linked.in</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fab fa-globe"></i>
        <span>Blog</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
        <i class="fab fa-instagram"></i>
        <span>Instagram</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="mailto:carlos@academiaready.es" data-width="80">
        <i class="far fa-envelope"></i>
        <span>Mail</span>
        </a>
        </div>
        </div>
        </div>
        </div>
          
        <!-- Fito Díaz -->
        <div class="col-lg-4" data-animation="fadeInRight">
        <div class="team-member">
        <div class="team-image">
        <img src="images/team/7.jpg">
        </div>
        <div class="team-desc">
        <h3>Fito Díaz</h3>
        <span>CMO y formador</span>
        <p>Lengua inglesa, refuerzo infantil y recursos humanos</p>
        <div class="align-center">
        <a class="btn btn-xs btn-slide btn-light" href="#">
        <i class="fab fa-facebook-f"></i>
        <span>Facebook</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fab fa-twitter"></i>
        <span>Twitter</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
        <i class="fab fa-instagram"></i>
        <span>Instagram</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
        <i class="far fa-envelope"></i>
        <span>Mail</span>
        </a>
        </div>
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
