<script src="include/upload.js"></script>

<?
$ref = $_GET["mod"];

// ----------------- VARIABLES

// -- foto
$sql_v4 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=4";
$rs_v4 = mysqli_query($conn,$sql_v4);
if(mysqli_num_rows($rs_v4)>0){
	$row_v4 = mysqli_fetch_array($rs_v4);
	$v4 = $row_v4["opcion"];
}else{
	$v4 = "si";
}

// -- alineación foto ppal
$sql_v40 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=40";
$rs_v40 = mysqli_query($conn,$sql_v40);
if(mysqli_num_rows($rs_v40)>0){
	$row_v40 = mysqli_fetch_array($rs_v40);
	$v40 = $row_v40["opcion"];
}else{
	$v40 = "no";
}

// -- pie de foto
$sql_v41 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=41";
$rs_v41 = mysqli_query($conn,$sql_v41);
if(mysqli_num_rows($rs_v41)>0){
	$row_v41 = mysqli_fetch_array($rs_v41);
	$v41 = $row_v41["opcion"];
}else{
	$v41 = "no";
}

// -- foto 2
$sql_v42 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=42";
$rs_v42 = mysqli_query($conn,$sql_v42);
if(mysqli_num_rows($rs_v42)>0){
	$row_v42 = mysqli_fetch_array($rs_v42);
	$v42 = $row_v42["opcion"];
}else{
	$v42 = "no";
}

// -- foto 3
$sql_v43 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=43";
$rs_v43 = mysqli_query($conn,$sql_v43);
if(mysqli_num_rows($rs_v43)>0){
	$row_v43 = mysqli_fetch_array($rs_v43);
	$v43 = $row_v43["opcion"];
}else{
	$v43 = "no";
}

// -- docs
$sql_v5 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=5";
$rs_v5 = mysqli_query($conn,$sql_v5);
if(mysqli_num_rows($rs_v5)>0){
	$row_v5 = mysqli_fetch_array($rs_v5);
	$v5 = $row_v5["opcion"];
}else{
	$v5 = "no";
}

// -- galería
$sql_v6 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=6";
$rs_v6 = mysqli_query($conn,$sql_v6);
if(mysqli_num_rows($rs_v6)>0){
	$row_v6 = mysqli_fetch_array($rs_v6);
	$v6 = $row_v6["opcion"];
}else{
	$v6 = "no";
}

// -- intro
$sql_v7 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=7";
$rs_v7 = mysqli_query($conn,$sql_v7);
if(mysqli_num_rows($rs_v7)>0){
	$row_v7 = mysqli_fetch_array($rs_v7);
	$v7 = $row_v7["opcion"];
}else{
	$v7 = "no";
}

// -- texto
$sql_v8 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=8";
$rs_v8 = mysqli_query($conn,$sql_v8);
if(mysqli_num_rows($rs_v8)>0){
	$row_v8 = mysqli_fetch_array($rs_v8);
	$v8 = $row_v8["opcion"];
}else{
	$v8 = "si";
}

// -- texto2
$sql_v9 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=9";
$rs_v9 = mysqli_query($conn,$sql_v9);
if(mysqli_num_rows($rs_v9)>0){
	$row_v9 = mysqli_fetch_array($rs_v9);
	$v9 = $row_v9["opcion"];
}else{
	$v9 = "no";
}

// -- título
$sql_v13 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=13";
$rs_v13 = mysqli_query($conn,$sql_v13);
if(mysqli_num_rows($rs_v13)>0){
	$row_v13 = mysqli_fetch_array($rs_v13);
	$v13 = $row_v13["opcion"];
}else{
	$v13 = "no";
}

// -- seo
$sql_v17 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=17";
$rs_v17 = mysqli_query($conn,$sql_v17);
if(mysqli_num_rows($rs_v17)>0){
	$row_v17 = mysqli_fetch_array($rs_v17);
	$v17 = $row_v17["opcion"];
}else{
	$v17 = "no";
}

// ----------------- FIN VARIABLES
?>

<?
$sql = "SELECT * FROM contenidos WHERE ref=".$ref;
$rs = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($rs);

