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

// -- descripcion
$sql_v4 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=4";
$rs_v4 = mysqli_query($conn,$sql_v4);
if(mysqli_num_rows($rs_v4)>0){
	$row_v4 = mysqli_fetch_array($rs_v4);
	$v4 = $row_v4["opcion"];
}else{
	$v4 = "no";
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

  <div class="panel panel-gradient panel-shadow" data-collapsed="0">
    <div class="panel-heading">
      <div class="panel-title">&nbsp;</div>
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
            <div class="col-sm-3"><input id="fecha" name="fecha" data-validate="required" type="text" class="form-control datepicker" placeholder="dd/mm/aaaa" data-format="dd/mm/yyyy" value="<? echo date('d/m/Y'); ?>"></div>
          </div>
        <? } ?>

        <? if($v0=="si"){ ?>
        <div class="form-group">
          <label class="col-sm-2 control-label">tipo</label>
          <div class="col-sm-7"><select id="tipo" name="tipo" class="selectboxit visible selectboxit-enabled selectboxit-btn">
            <?
            $sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref_menu=".$mod." ORDER BY orden";
            $rs_tipo = mysqli_query($conn,$sql_tipo);
            while($row_tipo = mysqli_fetch_array($rs_tipo)){
              echo "<option value='".$row_tipo["ref"]."'>".$row_tipo["nombre"]."</option>";
            }
            ?>
          </select><input name="tipo_origen" type="hidden" value="<? echo $row["ref_tipo"]; ?>" /></div>
        </div>
        <? } ?>

        <div class="form-group">
          <label class="col-sm-2 control-label"><b class="rojo">*</b> c&oacute;digo</label>
          <div class="col-sm-6"><input id="codigo" name="codigo" type="text" class="form-control" placeholder="c&oacute;digo" data-validate="required" autofocus></div>
        </div>

        <?
        $sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
        $rs_idiomas = mysqli_query($conn,$sql_idiomas);
        if(mysqli_num_rows($rs_idiomas)>1){ ?>
          <div class="col-sm-12" style="height:20px;"></div>
        <? } ?>

        <?
        while($row_idiomas = mysqli_fetch_array($rs_idiomas)){

          if(mysqli_num_rows($rs_idiomas)>1){ ?>
            <div class="col-sm-12 cabecera_idioma"><img src="imagenes/idiomas/<? echo $row_idiomas["foto"]; ?>" /><? echo $row_idiomas["nombre"]; ?></strong></div>
          <? } ?>

          <div class="form-group">
            <label class="col-sm-2 control-label"><? if($row_idiomas["ref"]==1){ ?><b class="rojo">*</b> <? } ?>nombre</label>
            <div class="col-sm-9"><input name="titulo_<? echo $row_idiomas["ref"]; ?>" id="titulo_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?> type="text" class="form-control" placeholder="nombre"></div>
          </div>

          <? if($v4=="si"){ ?>
          <div class="form-group">
            <label class="col-sm-2 control-label">descripci&oacute;n</label>
            <div class="col-sm-10"><input type="text" class="form-control" name="intro_<? echo $row_idiomas["ref"]; ?>" id="intro_<? echo $row_idiomas["ref"]; ?>" placeholder="descripci&oacute;n"></div>
          </div>
          <? } ?>

        <? } ?>
      </form>
    </div><!-- panel body -->
  </div><!-- panel -->

</div><!-- cuerpo -->

<script>
$(document).ready(function(){

  $("#btn_ins").click(function(){
    if(!$("#form_ins").valid()) return false;
		$("#btn_ins").prop("disabled",true);
		$("#ico_loading").css("display", "inline");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/videos_ins.php?mod=<? echo $mod; ?>",
      data: $("#form_ins").serializeArray(),
			success: function(resp){
        $("#btn_ins").prop("disabled",false);
				$("#ico_loading").css("display", "none");
        if(resp.ins==0){
          $("#btn_ins").prop("disabled",false);
  				$("#ico_loading").css("display", "none");
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
        <h4><img src="imagenes/ico_ok.png" style="margin:0 20px 0 0" />V&iacute;deo insertado correctamente</h4>
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

<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/square/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/futurico/futurico.css">
<link rel="stylesheet" href="assets/js/icheck/skins/polaris/polaris.css">
<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">

<!-- Bottom Scripts -->
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
