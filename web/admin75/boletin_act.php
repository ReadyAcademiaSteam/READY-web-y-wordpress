<?
$ref = $_GET["ref"];

$sql = "SELECT * FROM boletin WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);
?>

<nav id="contenedor_sup" class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
    <img id="ico_loading" src="imagenes/loading.gif" style="display:none;">
    <button id="btn_act" type="button" class="btn btn-green btn-icon icon-left">Actualizar<i class="entypo-check"></i></button>
    <button type="button" class="btn btn-gold btn-icon icon-left" onclick="window.location.href='<? $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>';">Volver a <? echo $row_mod["nombre"]; ?><i class="entypo-ccw"></i></button>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

	<?
	$camino = $row["titulo"];
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
      <form id="form_act" name="form_act" method="post" role="form" class="form-horizontal form-groups-standar validate">

        <br />

        <div class="form-group">
          <label class="col-sm-2 control-label"><b class="rojo">*</b> fecha</label>
          <div class="col-sm-3"><input id="fecha" name="fecha" data-validate="required" type="text" class="form-control datepicker" placeholder="dd/mm/aaaa" data-format="dd/mm/yyyy" value="<? echo cambiarf_a_normal($row["fecha"]); ?>"></div>
        </div>

        <div class="form-group">
          <label class="col-sm-2 control-label"><b class="rojo">*</b> t&iacute;tulo</label>
          <div class="col-sm-9"><input id="titulo" name="titulo" data-validate="required" type="text" class="form-control" placeholder="t&iacute;tulo" value="<? echo $row["titulo"]; ?>" autofocus></div>
			  </div>

        <br />

        <div class="form-group">
          <label class="col-sm-2 control-label">contenido</label>
          <div class="col-sm-9">
            <table class="table table-condensed table-striped">
              <tbody>
              <?
              // ----------------- Repaso lo marcados -----------------
              $sql_cont = "SELECT * FROM contenidos WHERE ref_menu IN (SELECT ref_menu FROM boletin_tipo) ORDER BY fecha DESC";
              $rs_cont = mysqli_query($conn,$sql_cont);
              while($row_cont = mysqli_fetch_array($rs_cont)){
                $sql_marcado = "SELECT * FROM boletin_contenido WHERE ref_boletin=".$ref." AND ref_contenido=".$row_cont["ref"];
                $rs_marcado = mysqli_query($conn,$sql_marcado);
                if(mysqli_num_rows($rs_marcado)!=0){
                  echo "<tr>";
                    echo "<td><input name='contenido".$row_cont["ref"]."' type='checkbox' class='verif' value='S' checked></td>";
                    $sql_cont_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row_cont["ref"]." AND ref_idioma=1";
                    $rs_cont_info = mysqli_query($conn,$sql_cont_info);
                    $row_cont_info = mysqli_fetch_array($rs_cont_info);
                    echo "<td><strong>".$row_cont_info["titulo"]." <em>(".cambiarf_a_normal($row_cont["fecha"]).")</em></strong></td>";
                  echo "</tr>";
                }
              }
              // ----------------- Repaso lo NO marcados -----------------
              $rs_cont = mysqli_query($conn,$sql_cont);
              while($row_cont = mysqli_fetch_array($rs_cont)){
                $sql_marcado = "SELECT * FROM boletin_contenido WHERE ref_boletin=".$ref." AND ref_contenido=".$row_cont["ref"];
                $rs_marcado = mysqli_query($conn,$sql_marcado);
                if(mysqli_num_rows($rs_marcado)==0){
                  echo "<tr>";
                    echo "<td><input name='contenido".$row_cont["ref"]."' type='checkbox' class='verif' value='S'></td>";
                    $sql_cont_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row_cont["ref"]." AND ref_idioma=1";
                    $rs_cont_info = mysqli_query($conn,$sql_cont_info);
                    $row_cont_info = mysqli_fetch_array($rs_cont_info);
                    echo "<td>".$row_cont_info["titulo"]." <em>(".cambiarf_a_normal($row_cont["fecha"]).")</em></td>";
                  echo "</tr>";
                }
              }
              ?>

              </tbody>
            </table>
          </div>
        </div>

      </form>
    </div><!-- panel body -->
  </div><!-- panel -->

</div><!-- cuerpo -->

<script>
$(document).ready(function(){

  $("#btn_act").click(function(){
  	if(!$("#form_act").valid()) return false;
    $("#btn_act").prop("disabled",true);
		$("#ico_loading").css("display", "inline");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/boletin_act.php?mod=<? echo $mod; ?>&ref=<? echo $ref; ?>",
      data: $("#form_act").serializeArray(),
      success: function(resp){
        $("#btn_act").prop("disabled",false);
				$("#ico_loading").css("display", "none");
        if(resp.act==0){
          $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error a nivel de <strong>programaci&oacute;n</strong>.<br><br>Contacta con el administrador.</h4>");
          $('#modal_error').modal('show');
        }else{
          $('#modal_exito').modal('show');
        }
      },
      error: function(){
        $("#btn_act").prop("disabled",false);
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
        <h4><img src="imagenes/ico_ok.png" style="margin:0 20px 0 0" />Boletín actualizado correctamente</h4>
      </div>
      <div class="modal-footer">
        <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&ref=<? echo $ref; ?>&secc=act'" type="button" class="btn btn-gold btn-icon icon-left"><i class="entypo-pencil"></i>Seguir editando</button>
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
