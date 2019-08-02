<?
// --- Variable Anno

if($_GET["anno"]==''){

	if($_COOKIE["anno_boletin"]==''){
		$sql_anno = "SELECT fecha FROM boletin ORDER BY fecha DESC";
		$rs_anno = mysqli_query($conn,$sql_anno);
		if(mysqli_num_rows($rs_anno)>0){
			$row_anno = mysqli_fetch_array($rs_anno);
			$anno = substr($row_anno["fecha"],0,4);
		}else{
			$anno = date("Y");
		}
	}else{
		$sql_annocookie = "SELECT fecha FROM boletin WHERE YEAR(fecha)='".$_COOKIE["anno_boletin"]."' ORDER BY fecha DESC";
		$rs_annocookie = mysqli_query($conn,$sql_annocookie);
		if(mysqli_num_rows($rs_annocookie)>0){
			$anno = $_COOKIE["anno_boletin"];
		}else{
			$sql_anno = "SELECT fecha FROM boletin ORDER BY fecha DESC";
			$rs_anno = mysqli_query($conn,$sql_anno);
			if(mysqli_num_rows($rs_anno)>0){
				$row_anno = mysqli_fetch_array($rs_anno);
				$anno = substr($row_anno["fecha"],0,4);
			}else{
				$anno = date("Y");
			}
		}
	}

}else{
	$anno = $_GET["anno"];
}

echo "<script>CambiaCookie('anno_boletin','".$anno."');</script>";

// ----------------- VARIABLES

// -- destinatarios
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "todos";
}

// ----------------- FIN VARIABLES
?>

<nav id="contenedor_sup" class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
    <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=ins'" type="button" class="btn btn-default btn-icon icon-left">Insertar bolet&iacute;n<i class="entypo-plus-circled"></i></button></li>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <? include("include/camino_migas.php"); ?>
  <div class="clearfix"></div>

  <form class="cuadro_filtro">
    <div class="form-group">

      <!-- select año -->
      <div class="col-md-2">
        <select name="anno" onchange="MM_jumpMenu('parent',this,0)" class="selectboxit visible selectboxit-enabled selectboxit-btn">
          <?
          $sql_anno = "SELECT fecha FROM boletin GROUP BY YEAR(fecha) ORDER BY fecha DESC";
          $rs_anno = mysqli_query($conn,$sql_anno);
          while($row_anno = mysqli_fetch_array($rs_anno)){
            echo "<option ";
            if(substr($row_anno[0],0,4)==$anno){ echo "selected"; }
            echo " value='".$_SERVER['PHP_SELF']."?mod=".$mod."&anno=".substr($row_anno[0],0,4)."'>".substr($row_anno[0],0,4)."</option>";
          }
          ?>
        </select>
      </div>

    </div>
  </form>

  <div class="col-xs-12" style="height:20px;"></div>

  <div class="row">
	  <div class="col-md-12">
	    <table class="table table-condensed table-striped">

				<thead>
				  <tr>
			      <th>fecha</th>
			      <th>t&iacute;tulo</th>
			      <th></th>
				  </tr>
				</thead>

				<tbody>
					<?
					$sql = "SELECT * FROM boletin WHERE YEAR(fecha)=".$anno." ORDER BY fecha DESC, ref DESC";
				  $rs = mysqli_query($conn,$sql);
				  $cta_parametros = mysqli_num_rows($rs);
				  while($row = mysqli_fetch_array($rs)){?>
				    <tr>

				      <!-- fecha -->
				    	<td><span class="gris"><b><? echo cambiarf_a_normal($row["fecha"]); ?></b></span></td>

				      <!-- título -->
				      <td><strong><a href="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?>&ref=<? echo $row[0]; ?>&secc=act"><i class='entypo-pencil'></i><?  echo $row["titulo"]; ?></a></strong></td>

				      <!-- envíos -->
				      <td><button onclick="modalEnviar('<? echo $row["ref"]; ?>');" type="button" class="btn btn-blue btn-xs btn-icon icon-left" title="enviar &laquo;<? echo $row["titulo"]; ?>&raquo;"><i class="entypo-mail"></i>enviar</button></td>

				      <!-- eliminar -->
				      <td align="right"><button onclick="modalDel(<? echo $row["ref"]; ?>);" type="button" class="btn btn-danger btn-xs" title="eliminar &laquo;<? echo $row["titulo"]; ?>&raquo;"><i class="entypo-cancel"></i></button></td>

				    </tr>
				  <? } ?>
				</tbody>

	    </table>
	  </div>
  </div>

</div><!-- cuerpo -->

<script>

//--------- ELIMINAR ---------

