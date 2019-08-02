<?
// ----------------- VARIABLES

// -- descripción
$sql_v51 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=51";
$rs_v51 = mysqli_query($conn,$sql_v51);
if(mysqli_num_rows($rs_v51)>0){
	$row_v51 = mysqli_fetch_array($rs_v51);
	$v51 = $row_v51["opcion"];
}else{
	$v51 = "no";
}

// ----------------- FIN VARIABLES
?>

<script>
$(document).ready(function(){

	//------ INSERTAR ------

	$("#btn_ins_doc").click(function(){
		$('#modal_ins_doc').modal('show');
		return false;
	});

	$("#form_ins_doc").submit(function(){
  	if(!$("#form_ins_doc").valid()) return false;
		$('#btn_modal_ins_doc').prop("disabled",true);
		$("#archivo").upload(
			'data/contenidos_doc_ins.php?mod=<? echo $mod; ?>&ref=<? echo $ref; ?>',
			{
			<?
			$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
			$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
			while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){
				?>
				nombredoc_<? echo $row_listaidiomas["ref"]; ?>: $("#nombredoc_<? echo $row_listaidiomas["ref"]; ?>").val(),
				<? if($v51=="si"){ ?>textodoc_<? echo $row_listaidiomas["ref"]; ?>: $("#textodoc_<? echo $row_listaidiomas["ref"]; ?>").val(),<? } ?>
			<? } ?>
		},
		function(resp){
			$('#btn_modal_ins_doc').prop("disabled",false);
			$('#modal_ins_doc').modal('hide');
			switch(resp.ins){
				case -3:
					$('#modal_error_doc .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />No se ha indicado ningún archivo<br /><br />Por favor, introdúcelo</h4>");
					$('#modal_error_doc').modal('show');
					break;
				case -2:
					$('#modal_error_doc .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />No se ha indicado ningún archivo<br /><br />Por favor, indica un fichero compatible</h4>");
					$('#modal_error_doc').modal('show');
					break;
				case -1:
					$('#modal_error_doc .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Ha ocurrido un ERROR. El fichero no ha subido.<br /><br />Contacta con el administrador.</h4>");
					$('#modal_error_doc').modal('show');
					break;
				case 0:
					$('#modal_error_doc .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Ha ocurrido un ERROR a nivel de <strong>programación</strong>.<br /><br />Contacta con el administrador.</h4>");
					$('#modal_error_doc').modal('show');
						break;
				default:
					$('#modal_exito_doc .modal-body').html("<h4><img src='imagenes/ico_ok.png' style='margin:0 20px 0 0' />Archivo insertado correctamente</h4>");
					$('#modal_exito_doc').modal('show');
			}
		},
		function(progreso, valor){
			$("#barra_de_progreso_doc").show();
			$("#barra_de_progreso_doc").val(valor);
		});
    return false;
  });

});

//--------- ACTUALIZAR ---------

function modalAct_doc(ref){
  $.ajax({
    url: 'data/contenidos_doc_modal.php?ref='+ref,
    dataType: "json",
    success: function(resp){

			<?
			$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
			$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
			while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){
				?>
	      $("#modal_act_doc .modal-body #nombredoc_<? echo $row_listaidiomas["ref"]; ?>").val(resp.nombredoc_<? echo $row_listaidiomas["ref"]; ?>);
				<? if($v51=="si"){ ?>$("#modal_act_doc .modal-body #textodoc_<? echo $row_listaidiomas["ref"]; ?>").val(resp.textodoc_<? echo $row_listaidiomas["ref"]; ?>);<? } ?>
			<? } ?>

			$("#modal_act_doc .modal-body #div_archivo").html("<a href='../archivos/contenidos/documentos/"+resp.archivo+"' target='_blank'><b>"+resp.archivo+"</b></a>");

			$('#btn_modal_act_doc').attr({onClick: "act_doc('"+ref+"');"});

    }
  });
  $('#modal_act_doc').modal('show');
  return false;
}

function act_doc(ref){
	if(!$("#form_act_doc").valid()) return false;
	$("#btn_modal_act_doc").prop("disabled",true);
	$("#ico_loading_act_doc").css("display", "inline");
  $.ajax({
		type: "POST",
		dataType: "json",
		url: "data/contenidos_doc_act.php?mod=<? echo $mod; ?>&ref="+ref,
		data: $("#form_act_doc").serializeArray(),
		success: function(resp){
			$("#btn_modal_act_doc").prop("disabled",false);
			$("#ico_loading_act_doc").css("display", "none");
			$('#modal_act_doc').modal('hide');
			if(resp.act==0){
				$('#modal_error_doc .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error a nivel de <strong>programaci&oacute;n</strong>.<br><br>Contacta con el administrador.</h4>");
				$('#modal_error_doc').modal('show');
			}else{
				$('#modal_exito_doc .modal-body').html("<h4><img src='imagenes/ico_ok.png' style='margin:0 20px 0 0' />Archivo actualizado correctamente</h4>");
				$('#modal_exito_doc').modal('show');
			}
		},
		error: function(){
			$("#btn_modal_act_doc").prop("disabled",false);
			$("#ico_loading_act_doc").css("display", "none");
			$('#modal_act_doc').modal('hide');
			$('#modal_error_doc .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
			$('#modal_error_doc').modal('show');
		}
  });
  return false;
}

//--------- ELIMINAR ---------

function modalDel_doc(ref){
	$.ajax({
		url: 'data/contenidos_doc_modal.php?ref='+ref,
    dataType: "json",
		success: function(resp){
			$('#modal_del_doc .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El documento «<b>"+resp.nombredoc_1+"</b>» ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>");
			$('#btn_modal_del_doc').attr({onClick: "del_doc('"+ref+"')"});
		}
	});
	$('#modal_del_doc').modal('show');
	return false;
}

function del_doc(ref){
  $('#btn_modal_del_doc').prop("disabled",true);
  $("#ico_loading_del_doc").css("display", "inline");
	$.ajax({
		url: 'data/contenidos_doc_del.php?ref='+ref,
		success: function(){
			location.reload();
		},
    error: function(){
      $('#modal_del_doc').modal('hide');
      $('#modal_error_doc .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br /><br />Vuelve a intentarlo.</h4>");
      $('#modal_error_doc').modal('show');
    }
	});
	return false;
}

//------ SUBIR ------

function subir1_doc(ref){
  $("#btn_subir1_"+ref+"_doc").css("display", "none");
  $("#ico_loading_subir1_"+ref+"_doc").css("display", "inline");
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "data/contenidos_doc_subir1.php?ref="+ref,
    success: function(){
      location.reload();
    },
    error: function(){
      $('#modal_error_doc .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error_doc').modal('show');
    }
  });
  return false;
}

//------ BAJAR ------

function bajar1_doc(ref){
  $("#btn_bajar1_"+ref+"_doc").css("display", "none");
  $("#ico_loading_bajar1_"+ref+"_doc").css("display", "inline");
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "data/contenidos_doc_bajar1.php?ref="+ref,
    success: function(){
      location.reload();
    },
    error: function(){
      $('#modal_error_doc .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error_doc').modal('show');
    }
  });
  return false;
}
</script>

<!-- ------------------------------------------ VENTANAS MODALES ------------------------------------------ -->

<!------ INSERTAR (formulario) ------>

<div id="modal_ins_doc" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_ins_doc" name="form_ins_doc" method="post" role="form" class="form-horizontal form-groups-standar validate" enctype="multipart/form-data">
        <div class="modal-header"><h4 class="modal-title">Insertar documento</h4></div>
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
              <div class="col-sm-8"><input id="nombredoc_<? echo $row_idiomas["ref"]; ?>" name="nombredoc_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?>class="form-control" type="text"<? if($row_idiomas["ref"]==1){ echo " autofocus"; }?>></div>
            </div>
            <? if($v51=="si"){ ?>
              <div class="form-group">
                <label class="col-sm-3 control-label">descripci&oacute;n</label>
                <div class="col-sm-8"><textarea id="textodoc_<? echo $row_idiomas["ref"]; ?>" name="textodoc_<? echo $row_idiomas["ref"]; ?>" class="form-control" rows="5"></textarea></div>
              </div>
            <? } ?>
          <? } ?>

					<div class="form-group">
					  <label class="col-sm-3 control-label"><b class="rojo">*</b> documento</label>
					  <div class="col-sm-8"><input id="archivo" name="archivo" class="form-control" type="file" data-validate="required"></div>
					</div>

					<div class="col-md-12">
					  <progress id="barra_de_progreso_doc" value="0" max="100" style="width:100%;margin-top:10px;display:none;"></progress>
					</div>

        </div>
        <div class="modal-footer">
          <button id="btn_modal_ins_doc" type="submit" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Insertar</button>
          <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!------ ACTUALIZAR (formulario) ------>

<div id="modal_act_doc" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_act_doc" name="form_act_doc" method="post" role="form" class="form-horizontal form-groups-standar validate" enctype="multipart/form-data">
        <div class="modal-header"><h4 class="modal-title">Actualizar documento</h4></div>
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
              <div class="col-sm-8"><input id="nombredoc_<? echo $row_idiomas["ref"]; ?>" name="nombredoc_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?>class="form-control" type="text"<? if($row_idiomas["ref"]==1){ echo " autofocus"; }?>></div>
            </div>

            <? if($v51=="si"){ ?>
              <div class="form-group">
                <label class="col-sm-3 control-label">descripci&oacute;n</label>
                <div class="col-sm-8"><textarea id="textodoc_<? echo $row_idiomas["ref"]; ?>" name="textodoc_<? echo $row_idiomas["ref"]; ?>" class="form-control" rows="5"></textarea></div>
              </div>
            <? } ?>

          <? } ?>

					<div class="form-group">
					  <label class="col-sm-3 control-label"><b class="rojo">*</b> documento</label>
					  <div class="col-sm-8"><div id="div_archivo" style="margin-top:3px;"></div></div>
					</div>

        </div>
        <div class="modal-footer">
					<img id="ico_loading_act_doc" src="imagenes/loading.gif" style="display:none;">
          <button id="btn_modal_act_doc" type="submit" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Actualizar</button>
          <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ---- ELIMINAR (opciones) ---- -->

<div id="modal_del_doc" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="text-align:left;">
        Cargando...
      </div>
      <div class="modal-footer">
        <img id="ico_loading_del_doc" src="imagenes/loading.gif" style="display:none;">
        <button id="btn_modal_del_doc" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-trash"></i>Confirmar</button>
        <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!------ EXITO DOC (info) ------>

<div id="modal_exito_doc" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body">
				Cargando...
			</div>
      <div class="modal-footer">
				<button onclick="location.reload();" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Aceptar</button>
			</div>
		</div>
  </div>
</div>

<!------ ERROR DOC (info) ------>

<div id="modal_error_doc" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body">
				Cargando...
			</div>
      <div class="modal-footer">
				<button onclick="location.reload();" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cerrar</button>
			</div>
		</div>
  </div>
</div>
