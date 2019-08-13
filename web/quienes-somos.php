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

<title>Quiénes somos - <? echo titulo; ?></title>

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
<meta name="theme-color" content="#f5f5f5">

</head>
<body data-icon="12">

<div id="wrapper">

<? include("include/cabecera.php"); ?>

<section id="page-title" class="page-title-center text-light" data-vide-bg="video/explore/explore" data-vide-options="position: 0% 50%">
    <div style="background-color: #5994aa; position: absolute; z-index: -1; top: 0px; left: 0px; bottom: 0px; right: 0px; overflow: hidden; ">
        <canvas id="quienes-somos-canvas" style="margin: auto; position: absolute; z-index: -1;  visibility: visible; opacity: 0.4; width: 100%;">
        
        </canvas>
    </div>
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="#">Inicio</a> </li>
                <li><a href="#">Sobre nosotros</a> </li>
                <li class="active"><a href="#">Quiénes somos</a> </li>
            </ul>
        </div>
        <div class="page-title">
            <h1>Quienes somos</h1>
            <span>Gente joven enamorada de su profesión: enseñar.</span>
        </div>
    </div>
</section>

<section data-animation="fadeInUp">
    <div class="container">
    <div class="row">
    <div class="col-lg-3">
    <div class="heading-text heading-section">
    <h2>Quienes somos</h2>
    </div>
    </div>
    <div class="col-lg-9">
    <div class="row">
    <div class="col-lg-6">
        <p>No somos otra academia de inglés en Albacete.</p>
        <p>No somos otra academia de refuerzo y de apoyo escolar.</p>
        <p>No somos otra empresa orientada a la robótica educativa y a la programación de videojuegos.</p>
        <p><a href="https://www.academiaready.es">READY Academia STEAM</a> es el resultado de varios años de experiencia de distintos profesionales albacetenses de la docencia en distintos centros y partiendo de otras perspectivas y enfoques de la enseñanza.</p>
        <p>Somos un grupo de locos ingenieros, maestros, filólogos, físicos y hasta titulados superiores en música y arte dramático. De ahí nuestra aplicación de la filosofía principal del centro, STEAM.</p>
        <p>En READY Academia STEAM creemos en la creatividad y fomentamos el descubrimiento y el uso de las habilidades, capacidades y talentos de cada uno de nuestros estudiantes para diseñar y definir una única, personalizada y propia manera de enfocar el estudio.</p>
    </div>
    <div class="col-lg-6">
        <p>Nuestro concepto en el refuerzo escolar es muy parecido. READY Academia STEAM tiene en cuenta la frustración y ansiedad que en ocasiones el estudiante siente cuando no es capaz de alcanzar unos resultados impuestos como obligatorios en materias cuya necesidad y sentido no entiende. Con nuestro sistema y nuestra atención, podemos garantizar que no sólo los comprenden sino que, aún más, los disfrutan.</p>
        <p>Además de ayudar a nuestros alumnos con los baches que puedan encontrar en sus estudios, realizamos cursos de <a href="servicios/refuerzo-escolar.php">robótica</a>, programación y un largo etcétera. Materias diferentes y con las que introducirles en las nuevas tecnologías, en la robótica educativa y en la programación que será esencial en el futuro más cercano. Conseguimos que los alumnos apliquen, de una forma lúdica y satisfactoria, conceptos que de otro modo suelen encontrar tediosos y difíciles de comprender para montar robots y programarlos, o crear sus propios videojuegos y enseñarlos orgullosos a sus amigos.</p>

    </div>
    </div></div>
    </div>
    </div>
</section>

