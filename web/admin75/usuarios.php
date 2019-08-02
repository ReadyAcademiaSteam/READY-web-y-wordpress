<nav id="contenedor_sup" class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
    <button type="button" class="btn btn-default btn-icon icon-left" onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=ins'">Insertar usuario<i class="entypo-plus-circled"></i></button></li>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <? include("include/camino_migas.php"); ?>
  <div class="clearfix"></div>

  <?
  $sql = "SELECT * FROM usuarios ORDER BY nombre,apellidos";
  $rs = mysqli_query($conn,$sql);
  ?>

  <table id="table_usu" class="table table-bordered table-striped table-condensed datatable">
  	<thead>
  		<tr class="replace-inputs">
  			<th>nombre</th>
  			<th>apellidos</th>
  			<th></th>
  		</tr>
  		<tr>
  			<th>nombre</th>
  			<th>apellidos</th>
  			<th></th>
  		</tr>
  	</thead>
  </table>

</div>

<script type="text/javascript">

//--------- MOSTRAR DATOS ---------

jQuery(document).ready(function($){

  var table = $("#table_usu").dataTable({
  	"bStateSave": true,
  	"bProcessing": true,
  	"bServerSide": true,
  	"sAjaxSource": "data/usuarios.php?mod=<? echo $mod; ?>",
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
  			"sFirst": "Primero",
  			"sLast": "Último",
  			"sNext": "Siguiente",
  			"sPrevious": "Anterior"
  		},
  		"oAria": {
  			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
  			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
  		}
  	}
  });

  table.columnFilter({
  	"sPlaceHolder": "head:after",
  	aoColumns:[
  		{type: "text"},
  		{type: "text"},
  		null
  	]
  });

});

//--------- ELIMINAR ---------

function modalDel(ref){
	$.ajax({
		url: 'data/usuarios_modal.php?ref='+ref,
    dataType: "json",
		success: function(resp){
			$('#modal_del .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El usuario «<b>"+resp.nombre+"</b>» ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>");
			$('#btn_modal_del').attr({onClick: "del('"+ref+"')"});
		}
	});
	$('#modal_del').modal('show');
	return false;
}

function del(ref){
  $('#btn_modal_del').prop("disabled",true);
  $("#ico_loading").css("display", "inline");
	$.ajax({
		url: 'data/usuarios_del.php?ref='+ref,
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
        <img id="ico_loading" src="imagenes/loading.gif" style="display:none;">
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
