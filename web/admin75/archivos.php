<script src="include/upload.js"></script>

<?
$cookie1 = "anno_archivos".$mod;
$cookie2 = "tipo_archivos".$mod;
$cookie3 = "etiqueta_archivos".$mod;

// --- Variable Anno

if(!isset($_GET["anno"]) || $_GET["anno"]==""){
	if(!isset($_COOKIE[$cookie1]) || $_COOKIE[$cookie1]==''){
		$sql_anno = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." ORDER BY fecha DESC";
		$rs_anno = mysqli_query($conn,$sql_anno);
		if(mysqli_num_rows($rs_anno)>0){
			$row_anno = mysqli_fetch_array($rs_anno);
			$anno = substr($row_anno["fecha"],0,4);
		}else{
			$anno = date("Y");
		}
	}else{
		$sql_annocookie = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." AND YEAR(fecha)='".$_COOKIE[$cookie1]."' ORDER BY fecha DESC";
		$rs_annocookie = mysqli_query($conn,$sql_annocookie);
		if(mysqli_num_rows($rs_annocookie)>0){
			$anno = $_COOKIE[$cookie1];
		}else{
			$sql_anno = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." ORDER BY fecha DESC";
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

// --- Variable Tipo

if(!isset($_GET["tipo"]) || $_GET["tipo"]==""){
	if(!isset($_COOKIE[$cookie2]) || $_COOKIE[$cookie2]==''){
		$tipo = 0;
	}else{
		$tipo = $_COOKIE[$cookie2];
	}
}else{
	$tipo = $_GET["tipo"];
}

// --- Variable Etiqueta

if(!isset($_GET["etiqueta"]) || $_GET["etiqueta"]==""){
	if(!isset($_COOKIE[$cookie3]) || $_COOKIE[$cookie3]==''){
		$etiqueta = 0;
	}else{
		$etiqueta = $_COOKIE[$cookie3];
	}
}else{
	$etiqueta = $_GET["etiqueta"];
}

echo "<script>CambiaCookie('".$cookie1."','".$anno."');</script>"; //anno_archivos
echo "<script>CambiaCookie('".$cookie2."','".$tipo."');</script>"; //tipo_archivos
echo "<script>CambiaCookie('".$cookie3."','".$etiqueta."');</script>"; //etiqueta_archivos

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

// -- fecha
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "anno";
}

// -- foto
$sql_v2 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=2";
$rs_v2 = mysqli_query($conn,$sql_v2);
if(mysqli_num_rows($rs_v2)>0){
	$row_v2 = mysqli_fetch_array($rs_v2);
	$v2 = $row_v2["opcion"];
}else{
	$v2 = "no";
}

// -- orden
$sql_v3 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=3";
$rs_v3 = mysqli_query($conn,$sql_v3);
if(mysqli_num_rows($rs_v3)>0){
	$row_v3 = mysqli_fetch_array($rs_v3);
	$v3 = $row_v3["opcion"];
}else{
	$v3 = "no";
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

// -- intro
$sql_v6 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=6";
$rs_v6 = mysqli_query($conn,$sql_v6);
if(mysqli_num_rows($rs_v6)>0){
	$row_v6 = mysqli_fetch_array($rs_v6);
	$v6 = $row_v6["opcion"];
}else{
	$v6 = "no";
}

// ----------------- FIN VARIABLES
?>

<nav id="contenedor_sup" class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
    <? if($v5=="si"){ ?><button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=etiquetas';" type="button" class="btn btn-blue btn-icon icon-left">Etiquetas<i class="entypo-tag"></i></button></li><? } ?>
    <button id="btn_ins" type="button" class="btn btn-default btn-icon icon-left">Insertar archivo<i class="entypo-doc-text"></i></button></li>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <? include("include/camino_migas.php"); ?>
  <div class="clearfix"></div>

	<? if($v0=="si" || $v1!="no" || $v14=="si"){ ?>

  <form class="cuadro_filtro">

    <div class="form-group">

      <!-- select año -->

      <? if($v1!="no"){ ?>
      <div class="col-md-2">
        <select name="anno" onchange="MM_jumpMenu('parent',this,0)" class="selectboxit visible selectboxit-enabled selectboxit-btn">
          <?
					$sql_anno = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." GROUP BY YEAR(fecha) ORDER BY fecha DESC";
					$rs_anno = mysqli_query($conn,$sql_anno);
					while ($row_anno = mysqli_fetch_array($rs_anno)){
						echo "<option ";
						echo "value='".$_SERVER['PHP_SELF']."?mod=".$mod;
						echo "&anno=".substr($row_anno[0],0,4);
						if($v0=="si"){ echo "&tipo=".$tipo; }
						if($v5=="si"){ echo "&etiqueta=".$etiqueta; }
						echo "'";
						if(substr($row_anno[0],0,4)==$anno){ echo " selected"; }
						echo ">".substr($row_anno[0],0,4)."</option>";
					}
          ?>
        </select>
      </div>
      <? } ?>

      <!-- select tipo -->

      <? if($v0=="si"){ ?>
      <div class="col-md-4">
        <select name="tipo" onChange="MM_jumpMenu('parent',this,0)" class="selectboxit">
          <option value="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?><? if($v1!="no"){ echo "&anno=".$anno; } ?>&tipo=0<? if($v5=="si"){ echo "&etiqueta=".$etiqueta; } ?>"<? if($tipo==0){ echo " selected"; } ?>></option>
          <?
          $sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref_menu=".$mod." ORDER BY orden";
          $rs_tipo = mysqli_query($conn,$sql_tipo);
          while ($row_tipo = mysqli_fetch_array($rs_tipo)){
            echo "<option ";
						echo "value='".$_SERVER['PHP_SELF']."?mod=".$mod;
						if($v1!="no"){ echo "&anno=".$anno; }
						echo "&tipo=".$row_tipo["ref"]."'";
						if($v5=="si"){ echo "&etiqueta=".$etiqueta; }
						echo "'";
            if($row_tipo["ref"]==$tipo){ echo " selected"; }
            echo ">".$row_tipo["nombre"]."</option>";
          }
          ?>
        </select>
      </div>
      <? } ?>

			<!-- select etiqueta -->

      <? if($v5=="si"){ ?>
      <div class="col-md-4">
        <select name="etiqueta" onChange="MM_jumpMenu('parent',this,0)" class="selectboxit">
          <option value="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?><? if($v1!="no"){ echo "&anno=".$anno; } ?><? if($v0=="si"){ echo "&tipo=".$tipo; } ?>&etiqueta=0"<? if($etiqueta==0){ echo " selected"; } ?>></option>
          <?
          $sql_etiqueta = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
          $rs_etiqueta = mysqli_query($conn,$sql_etiqueta);
          while($row_etiqueta = mysqli_fetch_array($rs_etiqueta)){
						$sql_etiqueta_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_etiqueta["ref"]." AND ref_idioma=1";
						$rs_etiqueta_info = mysqli_query($conn,$sql_etiqueta_info);
						$row_etiqueta_info = mysqli_fetch_array($rs_etiqueta_info);
            echo "<option ";
            echo "value='".$_SERVER['PHP_SELF']."?mod=".$mod;
            if($v1!="no"){ echo "&anno=".$anno; }
						if($v0=="si"){ echo "&tipo=".$tipo; }
            echo "&etiqueta=".$row_etiqueta["ref"]."'";
						if($row_etiqueta["ref"]==$etiqueta){ echo " selected"; }
						echo ">".$row_etiqueta_info["nombre"]."</option>";
          }
          ?>
        </select>
      </div>
    	<? } ?>

    </div>
	</form>

  <div class="col-xs-12" style="height:20px;"></div>

  <? } ?>

  <div class="row">
  	<div class="col-md-12">
    	<table class="table table-condensed table-striped">

        <thead>
          <tr>

						<!-- fecha -->
            <? if($v1!="no"){ ?>
              <th>fecha</th>
            <? } ?>

						<!-- nombre -->
            <th>nombre</th>

						<!-- tipo -->
            <? if($v0=="si"){ ?>
              <th>tipo</th>
            <? } ?>

						<!-- etiquetas -->
            <? if($v5=="si"){ ?>
              <th>etiquetas</th>
            <? } ?>

						<!-- archivo -->
            <th></th>

						<!-- orden -->
						<? if(($v3=="si")&&($v0=="no")||(($v3=="si")&&($v0=="si")&&($tipo!=0))){ ?>
              <th></th>
            <? } ?>

						<!-- eliminar -->
            <th></th>

          </tr>
        </thead>

	      <tbody>
					<?
					$sql = "SELECT * FROM contenidos WHERE ref_menu=".$mod." AND YEAR(fecha)=".$anno;
					if(($v0=="si")&&($tipo!=0)){ $sql.= " AND ref_tipo=".$tipo; }
					if(($v5=="si")&&($etiqueta!=0)){ $sql.= " AND ref IN (SELECT ref_contenido FROM contenidos_rel_etiquetas WHERE ref_etiqueta=".$etiqueta.")"; }
	        if($v3=="si" && $v1=="no"){
	          $sql.= " ORDER BY orden";
	        }else{
	          $sql.= " ORDER BY fecha DESC, ref DESC";
	        }
					$rs = mysqli_query($conn,$sql);
					$cta_parametros = mysqli_num_rows($rs);
					while($row = mysqli_fetch_array($rs)){

						$sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row["ref"]." AND ref_idioma=1";
						$rs_info = mysqli_query($conn,$sql_info);
						$row_info = mysqli_fetch_array($rs_info);
						?>

						<tr>

							<!-- fecha -->
	            <? if($v1!="no"){ ?>
	            	<td><span class="gris"><b><? echo cambiarf_a_normal($row["fecha"]); ?></b></span></td>
	            <? } ?>

							<!-- nombre -->
	            <td>
	            	<strong><i class='entypo-pencil'></i><a onclick="modalAct('<? echo $row["ref"]; ?>');" style="cursor:pointer"><? echo $row_info["titulo"]; ?></strong></b>
	            </td>

	            <!-- tipo -->
	            <? if($v0=="si"){ ?>
	            <td><span class="gris"><b><?
							$sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref=".$row["ref_tipo"];
							$rs_tipo = mysqli_query($conn,$sql_tipo);
							$row_tipo = mysqli_fetch_array($rs_tipo);
							echo $row_tipo["nombre"];
							?></b></span></td>
	            <? } ?>

							<!-- etiquetas -->
	            <?
	            if($v5=="si"){
	              $etiquetas = "";
	              $sql_etiq = "SELECT * FROM contenidos_rel_etiquetas WHERE ref_contenido=".$row["ref"];
	              $rs_etiq = mysqli_query($conn,$sql_etiq);
	              while($row_etiq = mysqli_fetch_array($rs_etiq)){
	                $sql_etiq_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_etiq["ref_etiqueta"]." AND ref_idioma=1";
	                $rs_etiq_info = mysqli_query($conn,$sql_etiq_info);
	                $row_etiq_info = mysqli_fetch_array($rs_etiq_info);
	                $etiquetas.= $row_etiq_info["nombre"].", ";
	              }
	              if($etiquetas!=""){
	                echo "<td>".substr($etiquetas,0,-2)."</td>";
	              }else{
	                echo "<td><em>- sin etiquetas -</em></td>";
	              }
	            }
	            ?>

	            <!-- documento -->
	            <td>
								<a href='../archivos/contenidos/<? echo $row["archivo"]; ?>' target='_blank'>
									<button id='btn-ver-<? echo $row["ref"]; ?>' type='submit' class='btn btn-blue btn-xs btn-icon icon-left'><i class='entypo-doc-text'></i>ver archivo</button>
								</a>
							</td>

	            <!-- orden -->
							<? if(($v3=="si")&&($v0=="no")||(($v3=="si")&&($v0=="si")&&($tipo!=0))){ ?>
								<td style="text-align:center;">
									<?
		              if($row["orden"]>1){
										echo "<img id='ico_loading_subir1_".$row["ref"]."' src='imagenes/loading.gif' style='display:none;margin-right:7px;'>";
		                echo "<button id='btn_subir1_".$row["ref"]."' onclick=\"subir1('".$row["ref"]."','".$row["ref_tipo"]."');\" type='button' class='btn btn-default btn-xs' title='subir'><i class='entypo-up-open'></i></button>";
		              }else{
		                echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-up-open'></i></button>";
		              }
		              if($row["orden"]<$cta_parametros){
										echo "<img id='ico_loading_bajar1_".$row["ref"]."' src='imagenes/loading.gif' style='display:none;margin-left:7px;'>";
		                echo "<button id='btn_bajar1_".$row["ref"]."' onclick=\"bajar1('".$row["ref"]."','".$row["ref_tipo"]."');\" type='button' class='btn btn-default btn-xs' title='bajar'><i class='entypo-down-open'></i></button>";
		              }else{
		                echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-down-open'></i></button>";
		              }
		              ?>
		            </td>
							<? } ?>

	            <!-- eliminar -->
	            <td align="right">
	              <button onclick="modalDel('<? echo $row["ref"]; ?>');" type="button" class="btn btn-danger btn-xs" title="eliminar &laquo;<? echo $row_info["titulo"]; ?>&raquo;"><i class="entypo-cancel"></i></button>
	            </td>

						</tr>
          <? } ?>

        </tbody>

    	</table>
  	</div>
  </div>

</div><!-- cuerpo -->

<script>

//------ INSERTAR ------

$(document).ready(function(){

	$("#btn_ins").click(function(){
		$('#modal_ins').modal('show');
		return false;
	});

  $("#btn_modal_ins").click(function(){
		if(!$("#form_ins").valid()) return false;
		$("#btn_modal_ins").prop("disabled",true);
		$("#archivo").upload(
			'data/archivos_ins.php?mod=<? echo $mod; ?>',
			{
			<? if($v1!="no"){ ?>fecha: $("#fecha").val(),<? } ?>
			<? if($v0=="si"){ ?>tipo: $("#tipo").val(),<? } ?>
			<? if($v5=="si"){ ?>etiquetas: $("#etiquetas").val(),<? } ?>
			<?
			$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
			$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
			while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){
				?>
				<? if($v6=="si"){ ?>intro_<? echo $row_listaidiomas["ref"]; ?>: $("#intro_<? echo $row_listaidiomas["ref"]; ?>").val(),<? } ?>
				titulo_<? echo $row_listaidiomas["ref"]; ?>: $("#titulo_<? echo $row_listaidiomas["ref"]; ?>").val(),
			<? } ?>
			},
			function(resp){
				$("#btn_modal_ins").prop("disabled",false);
				$('#modal_ins').modal('hide');
				switch(resp.ins){
				  case -3:
						$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />No se ha indicado ningún archivo<br /><br />Por favor, introdúcelo</h4>");
						$('#modal_error').modal('show');
				    break;
					case -2:
						$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />La extensión no está permitida.<br /><br />Por favor, indica un fichero compatible</h4>");
						$('#modal_error').modal('show');
				    break;
					case -1:
						$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Ha ocurrido un ERROR. El fichero no ha subido.<br /><br />Contacta con el administrador.</h4>");
						$('#modal_error').modal('show');
				    break;
					case 0:
						$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Ha ocurrido un ERROR a nivel de <strong>programación</strong>.<br /><br />Contacta con el administrador.</h4>");
						$('#modal_error').modal('show');
					    break;
				  default:
						$('#modal_exito .modal-body').html("<h4><img src='imagenes/ico_ok.png' style='margin:0 20px 0 0' />Archivo insertado correctamente</h4>");
		        $('#modal_exito').modal('show');
				}
			},
			function(progreso, valor){
				$("#barra_de_progreso").show();
				$("#barra_de_progreso").val(valor);
			}
		);
    return false;
  });
});

//--------- ACTUALIZAR ---------

function modalAct(ref){
  $.ajax({
    url: 'data/archivos_modal.php?ref='+ref,
    dataType: "json",

    success: function(resp){

			<? if($v1!="no"){ ?>
				fecha = cambiarf_a_normal(resp.fecha);
				$('#modal_act .modal-body #fecha').datepicker("update", fecha);
			<? } ?>

			<? if($v0=="si"){ ?>
				$("#modal_act .modal-body select#tipo").find('option').removeAttr("selected");
				$('#modal_act .modal-body select#tipo').data('selectBox-selectBoxIt').selectOption(resp.tipo);
			<? } ?>

			<?
			$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
			$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
			while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){
				?>
	      $("#modal_act .modal-body #titulo_<? echo $row_listaidiomas["ref"]; ?>").val(resp.titulo_<? echo $row_listaidiomas["ref"]; ?>);
				<? if($v6=="si"){ ?>$("#modal_act .modal-body #intro_<? echo $row_listaidiomas["ref"]; ?>").val(resp.intro_<? echo $row_listaidiomas["ref"]; ?>);<? } ?>
			<? } ?>

			<? if($v5=="si"){ ?>
	      $("#modal_act .modal-body select#etiquetas").val(null).trigger("change");
	      $('#modal_act .modal-body select#etiquetas').val(resp.etiquetas).trigger("change");
			<? } ?>

			$("#modal_act .modal-body #div_archivo").html("<a href='../archivos/contenidos/"+resp.archivo+"' target='_blank'><b>"+resp.archivo+"</b></a>");

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
		url: "data/archivos_act.php?mod=<? echo $mod; ?>&ref="+ref,
		data: $("#form_act").serializeArray(),
		success: function(resp){
			$("#btn_modal_act").prop("disabled",false);
			$("#ico_loading_act").css("display", "none");
			$('#modal_act').modal('hide');
			if(resp.act==0){
				$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error a nivel de <strong>programaci&oacute;n</strong>.<br><br>Contacta con el administrador.</h4>");
				$('#modal_error').modal('show');
			}else{
				$('#modal_exito .modal-body').html("<h4><img src='imagenes/ico_ok.png' style='margin:0 20px 0 0' />Archivo actualizado correctamente</h4>");
				$('#modal_exito').modal('show');
			}
		},
		error: function(){
			$("#btn_modal_act").prop("disabled",false);
			$("#ico_loading_act").css("display", "none");
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
		url: 'data/archivos_modal.php?ref='+ref,
    dataType: "json",
		success: function(resp){
			$('#modal_del .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El archivo &laquo;<b>"+resp.titulo_1+"</b>&raquo; ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>");
			$('#btn_modal_del').attr({onClick: "del('"+ref+"')"});
		}
	});
	$('#modal_del').modal('show');
	return false;
}

function del(ref){
  $('#btn_modal_del').prop("disabled",true);
  $("#ico_loading_del").css("display", "inline");
	$.ajax({
		url: 'data/archivos_del.php?mod=<? echo $mod; ?>&ref='+ref,
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

//------ SUBIR ------

function subir1(ref,tipo){
  $("#btn_subir1_"+ref).css("display", "none");
  $("#ico_loading_subir1_"+ref).css("display", "inline");
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "data/contenidos_subir1.php?mod=<? echo $mod; ?>&tipo="+tipo+"&ref="+ref,
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

function bajar1(ref,tipo){
  $("#btn_bajar1_"+ref).css("display", "none");
  $("#ico_loading_bajar1_"+ref).css("display", "inline");
  $.ajax({
    type: "POST",
    dataType: "json",
    url: "data/contenidos_bajar1.php?mod=<? echo $mod; ?>&tipo="+tipo+"&ref="+ref,
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

<!-- ---- INSERTAR (formulario) ---- -->

<div id="modal_ins" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_ins" name="form_ins" method="post" role="form" class="form-horizontal form-groups-standar validate" enctype="multipart/form-data">
        <div class="modal-header"><h4 class="modal-title">Insertar archivo</h4></div>
        <div class="modal-body" style="text-align:left;">

          <? if($v1!="no"){ ?>
          <div class="form-group">
            <label class="col-sm-3 control-label"><b class="rojo">*</b> fecha</label>
            <div class="col-sm-3"><input id="fecha" name="fecha" data-validate="required" type="text" class="form-control datepicker" placeholder="dd/mm/aaaa" data-format="dd/mm/yyyy" value="<? echo date('d/m/Y'); ?>"></div>
        	</div>
          <? } ?>

          <? if($v0=="si"){ ?>
          <div class="form-group">
            <label class="col-sm-3 control-label"><b class="rojo">*</b> tipo</label>
          	<div class="col-sm-7">
							<select id="tipo" name="tipo" class="selectboxit visible selectboxit-enabled selectboxit-btn">
								<?
								$sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref_menu=".$mod." ORDER BY orden";
								$rs_tipo = mysqli_query($conn,$sql_tipo);
								while($row_tipo = mysqli_fetch_array($rs_tipo)){
									echo "<option value='".$row_tipo["ref"]."'>".$row_tipo["nombre"]."</option>";
								}
								?>
	            </select>
						</div>
          </div>
          <? } ?>

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
                  echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>&nbsp;nombre";
                }
              ?></label>
              <div class="col-sm-8"><input id="titulo_<? echo $row_idiomas["ref"]; ?>" name="titulo_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?>class="form-control" type="text"></div>
						</div>

            <? if($v6=="si"){ ?>
            <div class="form-group">
              <label class="col-sm-3 control-label"><?
                if(($row_idiomas["ref"]==1)&&(mysqli_num_rows($rs_idiomas)==1)){
                  echo "<b class='rojo'>*</b>&nbsp;descripci&oacute;n";
                }else{
                  if($row_idiomas["ref"]==1){ echo "<b class='rojo'>*</b>&nbsp;";}
                  echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>&nbsp;descripci&oacute;n";
                }
              ?></label>
              <div class="col-sm-9"><input id="intro_<? echo $row_idiomas["ref"]; ?>" name="intro_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?>class="form-control" type="text"></div>
						</div>
            <? } ?>

					<? } ?>

          <? if($v5=="si"){ ?>
          <div class="form-group">
            <label class="col-sm-3 control-label">etiquetas</label>
            <div class="col-sm-9"><select id="etiquetas" name="etiquetas[]" class="select2" multiple data-allow-clear="true">
              <option value="0"></option>
              <?
              $sql_lista_etiquetas = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
              $rs_lista_etiquetas = mysqli_query($conn,$sql_lista_etiquetas);
              while($row_lista_etiquetas = mysqli_fetch_array($rs_lista_etiquetas)){
								$sql_lista_etiquetas_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_lista_etiquetas["ref"]." AND ref_idioma=1";
	              $rs_lista_etiquetas_info = mysqli_query($conn,$sql_lista_etiquetas_info);
	              $row_lista_etiquetas_info = mysqli_fetch_array($rs_lista_etiquetas_info);
								echo "<option value='".$row_lista_etiquetas["ref"]."'>".$row_lista_etiquetas_info["nombre"]."</option>";
              }
              ?>
            </select></div>
          </div>
          <? } ?>

          <div class="form-group">
            <label class="col-sm-3 control-label"><b class="rojo">*</b> documento</label>
            <div class="col-sm-8"><input id="archivo" name="archivo" class="form-control" type="file" data-validate="required"></div>
          </div>
          <div class="col-md-12">
            <progress id="barra_de_progreso" value="0" max="100" style="width:100%;margin-top:10px;display:none;"></progress>
          </div>

        </div>
        <div class="modal-footer">
          <button id="btn_modal_ins" type="submit" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Insertar</button>
          <button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- ---- ACTUALIZAR (formulario) ---- -->

<div id="modal_act" class="modal fade" data-backdrop="static">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="form_act" name="form_act" method="post" role="form" class="form-horizontal form-groups-standar validate" enctype="multipart/form-data">
        <div class="modal-header"><h4 class="modal-title">Actualizar archivo</h4></div>
        <div class="modal-body" style="text-align:left;">

          <? if($v1!="no"){ ?>
          <div class="form-group">
            <label class="col-sm-3 control-label"><b class="rojo">*</b> fecha</label>
            <div class="col-sm-3"><input id="fecha" name="fecha" data-validate="required" type="text" class="form-control datepicker" placeholder="dd/mm/aaaa" data-format="dd/mm/yyyy" value="<? echo date('d/m/Y'); ?>"></div>
        	</div>
          <? } ?>

          <? if($v0=="si"){ ?>
          <div class="form-group">
            <label class="col-sm-3 control-label"><b class="rojo">*</b> tipo</label>
          	<div class="col-sm-7">
							<select id="tipo" name="tipo" class="selectboxit visible selectboxit-enabled selectboxit-btn">
								<?
								$sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref_menu=".$mod." ORDER BY orden";
								$rs_tipo = mysqli_query($conn,$sql_tipo);
								while($row_tipo = mysqli_fetch_array($rs_tipo)){
									echo "<option value='".$row_tipo["ref"]."'>".$row_tipo["nombre"]."</option>";
								}
								?>
	            </select>
						</div>
          </div>
          <? } ?>

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
                  echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>&nbsp;nombre";
                }
              ?></label>
              <div class="col-sm-8"><input id="titulo_<? echo $row_idiomas["ref"]; ?>" name="titulo_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?>class="form-control" type="text"></div>
						</div>

            <? if($v6=="si"){ ?>
            <div class="form-group">
              <label class="col-sm-3 control-label"><?
                if(($row_idiomas["ref"]==1)&&(mysqli_num_rows($rs_idiomas)==1)){
                  echo "<b class='rojo'>*</b>&nbsp;descripci&oacute;n";
                }else{
                  if($row_idiomas["ref"]==1){ echo "<b class='rojo'>*</b>&nbsp;";}
                  echo "<img src='imagenes/idiomas/".$row_idiomas["foto"]."'>&nbsp;descripci&oacute;n";
                }
              ?></label>
              <div class="col-sm-9"><input id="intro_<? echo $row_idiomas["ref"]; ?>" name="intro_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?>class="form-control" type="text"></div>
						</div>
            <? } ?>

					<? } ?>

          <? if($v5=="si"){ ?>
          <div class="form-group">
            <label class="col-sm-3 control-label">etiquetas</label>
            <div class="col-sm-9"><select id="etiquetas" name="etiquetas[]" class="select2" multiple data-allow-clear="true">
              <option value="0"></option>
              <?
							$sql_lista_etiquetas = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
              $rs_lista_etiquetas = mysqli_query($conn,$sql_lista_etiquetas);
              while($row_lista_etiquetas = mysqli_fetch_array($rs_lista_etiquetas)){
								$sql_lista_etiquetas_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_lista_etiquetas["ref"]." AND ref_idioma=1";
	              $rs_lista_etiquetas_info = mysqli_query($conn,$sql_lista_etiquetas_info);
	              $row_lista_etiquetas_info = mysqli_fetch_array($rs_lista_etiquetas_info);
								echo "<option value='".$row_lista_etiquetas["ref"]."'>".$row_lista_etiquetas_info["nombre"]."</option>";
              }
              ?>
            </select></div>
          </div>
          <? } ?>

          <div class="form-group">
            <label class="col-sm-3 control-label"><b class="rojo">*</b> documento</label>
            <div class="col-sm-8"><div id="div_archivo" style="margin-top:3px;"></div></div>
          </div>

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

<!-- ---- ELIMINAR (opciones) ---- -->

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

<!------ EXITO (info) ------>

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

<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/square/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/futurico/futurico.css">
<link rel="stylesheet" href="assets/js/icheck/skins/polaris/polaris.css">
<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="assets/js/jcrop/jquery.Jcrop.min.css">

<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/daterangepicker/moment.min.js"></script>
<script src="assets/js/daterangepicker/daterangepicker.js"></script>
<script src="assets/js/toastr.js"></script>