function modalDel(ref){
  $.ajax({
    url: 'data/boletin_modal.php?ref='+ref,
    dataType: "json",
    success: function(resp){
      $('#modal_del .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El mailing «<b>"+resp.titulo+"</b>» ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>");
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
    url: 'data/boletin_del.php?ref='+ref,
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

//--------- ENVIAR ---------

function actualizarBarra(){
	$.get('data/progreso.txt',function(texto){
		var partes = texto.split('|'),
			porcentaje = parseInt(partes[0]),
			avance = partes[1],
			etiqueta = partes[0]+"% (" + partes[1] + ")";
		if(porcentaje==100)
			clearInterval(timerBarra);
		$("#dialogo_barras").html("<span id='titulo_barra'>"+etiqueta+"</span><div id='barra' class='progress progress-striped active'><div class='progress-bar progress-bar-success' role='progressbar' aria-valuemin='0' aria-valuemax='100' style='width:"+porcentaje+"%'></div></div>");
	});
}

function modalEnviar(ref){
  $('#modal_enviar').modal('show');
  $.ajax({
    url: 'data/boletin_modal.php?ref='+ref,
    dataType: "json",
    success: function(resp){
      $('#modal_enviar .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El mailing con t&iacute;tulo «<b>"+resp.titulo+"</b>» ser&aacute; enviado<br /><br />&iquest;Qu&eacute; tipo de env&iacute;o vas a realizar?</h4>");
      $('#btn_modal_enviar1').attr({onClick: "enviar1('"+ref+"');"});
			$('#btn_modal_enviartodos').attr({onClick: "enviartodos('"+ref+"');"});
    }
  });
  return false;
}

//------ Enviar 1 ------

function enviar1(ref){
	$('#btn_modal_enviar1').prop("disabled",true);
	$('#btn_modal_enviartodos').prop("disabled",true);
  $("#modal_enviar #ico_loading").css("display", "inline");
  $.ajax({
    type: "POST",
    url: "data/boletin_enviar.php?ref="+ref+"&modo=previa",
    success: function(resp){
			$('#btn_modal_enviar1').prop("disabled",false);
			$('#btn_modal_enviartodos').prop("disabled",false);
			$("#modal_enviar #ico_loading").css("display", "none");
			$('#modal_enviar').modal('hide');
			if(resp.enviado==0){
				$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />No se ha podido enviar el correo.<br><br>Vuelve a intentarlo y si el problema persiste, comunícalo al administrador.</h4>");
				$('#modal_error').modal('show');
			}else{
				$('#modal_exito .modal-body').html("<h4><img src='imagenes/ico_ok.png' style='margin:0 20px 0 0' />Envío realizado correctamente</h4>");
				$('#modal_exito').modal('show');
			}
    },
    error: function(){
			$('#btn_modal_enviar1').prop("disabled",false);
			$('#btn_modal_enviartodos').prop("disabled",false);
			$("#modal_enviar #ico_loading").css("display", "none");
			$('#modal_enviar').modal('hide');
			$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />No se ha podido enviar el correo.<br><br>Vuelve a intentarlo y si el problema persiste, comunícalo al administrador.</h4>");
			$('#modal_error').modal('show');
    }
  });
  return false;
}

//------ Enviar todos ------

function enviartodos(ref){

	$('#btn_modal_enviar1').prop("disabled",true);
	$('#btn_modal_enviartodos').prop("disabled",true);
	$("#dialogo_barras").show();
	$.post("data/boletin_enviar.php?ref="+ref+"&modo=todos",function(){
		$("#dialogo_barras").hide();
		$('#modal_enviar').modal("hide");
		$('#btn_modal_enviar1').prop("disabled",false);
		$('#btn_modal_enviartodos').prop("disabled",false);
		$('#modal_exito .modal-body').html("<h4><img src='imagenes/ico_ok.png' style='margin:0 20px 0 0' />Proceso realizado correctamente</h4>");
		$('#modal_exito').modal('show');
	});
	timerBarra = setInterval(actualizarBarra,1000);
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

<!-- ---- ENVIAR (opciones) ---- -->

<div id="modal_enviar" class="modal fade" data-backdrop="static">
	<div class="modal-dialog" style="width:700px;">
		<div class="modal-content">
			<div class="modal-body" style="text-align:left;">
				Cargando...
			</div>
			<div id="dialogo_barras" style="margin:0 40px;text-align:center;display:none;">
				<span id="titulo_barra">Iniciando...</span>
				<div id="barra" class="progress progress-striped active">
					<div class="progress-bar progress-bar-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
				</div>
			</div>
			<div class="modal-footer">
				<img id="ico_loading" src="imagenes/loading.gif" style="display:none;">
				<button id="btn_modal_enviar1" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-mail"></i>Enviar solo a m&iacute;</button>
				<button id="btn_modal_enviartodos" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-mail"></i>Enviar a todos</button>
				<button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
			</div>
		</div>
	</div>
</div>

<!------ EXITO (info) ------>

<div id="modal_exito" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
			  Cargando...
			</div>
			<div class="modal-footer">
				<button onclick="location.reload();" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-cancel"></i>Aceptar</button>
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
