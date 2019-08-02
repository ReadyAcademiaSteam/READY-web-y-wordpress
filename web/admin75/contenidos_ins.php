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

// -- fecha
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "anno";
}

// -- fecha ini-fin
$sql_v2 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=2";
$rs_v2 = mysqli_query($conn,$sql_v2);
if(mysqli_num_rows($rs_v2)>0){
	$row_v2 = mysqli_fetch_array($rs_v2);
	$v2 = $row_v2["opcion"];
}else{
	$v2 = "no";
}

// -- intro
$sql_v7 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=7";
$rs_v7 = mysqli_query($conn,$sql_v7);
if(mysqli_num_rows($rs_v7)>0){
	$row_v7 = mysqli_fetch_array($rs_v7);
	$v7 = $row_v7["opcion"];
}else{
	$v7 = "si";
}

// -- texto
$sql_v8 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=8";
$rs_v8 = mysqli_query($conn,$sql_v8);
if(mysqli_num_rows($rs_v8)>0){
	$row_v8 = mysqli_fetch_array($rs_v8);
	$v8 = $row_v8["opcion"];
}else{
	$v8 = "si";
}

// -- texto2
$sql_v9 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=9";
$rs_v9 = mysqli_query($conn,$sql_v9);
if(mysqli_num_rows($rs_v9)>0){
	$row_v9 = mysqli_fetch_array($rs_v9);
	$v9 = $row_v9["opcion"];
}else{
	$v9 = "no";
}

// -- firma
$sql_v10 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=10";
$rs_v10 = mysqli_query($conn,$sql_v10);
if(mysqli_num_rows($rs_v10)>0){
	$row_v10 = mysqli_fetch_array($rs_v10);
	$v10 = $row_v10["opcion"];
}else{
	$v10 = "no";
}

// -- etiquetas
$sql_v14 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=14";
$rs_v14 = mysqli_query($conn,$sql_v14);
if(mysqli_num_rows($rs_v14)>0){
	$row_v14 = mysqli_fetch_array($rs_v14);
	$v14 = $row_v14["opcion"];
}else{
	$v14 = "no";
}

// -- seo
$sql_v17 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=17";
$rs_v17 = mysqli_query($conn,$sql_v17);
if(mysqli_num_rows($rs_v17)>0){
	$row_v17 = mysqli_fetch_array($rs_v17);
	$v17 = $row_v17["opcion"];
}else{
	$v17 = "no";
}

// -- enlace
$sql_v20 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=20";
$rs_v20 = mysqli_query($conn,$sql_v20);
if(mysqli_num_rows($rs_v20)>0){
	$row_v20 = mysqli_fetch_array($rs_v20);
	$v20 = $row_v20["opcion"];
}else{
	$v20 = "no";
}

// -- target
$sql_v200 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=200";
$rs_v200 = mysqli_query($conn,$sql_v200);
if(mysqli_num_rows($rs_v200)>0){
	$row_v200 = mysqli_fetch_array($rs_v200);
	$v200 = $row_v200["opcion"];
}else{
	$v200 = "no";
}

// ----------------- FIN VARIABLES
?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="contenedor_sup">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
		<img id="ico_loading" src="imagenes/loading.gif" style="display:none;">
    <button id="btn_ins" type="button" class="btn btn-green btn-icon icon-left">Insertar<i class="entypo-check"></i></button>
    <button onclick="window.location.href='<? $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>';" type="button" class="btn btn-gold btn-icon icon-left">Volver a <? echo $row_mod["nombre"]; ?><i class="entypo-ccw"></i></button>
  </ul>

</nav>

