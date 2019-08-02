<?
// ----------------- VARIABLES

// -- codificado
$sql_v52 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=52";
$rs_v52 = mysqli_query($conn,$sql_v52);
if(mysqli_num_rows($rs_v52)>0){
	$row_v52 = mysqli_fetch_array($rs_v52);
	$v52 = $row_v52["opcion"];
}else{
	$v52 = "no";
}

// ----------------- FIN VARIABLES
?>

<link href="include/magnific-popup.css" rel="stylesheet">
<link href="include/upload/uploadifive.css" rel="stylesheet" type="text/css">

<script src="include/jquery.magnific-popup.js"></script>
<script src="include/upload/jquery.uploadifive.min.js" type="text/javascript"></script>

<?
$timestamp = time();

$directorio = "/".carpeta."imagenes/contenidos/galerias/";
$tabla = "contenidos_fotos";
$campo = "ref_contenido";
?>

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
				return openerElement.is('img') ? openerElement : openerElement.find('img');
			}
		}
	});

	//------ INSERTAR ------

	$("#btn_ins_gal").click(function(){
		$('#modal_ins_gal').modal('show');
		return false;
	});

	$('#file_upload').uploadifive({
		'auto': true,
		'formData': {
			'timestamp': '<? echo $timestamp; ?>',
			'token': '<? echo md5('unique_salt' . $timestamp); ?>',
			'mod': '<? echo $mod; ?>',
			'ref': '<? echo $ref; ?>',
			'directorio': '<? echo $directorio; ?>',
			'tabla': '<? echo $tabla; ?>',
			'campo': '<? echo $campo; ?>'
	  },
		'queueID': 'queue',
		'uploadScript': 'data/foto_subirgal.php',
		'onQueueComplete': function(){
			location.reload();
		}
	});

	//------ ORDENAR ------

	$("#btn_ord_gal").click(function(){
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/contenidos_gal_ordenar.php?ref=<? echo $ref; ?>",
      data: $("#form_gal").serializeArray(),
      success: function(resp){
        location.reload();
      },
      error: function(){
				$('#modal_error_gal .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br /><br />Vuelve a intentarlo.</h4>");
				$('#modal_error_gal').modal('show');
      }
    });
    return false;
  });

});

//--------- ELIMINAR ---------

function modalDel_gal(ref){
	$('#modal_del_gal').modal('show');
	$('#btn_modal_del_gal').attr({onClick: "gal_del('"+ref+"');"});
	return false;
}

function gal_del(ref){
	$("#btn_modal_del_gal").prop("disabled",true);
	$("#ico_loading_del_gal").css("display", "inline");
	$.ajax({
		url: 'data/contenidos_gal_del.php?mod=<? echo $mod; ?>&foto='+ref,
		success: function(){
			$("#btn_modal_del_gal").prop("disabled",false);
			$("#ico_loading_del_gal").css("display", "none");
			$('#modal_del_gal').modal('hide');
			var $image = $('#foto'+ref);
			var t = new TimelineLite({
				onComplete: function(){
					$image.slideUp(function(){
						$image.remove();
					});
				}
			});
			$image.addClass('no-animation');
			t.append(TweenMax.to($image, .2, {css:{scale:0.95}}));
			t.append(TweenMax.to($image, .5, {css:{autoAlpha:0, transform:"translateX(100px) scale(.95)"}}));
		},
		error: function(){
			$("#btn_modal_del_gal").prop("disabled",false);
			$("#ico_loading_del_gal").css("display", "none");
			$('#modal_del_gal').modal('hide');
			$('#modal_error_gal .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br /><br />Vuelve a intentarlo.</h4>");
			$('#modal_error_gal').modal('show');
		}
	});
	return false;
}

//--------- ACTUALIZAR ---------

function modalAct_gal(ref){
	$.ajax({
		url: 'data/contenidos_gal_modal.php?ref='+ref,
		dataType: "json",

		success: function(resp){

			<?
			$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
			$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
			while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){
				?>
				$("#modal_txt_gal .modal-body #nombregal_<? echo $row_listaidiomas["ref"]; ?>").val(resp.nombregal_<? echo $row_listaidiomas["ref"]; ?>);
			<? } ?>

			$('#btn_modal_txt_gal').attr({onClick: "act_gal('"+ref+"');"});

		}
	});
	$('#modal_txt_gal').modal('show');
	return false;
}

