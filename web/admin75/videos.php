<?
$cookie1 = "anno_contenido".$mod;
$cookie2 = "tipo_contenido".$mod;

// --- Variable Anno

if(isset($_GET["anno"])==''){

	switch ($v1) {

		case "anno":
			if($_COOKIE[$cookie1]==''){
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
			break;

		case "curso":
			if($_COOKIE[$cookie1]==''){
				$sql_anno = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." ORDER BY fecha DESC";
				$rs_anno = mysqli_query($conn,$sql_anno);
				if(mysqli_num_rows($rs_anno)>0){
					$row_anno = mysqli_fetch_array($rs_anno);
					if ($row_anno[0]==''){
						if(date("m")>8){
							$anno = date("Y")+1;
						}else{
							$anno = date("Y");
						}
					}else{
						if(intval(substr($row_anno[0],5,2))>8){
							$anno = substr($row_anno[0],0,4)+1;
						}else{
							$anno = substr($row_anno[0],0,4);
						}
					}
				}else{
					$anno = date("Y");
				}
			}else{
				$sql_annocookie = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." AND YEAR(fecha)='".$_COOKIE[$cookie1]."' AND MONTH(fecha)>'8' ORDER BY fecha DESC";
				$rs_annocookie = mysqli_query($conn,$sql_annocookie);
				if(mysqli_num_rows($rs_annocookie)>0){
					$anno = $_COOKIE[$cookie1];
				}else{
					$sql_anno = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." ORDER BY fecha DESC";
					$rs_anno = mysqli_query($conn,$sql_anno);
					if(mysqli_num_rows($rs_anno)>0){
						$row_anno = mysqli_fetch_array($rs_anno);
						if ($row_anno[0]==''){
							if(date("m")>8){
								$anno = date("Y")+1;
							}else{
								$anno = date("Y");
							}
						}else{
							if(substr($row_anno[0],5,2)>8){
								$anno = substr($row_anno[0],0,4)+1;
							}else{
								$anno = substr($row_anno[0],0,4);
							}
						}
					}else{
						$anno = date("Y");
					}
				}
			}
			break;

		case "no":
			$anno = date("Y");
			break;
	}

}else{
	$anno = $_GET["anno"];
}

// --- Variable Tipo

if(isset($_GET["tipo"])==""){
	if($_COOKIE[$cookie2]==''){
		$tipo = 0;
	}else{
		$tipo = $_COOKIE[$cookie2];
	}
}else{
	$tipo = $_GET["tipo"];
}

echo "<script>CambiaCookie('".$cookie1."','".$anno."');</script>"; //anno_contenido
echo "<script>CambiaCookie('".$cookie2."','".$tipo."');</script>"; //tipo_contenido

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

// -- orden
$sql_v3 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=3";
$rs_v3 = mysqli_query($conn,$sql_v3);
if(mysqli_num_rows($rs_v3)>0){
	$row_v3 = mysqli_fetch_array($rs_v3);
	$v3 = $row_v3["opcion"];
}else{
	$v3 = "no";
}

// ----------------- FIN VARIABLES
?>

<nav id="contenedor_sup" class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
    <button type="button" class="btn btn-default btn-icon icon-left" onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=ins'">Insertar vídeo<i class="entypo-plus-circled"></i></button></li>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <? include("include/camino_migas.php"); ?>
  <div class="clearfix"></div>

  <? if($v0=="si" || $v1!="no"){ ?>

	<form class="cuadro_filtro">

    <div class="form-group">

      <!-- select año -->
      <? if($v1=="anno"){ ?>
	      <div class="col-md-2">
	        <select name="anno" onchange="MM_jumpMenu('parent',this,0)" class="selectboxit visible selectboxit-enabled selectboxit-btn">
	          <?
	          $sql_anno = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." GROUP BY YEAR(fecha) ORDER BY fecha DESC";
	          $rs_anno = mysqli_query($conn,$sql_anno);
	          while ($row_anno = mysqli_fetch_array($rs_anno)){
							echo "<option ";
							if ($anno==substr($row_anno[0],0,4)){ echo "selected"; }
							echo" value='".$_SERVER['PHP_SELF']."?mod=".$mod."&anno=".substr($row_anno[0],0,4);
							if($v0=="si"){ echo "&tipo=".$tipo; }
							echo "'>".substr($row_anno[0],0,4)."</option>";
	          }
	          ?>
	        </select>
	      </div>
      <? } ?>

      <!-- select curso -->
	    <? if($v1=="curso"){ ?>
	      <div class="col-md-2">
	        <select name="cursos" onchange="MM_jumpMenu('parent',this,0)" class="selectboxit">
	          <?
	          $ult_fin = 0;

	          $sql_anno = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." ORDER BY fecha DESC";
	          $rs_anno = mysqli_query($conn,$sql_anno);
	          while($row_anno = mysqli_fetch_array($rs_anno)){

	            $mes = intval(substr($row_anno[0],5,2));

	            if($mes>8){

	              $anno_ini = intval(substr($row_anno[0],0,4));
	              $anno_fin = $anno_ini+1;

	              if($anno_fin!=$ult_fin){
	                echo "<option ";
	                if ($anno_fin==$anno){ echo "selected"; }
	                echo " value='".$_SERVER['PHP_SELF']."?mod=".$mod."&anno=".$anno_fin;
	                if($v0=="si"){ echo "&tipo=".$tipo; }
	                echo "'>".$anno_ini."/".$anno_fin."</option>";
	                $ult_fin = $anno_fin;
	              }

	            }else{

	              $anno_fin = intval(substr($row_anno[0],0,4));
	              $anno_ini = $anno_fin-1;

	              if($anno_fin!=$ult_fin){
	                echo "<option ";
	                if ($anno_fin==$anno){ echo "selected"; }
	                echo " value='".$_SERVER['PHP_SELF']."?mod=".$mod."&anno=".$anno_fin;
	                if($v0=="si"){ echo "&tipo=".$tipo; }
	                echo "'>".$anno_ini."/".$anno_fin."</option>";
	                $ult_fin = $anno_fin;
	              }
	            }
	          } //while
	          ?>
	        </select>
	      </div>
      <? } ?>

      <!-- select tipo -->
      <? if($v0=="si"){ ?>
	      <div class="col-md-4">
	        <select name="tipo" onChange="MM_jumpMenu('parent',this,0)" class="selectboxit">
	          <option value="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?>&anno=<? echo $anno; ?>&tipo=0"></option>
	          <?
	          $sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref_menu=".$mod." ORDER BY orden";
	          $rs_tipo = mysqli_query($conn,$sql_tipo);
	          while ($row_tipo = mysqli_fetch_array($rs_tipo)){
	            echo "<option ";
	            if ($tipo==$row_tipo["ref"]){ echo "selected"; }
	            echo" value='".$_SERVER['PHP_SELF']."?mod=".$mod;
	            if($v0!="no"){ echo "&anno=".$anno; }
	            echo "&tipo=".$row_tipo["ref"]."'>".$row_tipo["nombre"]."</option>";
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

						<!-- título -->
            <th>t&iacute;tulo</th>

						<!-- tipo -->
						<? if($v0=="si"){ ?>
							<th>tipo</th>
            <? } ?>

						<!-- ver -->
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
			switch ($v1) {

				case "anno":
					$sql = "SELECT * FROM contenidos WHERE ref_menu=".$mod." AND YEAR(fecha)=".$anno;
					if(($v0=="si")&&($tipo!=0)){ $sql.= " AND ref_tipo=".$tipo; }
					$sql.= " ORDER BY fecha DESC, ref DESC";
					break;

				case "curso":
					$anno_ant = $anno-1;
					$sql = "SELECT * FROM contenidos WHERE ref_menu=".$mod." AND ((YEAR(fecha)='".$anno."' AND MONTH(fecha)<9) OR (YEAR(fecha)='".$anno_ant."' AND MONTH(fecha)>8))";
					if(($v0=="si")&&($tipo!=0)){ $sql.= " AND ref_tipo=".$tipo; }
					$sql.= " ORDER BY fecha DESC, ref DESC";
					break;

				case "no":
					$sql = "SELECT * FROM contenidos WHERE ref_menu=".$mod;
					if(($v0=="si")&&($tipo!=0)){ $sql.= " AND ref_tipo=".$tipo; }
					if($v3=="si"){
						$sql.= " ORDER BY orden";
					}else{
						$sql.= " ORDER BY ref";
					}
					break;
				}

				$rs = mysqli_query($conn,$sql);
				$cta_parametros = mysqli_num_rows($rs);
				while($row = mysqli_fetch_array($rs)){
					?>
					<tr>

            <!-- fecha -->
            <? if($v1!="no"){ ?>
              <td><span class="gris"><b><? echo cambiarf_a_normal($row["fecha"]); ?></b></span></td>
            <? } ?>

            <!-- título -->
            <td>
              <?
              $sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row["ref"]." AND ref_idioma=1";
              $rs_info = mysqli_query($conn,$sql_info);
              $row_info = mysqli_fetch_array($rs_info);
              ?>
              <strong><a href="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?>&ref=<? echo $row[0]; ?>&secc=act"><i class='entypo-pencil'></i><?  echo $row_info["titulo"]; ?></a></strong>
            </td>

						<!-- tipo -->
            <? if($v0=="si"){ ?>
							<td>
	              <?
	              $sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref=".$row["ref_tipo"];
	              $rs_tipo = mysqli_query($conn,$sql_tipo);
	              $row_tipo = mysqli_fetch_array($rs_tipo);
	              echo $row_tipo["nombre"];
	              ?>
	            </td>
            <? } ?>

            <!-- ver -->
            <td>
              <a href="http://es.youtube.com/watch?v=<? echo $row["codigo"]; ?>" target="_blank">
								<button type="button" class="btn btn-default btn-xs" title="ver &laquo;<? echo $row_info["titulo"]; ?>&raquo;"><i class="entypo-play"></i></button>
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
  	</div><!-- col-md-12 -->
  </div><!-- row -->

</div><!-- cuerpo -->

<script>

//--------- ELIMINAR ---------

function modalDel(ref){
	$.ajax({
		url: 'data/contenidos_modal.php?ref='+ref,
    dataType: "json",
		success: function(resp){
			$('#modal_del .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El vídeo «<b>"+resp.titulo+"</b>» ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>");
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
		url: 'data/videos_del.php?mod=<? echo $mod; ?>&ref='+ref,
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
