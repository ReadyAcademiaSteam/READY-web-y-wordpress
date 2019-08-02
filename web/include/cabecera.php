<div id="topbar" class="visible-md visible-lg">
  <div class="container">
    <div class="row">

      <div class="col-sm-6">
        <ul class="top-menu">
          <li><a href="tel:967609944"><i class="fa fa-phone"></i>&nbsp;&nbsp;696 060 363</a></li>
          <li><a href="tel:696060363"><i class="fa fa-mobile"></i>&nbsp;&nbsp;699 22 04 49</a></li>
          <li><a href="mailto:hola@academiaready.es"><i class="fa fa-envelope"></i>&nbsp;&nbsp;hola@academiaready.es</a></li>
        </ul>
      </div>

      <div class="col-sm-6 hidden-xs">
        <div class="social-icons social-icons-colored-hover">
          <ul>
            <li class="social-facebook"><a href="https://www.facebook.com/readyacademia/" target="_blank"><i class="fa fa-facebook"></i></a></li>
            <li class="social-twitter"><a href="https://twitter.com/ReadyAcademia" target="_blank"><i class="fa fa-twitter"></i></a></li>
            <li class="social-dribbble"><a href="https://www.instagram.com/readyacademia/" target="_blank"><i class="fa fa-instagram"></i></a></li>
            <li class="social-youtube"><a href="https://www.youtube.com/channel/UCjVJT6bx9Qr-0cD3511MunQ" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
            <li class="social-linkedin"><a href="https://www.linkedin.com/company/academia-ready/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
</div>

<header id="header"<? if($menu==1){ echo " class='header-transparent dark'"; } ?>>
  <div id="header-wrap">
    <div class="container">

      <div id="logo">
        <a href="https://<? echo dominio; ?>/<? echo carpeta; ?>" class="logo" data-dark-logo="images/logo-dark.png">
          <img src="images/logo.png" alt="<? organizacion; ?>">
        </a>
      </div>

      <div id="mainMenu-trigger">
        <button class="lines-button x"> <span class="lines"></span> </button>
      </div>

      <div id="mainMenu" class="light">
        <div class="container">
          <nav>
            <ul>

              <li<? if($menu==1){ echo " class='current'"; } ?>><a href="https://<? echo dominio; ?>/<? echo carpeta; ?>">Inicio</a></li>

              <li class="dropdown<? if($menu==2){ echo " current"; } ?>"> <a href="sobre-nosotros.php">Sobre nosotros</a>
                <ul class="dropdown-menu">
                  <li><a href="quienes-somos.php"><i class="fa fa-group"></i>Quiénes somos</a></li>
                  <li><a href="nuestro-concepto.php"><i class="fa fa-lightbulb-o"></i>Nuestro concepto</a></li>
                  <li><a href="#"><i class="fa fa-keyboard-o"></i>Steam</a></li>
                </ul>
              </li>

              <li class="dropdown<? if($menu==3){ echo " current"; } ?>"> <a href="#">Servicios</a>
                <ul class="dropdown-menu">
                  <li><a href="refuerzo-escolar.php"><i class="fa fa-graduation-cap"></i>Refuerzo escolar</a></li>
                  <li><a href="ingles-para-ninos.php"><i class="fa fa-flag"></i>Inglés para niños</a></li>
                  <li><a href="ingles-para-adultos.php"><i class="fa fa-flag"></i>Inglés para adultos</a></li>
                  <li><a href="robotica.php"><i class="fa fa-cogs"></i>Robótica</a></li>
                  <li><a href="programacion-videojuegos.php"><i class="fa fa-desktop"></i>Programación de videojuegos</a></li>
                  <li><a href="taller-inventores.php"><i class="fa fa-flask"></i>Taller de inventores</a></li>
                </ul>
              </li>

              <li<? if($menu==4){ echo " class='current'"; } ?>><a href="agenda.php">Agenda</a></li>

              <li<? if($menu==5){ echo " class='current'"; } ?>><a href="blog.php">Blog</a></li>

              <li<? if($menu==6){ echo " class='current'"; } ?>><a href="contacto.php">Contacto</a></li>

            </ul>
          </nav>
        </div>
      </div>

    </div>
  </div>
</header>
