<?
// ----------------- VARIABLES

// -- tipo
$sql_v0 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=0";
$rs_v0 = mysqli_query($conn,$sql_v0);
if(mysqli_num_rows($rs_v0)>0){
	$row_v0 = mysqli_fetch_array($rs_v0);
	$v0 = $row_v0["opcion"];
}else{
	$v0 = "no";
}

// -- passw
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "no";
}

// -- activación
$sql_v2 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=2";
$rs_v2 = mysqli_query($conn,$sql_v2);
if(mysqli_num_rows($rs_v2)>0){
	$row_v2 = mysqli_fetch_array($rs_v2);
	$v2 = $row_v2["opcion"];
}else{
	$v2 = "no";
}

// -- teléfonos
$sql_v3 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=3";
$rs_v3 = mysqli_query($conn,$sql_v3);
if(mysqli_num_rows($rs_v3)>0){
	$row_v3 = mysqli_fetch_array($rs_v3);
	$v3 = $row_v3["opcion"];
}else{
	$v3 = "no";
}

// -- nif
$sql_v4 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=4";
$rs_v4 = mysqli_query($conn,$sql_v4);
if(mysqli_num_rows($rs_v4)>0){
	$row_v4 = mysqli_fetch_array($rs_v4);
	$v4 = $row_v4["opcion"];
}else{
	$v4 = "no";
}

// -- etiquetas
$sql_v5 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=5";
$rs_v5 = mysqli_query($conn,$sql_v5);
if(mysqli_num_rows($rs_v5)>0){
	$row_v5 = mysqli_fetch_array($rs_v5);
	$v5 = $row_v5["opcion"];
}else{
	$v5 = "no";
}

// ----------------- FIN VARIABLES
?>

<nav id="contenedor_sup" class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
		<img id="ico_loading" src="imagenes/loading.gif" style="display:none;">
    <button id="btn_ins" type="button" class="btn btn-green btn-icon icon-left">Insertar<i class="entypo-check"></i></button>
    <button onclick="window.location.href='<? $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>';" type="button" class="btn btn-gold btn-icon icon-left">Volver a <? echo $row_mod["nombre"]; ?><i class="entypo-ccw"></i></button>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

	<?
	$camino = "Insertar";
	include("include/camino_migas.php");
	?>

  <div class="clearfix"></div>

	<div id="panel_contenido" class="panel panel-gradient panel-shadow" data-collapsed="0">
    <div class="panel-heading">
      <div class="panel-title">&nbsp;</div>
      <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
      </div>
    </div>
    <div class="panel-body">
	    <form id="form_ins" name="form_ins" role="form" class="form-horizontal form-groups-standar validate">

				<div class="form-group">
          <label class="col-sm-2 control-label"><b class="rojo">*</b> usuario</label>
          <div class="col-sm-5"><input name="usuario" type="text" class="form-control" data-validate="email" data-message-required="No tiene un formato de e-mail" autofocus></div>
        </div>

				<? if($v1=="si"){ ?>
	      	<div class="form-group">
	          <label class="col-sm-2 control-label"><b class="rojo">*</b> contrase&ntilde;a</label>
	          <div class="col-sm-4"><input name="passw" type="password" class="form-control" data-validate="required"></div>
	        </div>
				<? } ?>

				<hr>

				<div class="form-group">
          <label class="col-sm-2 control-label"><b class="rojo">*</b> nombre</label>
          <div class="col-sm-4"><input name="nombre" type="text" class="form-control" data-validate="required" data-message-required="El campo es obligatorio"></div>
        </div>

				<div class="form-group">
          <label class="col-sm-2 control-label">apellidos</label>
          <div class="col-sm-6"><input name="apellidos" type="text" class="form-control"></div>
        </div>

				<? if($v0=="si"){ ?>
          <div class="form-group">
            <label class="col-sm-2 control-label">tipo</label>
            <div class="col-sm-7">
							<select name="tipo" class="selectboxit visible selectboxit-enabled selectboxit-btn">
						    <?
		            $sql_tipo = "SELECT * FROM registrados_tipo WHERE ref_menu=".$mod." ORDER BY orden";
		            $rs_tipo = mysqli_query($conn,$sql_tipo);
		            while($row_tipo = mysqli_fetch_array($rs_tipo)){
		              echo "<option value='".$row_tipo["ref"]."'>".$row_tipo["nombre"]."</option>";
		            }
		            ?>
	            </select>
						</div>
          </div>
        <? } ?>

				<? if($v3=="si"){ ?>
	      	<div class="form-group">
	          <label class="col-sm-2 control-label">tel&eacute;fono</label>
	          <div class="col-sm-4"><input name="tlf" type="text" class="form-control"></div>
	        </div>
				<? } ?>

				<? if($v4=="si"){ ?>
	      	<div class="form-group">
	          <label class="col-sm-2 control-label">n.i.f.</label>
	          <div class="col-sm-4"><input name="nif" type="text" class="form-control"></div>
	        </div>
				<? } ?>

				<? if($v5=="si"){ ?>
					<hr>
	        <div class="form-group">
	          <label class="col-sm-2 control-label">etiquetas</label>
	          <div class="col-sm-10">
							<?
		          $sql_etiquetas = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
		          $rs_etiquetas = mysqli_query($conn,$sql_etiquetas);
		          while($row_etiquetas = mysqli_fetch_array($rs_etiquetas)){
								$sql_etiquetas_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_etiquetas["ref"]." AND ref_idioma=1";
								$rs_etiquetas_info = mysqli_query($conn,$sql_etiquetas_info);
								$row_etiquetas_info = mysqli_fetch_array($rs_etiquetas_info);
		            echo "<div class='col-sm-3' style='padding-left:0'>";
		              echo "<div class='checkbox'>";
		              echo "<label><input id='etiqueta".$row_etiquetas["ref"]."' name='etiqueta".$row_etiquetas["ref"]."' type='checkbox' value='S'>";
		              echo "<b>".$row_etiquetas_info["nombre"]."</b></label>";
		              echo "</div>";
		            echo "</div>";
		          }
	          	?>
						</div>
	        </div>
	      <? } ?>

	    </form>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){

  $("#btn_ins").click(function(){
		if(!$("#form_ins").valid()) return false;
		$("#btn_ins").prop("disabled",true);
		$("#ico_loading").css("display", "inline");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/registrados_ins.php?mod=<? echo $mod; ?>",
      data: $("#form_ins").serializeArray(),
      success: function(resp){
				$("#btn_ins").prop("disabled",false);
				$("#ico_loading").css("display", "none");
				if(resp.ins==-1){
					$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_alerta.png' style='margin:0 20px 0 10px;float:left;' />El usuario <strong>ya existe</strong>.<br><br>Introduce otro.</h4>");
					$('#modal_error').modal('show');
				}else{
					if(resp.ins==0){
						$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error a nivel de <strong>programaci&oacute;n</strong>.<br><br>Contacta con el administrador.</h4>");
	          $('#modal_error').modal('show');
	        }else{
						$('#btn_modal_seguir').attr({onClick: "window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&ref="+resp.ins+"&secc=act'"});
		      	$('#modal_exito').modal('show');
					}
				}
			},
			error: function(){
				$("#btn_ins").prop("disabled",false);
				$("#ico_loading").css("display", "none");
				$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
				$('#modal_error').modal('show');
			}
    });
    return false;
  });

});
</script>

