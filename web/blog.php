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

<? $menu = 5; ?>

<?
if(isset($_GET["anno"])){
  $anno = intval($_GET["anno"]);
}else{
	$anno = 0;
}

if(isset($_GET["etiqueta"])){
  $etiqueta = intval($_GET["etiqueta"]);
}else{
	$etiqueta = 0;
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

<section id="page-content" class="sidebar-right">
  <div class="container">
    <div class="row">

      <div class="content col-md-9">

        <div class="page-title m-b-30">
          <h1>Blog</h1>
        </div>

        <div id="blog" class="post-thumbnails">

          <?
          if($anno==0){
            if($etiqueta==0){
              $sql = "SELECT * FROM contenidos WHERE ref_menu=2 ORDER BY fecha DESC LIMIT 10";
            }else{
              $sql = "SELECT * FROM contenidos WHERE ref_menu=2 AND ref IN (SELECT ref_contenido FROM contenidos_rel_etiquetas WHERE ref_etiqueta=".$etiqueta.") ORDER BY fecha DESC";
            }
          }else{
            $sql = "SELECT * FROM contenidos WHERE ref_menu=2 AND YEAR(fecha)=".$anno." ORDER BY fecha DESC";
          }
          $rs = mysqli_query($conn,$sql);
          if(mysqli_num_rows($rs)==0){

            echo "<h3>No hay entradas</h3><div class='m-b-100'></div>";

          }else{

            while($row = mysqli_fetch_array($rs)){

              $sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row["ref"]." AND ref_idioma=1";
              $rs_info = mysqli_query($conn,$sql_info);
              $row_info = mysqli_fetch_array($rs_info);

              $enlace = "blog/".$row["ref"]."/".url_amigable($row_info["titulo"]);

              if($row["foto"]){
                $foto = $row["foto"];
              }else{
                $foto = "0.jpg";
              }
              ?>
              <div class="post-item">
                <div class="post-item-wrap">
                  <div class="post-image">
                    <a href="<? echo $enlace; ?>">
                      <img src="imagenes/contenidos/1/<? echo $foto; ?>" alt="<? echo $row_info["titulo"]; ?>">
                    </a>
                  </div>
                  <div class="post-item-description">
                    <span class="post-meta-date"><i class="fa fa-calendar-o"></i><? echo nombre_fecha_completa($row["fecha"]); ?></span>
                    <h2><a href="<? echo $enlace; ?>"><? echo $row_info["titulo"]; ?></a></h2>
                    <p><? echo $row_info["intro"]; ?></p>
                    <a href="<? echo $enlace; ?>" class="item-link">Leer más <i class="fa fa-arrow-right"></i></a>
                  </div>
                </div>
              </div>
            <? } ?>
          <? } ?>

        </div>
      </div>

      <div class="sidebar col-md-3">
        <div class="pinOnScroll">

          <ul class="list-icon list-icon-caret">
            <li>
              <? if($anno==0){ echo "<b>"; }else{ echo "<a href='blog.php'>"; } ?>
                Últimas entradas
              <? if($anno==0){ echo "</b>"; }else{ echo "</a>"; } ?>
            </li>
            <?
            $sql_anno = "SELECT YEAR(fecha) FROM contenidos WHERE ref_menu=2 GROUP BY YEAR(fecha) ORDER BY fecha DESC";
            $rs_anno = mysqli_query($conn,$sql_anno);
            while($row_anno = mysqli_fetch_array($rs_anno)){
              ?>
              <li>
                <? if($anno==$row_anno[0]){ echo "<b>"; }else{ echo "<a href='blog.php?anno=".$row_anno[0]."'>"; } ?>
                <? echo $row_anno[0]; ?>
                <? if($anno==$row_anno[0]){ echo "</b>"; }else{ echo "</a>"; } ?>
                <?
                $sql_total = "SELECT COUNT(*) FROM contenidos WHERE ref_menu=2 AND YEAR(fecha)=".$row_anno[0];
                $rs_total = mysqli_query($conn,$sql_total);
                $row_total = mysqli_fetch_array($rs_total);
                ?>
                <span><em>(<? echo $row_total[0]; ?>)</em></span>
              </li>
            <? } ?>
          </ul>

          <div class="widget widget-tags">
            <h4 class="widget-title">Etiquetas</h4>
            <div class="tags">
              <?
              $sql_etiqueta = "SELECT * FROM etiquetas WHERE ref_menu=2 ORDER BY orden";
              $rs_etiqueta = mysqli_query($conn,$sql_etiqueta);
              while($row_etiqueta = mysqli_fetch_array($rs_etiqueta)){
                $sql_etiqueta_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_etiqueta["ref"]." AND ref_idioma=1";
                $rs_etiqueta_info = mysqli_query($conn,$sql_etiqueta_info);
                $row_etiqueta_info = mysqli_fetch_array($rs_etiqueta_info);
                ?>
                <a href="blog.php?etiqueta=<? echo $row_etiqueta["ref"]; ?>"<? if($etiqueta==$row_etiqueta["ref"]){ echo " class='active'"; } ?>>
                <? echo $row_etiqueta_info["nombre"]; ?>
                </a>
              <? } ?>
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
