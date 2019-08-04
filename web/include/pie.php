<footer id="footer" class="footer-light ">

  <div style="background-color:#1c1c1c" class="footer-content">

    <div  class="container ">
      <div class="row oscuro">
      <div class="col-lg-5">

      <div class="widget clearfix widget-newsletter">
      <h4 class="widget-title"><i class="fa fa-envelope"></i> Apúntate a nuestro newsletter</h4>
      <p>Noticias, ofertas exclusivas y muchas más ventajas.</p>
      <form class="widget-subscribe-form p-r-40" action="include/subscribe-form.php" role="form" method="post" novalidate="novalidate">
      <div class="input-group">
      <input aria-required="true" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email" type="email">
      <span class="input-group-btn">
      <button type="submit" id="widget-subscribe-submit-button" class="btn"><i class="fa fa-paper-plane"></i></button>
      </span> </div>
      </form>
      </div>
    </div>
      



       <div class="col-lg-7">
      <div class="row claro">
      <div class="col-lg-4">
      <div class="widget">
      <div class="widget-title">SOBRE NOSOTROS</div>
      <ul class="list">
      <li><a href="#">Blog de Ready</a></li>
      <li><a href="#">Blog de Carlos</a></li>
      <li><a href="#">Quienes somos</a></li>
      <li><a href="#">STEAM</a></li>      
      </ul>
      </div>
      </div>
      <div class="col-lg-4">
      <div class="widget">
      <div class="widget-title">SERVICIOS</div>
      <ul class="list">
      <li><a href="#">Refuerzo escolar</a></li>
      <li><a href="#">Universitario</a></li>
      <li><a href="#">Pruebas de acceso</a></li>
      <li><a href="#">Clases particulares</a></li>
      <li><a href="#">Inglés para niños</a></li>
      <li><a href="#">Inglés para adultos</a></li>
      <li><a href="#">Robótica educativa</a></li>
      <li><a href="#">Programación de videojuegos</a></li>
      <li><a href="#">Taller de inventores</a></li>
      </ul>
      </div>
      </div>      
      <div class="col-lg-4">
      <div class="widget">
      <div class="widget-title">Atención al cliente</div>
      <ul class="list">
      <li><a href="#">Contacto</a></li>
      <li><a href="#">Preguntas rápidas</a></li>
      <li><a href="#">Centro de sabiduría</a></li>
      <li><a href="#">Chat directo</a></li>
      </ul>
      </div>
      </div>
      </div>
      </div>
      </div>
    </div>
</div>
<div class="footer-content">
    <div class="container">
      <div class="row">

        <div class="col-md-4">
          <div class="widget clearfix widget-contact-us" style="background-image: url('images/world-map-dark.png'); background-position: 50% 20px; background-repeat: no-repeat">
            <img src="images/logo.png" />
            <ul class="list-icon">
              <li><i class="fa fa-map-marker"></i>Ignacio Monturiol, 2<br>02005 Albacete</li>
              <li><i class="fa fa-mobile"></i> <a href="tel:+34 699 22 04 49">+34 699 22 04 49</a> </li>
              <li><i class="fa fa-envelope"></i> <a href="mailto:hola@academiaready.es">hola@academiaready.es</a> </li>
            </ul>
            <div class="social-icons social-icons-border float-left m-t-20">
              <ul>
                <li class="social-facebook"><a href="https://www.facebook.com/readyacademia/" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <li class="social-twitter"><a href="https://twitter.com/ReadyAcademia" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <li class="social-instagram"><a href="https://www.instagram.com/readyacademia/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <li class="social-youtube"><a href="https://www.youtube.com/channel/UCjVJT6bx9Qr-0cD3511MunQ" target="_blank"><i class="fa fa-youtube"></i></a></li>
                <li class="social-linkedin"><a href="https://www.linkedin.com/company/academia-ready/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div id="fb-root"></div>
          <script async defer src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.2"></script>
          <div class="fb-page" data-href="https://www.facebook.com/readyacademia/" data-tabs="timeline" data-height="300" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/readyacademia/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/readyacademia/">Ready - Academia STEAM</a></blockquote></div>
        </div>

        <div class="col-md-4">
          <h4>LO ÚLTIMO EN INSTAGRAM</h4>
          <?
      		// Supply a user id and an access token
      		$userid = 8569122299;
      		$accessToken = "8569122299.1677ed0.42f1ce628daa404587060a3ffd55002d";

      		// Gets our data
      		function fetchData($url){
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
      		}

      		// Pulls and parses data.
      		$result = fetchData("https://api.instagram.com/v1/users/{$userid}/media/recent/?access_token={$accessToken}");
      		$result = json_decode($result);
          ?>
          <div class="grid-layout grid-3-columns" data-margin="0" data-item="grid-item" data-lightbox="gallery">
            <?
            $i = 1;
          	foreach ($result->data as $post): ?>
          		<!-- Renders images. @Options (thumbnail,low_resoulution, high_resolution) -->
              <div class="grid-item">
                <a class="image-hover-zoom" href="<?= $post->images->standard_resolution->url ?>" data-lightbox="gallery-item"><img src="<?= $post->images->thumbnail->url ?>"></a>
              </div>
              <?
              if($i++==6) break;
            endforeach
            ?>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="copyright-content">
    <div class="container">
      <div class="copyright-text text-center">&copy; <?
        if(anyo==date("Y")){
          echo anyo;
        }else{
          echo anyo."-".date("Y");
        }
        ?> <? echo organizacion; ?>&nbsp;&nbsp;|&nbsp;&nbsp;<a data-target="#avisolegal" data-toggle="modal" style="cursor:pointer;">Aviso legal</a>&nbsp;&nbsp;|&nbsp;&nbsp;Diseño y Hosting <a href="https://onirics.es" target="_blank" /><img src="images/logo_onirics.png" alt="Diseño Web Albacete" style="margin: -4px 0 0 3px;" /></a></div>
    </div>
  </div>

</footer>
