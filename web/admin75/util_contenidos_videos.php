<script>

//--------- INSERTAR ---------

function modalIns_videos(ref){
  $('#modal_ins_videos').modal('show');
  return false;
}

function ins_videos(){
  if(!$("#form_ins_videos").valid()) return false;
  $("#btn_modal_ins_videos").prop("disabled",true);
  $("#ico_loading_ins_videos").css("display", "inline");
  $.ajax({
		type: "POST",
		dataType: "json",
		data: $("#form_ins_videos").serializeArray(),
    url: 'data/contenidos_videos_ins.php?ref=<? echo $ref; ?>',
    success: function(resp){
      $("#btn_modal_ins_videos").prop("disabled",false);
			$("#ico_loading_ins_videos").css("display", "none");
      $('#modal_ins_videos').modal('hide');
      if(resp.ins==0){
        $('#modal_error_videos .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error a nivel de <strong>programaci&oacute;n</strong>.<br><br>Contacta con el administrador.</h4>");
  			$('#modal_error_videos').modal('show');
      }else{
        $('#modal_exito_videos .modal-body').html("<h4><img src='imagenes/ico_ok.png' style='margin:0 20px 0 0' />Vídeo insertado correctamente</h4>");
  			$('#modal_exito_videos').modal('show');
      }
    },
    error: function(){
      $("#btn_modal_ins_videos").prop("disabled",false);
			$("#ico_loading_ins_videos").css("display", "none");
			$('#modal_ins_videos').modal('hide');
			$('#modal_error_videos .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
			$('#modal_error_videos').modal('show');
    }
  });
  return false;
}

//--------- ACTUALIZAR ---------

function modalAct_videos(ref){
  $.ajax({
    url: 'data/contenidos_videos_modal.php?ref='+ref,
    dataType: "json",
    success: function(resp){

      <?
      $sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
      $rs_idiomas = mysqli_query($conn,$sql_idiomas);
      while($row_idiomas = mysqli_fetch_array($rs_idiomas)){
        ?>
        $('#modal_act_videos .modal-body #nombrevideo_<? echo $row_idiomas["ref"]; ?>').val(resp.nombrevideo_<? echo $row_idiomas["ref"]; ?>);
      <? } ?>

      $('#modal_act_videos .modal-body #codigo').val(resp.codigo);

			$('#btn_modal_act_videos').attr({onClick: "act_videos('"+ref+"');"});
    }
  });
  $('#modal_act_videos').modal('show');
  return false;
}

function act_videos(ref){
  if(!$("#form_act_videos").valid()) return false;
  $("#btn_modal_act_videos").prop("disabled",true);
	$("#ico_loading_act_videos").css("display", "inline");
  $.ajax({
		type: "POST",
		dataType: "json",
    url: 'data/contenidos_videos_act.php?ref='+ref,
		data: $("#form_act_videos").serializeArray(),
    success: function(resp){
      $("#btn_modal_act_videos").prop("disabled",false);
			$("#ico_loading_act_videos").css("display", "none");
			$('#modal_act_videos').modal('hide');
      if(resp.act==0){
				$('#modal_error_videos .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error a nivel de <strong>programaci&oacute;n</strong>.<br><br>Contacta con el administrador.</h4>");
				$('#modal_error_videos').modal('show');
			}else{
				$('#modal_exito_videos .modal-body').html("<h4><img src='imagenes/ico_ok.png' style='margin:0 20px 0 0' />Vídeo actualizado correctamente</h4>");
				$('#modal_exito_videos').modal('show');
			}
		},
		error: function(){
			$("#btn_modal_act_videos").prop("disabled",false);
			$("#ico_loading_act_videos").css("display", "none");
			$('#modal_act_videos').modal('hide');
			$('#modal_error_videos .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
			$('#modal_error_videos').modal('show');
		}
  });
  return false;
}

//--------- ELIMINAR ---------

function modalDel_videos(ref){
  $.ajax({
    url: 'data/contenidos_videos_modal.php?ref='+ref,
    dataType: "json",
    success: function(resp){
      $('#modal_del_videos .modal-body').html("<img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El vídeo <b>"+resp.nombrevideo_1+"</b> ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>");
      $('#btn_modal_del_videos').attr({onClick: "del_videos('"+ref+"');"});
    }
  });
  $('#modal_del_videos').modal('show');
  return false;
}

function del_videos(ref){
  $('#btn_modal_del_videos').prop("disabled",true);
  $("#ico_loading_del_videos").css("display", "inline");
  $.ajax({
    url: 'data/contenidos_videos_del.php?ref='+ref,
    success: function(){
      location.reload();
    },
    error: function(){
      $('#modal_del_videos').modal('hide');
      $('#modal_error_videos .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br /><br />Vuelve a intentarlo.</h4>");
      $('#modal_error_videos').modal('show');
    }
  });
  return false;
}

//------ SUBIR ------

function subir1_videos(ref){
  $("#btn_subir1_"+ref+"_videos").css("display", "none");
  $("#ico_loading_subir1_"+ref+"_videos").css("display", "inline");
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "data/contenidos_videos_subir1.php?ref="+ref,
    success: function(){
      location.reload();
    },
    error: function(){
      $('#modal_error_videos .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error_videos').modal('show');
    }
  });
  return false;
}

//------ BAJAR ------

function bajar1_videos(ref){
  $("#btn_bajar1_"+ref+"_videos").css("display", "none");
  $("#ico_loading_bajar1_"+ref+"_videos").css("display", "inline");
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "data/contenidos_videos_bajar1.php?ref="+ref,
    success: function(){
      location.reload();
    },
    error: function(){
      $('#modal_error_videos .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error_videos').modal('show');
    }
  });
  return false;
}
</script>

<!-- ------------------------------------------ VENTANAS MODALES ------------------------------------------ -->

<!------ INSERTAR (formulario) ------>

<div id="modal_ins_videos" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_ins_videos" name="form_ins_videos" method="post" role="form" class="form-horizontal form-groups-standar validate">
        <div class="modal-header"><h4 class="modal-title">Insertar vídeo</h4></div>
        <div class="modal-body" style="text-align:left;">

          <?
          $sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
          $rs_idiomas = mysqli_query($conn,$sql_idiomas);
          while($row_idiomas = mysqli_fetch_array($rs_idiomas)){
            ?>
            <div class="form-group">
              <label class="col-sm-3 control-label"><?
                if(($row_idiomas["ref"]==1)&&(mysqli_num_rows($rs_idiomas)==1)){
                  echo "<b class='rojo'>*</b>&nbsp;nombre";
                }else{
                  if($row_idiomas["ref"]==1){ echo "<b class='rojo'>*</b>&nbsp;";}
                  echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>";
                }
                ?></label>
              <div class="col-sm-8"><input name="nombrevideo_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?>class="form-control" type="text"<? if($row_idiomas["ref"]==1){ echo " autofocus"; }?>></div>
            </div>
          <? } ?>

          <div class="form-group">
            <label class="col-sm-3 control-label"><b class="rojo">*</b> código</label>
            <div class="col-sm-4">
              <input id="codigo" name="codigo" type="text" class="form-control" placeholder="código youtube">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <img id="ico_loading_ins_videos" src="imagenes/loading.gif" style="display:none;">
          <button id="btn_modal_ins_videos" onclick="ins_videos();" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Insertar</button>
          <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!------ ACTUALIZAR (formulario) ------>

<div id="modal_act_videos" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_act_videos" name="form_act_videos" method="post" role="form" class="form-horizontal form-groups-standar validate">
        <div class="modal-header"><h4 class="modal-title">Actualizar vídeo</h4></div>
        <div class="modal-body" style="text-align:left;">

          <?
          $sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
          $rs_idiomas = mysqli_query($conn,$sql_idiomas);
          while($row_idiomas = mysqli_fetch_array($rs_idiomas)){
            ?>
            <div class="form-group">
              <label class="col-sm-3 control-label"><?
                if(($row_idiomas["ref"]==1)&&(mysqli_num_rows($rs_idiomas)==1)){
                  echo "<b class='rojo'>*</b>&nbsp;nombre";
                }else{
                  if($row_idiomas["ref"]==1){ echo "<b class='rojo'>*</b>&nbsp;";}
                  echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>";
                }
                ?></label>
              <div class="col-sm-8"><input id="nombrevideo_<? echo $row_idiomas["ref"]; ?>" name="nombrevideo_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?>class="form-control" type="text"<? if($row_idiomas["ref"]==1){ echo " autofocus"; } ?>></div>
            </div>
          <? } ?>

          <div class="form-group">
            <label class="col-sm-3 control-label"><b class="rojo">*</b> código</label>
            <div class="col-sm-4">
              <input id="codigo" name="codigo" type="text" class="form-control" placeholder="código youtube">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <img id="ico_loading_act_videos" src="imagenes/loading.gif" style="display:none;">
          <button id="btn_modal_act_videos" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Actualizar</button>
          <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!------ ELIMINAR (opciones) ------>

<div id="modal_del_videos" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="text-align:left;">
        Cargando...
      </div>
      <div class="modal-footer">
        <img id="ico_loading_del_videos" src="imagenes/loading.gif" style="display:none;">
        <button id="btn_modal_del_videos" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-trash"></i>Confirmar</button>
        <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!------ EXITO VIDEO (info) ------>

<div id="modal_exito_videos" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body">
				<h4><img src="imagenes/ico_ok.png" style="margin:0 20px 0 0" />Documento insertado correctamente</h4>
			</div>
      <div class="modal-footer">
				<button onclick="location.reload();" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Aceptar</button>
			</div>
		</div>
  </div>
</div>

<!------ ERROR VIDEO (info) ------>

<div id="modal_error_videos" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body" style="text-align:left;">
				Cargando...
			</div>
      <div class="modal-footer">
				<button onclick="location.reload();" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cerrar</button>
			</div>
		</div>
  </div>
</div>