<div class="cuerpo">

	<?
	$camino = "Insertar";
	include("include/camino_migas.php");
	?>
  <div class="clearfix"></div>

  <div class="panel panel-gradient panel-shadow" data-collapsed="0">

    <div class="panel-heading">
      <div class="panel-title">Contenidos</div>
      <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
      </div>
    </div>

    <div class="panel-body">
      <form id="form_ins" name="form_ins" method="post" role="form" class="form-horizontal form-groups-standar validate">

				<? if($v1!="no"){ ?>
	        <div class="form-group">
	          <label class="col-sm-2 control-label"><b class="rojo">*</b> fecha</label>
	          <div class="col-sm-3"><input name="fecha" data-validate="required" type="text" class="form-control datepicker" placeholder="dd/mm/aaaa" data-format="dd/mm/yyyy" value="<? echo date('d/m/Y'); ?>"></div>
	        </div>
				<? } ?>

				<? if($v0=="si"){ ?>
	        <div class="form-group">
	          <label class="col-sm-2 control-label">tipo</label>
	          <div class="col-sm-7">
							<select name="tipo" class="selectboxit visible selectboxit-enabled selectboxit-btn">
								<?
								$sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref_menu=".$mod." ORDER BY orden";
								$rs_tipo = mysqli_query($conn,$sql_tipo);
								while($row_tipo = mysqli_fetch_array($rs_tipo)){
									echo "<option value='".$row_tipo["ref"]."'>".$row_tipo["nombre"]."</option>";
								}
								?>
	            </select>
							<input name="tipo_origen" type="hidden" value="<? echo $row["ref_tipo"]; ?>" />
						</div>
	        </div>
	      <? } ?>

				<? if($v2=="si"){ ?>
	        <div class="form-group">
	          <label class="col-sm-2 control-label">fecha ini</label>
	          <div class="col-sm-3"><input name="fecha_ini" type="text" class="form-control datepicker" placeholder="dd/mm/aaaa"></div>
	          <label class="col-sm-2 control-label">fecha fin</label>
	          <div class="col-sm-3"><input name="fecha_fin" type="text" class="form-control datepicker" placeholder="dd/mm/aaaa"></div>
	        </div>
	      <? } ?>

				<?
	      $sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
	      $rs_idiomas = mysqli_query($conn,$sql_idiomas);
	      if((($v0=="si")||($v1!="no")||($v2=="si")) && (mysqli_num_rows($rs_idiomas)>1)){
					?>
	        <div class="col-sm-12" style="height:20px;"></div>
	      <? } ?>

				<?
	      while($row_idiomas = mysqli_fetch_array($rs_idiomas)){

					if(mysqli_num_rows($rs_idiomas)>1){ ?>
	          <div class="col-sm-12 cabecera_idioma"><img src="imagenes/idiomas/<? echo $row_idiomas["foto"]; ?>" /><? echo $row_idiomas["nombre"]; ?></strong></div>
	        <? } ?>

	        <div class="form-group">
	          <label class="col-sm-2 control-label"><? if($row_idiomas["ref"]==1){ ?><b class="rojo">*</b> <? } ?>t&iacute;tulo</label>
	          <div class="col-sm-9"><input name="titulo_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?> type="text" class="form-control" placeholder="t&iacute;tulo"<? if($row_idiomas["ref"]==1){ echo " autofocus"; } ?>></div>
					</div>

					<? if($v7=="si"){ ?>
	          <div class="form-group">
	            <label class="col-sm-2 control-label">intro</label>
	            <div class="col-sm-10"><input name="intro_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" placeholder="intro"></div>
						</div>
	        <? } ?>

					<? if($v8=="si"){ ?>
			      <div class="form-group">
			        <label class="col-sm-2 control-label">texto</label>
			        <div class="col-sm-10"><textarea name="texto_<? echo $row_idiomas["ref"]; ?>" class="form-control ckeditor" rows="25"></textarea></div>
						</div>
	        <? } ?>

					<? if($v9=="si"){ ?>
	          <div class="form-group">
	            <label class="col-sm-2 control-label">texto 2</label>
	            <div class="col-sm-10"><textarea name="texto2_<? echo $row_idiomas["ref"]; ?>" class="form-control ckeditor" rows="25"></textarea></div>
	          </div>
	        <? } ?>

	        <? if($v17=="si"){ ?>
						<div class="col-sm-12" style="border-bottom:solid 1px #CCC;margin-bottom:20px;">SEO</strong></div>
						<div class="form-group">
							<label class="col-sm-2 control-label">title</label>
							<div class="col-sm-10"><input name="title_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" /></div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">descripci&oacute;n</label>
							<div class="col-sm-10"><input name="description_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" /></div>
						</div>
          <? } ?>

        <? } ?>

				<? if($v10=="si"){ ?>
	        <div class="form-group">
	          <label class="col-sm-2 control-label">firma</label>
	          <div class="col-sm-7"><input name="firma" type="text" class="form-control" placeholder="firma" autofocus></div>
	        </div>
	      <? } ?>

				<? if($v20=="si"){ ?>
	        <div class="form-group">
	          <label class="col-sm-2 control-label">http://</label>
	          <div class="col-sm-5"><input name="enlace" type="text" class="form-control" placeholder="direcci&oacute;n web"></div>
						<? if($v200=="si"){ ?>
							<label class="col-sm-2 control-label">destino</label>
		          <div class="col-sm-3">
								<select name="target" class="selectboxit visible selectboxit-enabled selectboxit-btn">
			            <option value="_blank">Otra ventana</option>
			            <option value="_self">Misma ventana</option>
			          </select>
							</div>
						<? } ?>
	        </div>
	      <? } ?>

				<? if($v14=="si"){ ?>
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
      url: "data/contenidos_ins.php?mod=<? echo $mod; ?>",
      data: $("#form_ins").serializeArray(),
      success: function(resp){
				$("#btn_ins").prop("disabled",false);
				$("#ico_loading").css("display", "none");
        if(resp.ins==0){
					$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error a nivel de <strong>programaci&oacute;n</strong>.<br><br>Contacta con el administrador.</h4>");
          $('#modal_error').modal('show');
        }else{
          $('#btn_modal_seguir').attr({onClick: "window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&ref="+resp.ins+"&secc=act'"});
          $('#modal_exito').modal('show');
        }
      },
      error: function(){
				$("#btn_ins").prop("disabled",false);
				$("#ico_loading").css("display", "none");
				$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong> en la inserci&oacute;n del contenido.<br>Volver a intentarlo.</h4>");
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
        <h4><img src="imagenes/ico_ok.png" style="margin:0 20px 0 10px" />Contenido insertado correctamente</h4>
      </div>
      <div class="modal-footer">
        <button id="btn_modal_seguir" type="button" class="btn btn-default btn-icon icon-left"><i class="entypo-pencil"></i>Seguir editando</button>
        <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>'" type="button" class="btn btn-gold btn-icon icon-left"><i class="entypo-ccw"></i>Volver a <? echo $row_mod["nombre"]; ?></button>
      </div>
    </div>
  </div>
</div>

<!------ ERROR (info) ------>

<div id="modal_error" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body">
        Cargando...
      </div>
      <div class="modal-footer" style="text-align:left;">
        <div class="row" style="padding:0 0 25px 0">
        <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>'" type="button" class="btn btn-gold btn-icon icon-left"><i class="entypo-ccw"></i>Volver a <? echo $row_mod["nombre"]; ?></button>
				</div>
      </div>
		</div>
  </div>
</div>

<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/square/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/futurico/futurico.css">
<link rel="stylesheet" href="assets/js/icheck/skins/polaris/polaris.css">
<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">

<script src="assets/js/ckeditor/ckeditor.js"></script>
<script src="assets/js/ckeditor/adapters/jquery.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/daterangepicker/moment.min.js"></script>
<script src="assets/js/daterangepicker/daterangepicker.js"></script>
<script src="assets/js/jquery.multi-select.js"></script>
<script src="assets/js/icheck/icheck.min.js"></script>
<script src="assets/js/jquery.inputmask.bundle.min.js"></script>
