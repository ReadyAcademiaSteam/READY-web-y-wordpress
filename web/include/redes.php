<link rel="stylesheet" href="include/redes.css" />

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="share-post" style="margin:30px 0;">

  <div class="fb-like" data-href="<? echo url_completa(); ?>" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>

  <a href="https://twitter.com/intent/tweet?url=<? echo url_completa(); ?>&text=<? echo $row_info["titulo"]; ?>" target="_blank" class="twitter"><i class="fa fa-twitter"></i>&nbsp;&nbsp;Twitter</a>

  <a href="whatsapp://send?text=<? echo url_completa(); ?>" data-action="share/whatsapp/share" target="_blank" class="whatsapp"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;WhatsApp</a>

</div>