<!-- ------------------------------------------ VENTANAS MODALES ------------------------------------------ -->

<!------ EXITO (info) ------>

<div id="modal_exito" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			  <h4><img src="imagenes/ico_ok.png" style="margin:0 20px 0 0" />Registrado insertado correctamente</h4>
			</div>
			<div class="modal-footer">
			  <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=ins'" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-user-add"></i>Añadir otro</button>
			  <button id="btn_modal_seguir" type="button" class="btn btn-gold btn-icon icon-left"><i class="entypo-pencil"></i>Seguir editando</button>
			  <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>'" type="button" class="btn btn-default btn-icon icon-left"><i class="entypo-ccw"></i>Volver a <? echo $row_mod["nombre"]; ?></button>
			</div>
		</div>
  </div>
</div>

<!------ ERROR (info) ------>

<div id="modal_error" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body" style="text-align:left;">
				Cargando...
			</div>
      <div class="modal-footer">
				<button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>'" type="button" class="btn btn-gold btn-icon icon-left"><i class="entypo-ccw"></i>Volver a <? echo $row_mod["nombre"]; ?></button>
				<button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cerrar y volver a intentarlo</button>
      </div>
		</div>
  </div>
</div>

<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="assets/js/select2/select2.css">
<link rel="stylesheet" href="assets/js/selectboxit/jquery.selectBoxIt.css">
<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/square/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/futurico/futurico.css">
<link rel="stylesheet" href="assets/js/icheck/skins/polaris/polaris.css">
<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">

<script src="assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
<script src="assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="assets/js/select2/select2.min.js"></script>
<script src="assets/js/bootstrap-tagsinput.min.js"></script>
<script src="assets/js/typeahead.min.js"></script>
<script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/daterangepicker/moment.min.js"></script>
<script src="assets/js/daterangepicker/daterangepicker.js"></script>
<script src="assets/js/jquery.multi-select.js"></script>
<script src="assets/js/icheck/icheck.min.js"></script>
<script src="assets/js/jquery.inputmask.bundle.min.js"></script>