<section class="box-fancy section-fullwidth text-light p-b-0">
    <div class="row">
        <div style="background-color:#ed6d6b" class="col-lg-4" >
        <h1 class="text-lg text-uppercase">01.</h1>
        <h3>Refuerzo</h3>
        <span data-animation="fadeIn">En Ready somos conscientes que todo alumno o alumna, tarde o temprano, necesita ayuda en sus estudios. Ya sea en primaria, en secundaria o en la universidad. Nosotros cubrimos tus necesidades con nuestras clases de apoyo.</span>
        </div>

        <div style="background-color:#5994aa" class="col-lg-4">
        <h1 class="text-lg text-uppercase">02.</h1>
        <h3>Tecnología</h3>
        <span data-animation="fadeIn" style="animation-delay: 0.25s">El pilar fundamental de nuestra academia es la tecnología. Queremos que desde corta edad vuestros hijos e hijas la dominen con nuestras clases de robótica educativa, programación de videojuegos y talleres STEAM.</span>
        </div>

        <div style="background-color:#ffdf66" class="col-lg-4">
        <h1 class="text-lg text-uppercase">03.</h1>
        <h3>Idiomas</h3>
        <span data-animation="fadeIn" style="animation-delay: 0.5s">Vivimos en un mundo multicultural y plurilingue. Es esencial dominar el inglés desde bien pequeño. Tenemos una amplia oferta de cursos de inglés, para todos los niveles. ¿Nos acompañas? ¡Queremos que seas uno/a más!</span>
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
        <div class="col-lg-4" data-animation="fadeIn">
        <div class="team-member">
        <div class="team-image">
        <img src="images/quienessomos/antonio.jpg">
        </div>
        <div class="team-desc">
        <h3>Antonio Reverte</h3>
        <span>COO y formador</span>
        <p>Docente de refuerzo escolar y universitario. </p>
        <ul style="text-align: left; padding: 0 0 0 2.5em;" class="list-icon list-icon-check list-icon-colored">
            <li>Ingeniero industrial de profesión</li>
            <li>Maker de espíritu</li>
            <li>Músico aficionado</li>
        </ul>
        <ul style="text-align: left; padding: 0 0 0 2.5em;" class="list-icon">
            <li><i style="color: #ffdf66" class="fa fa-trophy"></i>Aprende muy rápido</li>
            <li><i style="color: #ed6d6b" class="fa fa-heart "></i>Le encanta bromear con sus alumnos</li>
            <li><i style="color: #6b4d16" class="fa fa-poo"></i>No le gusta que el despertador suene a las 7:00</li>
        </ul>
        <div class="align-center">
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fa fa-twitter"></i>
        <span>Twitter</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
        <i class="fa fa-instagram"></i>
        <span>Instagram</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
        <i class="fa fa-envelope"></i>
        <span>Mail</span>
        </a>
        </div>
        </div>
        </div>
        </div>
          
        <!-- Carlos Díaz -->
        <div class="col-lg-4" data-animation="fadeIn">
        <div class="team-member">
        <div class="team-image">
        <img src="images/quienessomos/carlos.jpg">
        </div>
        <div class="team-desc">
        <h3>Carlos Díaz</h3>
        <span>CEO y Formador</span>
        <p>Robótica educativa, programación de videojuegos, talleres STEAM </p>
        <ul style="text-align: left; padding: 0 0 0 2.5em;" class="list-icon list-icon-check list-icon-colored">
            <li>Ingeniero industrial de profesión</li>
            <li>Maker de espíritu</li>
            <li>Músico aficionado</li>
        </ul>
        <ul style="text-align: left; padding: 0 0 0 2.5em;" class="list-icon">
            <li><i style="color: #ffdf66" class="fa fa-trophy"></i>Aprende muy rápido</li>
            <li><i style="color: #ed6d6b" class="fa fa-heart "></i>Le encanta bromear con sus alumnos</li>
            <li><i style="color: #6b4d16" class="fa fa-poo"></i>No le gusta que el despertador suene a las 7:00</li>
        </ul>
        <div class="align-center">
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fa fa-linkedin"></i>
        <span>Linked.in</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fa fa-globe"></i>
        <span>Blog</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
        <i class="fa fa-instagram"></i>
        <span>Instagram</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="mailto:carlos@academiaready.es" data-width="80">
        <i class="fa fa-envelope"></i>
        <span>Mail</span>
        </a>
        </div>
        </div>
        </div>
        </div>
          
        <!-- Fito Díaz -->
        <div class="col-lg-4" data-animation="fadeIn">
        <div class="team-member">
        <div class="team-image">
        <img src="images/quienessomos/fito.jpg">
        </div>
        <div class="team-desc">
        <h3>Fito Díaz</h3>
        <span>CMO y formador</span>
        <p>Lengua inglesa, refuerzo infantil y recursos humanos</p>
        <ul style="text-align: left; padding: 0 0 0 2.5em;" class="list-icon list-icon-check list-icon-colored">
            <li>Ingeniero industrial de profesión</li>
            <li>Maker de espíritu</li>
            <li>Músico aficionado</li>
        </ul>
        <ul style="text-align: left; padding: 0 0 0 2.5em;" class="list-icon">
            <li><i style="color: #ffdf66" class="fa fa-trophy"></i>Aprende muy rápido</li>
            <li><i style="color: #ed6d6b" class="fa fa-heart "></i>Le encanta bromear con sus alumnos</li>
            <li><i style="color: #6b4d16" class="fa fa-poo"></i>No le gusta que el despertador suene a las 7:00</li>
        </ul>
        <div class="align-center">
        <a class="btn btn-xs btn-slide btn-light" href="#">
        <i class="fa fa-facebook-f"></i>
        <span>Facebook</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fa fa-twitter"></i>
        <span>Twitter</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
        <i class="fa fa-instagram"></i>
        <span>Instagram</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
        <i class="fa fa-envelope"></i>
        <span>Mail</span>
        </a>
        </div>
        </div>
        </div>
        </div>
        
        </div>

  </div>
