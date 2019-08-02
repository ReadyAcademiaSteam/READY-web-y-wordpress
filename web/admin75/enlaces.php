<?
// ----------------- VARIABLES

// -- tipo
$sql_v0 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=0";
$rs_v0 = mysqli_query($conn,$sql_v0);
if(mysqli_num_rows($rs_v0)>0){
	$row_v0 = mysqli_fetch_array($rs_v0);
	$v0 = $row_v0["opcion"];
}else{
	$v0 = "si";
}

// -- orden
$sql_v3 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=3";
$rs_v3 = mysqli_query($conn,$sql_v3);
if(mysqli_num_rows($rs_v3)>0){
	$row_v3 = mysqli_fetch_array($rs_v3);
	$v3 = $row_v3["opcion"];
}else{
	$v3 = "si";
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

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
		<? if($v5=="si"){ ?><button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=etiquetas';" type="button" class="btn btn-blue btn-icon icon-left">Etiquetas<i class="entypo-tag"></i></button></li><? } ?>
    <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=ins'" type="button" class="btn btn-default btn-icon icon-left">Insertar enlace<i class="entypo-plus-circled"></i></button></li>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <? include("include/camino_migas.php"); ?>
  <div class="clearfix"></div>

  <?
  if($v0=="si"){
    $sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref_menu=".$mod." ORDER BY orden";
    $rs_tipo = mysqli_query($conn,$sql_tipo);
    while($row_tipo = mysqli_fetch_array($rs_tipo)){
      $sql = "SELECT * FROM contenidos WHERE ref_menu=".$mod." AND ref_tipo=".$row_tipo["ref"];
      if($v3=="no"){
        $sql = $sql." ORDER BY ref";
      }else{
        $sql = $sql." ORDER BY orden";
      }
      $rs = mysqli_query($conn,$sql);
      $cta_parametros = mysqli_num_rows($rs);

      if(mysqli_num_rows($rs)!=0){
        ?>
        <div class="panel panel-gradient panel-shadow" data-collapsed="0">
	        <div class="panel-heading">
	          <div class="panel-title"><? echo $row_tipo["nombre"]; ?></div>
	          <div class="panel-options">
	            <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
	            <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
	          </div>
	        </div>
	        <div class="panel-body">
	          <table class="table table-condensed table-striped">
	            <tbody>

	              <? while($row = mysqli_fetch_array($rs)){ ?>
	                <tr>

										<!-- título -->
	                  <td>
		                  <?
	                    $sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row["ref"]." AND ref_idioma=1";
	                    $rs_info = mysqli_query($conn,$sql_info);
	                    $row_info = mysqli_fetch_array($rs_info);
		                  ?>
		                  <strong><a href="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?>&ref=<? echo $row[0]; ?>&secc=act"><i class='entypo-pencil'></i><?  echo $row_info["titulo"]; ?></a></strong>
	                  </td>

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

										<!-- orden -->
	                  <? if($v3=="si"){ ?>
	                  	<td style="text-align:center;">
	                      <?
	                      if($row["orden"]>1){
													echo "<img id='ico_loading_subir1_".$row["ref"]."' src='imagenes/loading.gif' style='display:none;margin-right:7px;'>";
	                        echo "<button id='btn_subir1_".$row["ref"]."' onclick=\"subir1('".$row["ref"]."','".$row["ref_tipo"]."');\" type='button' class='btn btn-default btn-xs' title='subir'><i class='entypo-up-open'></i></button>";
	                      }else{
	                        echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-up-open'></i></button>";
	                      }
	                      if($row["orden"]<$cta_parametros){
													echo "<img id='ico_loading_bajar1_".$row["ref"]."' src='imagenes/loading.gif' style='display:none;margin-right:7px;'>";
	                        echo "<button id='btn_bajar1_".$row["ref"]."' onclick=\"bajar1('".$row["ref"]."','".$row["ref_tipo"]."');\" type='button' class='btn btn-default btn-xs' title='bajar'><i class='entypo-down-open'></i></button>";
	                      }else{
	                        echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-down-open'></i></button>";
	                      }
	                      ?>
	                  	</td>
	                  <? } ?>

										<!-- enlace -->
	                  <th>
	                    <button onclick="window.open('http://<? echo $row["enlace"]; ?>','_blank');" type="button" class="btn btn-default btn-xs" title="visitar &laquo;<? echo $row_info["titulo"]; ?>&raquo;"><i class="entypo-globe"></i></button>
	                  </th>

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
      	<?
      }
    }

  }else{

    $sql = "SELECT * FROM contenidos WHERE ref_menu=".$mod;
    if($v3=="no"){
      $sql.= " ORDER BY nombre";
    }else{
      $sql.= " ORDER BY orden";
    }
    $rs = mysqli_query($conn,$sql);
    $cta_parametros = mysqli_num_rows($rs);
    if(mysqli_num_rows($rs)!=0){
		  ?>
      <div class="panel panel-gradient panel-shadow" data-collapsed="0">
        <div class="panel-heading">
					<div class="panel-title">Enlaces</div>
					<div class="panel-options">
					  <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					  <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					</div>
        </div>
        <div class="panel-body">
        	<table class="table table-condensed table-striped">
            <tbody>

              <? while($row = mysqli_fetch_array($rs)){ ?>
                <tr>

                  <!-- título -->
                  <td>
                  	<?
                    $sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row["ref"]." AND ref_idioma=1";
                    $rs_info = mysqli_query($conn,$sql_info);
                    $row_info = mysqli_fetch_array($rs_info);
                    ?>
                    <strong><a href="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?>&ref=<? echo $row[0]; ?>&secc=act"><i class='entypo-pencil'></i><?  echo $row_info["titulo"]; ?></a></strong>
                  </td>

									<!-- etiquetas -->
			            <?
			            if($v5=="si"){
			              $etiquetas = "";
			              $sql_etiq = "SELECT * FROM contenidos_rel_etiquetas WHERE ref_contenido=".$row["ref"];
			              $rs_etiq = mysqli_query($conn,$sql_etiq);
			              while($row_etiq = mysqli_fetch_array($rs_etiq)){
			                $sql_etiq_info = "SELECT * FROM etiquetas WHERE ref=".$row_etiq["ref_etiqueta"];
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

                  <!-- orden -->
                  <? if($v3=="si"){ ?>
                  	<td style="text-align:center;">
                      <?
                      if($row["orden"]>1){
												echo "<img id='ico_loading_subir1_".$row["ref"]."' src='imagenes/loading.gif' style='display:none;margin-right:7px;'>";
                        echo "<button id='btn_subir1_".$row["ref"]."' onclick=\"subir1('".$row["ref"]."','0');\" type='button' class='btn btn-default btn-xs' title='subir'><i class='entypo-up-open'></i></button>";
                      }else{
                        echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-up-open'></i></button>";
                      }
                      if($row["orden"]<$cta_parametros){
												echo "<img id='ico_loading_bajar1_".$row["ref"]."' src='imagenes/loading.gif' style='display:none;margin-right:7px;'>";
                        echo "<button id='btn_bajar1_".$row["ref"]."' onclick=\"bajar1('".$row["ref"]."','0');\" type='button' class='btn btn-default btn-xs' title='bajar'><i class='entypo-down-open'></i></button>";
                      }else{
                        echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-down-open'></i></button>";
                      }
                      ?>
                  	</td>
                  <? } ?>

                  <!-- enlace -->
                  <th>
                    <button onclick="window.open('http://<? echo $row["enlace"]; ?>','_blank');" type="button" class="btn btn-default btn-xs" title="visitar &laquo;<? echo $row_info["titulo"]; ?>&raquo;"><i class="entypo-globe"></i></button>
                  </th>

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
			<?
    }
  }
  ?>

</div>

<script>

//--------- ELIMINAR ---------

function modalDel(ref){
  $.ajax({
    url: 'data/contenidos_modal.php?ref='+ref,
    dataType: "json",
    success: function(resp){
      $('#modal_del .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El enlace <b>&laquo;"+resp.titulo+"&raquo;</b> ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>");
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
    url: 'data/enlaces_del.php?mod=<? echo $mod; ?>&ref='+ref,
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

<? if($v3=="si"){ ?>

  //------ SUBIR ------

  function subir1(ref,tipo){
		$("#btn_subir1_"+ref).css("display", "none");
	  $("#ico_loading_subir1_"+ref).css("display", "inline");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/contenidos_subir1.php?mod=<? echo $mod; ?>&ref="+ref+"&tipo="+tipo,
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
      url: "data/contenidos_bajar1.php?mod=<? echo $mod; ?>&ref="+ref+"&tipo="+tipo,
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

<? } ?>

</script>

<!-- ------------------------------------------ VENTANAS MODALES ------------------------------------------ -->

<!------ ELIMINAR (ociones) ------>

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
