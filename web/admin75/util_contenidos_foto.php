<link href="include/magnific-popup.css" rel="stylesheet">
<script src="include/jquery.magnific-popup.js"></script>

<script>
$(document).ready(function(){

	//------ VISUALIZAR ------

	$(".galeria").magnificPopup({
		delegate: "a",
		type: "image",
		tLoading: "Cargando imagen #%curr%...",
		mainClass: "mfp-fade",
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">La imagen #%curr%</a> no puede ser cargada.',
			titleSrc: function(item) {
				return item.el.attr('title');
			}
		},
		zoom: {
			enabled: true,
			duration: 300,
			easing: "ease-in-out",
			opener: function(openerElement) {
				return openerElement.is("img") ? openerElement : openerElement.find('img');
			}
		}
	});

	<? for($i=1; $i<= 3; $i++){ ?>

		//------ INSERTAR ------

		$("#ins_foto<? echo $i; ?>").change(function(){
			$("#ins_foto<? echo $i; ?>").prop("disabled",true);
			$("#foto<? echo $i; ?>").upload(
				'data/foto_subir.php?mod=<? echo $mod; ?>&ref=<? echo $ref; ?>',
				{
					carpeta: "../../imagenes/contenidos",
					tabla: "contenidos",
					ppal: <? echo $i; ?>,
				},
				function() {
					location.reload();
				},
				function(progreso, valor){
					$("#barra_de_progreso_foto<? echo $i; ?>").show();
					$("#barra_de_progreso_foto<? echo $i; ?>").val(valor);
				}
			);
	    return false;
	  });

		//------ BORRAR ------

		$("#btn_del_foto<? echo $i; ?>").click(function(){
			$('#modal_del_foto<? echo $i; ?>').modal('show');
			return false;
		});

		$("#btn_modal_del_foto<? echo $i; ?>").click(function(){
			$("#btn_modal_del_foto<? echo $i; ?>").prop("disabled",true);
	  	$("#ico_loading_del_foto<? echo $i; ?>").css("display", "inline");
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "data/contenidos_foto_del.php?mod=<? echo $mod; ?>&ref=<? echo $ref; ?>&ppal=<? echo $i; ?>",
				success: function(){
					location.reload();
				},
				error: function(){
					$("#btn_modal_del_foto<? echo $i; ?>").prop("disabled",false);
			  	$("#ico_loading_del_foto<? echo $i; ?>").css("display", "none");
					$('#modal_del_foto<? echo $i; ?>').modal('hide');
					$('#modal_error_foto .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
	        $('#modal_error_foto').modal('show');
				}
      });
      return false;
    });

	<? } ?>

	//------ TEXTO PIE ------

	$("#btn_txt_foto1").click(function(){
		$("#modal_txt_foto1").modal("show");
		return false;
	});

	$("#btn_modal_txt_foto1").click(function(){
		if(!$("#form_txt_foto1").valid()) return false;
		$("#btn_modal_txt_foto1").prop("disabled",true);
		$("#ico_loading_txt_foto1").css("display", "inline");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/contenidos_foto_txt.php?ref=<? echo $ref; ?>",
      data: $("#form_txt_foto1").serializeArray(),
			success: function(){
				location.reload();
			},
			error: function(){
				$("#btn_modal_txt_foto1").prop("disabled",false);
				$("#ico_loading_txt_foto1").css("display", "none");
				$('#modal_txt_foto1').modal('hide');
				$('#modal_error_foto .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
				$('#modal_error_foto').modal('show');
			}
    });
    return false;
  });

	//------ ALINEACIÓN ------

	$("#align_foto1").change(function(){
		$("#ico_loading_align_foto1").css("display", "inline");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/contenidos_foto_alineacion.php?ref=<? echo $ref; ?>&align="+$("#align_foto1").val(),
      success: function(){
				$("#ico_loading_align_foto1").css("display", "none");
				var opts = {
					"closeButton": true,
					"debug": false,
					"positionClass": "toast-top-right",
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"timeOut": "5000",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
				};
				toastr.success("", "Alineaci&oacute;n establecida correctamente", opts);
      },
      error: function(){
				$("#ico_loading_align_foto1").css("display", "none");
				toastr.error("", "Se ha producido un ERROR puntual a nivel de servidor. Vuelve a intentarlo.", opts);
      }
    });
    return false;
	});

});
</script>

<!-- ------------------------------------------ VENTANAS MODALES ------------------------------------------ -->

<!------ ELIMINAR (opciones) ------>

<? for($i=1; $i<=3; $i++){ ?>
	<div id="modal_del_foto<? echo $i; ?>" class="modal fade" data-backdrop="static">
	  <div class="modal-dialog">
	    <div class="modal-content">
				<div class="modal-body" style="text-align:left;">
				  <h4><img src="imagenes/ico_preg.png" style="margin:0 20px 0 10px;float:left;" />La foto ser&aacute; eliminada<br /><br />&iquest;Deseas continuar?</h4>
				</div>
				<div class="modal-footer">
					<img id="ico_loading_del_foto<? echo $i; ?>" src="imagenes/loading.gif" style="display:none;">
				  <button id="btn_modal_del_foto<? echo $i; ?>" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-trash"></i>Confirmar</button>
				  <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
				</div>
	    </div>
	  </div>
	</div>
<? } ?>

<!------ TEXTO (formulario) ------>

<div id="modal_txt_foto1" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_txt_foto1" name="form_txt_foto1" method="post" role="form" class="form-horizontal form-groups-standar">
        <div class="modal-header"><h4 class="modal-title">Editar pie de foto</h4></div>
        <div class="modal-body" style="text-align:left;">
          <?
          $sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
          $rs_idiomas = mysqli_query($conn,$sql_idiomas);
          while($row_idiomas = mysqli_fetch_array($rs_idiomas)){
            $sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=".$row_idiomas["ref"];
            $rs_info = mysqli_query($conn,$sql_info);
            $row_info = mysqli_fetch_array($rs_info);
            ?>
            <div class="form-group">
              <label class="col-sm-3 control-label"><?
              if(($row_idiomas["ref"]==1)&&(mysqli_num_rows($rs_idiomas)==1)){
                echo "pie de foto";
              }else{
                echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>";
              }
              ?></label>
              <div class="col-sm-8"><input id="nombrepie_<? echo $row_idiomas["ref"]; ?>" name="nombrepie_<? echo $row_idiomas["ref"]; ?>" class="form-control" value="<? echo $row_info["pie"]; ?>" type="text"<? if($row_idiomas["ref"]==1){ echo " autofocus"; }?>></div>
            </div>
          <? } ?>
        </div>
        <div class="modal-footer">
					<img id="ico_loading_txt_foto1" src="imagenes/loading.gif" style="display:none;">
          <button id="btn_modal_txt_foto1" type="submit" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Actualizar</button>
          <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!------ ERROR (info) ------>

<div id="modal_error_foto" class="modal fade" data-backdrop="static">
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
