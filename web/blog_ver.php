<!DOCTYPE html>
<html lang="es">
<head>

<? include("include/define.php"); ?>
<? include("include/conexion.php"); ?>
<? include("include/funciones.php"); ?>

<? $menu = 5; ?>

<base href="https://<? echo dominio; ?>/">

<?
if(isset($_GET["ref"])&&($_GET["ref"]!='')){
	$ref = $_GET["ref"];
	$sql = "SELECT * FROM contenidos WHERE ref_menu=2 AND ref=".$ref;
	$rs = mysqli_query($conn,$sql);
	if(mysqli_num_rows($rs)==0){
		header("location: https://".dominio."/404.php");
		exit();
	}
}else{
	header("location: https://".dominio."/404.php");
	exit();
}

$row = mysqli_fetch_array($rs);

$sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=1";
$rs_info = mysqli_query($conn,$sql_info);
$row_info = mysqli_fetch_array($rs_info);
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

<meta property="og:title" content="<? echo $row_info["titulo"]; ?>" />
<meta property="og:description" content="<? echo $row_info["intro"]; ?>" />
<? if($row["foto"]){ ?>
<meta property="og:image" content="https://<? echo dominio."/imagenes/contenidos/".$row["foto"]; ?>" />
<? } ?>

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
				<div id="blog" class="single-post">

					<div class="post-item">
						<div class="post-item-wrap">

							<? if($row["foto"]){ ?>
								<div class="post-image" data-lightbox="gallery">
									<a href="imagenes/contenidos/<? echo $row["foto"]; ?>" class="image-hover-zoom" data-lightbox="gallery-item">
										<img src="imagenes/contenidos/2/<? echo $row["foto"]; ?>" alt="<? echo $row_info["titulo"]; ?>">
									</a>
								</div>
							<? } ?>

							<div class="post-item-description">
								<h2><? echo $row_info["titulo"]; ?></h2>
								<div class="post-meta">
									<span class="post-meta-date"><i class="fa fa-calendar-o"></i><? echo nombre_fecha_completa($row["fecha"]); ?></span>
									<span class="post-meta-comments"><a href="javascript:history.go(-1);"><i class="fa fa-reply"></i>Volver</a></span>

									<script async defer src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v3.2"></script>

									<div class="post-meta-share">
										<a href="https://www.facebook.com/sharer/sharer.php?u=<? echo url_completa(); ?>&src=sdkpreparse" target="_blank" class="btn btn-xs btn-slide btn-facebook">
											<i class="fa fa-facebook"></i><span>Facebook</span>
										</a>
										<a href="https://twitter.com/intent/tweet?url=<? echo url_completa(); ?>&text=<? echo $row_info["titulo"]; ?>" target="_blank" class="btn btn-xs btn-slide btn-twitter" data-width="100">
											<i class="fa fa-twitter"></i><span>Twitter</span>
										</a>
									</div>
								</div>
								<? echo $row_info["texto"]; ?>
							</div>

						</div>
					</div>
				</div>
			</div>

			<div class="sidebar col-md-3">
				<div class="pinOnScroll">

					<!-- -------------------- DOCUMENTOS -------------------- -->

					<?
					$sql_doc = "SELECT * FROM contenidos_docs WHERE ref_contenido=".$ref." ORDER BY orden";
					$rs_doc = mysqli_query($conn,$sql_doc);
					if(mysqli_num_rows($rs_doc)>0){
						?>
						<h3>Documentos adjuntos</h3>

						<ul class="list-icon list-icon-file list-icon-colored">
							<?
							while($row_doc = mysqli_fetch_array($rs_doc)){
								$peso = filesize("archivos/contenidos/documentos/".$row_doc["archivo"]);
								$sql_doc_info = "SELECT * FROM contenidos_docs_info WHERE ref_doc=".$row_doc["ref"]." AND ref_idioma=1";
								$rs_doc_info = mysqli_query($conn,$sql_doc_info);
								$row_doc_info = mysqli_fetch_array($rs_doc_info);
								?>
			          <li><a href="archivos/contenidos/documentos/<? echo $row_doc["archivo"]; ?>" target="_blank"><strong><? echo $row_doc_info["nombre"]; ?></strong> <em>(<? echo tamano_archivo($peso); ?>)</em></a></li>
							<? } ?>
		        </ul>
					<? } ?>

					<!-- -------------------- GALERÍA DE FOTOS -------------------- -->
					<?
					$sql_gal = "SELECT * FROM contenidos_fotos WHERE ref_contenido=".$ref." ORDER BY orden";
					$rs_gal = mysqli_query($conn,$sql_gal);
					if(mysqli_num_rows($rs_gal)>0){
						?>

						<h3>Galería</h3>

						<div class="grid-layout grid-2-columns" data-margin="20" data-item="grid-item" data-lightbox="gallery">

							<?
							while($row_gal = mysqli_fetch_array($rs_gal)){
								$sql_gal_info = "SELECT * FROM contenidos_fotos_info WHERE ref_foto=".$row_gal["ref"]." AND ref_idioma=1";
								$rs_gal_info = mysqli_query($conn,$sql_gal_info);
								if(mysqli_num_rows($rs_gal_info)>0){
									$row_gal_info = mysqli_fetch_array($rs_gal_info);
									$pie_gal = $row_gal_info["nombre"];
								}else{
									$pie_gal = $row_info["titulo"];
								}
								?>
								<div class="grid-item">
									<a href="imagenes/contenidos/galerias/<? echo $row_gal["foto"]; ?>" class="image-hover-zoom" data-lightbox="gallery-item">
										<img src="imagenes/contenidos/galerias/0/<? echo $row_gal["foto"]; ?>" alt="<? echo $pie_gal; ?>">
									</a>
								</div>
							<? } ?>
						<? } ?>

					</div>

				</div>
			</div>

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
