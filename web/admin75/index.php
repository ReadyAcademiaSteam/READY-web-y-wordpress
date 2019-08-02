<!DOCTYPE html>
<html lang="es">
<head>

<? include("../include/define.php"); ?>
<? include("include/funciones.php"); ?>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link href="https://<? echo dominio; ?>/<? echo carpeta; ?>imagenes/favicon.ico" rel="icon" type="image/x-icon" />

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="Administraci&oacute;n Morpheus" />
<meta name="author" content="<? echo autor; ?>" />

<title>Administraci&oacute;n | <? echo titulo_admin; ?></title>

<link rel="stylesheet" href="assets/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css">
<link rel="stylesheet" href="assets/css/font-icons/entypo/css/entypo.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/neon-core.css">
<link rel="stylesheet" href="assets/css/neon-theme.css">
<link rel="stylesheet" href="assets/css/neon-forms.css">
<link rel="stylesheet" href="assets/css/custom.css">
<link rel="stylesheet" href="assets/css/skins/white.css">

<script src="include/javascript.js"></script>
<script src="assets/js/jquery-1.11.0.min.js"></script>

<!--[if lt IE 9]><script src="assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="page-body login-page login-form-fall">

<script type="text/javascript">
	var baseurl = '';
</script>

<div class="login-container">

	<div class="login-header login-caret">
		<div class="login-content">

			<a href="https://<? echo dominio; ?><? if(carpeta){ echo "/".carpeta; } ?>" class="logo">
				<img src="imagenes/logo.png" width="300" alt="<? echo organizacion; ?>" />
			</a>

			<div class="login-progressbar-indicator">
				<h3>43%</h3>
				<span>accediendo...</span>
			</div>

		</div>
	</div>

	<div class="login-progressbar">
		<div></div>
	</div>

	<div class="login-form">
		<div class="login-content">

			<div class="form-login-error">
				<h3>Usuario y contraseña incorrectos</h3>
				<p>Comprueba que los datos introducidos son correctos.</p>
			</div>

			<form id="form_login" method="post" role="form">

				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><i class="entypo-user"></i></div>
						<input id="username" name="username" type="text" class="form-control" placeholder="usuario" autocomplete="off" />
					</div>
				</div>

				<div class="form-group">
					<div class="input-group">
						<div class="input-group-addon"><i class="entypo-key"></i></div>
						<input id="password" name="password" type="password" class="form-control" placeholder="contraseña" autocomplete="off" />
					</div>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block btn-login">Entrar<i class="entypo-login"></i></button>
				</div>

      </form>

		</div>
	</div>

</div>

<script src="assets/js/gsap/main-gsap.js"></script>
<script src="assets/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/joinable.js"></script>
<script src="assets/js/resizeable.js"></script>
<script src="assets/js/neon-api.js"></script>
<script src="assets/js/jquery.validate.min.js"></script>
<script src="assets/js/neon-login.js"></script>
<script src="assets/js/neon-custom.js"></script>
<script src="assets/js/neon-demo.js"></script>

</body>
</html>