$sql_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=1";
$rs_info = mysqli_query($conn,$sql_info);
$row_info = mysqli_fetch_array($rs_info);
?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
		<img id="ico_loading" src="imagenes/loading.gif" style="display:none;">
    <? if($v4=="si" || $v7=="si" || $v8=="si" || $v9=="si" || $v13=="si" || $v17=="si"){ ?><button id="btn_act" type="button" class="btn btn-green btn-icon icon-left">Actualizar<i class="entypo-check"></i></button><? } ?>
	  <? if($v5=="si"){ ?><button id="btn_doc_ins" type="button" class="btn btn-default btn-icon icon-left">Insertar documento<i class="entypo-doc-text"></i></button><? } ?>
    <? if($v6=="si"){ ?>
      <button id="btn_ins_gal" type="button" class="btn btn-default btn-icon icon-left">Insertar im&aacute;genes<i class="entypo-picture"></i></button>
      <button id="btn_ord_gal" type="button" class="btn btn-green btn-icon icon-left">Ordenar galer&iacute;a<i class="entypo-list"></i></button>
    <? } ?>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <?
	$camino = $row_info["titulo"];
	include("include/camino_migas.php");
  ?>
  <div class="clearfix"></div>

  <? if($v4=="si" || $v7=="si" || $v8=="si" || $v9=="si" || $v13=="si" || $v17=="si"){ ?>
  <div id="panel_contenido" class="panel panel-gradient panel-shadow" data-collapsed="0">

    <div class="panel-heading">
      <div class="panel-title">Contenidos</div>
      <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
      </div>
    </div>

    <div class="panel-body">

      <? if((($v4=="si")||($v42=="si")||($v43=="si")) && (($v7=="si")||($v8=="si")||($v9=="si")||($v17=="si"))){ ?>
      <div class="col-lg-10 col-sm-8">
      <? } ?>

      <form id="form_act" name="form_act" method="post" role="form" class="form-horizontal form-groups-standar validate">

		    <?
        $sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
        $rs_idiomas = mysqli_query($conn,$sql_idiomas);
        while($row_idiomas = mysqli_fetch_array($rs_idiomas)){

          $sql_info_idiomas = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=".$row_idiomas["ref"];
          $rs_info_idiomas = mysqli_query($conn,$sql_info_idiomas);
          $row_info_idiomas = mysqli_fetch_array($rs_info_idiomas);

			    if(mysqli_num_rows($rs_idiomas)>1){ ?>
          <div class="col-sm-12 cabecera_idioma"><img src="imagenes/idiomas/<? echo $row_idiomas["foto"]; ?>" /><? echo $row_idiomas["nombre"]; ?></div>
          <? } ?>

          <? if($v13=="si"){ ?>
          <div class="form-group">
            <label for="field-1" class="col-sm-2 control-label"><? if($row_idiomas["ref"]==1){ ?><b class="rojo">*</b> <? } ?>t&iacute;tulo</label>
            <div class="col-sm-9"><input name="titulo_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" value="<? echo $row_info_idiomas["titulo"];?>" placeholder="t&iacute;tulo"<? if($row_idiomas["ref"]==1){ echo " autofocus"; } ?>></div>
          </div>
          <? } ?>

          <? if($v7=="si"){ ?>
          <div class="form-group">
            <label for="field-1" class="col-sm-2 control-label">intro</label>
            <div class="col-sm-10"><input name="intro_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" value="<? echo $row_info_idiomas["intro"];?>" placeholder="intro"></div>
          </div>
          <? } ?>

          <? if($v8=="si"){ ?>
          <div class="form-group">
            <label for="field-1" class="col-sm-2 control-label">texto</label>
            <div class="col-sm-10"><textarea name="texto_<? echo $row_idiomas["ref"]; ?>" class="form-control ckeditor" rows="25"><? echo $row_info_idiomas["texto"]; ?></textarea></div>
          </div>
          <? } ?>

					<? if($v9=="si"){ ?>
            <div class="form-group">
              <label class="col-sm-2 control-label">texto 2</label>
              <div class="col-sm-10"><textarea name="texto2_<? echo $row_idiomas["ref"]; ?>" class="form-control ckeditor" rows="25"><? echo $row_info_idiomas["texto2"]; ?></textarea></div>
			      </div>
          <? } ?>

          <? if($v17=="si"){ ?>
	          <div class="col-sm-12" style="border-bottom:solid 1px #CCC;margin-bottom:20px;">SEO</strong></div>
	          <div class="form-group">
	            <label for="field-1" class="col-sm-2 control-label">title</label>
	            <div class="col-sm-10"><input name="title_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" value="<? echo $row_info_idiomas["seo_title"]; ?>" /></div>
	          </div>
	          <div class="form-group">
	            <label for="field-1" class="col-sm-2 control-label">descripci&oacute;n</label>
	            <div class="col-sm-10"><input name="description_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" value="<? echo $row_info_idiomas["seo_descripcion"]; ?>" /></div>
	          </div>
          <? } ?>

        <? } ?>
      </form>

    <? if((($v4=="si")||($v42=="si")||($v43=="si")) && (($v7=="si")||($v8=="si")||($v9=="si")||($v17=="si"))){ ?>

    </div>

    <div class="col-lg-2 col-sm-4">

    <? } ?>

	  <? if($v4=="si"){ ?>
		<div class="col-sm-12" style="text-align:center;">
      <? if($row["foto"]!=""){ ?>
        <div class="gallery-env">
          <article class="image-thumb">
            <div class="image-options">
              <? if(($row["foto"]!="")&&($v41=="si")){ ?><a id="btn_txt_foto1" style="cursor:pointer" class="edit"><i class="entypo-pencil"></i></a><? } ?>
              <a id="btn_del_foto1" style="cursor:pointer" class="delete"><i class="entypo-cancel"></i></a>
            </div>
            <div class="galeria">
							<a href="../imagenes/contenidos/<? echo $row["foto"]; ?>" title="<?
	              if($row_info["pie"]){
	                echo $row_info["pie"];
	              }else{
	                if($row_info["titulo"]){
	                  echo $row_info["titulo"];
	                }else{
	                  echo $row_mod["nombre"];
	                }
	              }
		            ?>">
	            	<div align="center"><img src="../imagenes/contenidos/0/<? echo $row["foto"]; ?>" style="margin:8px 0;" class="img-responsive"></div>
	            </a>
						</div>
          </article>
        </div>
			<? } ?>
      <form id="ins_foto1" name="ins_foto1" method="post" role="form" enctype="multipart/form-data">
        <progress id="barra_de_progreso_foto1" value="0" max="100" style="width:100%;margin-top:10px;display:none;"></progress>
        <input id="foto1" name="foto1" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <? if($row["foto"]!=""){ echo "cambiar&nbsp;foto"; }else{ echo "insertar&nbsp;foto"; } ?>" />
      </form>

      <? if(($row["foto"]!="")&&($v40=="si")){ ?>
				<br />
        <select id="align_foto1" name="align_foto1" class="selectboxit visible selectboxit-enabled selectboxit-btn">
          <option value="right"<? if ($row["align"]=="right"){ echo " selected"; }?>>derecha</option>
          <option value="center"<? if ($row["align"]=="center"){ echo " selected"; }?>>centro</option>
          <option value="left"<? if ($row["align"]=="left"){ echo " selected"; }?>>izquierda</option>
					<img id="ico_loading_foto1_align" src="imagenes/loading.gif" style="display:none;">
        </select>
      <? } ?>
    </div>
	  <? } ?>

	  <? if($v42=="si"){?>
      <div class="col-sm-12 cabecera_idioma clearfix" style="text-align:center;margin-top:30px;">foto 2</div>
		  <div class="col-sm-12" style="text-align:center;">
			  <? if($row["foto2"]!=""){ ?>
        <div class='gallery-env'>
          <article class='image-thumb'>
            <div class="image-options">
              <a id="btn_del_foto2" style="cursor:pointer" class="delete"><i class="entypo-cancel"></i></a>
            </div>
            <div class='galeria'><a href='../imagenes/contenidos/<? echo $row["foto2"]; ?>' title='<? echo $row_info["titulo"]; ?>'>
            <div align="center"><img src="../imagenes/contenidos/0/<? echo $row["foto2"]; ?>" style="margin:8px 0;" class="img-responsive"></div>
            </a></div>
          </article>
        </div>
        <? } ?>
        <form id="ins_foto2" name="ins_foto2" method="post" role="form" enctype="multipart/form-data">
          <progress id="barra_de_progreso_foto2" value="0" max="100" style="width:100%;margin-top:10px;display:none;"></progress>
          <input id="foto2" name="foto2" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <? if($row["foto2"]!=""){ echo "cambiar foto 2"; }else{ echo "insertar foto 2"; } ?>" />
        </form>
      </div>
    <? } ?>

    <? if($v43=="si"){?>
      <div class="col-sm-12 cabecera_idioma clearfix" style="text-align:center;margin-top:30px;">foto 3</div>
		  <div class="col-sm-12" style="text-align:center;">
			  <? if($row["foto3"]!=""){ ?>
          <div class="gallery-env">
            <article class="image-thumb">
              <div class="image-options">
                <a id="btn_del_foto3" style="cursor:pointer" class="delete"><i class="entypo-cancel"></i></a>
              </div>
              <div class="galeria"><a href='../imagenes/contenidos/<? echo $row["foto3"]; ?>' title='<? echo $row_info["titulo"]; ?>'>
              <div align="center"><img src="../imagenes/contenidos/0/<? echo $row["foto3"]; ?>" style="margin:8px 0;" class="img-responsive"></div>
              </a></div>
            </article>
          </div>
			  <? } ?>
        <form id="ins_foto3" name="ins_foto3" method="post" role="form" enctype="multipart/form-data">
          <progress id="barra_de_progreso_foto3" value="0" max="100" style="width:100%;margin-top:10px;display:none;"></progress>
          <input id="foto3" name="foto3" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <? if($row["foto3"]!=""){ echo "cambiar foto 3"; }else{ echo "insertar foto 3"; } ?>" />
        </form>
      </div>
    <? } ?>

    <? if(($v4=="si") || ($v42=="si") || ($v43=="si")){ ?>
    </div>
    <? } ?>

    </div>

  </div>
  <? } ?>

	<!-- ------------------ DOCUMENTOS ------------------ -->

  <? if($v5=="si"){ ?>
  <div class="panel panel-gradient panel-shadow" data-collapsed="0">
    <div class="panel-heading">
      <div class="panel-title">Documentos</div>
      <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
      </div>
    </div>
    <div class="panel-body">
      <?
      $sql_doc = "SELECT * FROM contenidos_docs WHERE ref_contenido='".$ref."' ORDER BY orden";
      $rs_doc = mysqli_query($conn,$sql_doc);
      $cta_parametros = mysqli_num_rows($rs_doc);
      if($cta_parametros>0){
        ?>
        <table class="table table-condensed table-striped">
          <tbody>
            <?
            while ($row_doc = mysqli_fetch_array($rs_doc)){
              $sql_doc_info = "SELECT * FROM contenidos_docs_info WHERE ref_doc=".$row_doc["ref"]." AND ref_idioma=1";
              $rs_doc_info = mysqli_query($conn,$sql_doc_info);
              $row_doc_info = mysqli_fetch_array($rs_doc_info);
              ?>
              <tr>
                <?
                echo "<td><b><a onclick='modalAct_doc(".$row_doc["ref"].");' style='cursor:pointer'>".$row_doc_info["nombre"]."</a></b></td>";

                echo "<td>";
                if($row_doc["orden"]>1){
									echo "<img id='ico_loading_subir1_".$row_doc["ref"]."_doc' src='imagenes/loading.gif' style='display:none;margin-right:7px;'>";
                  echo "<button id='btn_subir1_".$row_doc["ref"]."_doc' onclick=\"subir1_doc('".$row_doc["ref"]."');\" type='button' class='btn btn-default btn-xs' title='subir'><i class='entypo-up-open'></i></button>";
                }else{
                  echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-up-open'></i></button>";
                }
                if($row_doc["orden"]<$cta_parametros){
									echo "<img id='ico_loading_bajar1_".$row_doc["ref"]."_doc' src='imagenes/loading.gif' style='display:none;margin-left:7px;'>";
                  echo "<button id='btn_bajar1_".$row_doc["ref"]."_doc' onclick=\"bajar1_doc('".$row_doc["ref"]."');\" type='button' class='btn btn-default btn-xs' title='bajar'><i class='entypo-down-open'></i></button>";
                }else{
                  echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-down-open'></i></button>";
                }
                echo "</td>";

                echo "<td><a href='../archivos/contenidos/documentos/".$row_doc["archivo"]."' target='_blank'><button type='button' class='btn btn-blue btn-xs btn-icon icon-left'><i class='entypo-doc-text'></i>ver documento</button></td>";
                ?>

                <td align="right">
                  <button onclick="modalDel_doc('<? echo $row_doc["ref"]; ?>');" type="button" class="btn btn-danger btn-xs" title="eliminar &laquo;<? echo $row_doc_info["nombre"]; ?>&raquo;"><i class="entypo-cancel"></i></button>
                </td>

              </tr>
            <? } ?>
          </tbody>
        </table>
      <? } ?>
    </div>
  </div>
  <? } ?>

	<!-- ------------------ GALERÍA DE FOTOS ------------------ -->

  <? if($v6=="si"){ ?>
  <div class="panel panel-gradient panel-shadow" data-collapsed="0">
    <div class="panel-heading">
      <div class="panel-title">Galer&iacute;a de im&aacute;genes</div>
      <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
      </div>
    </div>
    <div class="panel-body">
      <div class="gallery-env">
				<form id="form_gal" name="form_gal" action="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?>&ref=<? echo $ref; ?>&secc=act&accion=actualizar_galeria" method="post">
					<?
	        $sql_gal = "SELECT * FROM contenidos_fotos WHERE ref_contenido=".$ref." ORDER BY orden, ref";
	        $rs_gal = mysqli_query($conn,$sql_gal);
	        $total_foto = mysqli_num_rows($rs_gal);
	        if (mysqli_num_rows($rs_gal)!=0){
	          $cta_foto = 1;
	          while($row_gal = mysqli_fetch_array($rs_gal)){
	            ?>
	            <div id="foto<? echo $row_gal["ref"]; ?>" class="col-lg-2 col-sm-2 col-xs-4">
	              <article class="image-thumb">
	                <?
	                echo "<div class='galeria'><a href='../imagenes/contenidos/galerias/".$row_gal["foto"]."' class='image' title='";
	                $sql_foto_info = "SELECT * FROM contenidos_fotos_info WHERE ref_foto=".$row_gal["ref"]." AND ref_idioma=1";
	                $rs_foto_info = mysqli_query($conn,$sql_foto_info);
	                $row_foto_info = mysqli_fetch_array($rs_foto_info);
	                if($row_foto_info["nombre"]==''){
	                  echo $row_info["titulo"];
	                }else{
	                  echo $row_foto_info["nombre"];
	                }
	                echo "'><img src='../imagenes/contenidos/galerias/0/".$row_gal["foto"]."' border='0'/></a></div>";
	                ?>
	                <div class="image-options">
	                  <?
	                  echo "<select id='orden".$row_gal["ref"]."' name='orden".$row_gal["ref"]."'>";
	                  for($i=1;$i<=$total_foto;$i++){
	                    echo "<option value='".$i."'";
	                    if($row_gal["orden"]==$i){ echo " selected"; }
	                    echo ">".$i."</option>";
	                  }
	                  echo "</select>";
	                  ?>
	                  <a onclick="modalAct_gal('<? echo $row_gal["ref"]; ?>');" style="cursor:pointer" class="edit"><i class="entypo-pencil"></i></a>
	                  <a onclick="modalDel_gal('<? echo $row_gal["ref"]; ?>');" style="cursor:pointer" class="delete"><i class="entypo-cancel"></i></a>
	                </div>
	              </article>
	            </div>
	            <?
            }
            $cta_foto++;
          }
          ?>
				</form>
      </div>
    </div>

  </div>
  <? } ?>

