<script>

//--------- INSERTAR ---------

function modalIns(){
  $('#modal_ins').modal('show');
  return false;
}

function ins(){
	if(!$("#form_ins").valid()) return false;
  $("#btn_modal_ins").prop("disabled",true);
  $("#ico_loading_ins").css("display", "inline");
  $.ajax({
		type: "POST",
		dataType: "json",
    url: "data/etiquetas_ins.php?mod=<? echo $mod; ?>",
    data: $("#form_ins").serializeArray(),
    success: function(resp){
      if(resp.ins==0){
        $('#modal_ins').modal('hide');
        $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>programación</strong>.<br><br>Contacta con el administrador.</h4>");
        $('#modal_error').modal('show');
      }else{
  			location.reload();
      }
		},
    error: function(){
      $('#modal_ins').modal('hide');
      $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error').modal('show');
    }
  });
  return false;
}

//--------- ACTUALIZAR ---------

function modalAct(ref){
  $.ajax({
    url: 'data/etiquetas_modal.php?ref='+ref,
    dataType: "json",
    success: function(resp){

      <?
			$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
			$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
			while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){
				?>
	      $("#modal_act .modal-body #nombre_<? echo $row_listaidiomas["ref"]; ?>").val(resp.nombre_<? echo $row_listaidiomas["ref"]; ?>);
			<? } ?>

			$('#btn_modal_act').attr({onClick: "act('"+ref+"')"});

    }
  });
  $('#modal_act').modal('show');
  return false;
}

function act(ref){
	if(!$("#form_act").valid()) return false;
  $("#btn_modal_act").prop("disabled",true);
  $("#ico_loading_act").css("display", "inline");
  $.ajax({
		type: "POST",
		dataType: "json",
    url: 'data/etiquetas_act.php?ref='+ref,
		data: $("#form_act").serializeArray(),
		success: function(resp){
      if(resp.act==0){
        $('#modal_act').modal('hide');
        $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>programación</strong>.<br><br>Contacta con el administrador.</h4>");
        $('#modal_error').modal('show');
      }else{
  			location.reload();
      }
		},
		error: function(){
      $('#modal_act').modal('hide');
      $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error').modal('show');
		}

  });
  return false;
}

//--------- ELIMINAR ---------

function modalDel(ref){
  $.ajax({
    url: 'data/etiquetas_modal.php?ref='+ref,
    dataType: "json",
    success: function(resp){
      $('#modal_del .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El valor <b>&laquo;"+resp.nombre+"&raquo;</b> ser&aacute; eliminada<br /><br />&iquest;Deseas continuar?</h4>");
      $('#btn_modal_del').attr({onClick: "del('"+ref+"')"});
    }
  });
  $('#modal_del').modal('show');
  return false;
}

function del(ref){
  $("#btn_modal_del").prop("disabled",true);
  $("#ico_loading_del").css("display", "inline");
  $.ajax({
    url: 'data/etiquetas_del.php?mod=<? echo $mod; ?>&ref='+ref,
    success: function(){
			location.reload();
		},
		error: function(){
      $('#modal_del').modal('hide');
      $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error').modal('show');
		}
  });
  return false;
}

//------ SUBIR ------

function subir1(ref){
  $("#btn_subir1_"+ref).css("display", "none");
  $("#ico_loading_subir1_"+ref).css("display", "inline");
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "data/etiquetas_subir1.php?mod=<? echo $mod; ?>&ref="+ref,
    success: function(){
      location.reload();
    },
    error: function(){
      $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error').modal('show');
    }
  });
  return false;
}

//------ BAJAR ------

function bajar1(ref){
  $("#btn_bajar1_"+ref).css("display", "none");
  $("#ico_loading_bajar1_"+ref).css("display", "inline");
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "data/etiquetas_bajar1.php?mod=<? echo $mod; ?>&ref="+ref,
    success: function(){
      location.reload();
    },
    error: function(){
      $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error').modal('show');
    }
  });
  return false;
}

</script>

<!-- ------------------------------------------ VENTANAS MODALES ------------------------------------------ -->

<!------ INSERTAR (formulario) ------>

<div id="modal_ins" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_ins" name="form_ins" method="post" role="form" class="form-horizontal form-groups-standar validate">
        <div class="modal-header"><h4 class="modal-title">Insertar valor</h4></div>
        <div class="modal-body" style="text-align:left;">

          <?
					$sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
					$rs_idiomas = mysqli_query($conn,$sql_idiomas);
					while($row_idiomas = mysqli_fetch_array($rs_idiomas)){
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?
							if($row_idiomas["ref"]==1){ echo "<b class='rojo'>*</b>&nbsp;"; }
              if(mysqli_num_rows($rs_idiomas)==1){
                echo "valor";
						  }else{
							  echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>";
							}
							?></label>
							<div class="col-sm-8">
								<input id="nombre_<? echo $row_idiomas["ref"]; ?>" name="nombre_<? echo $row_idiomas["ref"]; ?>" class="form-control" type="text"<? if($row_idiomas["ref"]==1){ echo " autofocus"; }?>>
							</div>
						</div>
					<? } ?>

        </div>
        <div class="modal-footer">
          <img id="ico_loading_ins" src="imagenes/loading.gif" style="display:none;">
          <button id="btn_modal_ins" onclick="ins();" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Insertar</button>
          <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!------ ACTUALIZAR (formulario) ------>

<div id="modal_act" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_act" name="form_act" method="post" role="form" class="form-horizontal form-groups-standar validate">
        <div class="modal-header"><h4 class="modal-title">Actualizar valor</h4></div>
        <div class="modal-body" style="text-align:left;">

          <?
					$sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
					$rs_idiomas = mysqli_query($conn,$sql_idiomas);
					while($row_idiomas = mysqli_fetch_array($rs_idiomas)){
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?
							if($row_idiomas["ref"]==1){ echo "<b class='rojo'>*</b>&nbsp;"; }
              if(mysqli_num_rows($rs_idiomas)==1){
                echo "valor";
						  }else{
							  echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>";
							}
							?></label>
							<div class="col-sm-8">
								<input id="nombre_<? echo $row_idiomas["ref"]; ?>" name="nombre_<? echo $row_idiomas["ref"]; ?>" class="form-control" type="text"<? if($row_idiomas["ref"]==1){ echo " autofocus"; }?>>
							</div>
						</div>
					<? } ?>

        </div>
        <div class="modal-footer">
          <img id="ico_loading_act" src="imagenes/loading.gif" style="display:none;">
          <button id="btn_modal_act" type="submit" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Actualizar</button>
          <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!------ ELIMINAR (opciones) ------>

<div id="modal_del" class="modal fade" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="text-align:left;">
				Cargando...
			</div>
			<div class="modal-footer">
        <img id="ico_loading_del" src="imagenes/loading.gif" style="display:none;">
				<button id="btn_modal_del" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-trash"></i>Confirmar</button>
				<button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
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
				<button onclick="location.reload();" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cerrar</button>
	    </div>
		</div>
  </div>
</div>