function act_gal(ref){
	if(!$("#form_txt_gal").valid()) return false;
	$("#btn_modal_txt_gal").prop("disabled",true);
	$("#ico_loading_txt_gal").css("display", "inline");
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "data/contenidos_gal_txt.php?foto="+ref,
		data: $("#form_txt_gal").serializeArray(),
		success: function(resp){
			$("#btn_modal_txt_gal").prop("disabled",false);
			$("#ico_loading_txt_gal").css("display", "none");
			$('#modal_txt_gal').modal('hide');
			if(resp.act==0){
				$('#modal_error_gal .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error a nivel de <strong>programaci&oacute;n</strong>.<br><br>Contacta con el administrador.</h4>");
				$('#modal_error_gal').modal('show');
			}else{
				location.reload();
			}
		},
		error: function(){
			$("#btn_modal_txt_gal").prop("disabled",false);
			$("#ico_loading_txt_gal").css("display", "none");
			$('#modal_txt_gal').modal('hide');
			$('#modal_error_gal .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
			$('#modal_error_gal').modal('show');
		}
	});
	return false;
}

</script>

<!-- ------------------------------------------ VENTANAS MODALES ------------------------------------------ -->

<!------ INSERTAR (formulario) ------>

<div id="modal_ins_gal" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
      <div class="modal-body">
				<div id="queue"></div>
			</div>
      <div class="modal-footer">
      	<input id="file_upload" name="file_upload" type="file" multiple="true" lang="es" class="btn-file entypo-check">
        <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left" style="float:right;"><i class="entypo-cancel"></i>Cancelar</button>
      </div>
		</div>
  </div>
</div>

<!------ ELIMINAR GAL (opciones) ------>

<div id="modal_del_gal" class="modal fade" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="text-align:left;">
				<h4><img src="imagenes/ico_preg.png" style="margin:0 20px 0 10px;float:left;" />La foto ser&aacute; eliminada<br /><br />&iquest;Deseas continuar?</h4>
			</div>
			<div class="modal-footer">
				<img id="ico_loading_del_gal" src="imagenes/loading.gif" style="display:none;">
				<button id="btn_modal_del_gal" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-trash"></i>Confirmar</button>
				<button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
			</div>
		</div>
	</div>
</div>

<!------ ACTUALIZAR PIE FOTO GAL (formulario) ------>

<div id="modal_txt_gal" class="modal fade" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form_txt_gal" name="form_txt_gal" method="post" role="form" class="form-horizontal form-groups-standar">
				<div class="modal-header">
					<h4 class="modal-title">Editar texto foto</h4>
				</div>
				<div class="modal-body" style="text-align:left;">

					<?
					$sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
					$rs_idiomas = mysqli_query($conn,$sql_idiomas);
					while($row_idiomas = mysqli_fetch_array($rs_idiomas)){
						?>
						<div class="form-group">
							<label class="col-sm-3 control-label"><?
							if(($row_idiomas["ref"]==1)&&(mysqli_num_rows($rs_idiomas)==1)){
								echo "pie de foto";
							}else{
								echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>";
							}
							?></label>
							<div class="col-sm-8">
								<input id="nombregal_<? echo $row_idiomas["ref"]; ?>" name="nombregal_<? echo $row_idiomas["ref"]; ?>" class="form-control" type="text"<? if($row_idiomas["ref"]==1){ echo " autofocus"; }?>>
							</div>
						</div>
					<? } ?>

				</div>
				<div class="modal-footer">
					<img id="ico_loading_txt_gal" src="imagenes/loading.gif" style="display:none;">
					<button id="btn_modal_txt_gal" type="submit" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Actualizar</button>
					<button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!------ ERROR GAL (info) ------>

<div id="modal_error_gal" class="modal fade" data-backdrop="static">
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