</section>

<section class="background-grey">
    <div class="container">
    <div class="heading heading-center text-center heading-line">
        <h2>Nuestro equipo</h2>
        <span class="lead ">Los engranajes de nuestra maquinaria.</span>
        <span class="lead"> Sin ellos seríamos otra academia más.</span>
    </div>

    <div class="row team-members team-members-shadow m-b-40">
        <div class="col-lg-3">
            <div class="team-member">
            <div class="team-image">
            <img src="images/quienessomos/maria.jpg">
            </div>
            <div class="team-desc">
            <h3>Maria Nieto</h3>
            <span>Software Developer</span>
            <div class="align-center">
            <a class="btn btn-xs btn-slide btn-light" href="#">
            <i class="fa fa-facebook-f"></i>
            <span>Facebook</span>
            </a>
            <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
            <i class="fa fa-twitter"></i>
            <span>Twitter</span>
            </a>
            <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
            <i class="fa fa-instagram"></i>
            <span>Instagram</span>
            </a>
            <a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
            <i class="fa fa-envelope"></i>
            <span>Mail</span>
            </a>
            </div>
            </div>
            </div>
        </div>
        <div class="col-lg-3">
        <div class="team-member">
        <div class="team-image">
        <img src="images/quienessomos/Alba.jpg">
        </div>
        <div class="team-desc">
        <h3>Alba Jimenez</h3>
        <span>Profesora de Inglés</span>
        <div class="align-center">
        <a class="btn btn-xs btn-slide btn-light" href="#">
        <i class="fa fa-facebook-f"></i>
        <span>Facebook</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fa fa-twitter"></i>
        <span>Twitter</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
        <i class="fa fa-instagram"></i>
        <span>Instagram</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
        <i class="fa fa-envelope"></i>
        <span>Mail</span>
        </a>
        </div>
        </div>
        </div>
        </div>
        <div class="col-lg-3">
        <div class="team-member">
        <div class="team-image">
        <img src="images/quienessomos/Lucia.jpg">
        </div>
        <div class="team-desc">
        <h3>Lucia Cabañas</h3>
        <span>Profesora refuerzo de Letras</span>
        <div class="align-center">
        <a class="btn btn-xs btn-slide btn-light" href="#">
        <i class="fa fa-facebook-f"></i>
        <span>Facebook</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fa fa-twitter"></i>
        <span>Twitter</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
        <i class="fa fa-instagram"></i>
        <span>Instagram</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
        <i class="fa fa-envelope"></i>
        <span>Mail</span>
        </a>
        </div>
        </div>
        </div>
        </div>
        <div class="col-lg-3">
        <div class="team-member">
        <div class="team-image">
        <img src="images/quienessomos/Victor.jpg">
        </div>
        <div class="team-desc">
        <h3>Victor Martinez</h3>
        <span>Profesor de Inglés</span>
        <div class="align-center">
        <a class="btn btn-xs btn-slide btn-light" href="#">
        <i class="fa fa-facebook-f"></i>
        <span>Facebook</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="100">
        <i class="fa fa-twitter"></i>
        <span>Twitter</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="#" data-width="118">
        <i class="fa fa-instagram"></i>
        <span>Instagram</span>
        </a>
        <a class="btn btn-xs btn-slide btn-light" href="mailto:#" data-width="80">
        <i class="fa fa-envelope"></i>
        <span>Mail</span>
        </a>
        </div>
        </div>
        </div>
        </div>
        </div>
    </div>
    <div class="call-to-action p-t-100 p-b-100  mb-0 call-to-action-dark">
        <div class="container">
            <div class="row">
            <div class="col-lg-10">
                <h3>
                ¿Quieres estar informado/a de las <span>novedades y ofertas</span> de READY?
                </h3>
                <p>
                Accede al instante a descuentos, regalos y ofertas exclusivas.
                </p>
            </div>
            <div class="col-lg-2"><a class="btn" href="#">¡Suscribete!</a></div>
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
<script src="js/quienessomos.js"></script>

<? include("include/comun.php"); ?>

</body>
</html>
