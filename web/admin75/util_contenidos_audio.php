<script>
$(document).ready(function(){

  //------ INSERTAR ------

  $("#ins_audio").change(function(){
    $("#audio").prop("disabled",true);
    $("#audio").upload(
      'data/contenidos_audio_ins.php?ref=<? echo $ref; ?>',
      function(resp){
        $("#audio").prop("disabled",false);
        switch(resp.ins){
					case -2:
            $('#modal_error_audio .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />La extensión no está permitida.<br /><br />Por favor, indica un fichero compatible</h4>");
						$('#modal_error_audio').modal('show');
				    break;
					case -1:
						$('#modal_error_audio .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Ha ocurrido un ERROR. El fichero no ha subido.<br /><br />Contacta con el administrador.</h4>");
						$('#modal_error_audio').modal('show');
				    break;
					case 0:
						$('#modal_error_audio .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Ha ocurrido un ERROR a nivel de <strong>programación</strong>.<br /><br />Contacta con el administrador.</h4>");
						$('#modal_error_audio').modal('show');
					    break;
				  default:
            location.reload();
				}
      },
      function(progreso, valor){
        $("#barra_de_progreso_audio").show();
        $("#barra_de_progreso_audio").val(valor);
      }
    );
    return false;
  });

  //------ BORRAR ------

  $("#btn_del_audio").click(function(){
    $('#modal_del_audio').modal('show');
    return false;
  });

  $("#btn_modal_del_audio").click(function(){
    $("#btn_modal_del_audio").prop("disabled",true);
  	$("#ico_loading_del_audio").css("display", "inline");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/contenidos_audio_del.php?ref=<? echo $ref; ?>",
      success: function(resp){
        location.reload();
      },
      error: function(){
        $('#modal_del_audio').modal('hide');
        $('#modal_error_audio .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
        $('#modal_error_audio').modal('show');
      }
    });
    return false;
  });

});
</script>

<!-- ------------------------------------------ VENTANAS MODALES ------------------------------------------ -->

<!------ ELIMINAR (opciones) ------>

<div id="modal_del_audio" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
			<div class="modal-body" style="text-align:left;">
			  <h4><img src="imagenes/ico_preg.png" style="margin:0 20px 0 10px;float:left;" />El audio ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>
			</div>
			<div class="modal-footer">
        <img id="ico_loading_del_audio" src="imagenes/loading.gif" style="display:none;">
			  <button id="btn_modal_del_audio" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-trash"></i>Confirmar</button>
			  <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
			</div>
    </div>
  </div>
</div>

<!------ ERROR (info) ------>

<div id="modal_error_audio" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body" style="text-align:left;">
        Cargando...
      </div>
      <div class="modal-footer">
				<button onclick="location.reload();" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cerrar y volver a intentarlo</button>
      </div>
		</div>
  </div>
</div>
