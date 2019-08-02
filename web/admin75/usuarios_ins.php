<nav id="contenedor_sup" class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
    <img id="ico_loading" src="imagenes/loading.gif" style="display:none;">
    <button id="btn_ins" type="button" class="btn btn-green btn-icon icon-left">Insertar<i class="entypo-check"></i></button>
    <button type="button" class="btn btn-gold btn-icon icon-left" onclick="window.location.href='<? $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>';">Volver a <? echo $row_mod["nombre"]; ?><i class="entypo-ccw"></i></button>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

	<?
	$camino = "Insertar";
	include("include/camino_migas.php");
	?>

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
          <div class="col-sm-3"><input name="usuario" type="text" class="form-control" data-validate="required" data-message-required="El campo es obligatorio" autofocus></div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"><b class="rojo">*</b> contrase&ntilde;a</label>
          <div class="col-sm-3"><input name="passw" type="password" class="form-control" data-validate="required"></div>
        </div>

        <hr>

        <div class="form-group">
          <label class="col-sm-2 control-label"><b class="rojo">*</b> nombre</label>
          <div class="col-sm-5"><input name="nombre" type="text" class="form-control" data-validate="required" data-message-required="El campo es obligatorio"></div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">apellidos</label>
          <div class="col-sm-6"><input name="apellidos" type="text" class="form-control"></div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"><b class="rojo">*</b> e-mail</label>
          <div class="col-sm-5"><input name="email" type="text" class="form-control" data-validate="required" data-message-required="El campo es obligatorio"></div>
        </div>

        <hr>

        <div class="form-group">
          <label class="col-sm-2 control-label">nivel</label>
          <div class="col-sm-6"><select name="nivel" id="nivel" onChange="nivel_ins();" class="selectboxit visible selectboxit-enabled selectboxit-btn">
            <option value='1'>Administrador</option>
            <option value='2'>Usuario</option>
          </select></div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label">permisos</label>
          <div class="col-sm-6">
            <ul class="icheck-list">
              <?
        			$sql_tipo = "SELECT * FROM menu_admin WHERE ref<>1 AND ref<>999 AND nivel=0 ORDER BY orden";
        			$rs_tipo = mysqli_query($conn,$sql_tipo);
        			while($row_tipo = mysqli_fetch_array($rs_tipo)){
        			  ?>
                <li style='margin-bottom:0;'>
                  <input id="tipo<? echo $row_tipo["ref"]; ?>" name="tipo<? echo $row_tipo["ref"]; ?>" type="checkbox" class="icheck" value="S" checked disabled>
                  <label><? echo $row_tipo["nombre"]; ?></label>
                </li>
              <? } ?>
          	</ul>
          </div>
        </div>

      </form>
    </div>

  </div>

</div>

<script>
function nivel_ins(){
  if(document.form_ins.nivel.value==1){
	  for(i=0; i<document.form_ins.elements.length; i++){
		  if(document.form_ins.elements[i].type == "checkbox"){
        document.form_ins.elements[i].checked = 1;
        document.form_ins.elements[i].disabled = true;
		  }
	  }
  }else{
	  for(i=0; i<document.form_ins.elements.length; i++){
		  if(document.form_ins.elements[i].type == "checkbox"){
        document.form_ins.elements[i].checked = 0;
        document.form_ins.elements[i].disabled = false;
		  }
	  }
  }
}

$(document).ready(function(){

  $("#btn_ins").click(function(){
		if(!$("#form_ins").valid()) return false;
    $("#btn_ins").prop("disabled",true);
		$("#ico_loading").css("display", "inline");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/usuarios_ins.php",
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
        <h4><img src="imagenes/ico_ok.png" style="margin:0 20px 0 0" />Registrado insertado correctamente</h4>
      </div>
      <div class="modal-footer">
        <button id="btn_modal_seguir" type="button" class="btn btn-gold btn-icon icon-left"><i class="entypo-pencil"></i>Seguir editando</button>
        <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=ins'" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-user-add"></i>Añadir otro</button>
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
<link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">

<script src="assets/js/wysihtml5/wysihtml5-0.4.0pre.min.js"></script>
<script src="assets/js/wysihtml5/bootstrap-wysihtml5.js"></script>
<script src="assets/js/select2/select2.min.js"></script>
<script src="assets/js/bootstrap-tagsinput.min.js"></script>
<script src="assets/js/typeahead.min.js"></script>
<script src="assets/js/icheck/icheck.min.js"></script>
<script src="assets/js/selectboxit/jquery.selectBoxIt.min.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/daterangepicker/moment.min.js"></script>
<script src="assets/js/daterangepicker/daterangepicker.js"></script>
<script src="assets/js/jquery.multi-select.js"></script>
<script src="assets/js/jquery.inputmask.bundle.min.js"></script>
