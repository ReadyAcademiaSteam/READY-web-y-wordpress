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
		<? if($v5=="si"){ ?><button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=etiquetas';" type="button" class="btn btn-blue btn-icon icon-left">Etiquetas<i class="entypo-tag"></i></button></li><? } ?>
    <button type="button" class="btn btn-default btn-icon icon-left" onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=ins'">Insertar registrado<i class="entypo-plus-circled"></i></button></li>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <? include("include/camino_migas.php"); ?>
  <div class="clearfix"></div>

  <?
  $sql = "SELECT * FROM registrados WHERE ref_menu=".$mod." ORDER BY nombre,apellidos";
  $rs = mysqli_query($conn,$sql);
  ?>

  <table id="table_reg" class="table table-bordered table-striped table-condensed datatable">
		<thead>
			<tr class="replace-inputs">
				<th></th>
				<th></th>
				<th></th>
				<? if($v0=="si"){ ?><th></th><? } ?>
				<? if($v5=="si"){ ?><th></th><? } ?>
				<? if($v2=="si"){ ?><th></th><? } ?>
				<th>
			</tr>
			<tr>
				<th>nombre</th>
				<th>apellidos</th>
				<th>usuario</th>
				<? if($v0=="si"){ ?><th>tipo</th><? } ?>
				<? if($v5=="si"){ ?><th>etiquetas</th><? } ?>
				<? if($v2=="si"){ ?><th>activo</th><? } ?>
				<th></th>
			</tr>
		</thead>
  </table>

</div>

<script type="text/javascript">

//--------- MOSTRAR DATOS ---------

jQuery(document).ready(function($){

	var table = $("#table_reg").dataTable({
		"bStateSave": true,
		"bProcessing": true,
		"bServerSide": true,
		"sAjaxSource": "data/registrados.php?mod=<? echo $mod; ?>",
		"iDisplayLength": 25,

		"sPaginationType": "bootstrap",
		"aLengthMenu": [[25, 50, -1], [25, 50, "Todos"]],
		"oLanguage": {
			"sProcessing":     "<img src='assets/images/loader-1.gif'>",
			"sLengthMenu":     "Ver _MENU_",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "No hay datos en la tabla",
			"sInfo":           "Registros del _START_ al _END_ (total _TOTAL_ registros)",
			"sInfoEmpty":      "Del 0 al 0 (total 0 registros)",
			"sInfoFiltered":   "(filtrado de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ".",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst":    "Primero",
				"sLast":     "Último",
				"sNext":     "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
		}
	});

	table.columnFilter({
		"sPlaceHolder": "head:after",
		aoColumns:[
			{type: "text"},
			{type: "text"},
			{type: "text"},
			<? if($v0=="si"){ ?>
				{type: "select", values:[
					<?
					$sql_tipo = "SELECT * FROM registrados_tipo WHERE ref_menu=".$mod." ORDER BY orden";
					$rs_tipo = mysqli_query($conn,$sql_tipo);
					while($row_tipo = mysqli_fetch_array($rs_tipo)){
						echo "{value: '".$row_tipo["ref"]."', label: '".$row_tipo["nombre"]."'},";
					}
					?>
				]},
			<? } ?>
			<? if($v5=="si"){ ?>
				{type: "select", values:[
					<?
					$sql_etiquetas = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
					$rs_etiquetas = mysqli_query($conn,$sql_etiquetas);
					while($row_etiquetas = mysqli_fetch_array($rs_etiquetas)){
						$sql_etiquetas_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_etiquetas["ref"]." AND ref_idioma=1";
						$rs_etiquetas_info = mysqli_query($conn,$sql_etiquetas_info);
						$row_etiquetas_info = mysqli_fetch_array($rs_etiquetas_info);
						echo "{value: '".$row_etiquetas["ref"]."', label: '".$row_etiquetas_info["nombre"]."'},";
					}
					?>
				]},
			<? } ?>
			<? if($v2=="si"){ ?>
				{type: "select", values:[
					{value: 'S', label: 'S&iacute;'},
					{value: 'N', label: 'No'}
				]},
			<? } ?>
			null
		]
	});

});

//--------- ELIMINAR ---------

function modalDel(ref){
	$.ajax({
		url: 'data/registrados_modal.php?ref='+ref,
	  dataType: "json",
		success: function(resp){
			$('#modal_del .modal-body').html("<img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El registrado <b>"+resp.nombre+"</b> ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>");
			$('#btn_modal_del').attr({onClick: "del('"+ref+"')"});
		}
	});
	return false;
	$('#modal_del').modal('show');
}

function del(ref){
	$('#btn_modal_del').prop("disabled",true);
  $("#ico_loading").css("display", "inline");
	$.ajax({
		url: 'data/registrados_del.php?ref='+ref,
		success: function(){
			location.reload();
		},
    error: function(){
      $('#modal_del').modal('hide');
      $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br /><br />Vuelve a intentarlo.</h4>");
      $('#modal_error').modal('show');
    }
	});
	return false;
}

<? if($v2=="si"){ ?>

  //--------- ACTIVAR ---------

  function modalActivar(ref){
		$.ajax({
			url: 'data/registrados_modal.php?ref='+ref,
	    dataType: "json",
			success: function(resp){
				$('#modal_activar .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El registrado «<b>"+resp.nombre+"</b>» ser&aacute; activado<br /><br />&iquest;Deseas continuar?</h4>");
				$('#btn_modal_activar').attr({onClick: "activar('"+ref+"','S','N')"});
				$('#btn_modal_activar_enviar').attr({onClick: "activar('"+ref+"','S','S')"});
			}
		});
		$('#modal_activar').modal('show');
		return false;
  }

  function modalDesactivar(ref){
		$.ajax({
			url: 'data/registrados_modal.php?ref='+ref,
	    dataType: "json",
			success: function(resp){
				$('#modal_desactivar .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El registrado «<b>"+resp.nombre+"</b>» ser&aacute; desactivado<br /><br />&iquest;Deseas continuar?</h4>");
				$('#btn_modal_desactivar').attr({onClick: "activar('"+ref+"','N','N')"});
			}
		});
		$('#modal_desactivar').modal('show');
		return false;
  }

  function activar(ref,opcion,enviar){
		$("#btn_modal_activar_enviar").prop("disabled",true);
		$("#btn_modal_activar").prop("disabled",true);
		$("#ico_loading").css("display", "inline");
		$.ajax({
			url: 'data/registrados_activar.php?ref='+ref+"&opcion="+opcion+"&enviar="+enviar,
			success: function(resp){
				if(enviar=="S"){
					if(resp.enviado==0){
						$('#modal_activar').modal('hide');
						$('#modal_desactivar').modal('hide');
						$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_alerta.png' style='margin:0 20px 0 10px;float:left;' />Actualización realizada correctamente pero <strong>no se ha podido enviar el correo de notificación</strong>.</h4>");
						$('#modal_error').modal('show');
					}else{
						$('#modal_activar').modal('hide');
						$('#modal_desactivar').modal('hide');
						$('#modal_exito .modal-body').html("<h4><img src='imagenes/ico_ok.png' style='margin:0 20px 0 0;' /><strong>Actualización</strong> y <strong>envío</strong> realizados correctamente.</h4>");
						$('#modal_exito').modal('show');
					}
				}else{
					location.reload();
				}
			},
			error: function(){
				$('#modal_activar').modal('hide');
				$('#modal_desactivar').modal('hide');
				$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br /><br />Vuelve a intentarlo.</h4>");
				$('#modal_error').modal('show');
			}
		});
		return false;
  }

<? } ?>

</script>

<!-- ------------------------------------------ VENTANAS MODALES ------------------------------------------ -->

<!-- ---- ELIMINAR (opciones) ---- -->

<div id="modal_del" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
			<div class="modal-body" style="text-align:left;">
			  Cargando...
			</div>
			<div class="modal-footer">
			  <button id="btn_modal_del" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-trash"></i>Confirmar</button>
			  <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
			</div>
    </div>
  </div>
</div>

<? if($v2=="si"){ ?>

	<!-- ---- ACTIVAR (confirmar) ---- -->

	<div id="modal_activar" class="modal fade" data-backdrop="static">
	  <div class="modal-dialog">
	    <div class="modal-content">
				<div class="modal-body" style="text-align:left;">
				  Cargando...
				</div>
				<div class="modal-footer">
					<img id="ico_loading" src="imagenes/loading.gif" style="display:none;">
				  <? if($v1=="si"){ ?>
						<button id="btn_modal_activar_enviar" type="button" class="btn btn-blue btn-icon icon-left"><i class="entypo-mail"></i>Confirmar y notificar</button>
					<? } ?>
				  <button id="btn_modal_activar" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Confirmar</button>
				  <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
				</div>
	    </div>
	  </div>
	</div>

	<!-- ---- DESACTIVAR (confirmar) ---- -->

	<div id="modal_desactivar" class="modal fade" data-backdrop="static">
	  <div class="modal-dialog">
	    <div class="modal-content">
				<div class="modal-body" style="text-align:left;">
				  Cargando...
				</div>
				<div class="modal-footer">
					<img id="ico_loading" src="imagenes/loading.gif" style="display:none;">
				  <button id="btn_modal_desactivar" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Confirmar</button>
				  <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
				</div>
	    </div>
	  </div>
	</div>

	<!-- ---- EXITO (info) ---- -->

	<div id="modal_exito" class="modal fade" data-backdrop="static">
	  <div class="modal-dialog">
	    <div class="modal-content">
	      <div class="modal-body">
					Cargando...
				</div>
	      <div class="modal-footer">
	        <button onclick="location.reload();" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-pencil"></i>Aceptar</button>
	      </div>
	    </div>
	  </div>
	</div>

<? } ?>

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

<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css">
<link rel="stylesheet" href="assets/js/select2/select2-bootstrap.css">
<link rel="stylesheet" href="assets/js/select2/select2.css">

<script src="assets/js/jquery.dataTables.min.js"></script>
<script src="assets/js/datatables/TableTools.min.js"></script>
<script src="assets/js/dataTables.bootstrap.js"></script>
<script src="assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
<script src="assets/js/datatables/lodash.min.js"></script>
<script src="assets/js/datatables/responsive/js/datatables.responsive.js"></script>
<script src="assets/js/select2/select2.min.js"></script>
