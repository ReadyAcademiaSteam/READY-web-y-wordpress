<?
if(isset($_GET["mod"]) && $_GET["mod"]!=""){
	$mod = $_GET["mod"];
}else{
	$mod = 1;
}
?>
<? include("include/permiso.php"); ?>

<!DOCTYPE html>
<html lang="es">
<head>

<? include("../include/define.php"); ?>
<? include("../include/version.php"); ?>
<? include("include/funciones.php"); ?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="https://<? echo dominio; ?>/<? echo carpeta; ?>imagenes/favicon.ico" rel="icon" type="image/x-icon" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Panel Administraci&oacute;n Morpheus" />
<meta name="author" content="onirics.es" />

<title>Administraci&oacute;n | <? echo titulo_admin; ?></title>

<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/neon-core.css">
<link rel="stylesheet" href="assets/css/neon-theme.css">
<link rel="stylesheet" href="assets/css/neon-forms.css">
<link rel="stylesheet" href="assets/css/skins/white.css">
<link rel="stylesheet" href="assets/css/custom.css">

<script src="include/javascript.js"></script>
<script src="assets/js/jquery-1.11.0.min.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>

<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<? $raiz = $_SERVER["PHP_SELF"]; ?>

</head>

<body class="page-body skin-white">

<div class="page-container">

	<? include("include/menu.php"); ?>

	<div class="main-content">

	  <?
    $sql_mod = "SELECT * FROM menu_admin WHERE ref=".$mod;
    $rs_mod = mysqli_query($conn,$sql_mod);
    $row_mod = mysqli_fetch_array($rs_mod);

    if($mod!=1){
      $fichero = $row_mod["modulo"];
    }else{
      $fichero = "inicio";
    }
    if(isset($_GET["secc"]) && $_GET["secc"]!=""){
      $fichero = $fichero."_".$_GET["secc"];
    }
    include($fichero.".php");
  	?>

    <? include("include/pie.php"); ?>

	</div>

</div>

<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="assets/js/select2/select2.css">
<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">

<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/select2/select2.min.js"></script>
<script src="assets/js/bootstrap-tagsinput.min.js"></script>
<script src="assets/js/bootstrap-switch.min.js"></script>
<script src="assets/js/typeahead.min.js"></script>
<script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/neon-custom.js"></script>
<script src="assets/js/neon-demo.js"></script>

</body>
</html>