</div>

<script>
$(document).ready(function(){

	$("#btn_act").click(function(){
    if(!$("#form_act").valid()) return false;
		$("#btn_act").prop("disabled",true);
		$("#ico_loading").css("display", "inline");
    $.ajax({
      type: "POST",
      dataType: "json",
      url: "data/contenidos_act.php?mod=<? echo $mod; ?>&ref=<? echo $ref; ?>&tipo=fijo",
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
				<h4><img src="imagenes/ico_ok.png" style="margin:0 20px 0 0" />Contenido actualizado correctamente</h4>
			</div>
      <div class="modal-footer">
        <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>'" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-pencil"></i>Aceptar</button>
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
				<button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cerrar y volver a intentarlo</button>
      </div>
		</div>
  </div>
</div>

<? if($v4=="si"){ include("util_contenidos_foto.php"); } ?>
<? if($v5=="si"){ include("util_contenidos_doc.php"); } ?>
<? if($v6=="si"){ include("util_contenidos_gal.php"); }  ?>

<link rel="stylesheet" href="assets/js/daterangepicker/daterangepicker-bs3.css">
<link rel="stylesheet" href="assets/js/icheck/skins/minimal/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/square/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/flat/_all.css">
<link rel="stylesheet" href="assets/js/icheck/skins/futurico/futurico.css">
<link rel="stylesheet" href="assets/js/icheck/skins/polaris/polaris.css">
<link rel="stylesheet" href="assets/js/wysihtml5/bootstrap-wysihtml5.css">
<link rel="stylesheet" href="assets/js/jcrop/jquery.Jcrop.min.css">

<script src="assets/js/fileinput.js"></script>
<script src="assets/js/ckeditor/ckeditor.js"></script>
<script src="assets/js/ckeditor/adapters/jquery.js"></script>
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/bootstrap-timepicker.min.js"></script>
<script src="assets/js/bootstrap-colorpicker.min.js"></script>
<script src="assets/js/daterangepicker/moment.min.js"></script>
<script src="assets/js/daterangepicker/daterangepicker.js"></script>
<script src="assets/js/toastr.js"></script>
<script src="assets/js/jquery.multi-select.js"></script>
<script src="assets/js/icheck/icheck.min.js"></script>
<script src="assets/js/jquery.inputmask.bundle.min.js"></script>
<script src="assets/js/jcrop/jquery.Jcrop.min.js"></script>
