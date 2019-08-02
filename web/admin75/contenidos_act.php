<script src="include/upload.js"></script>

<?
$ref = $_GET["ref"];

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

// -- fecha ini-fin
$sql_v2 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=2";
$rs_v2 = mysqli_query($conn,$sql_v2);
if(mysqli_num_rows($rs_v2)>0){
	$row_v2 = mysqli_fetch_array($rs_v2);
	$v2 = $row_v2["opcion"];
}else{
	$v2 = "no";
}

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
	$v5 = "si";
}

// -- galería
$sql_v6 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=6";
$rs_v6 = mysqli_query($conn,$sql_v6);
if(mysqli_num_rows($rs_v6)>0){
	$row_v6 = mysqli_fetch_array($rs_v6);
	$v6 = $row_v6["opcion"];
}else{
	$v6 = "si";
}

// -- intro
$sql_v7 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=7";
$rs_v7 = mysqli_query($conn,$sql_v7);
if(mysqli_num_rows($rs_v7)>0){
	$row_v7 = mysqli_fetch_array($rs_v7);
	$v7 = $row_v7["opcion"];
}else{
	$v7 = "si";
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

// -- firma
$sql_v10 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=10";
$rs_v10 = mysqli_query($conn,$sql_v10);
if(mysqli_num_rows($rs_v10)>0){
	$row_v10 = mysqli_fetch_array($rs_v10);
	$v10 = $row_v10["opcion"];
}else{
	$v10 = "no";
}

// -- etiquetas
$sql_v14 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=14";
$rs_v14 = mysqli_query($conn,$sql_v14);
if(mysqli_num_rows($rs_v14)>0){
	$row_v14 = mysqli_fetch_array($rs_v14);
	$v14 = $row_v14["opcion"];
}else{
	$v14 = "no";
}

// -- vídeos
$sql_v15 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=15";
$rs_v15 = mysqli_query($conn,$sql_v15);
if(mysqli_num_rows($rs_v15)>0){
	$row_v15 = mysqli_fetch_array($rs_v15);
	$v15 = $row_v15["opcion"];
}else{
	$v15 = "no";
}

// -- audios
$sql_v16 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=16";
$rs_v16 = mysqli_query($conn,$sql_v16);
if(mysqli_num_rows($rs_v16)>0){
	$row_v16 = mysqli_fetch_array($rs_v16);
	$v16 = $row_v16["opcion"];
}else{
	$v16 = "no";
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

// -- enlace
$sql_v20 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=20";
$rs_v20 = mysqli_query($conn,$sql_v20);
if(mysqli_num_rows($rs_v20)>0){
	$row_v20 = mysqli_fetch_array($rs_v20);
	$v20 = $row_v20["opcion"];
}else{
	$v20 = "no";
}

// -- target
$sql_v200 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=200";
$rs_v200 = mysqli_query($conn,$sql_v200);
if(mysqli_num_rows($rs_v200)>0){
	$row_v200 = mysqli_fetch_array($rs_v200);
	$v200 = $row_v200["opcion"];
}else{
	$v200 = "no";
}

// ----------------- FIN VARIABLES

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
    <button id="btn_act" type="button" class="btn btn-green btn-icon icon-left">Actualizar<i class="entypo-check"></i></button>
	  <? if($v5=="si"){ ?><button id="btn_ins_doc" type="button" class="btn btn-default btn-icon icon-left">Insertar documento<i class="entypo-doc-text"></i></button><? } ?>
    <? if($v6=="si"){ ?>
      <button id="btn_ins_gal" type="button" class="btn btn-default btn-icon icon-left">Insertar im&aacute;genes<i class="entypo-picture"></i></button>
      <button id="btn_ord_gal" type="button" class="btn btn-green btn-icon icon-left">Ordenar galer&iacute;a<i class="entypo-list"></i></button>
    <? } ?>
		<? if($v15=="si"){ ?><button onclick="modalIns_videos();" type="button" class="btn btn-default btn-icon icon-left">Insertar vídeo<i class="entypo-video"></i></button><? } ?>
    <button onclick="window.location.href='<? $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>';" type="button" class="btn btn-gold btn-icon icon-left">Volver a <? echo $row_mod["nombre"]; ?><i class="entypo-ccw"></i></button>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <?
	$camino = $row_info["titulo"];
	include("include/camino_migas.php");
  ?>
  <div class="clearfix"></div>

  <div class="panel panel-gradient panel-shadow" data-collapsed="0">
    <div class="panel-heading">
      <div class="panel-title">Contenidos</div>
      <div class="panel-options">
        <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
        <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
      </div>
    </div>
    <div class="panel-body">

      <? if(($v4=="si") || ($v42=="si") || ($v43=="si") || ($v16=="si")){ ?>
      	<div class="col-lg-10 col-sm-8">
      <? } ?>

      <form id="form_act" name="form_act" method="post" role="form" class="form-horizontal form-groups-standar validate">

		    <? if($v1!="no"){ ?>
          <div class="form-group">
            <label class="col-sm-2 control-label"><b class="rojo">*</b> fecha</label>
            <div class="col-sm-3"><input name="fecha" data-validate="required" type="text" class="form-control datepicker" value="<? echo cambiarf_a_normal($row["fecha"]); ?>" placeholder="dd/mm/aaaa" data-format="dd/mm/yyyy"></div>
          </div>
        <? } ?>

		    <? if($v0=="si"){ ?>
          <div class="form-group">
            <label class="col-sm-2 control-label">tipo</label>
            <div class="col-sm-7">
							<select name="tipo" class="selectboxit visible selectboxit-enabled selectboxit-btn">
						    <?
		            $sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref_menu=".$mod." ORDER BY orden";
		            $rs_tipo = mysqli_query($conn,$sql_tipo);
		            while($row_tipo = mysqli_fetch_array($rs_tipo)){
		              echo "<option";
		              if($row_tipo["ref"]==$row["ref_tipo"]){ echo " selected"; }
		              echo " value='".$row_tipo["ref"]."'>".$row_tipo["nombre"]."</option>";
		            }
		            ?>
	            </select>
							<input name="tipo_origen" type="hidden" value="<? echo $row["ref_tipo"]; ?>" />
						</div>
          </div>
        <? } ?>

				<? if($v2=="si"){ ?>
          <div class="form-group">
            <label class="col-sm-2 control-label"><? if($v1=='no'){ echo "<b class='rojo'>*</b> "; } ?>fecha ini</label>
            <div class="col-sm-3"><input name="fecha_ini" <? if($v1=='no'){ ?>data-validate="required" <? } ?>type="text" class="form-control datepicker" value="<? if($row["fecha_ini"]!=NULL){ echo cambiarf_a_normal($row["fecha_ini"]); } ?>" placeholder="dd/mm/aaaa"></div>
            <label class="col-sm-2 control-label">fecha fin</label>
            <div class="col-sm-3"><input name="fecha_fin" type="text" class="form-control datepicker" value="<? if($row["fecha_fin"]!=NULL){ echo cambiarf_a_normal($row["fecha_fin"]); } ?>" placeholder="dd/mm/aaaa"></div>
          </div>
        <? } ?>

		    <?
        $sql_idiomas = "SELECT * FROM idiomas WHERE activo='S'";
        $rs_idiomas = mysqli_query($conn,$sql_idiomas);
        if((($v0=="si")||($v1!="no")||($v2=="si")) && (mysqli_num_rows($rs_idiomas)>1)){ ?>
        	<div class="col-sm-12" style="height:20px;"></div>
        <? } ?>

		    <?
        while($row_idiomas = mysqli_fetch_array($rs_idiomas)){

          $sql_info_idiomas = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=".$row_idiomas["ref"];
          $rs_info_idiomas = mysqli_query($conn,$sql_info_idiomas);
          $row_info_idiomas = mysqli_fetch_array($rs_info_idiomas);

          if(mysqli_num_rows($rs_idiomas)>1){ ?>
            <div class="col-sm-12 cabecera_idioma"><img src="imagenes/idiomas/<? echo $row_idiomas["foto"]; ?>" /><? echo $row_idiomas["nombre"]; ?></div>
          <? } ?>

          <div class="form-group">
            <label class="col-sm-2 control-label"><? if($row_idiomas["ref"]==1){ ?><b class="rojo">*</b> <? } ?>t&iacute;tulo</label>
            <div class="col-sm-9"><input name="titulo_<? echo $row_idiomas["ref"]; ?>" <? if($row_idiomas["ref"]==1){ ?>data-validate="required" <? } ?> type="text" class="form-control" value='<? echo $row_info_idiomas["titulo"];?>' placeholder="t&iacute;tulo"<? if($row_idiomas["ref"]==1){ echo " autofocus"; } ?>></div>
			    </div>

			    <? if($v7=="si"){ ?>
            <div class="form-group">
              <label class="col-sm-2 control-label">intro</label>
              <div class="col-sm-10"><input name="intro_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" value='<? echo $row_info_idiomas["intro"];?>' placeholder="intro"></div>
			      </div>
          <? } ?>

			    <? if($v8=="si"){ ?>
            <div class="form-group">
              <label class="col-sm-2 control-label">texto</label>
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
              <label class="col-sm-2 control-label">title</label>
              <div class="col-sm-10"><input name="title_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" value='<? echo $row_info_idiomas["seo_title"]; ?>' /></div>
			      </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">descripci&oacute;n</label>
              <div class="col-sm-10"><input name="description_<? echo $row_idiomas["ref"]; ?>" type="text" class="form-control" value='<? echo $row_info_idiomas["seo_descripcion"]; ?>' /></div>
			      </div>
          <? } ?>
        <? } ?>

				<? if($v10=="si"){ ?>
          <div class="form-group">
            <label class="col-sm-2 control-label">firma</label>
            <div class="col-sm-7"><input name="firma" type="text" class="form-control" value='<? echo $row["firma"];?>' placeholder="firma" autofocus></div>
          </div>
        <? } ?>

				<? if($v20=="si"){ ?>
					<div class="form-group">
						<label class="col-sm-2 control-label">http://</label>
						<div class="col-sm-5"><input name="enlace" type="text" class="form-control" value="<? echo $row["enlace"];?>" placeholder="direcci&oacute;n web"></div>
						<? if($v200=="si"){ ?>
							<label class="col-sm-2 control-label">destino</label>
							<div class="col-sm-3">
								<select name="target" class="selectboxit visible selectboxit-enabled selectboxit-btn">
									<option value="_blank"<? if($row["target"]=="_blank"){ echo " selected"; } ?>>Otra ventana</option>
									<option value="_self"<? if($row["target"]=="_self"){ echo " selected"; } ?>>Misma ventana</option>
								</select>
							</div>
						<? } ?>
					</div>
				<? } ?>

				<? if($v14=="si"){ ?>
					<hr>
					<div class="form-group">
						<label class="col-sm-2 control-label">etiquetas</label>
						<div class="col-sm-10"><?
						$sql_etiquetas = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
						$rs_etiquetas = mysqli_query($conn,$sql_etiquetas);
						while($row_etiquetas = mysqli_fetch_array($rs_etiquetas)){
							$sql_etiquetas_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_etiquetas["ref"]." AND ref_idioma=1";
							$rs_etiquetas_info = mysqli_query($conn,$sql_etiquetas_info);
							$row_etiquetas_info = mysqli_fetch_array($rs_etiquetas_info);
							echo "<div class='col-sm-3' style='padding-left:0'>";
								$sql_item = "SELECT * FROM contenidos_rel_etiquetas WHERE (ref_contenido=".$ref." AND ref_etiqueta=".$row_etiquetas["ref"].")";
								$rs_item = mysqli_query($conn,$sql_item);
								if(mysqli_num_rows($rs_item)){$esta='S';}else{$esta='N';}
								echo "<div class='checkbox'>";
								echo "<label><input id='etiqueta".$row_etiquetas["ref"]."' name='etiqueta".$row_etiquetas["ref"]."' type='checkbox' value='S'";
								if($esta=='S'){echo " checked";}
								echo ">";
								echo "<b>".$row_etiquetas_info["nombre"]."</b></label>";
								echo "</div>";
							echo "</div>";
						}
						?></div>
					</div>
				<? } ?>

	    </form>

    <? if(($v4=="si") || ($v42=="si") || ($v43=="si") || ($v16=="si")){ ?>
	    </div>
	    <div class="col-lg-2 col-sm-4">
    <? } ?>

	    <? if($v4=="si"){ ?>
        <div class="col-sm-12" style="text-align:center;">
          <? if ($row["foto"]!=""){ ?>
            <div class='gallery-env'>
              <article class='image-thumb'>
                <div class="image-options">
                  <? if (($row["foto"]!="")&&($v41=="si")){ ?><a id="btn_txt_foto1" style="cursor:pointer" class="edit"><i class="entypo-pencil"></i></a><? } ?>
                  <a id="btn_del_foto1" style="cursor:pointer" class="delete"><i class="entypo-cancel"></i></a>
                </div>
                <div class='galeria'>
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
            <input id="foto1" name="foto1" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <? if ($row["foto"]!=''){ echo "cambiar&nbsp;foto"; }else{ echo "insertar&nbsp;foto";} ?>" />
          </form>
          <? if(($row["foto"]!="")&&($v40=="si")){ ?>
            <br />
            <select id="align_foto1" name="align_foto1" class="selectboxit visible selectboxit-enabled selectboxit-btn">
              <option value="right"<? if ($row["align"]=="right"){ echo " selected"; }?>>derecha</option>
              <option value="center"<? if ($row["align"]=="center"){ echo " selected"; }?>>centro</option>
              <option value="left"<? if ($row["align"]=="left"){ echo " selected"; }?>>izquierda</option>
            </select>
						<img id="ico_loading_align_foto1" src="imagenes/loading.gif" style="display:none;">
          <? } ?>
        </div>
	    <? } ?>

      <? if($v42=="si"){?>
        <div class="col-sm-12 cabecera_idioma clearfix" style="text-align:center;margin-top:30px;">foto 2</div>
        <div class="col-sm-12" style="text-align:center;">
          <? if ($row["foto2"]!=""){ ?>
            <div class='gallery-env'>
              <article class='image-thumb'>
                <div class="image-options">
                  <a id="btn_del_foto2" style="cursor:pointer" class="delete"><i class="entypo-cancel"></i></a>
                </div>
                <div class='galeria'>
                  <a href='../imagenes/contenidos/<? echo $row["foto2"]; ?>' title='<? echo $row_info["titulo"]; ?>'>
                    <img src="../imagenes/contenidos/0/<? echo $row["foto2"]; ?>" style="margin:8px 0;" class="img-responsive">
                  </a>
                </div>
              </article>
            </div>
          <? } ?>
          <form id="ins_foto2" name="ins_foto2" method="post" role="form" enctype="multipart/form-data">
            <progress id="barra_de_progreso_foto2" value="0" max="100" style="width:100%;margin-top:10px;display:none;"></progress>
            <input id="foto2" name="foto2" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <? if ($row["foto2"]!=''){ echo "cambiar foto 2"; }else{ echo "insertar foto 2";} ?>" />
          </form>
        </div>
      <? } ?>

      <? if($v43=="si"){?>
        <div class="col-sm-12 cabecera_idioma clearfix" style="text-align:center;margin-top:30px;">foto 3</div>
        <div class="col-sm-12" style="text-align:center;">
          <? if ($row["foto3"]!=""){ ?>
            <div class='gallery-env'>
              <article class='image-thumb'>
                <div class="image-options">
                  <a id="btn_del_foto3" style="cursor:pointer" class="delete"><i class="entypo-cancel"></i></a>
                </div>
                <div class='galeria'>
                  <a href='../imagenes/contenidos/<? echo $row["foto3"]; ?>' title='<? echo $row_info["titulo"]; ?>'>
                    <img src="../imagenes/contenidos/0/<? echo $row["foto3"]; ?>" style="margin:8px 0;" class="img-responsive">
                  </a>
                </div>
              </article>
            </div>
          <? } ?>
          <form id="ins_foto3" name="ins_foto3" method="post" role="form" enctype="multipart/form-data">
            <progress id="barra_de_progreso_foto3" value="0" max="100" style="width:100%;margin-top:10px;display:none;"></progress>
            <input id="foto3" name="foto3" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-file'></i> <? if ($row["foto3"]!=''){ echo "cambiar foto 3"; }else{ echo "insertar foto 3";} ?>" />
          </form>
        </div>
      <? } ?>

			<? if($v16=="si"){?>
        <div class="col-sm-12 cabecera_idioma clearfix" style="text-align:center;margin-top:30px;">audio</div>
        <div class="col-sm-12" style="text-align:center;">
          <? if($row["audio"]!=""){ ?>
						<audio controls style="width:100%;">
              <source src="../archivos/contenidos/<? echo $row["audio"]; ?>" type="audio/mpeg">
            </audio>
          <? } ?>
          <form id="ins_audio" name="ins_audio" method="post" role="form" enctype="multipart/form-data">
            <progress id="barra_de_progreso_audio" value="0" max="100" style="width:100%;margin-top:10px;display:none;"></progress>
            <input id="audio" name="audio" type="file" class="form-control file2 inline btn btn-primary" data-label="<i class='glyphicon glyphicon-music'></i> <? if ($row["audio"]!=''){ echo "cambiar audio"; }else{ echo "insertar audio";} ?>" />
						<? if($row["audio"]!=""){ ?>
							<a id="btn_del_audio" style="cursor:pointer"class="btn btn-danger"><i class='glyphicon glyphicon-music'></i> eliminar audio</a>
						<? } ?>
					</form>
        </div>
      <? } ?>

      <? if(($v4=="si") || ($v42=="si") || ($v43=="si") || ($v16=="si")){ ?>
      	</div>
      <? } ?>

    </div>
  </div>

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
                <div id="foto<? echo $row_gal["ref"]; ?>" class="col-lg-2 col-sm-3 col-xs-6">
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
                      for($i=1; $i<=$total_foto; $i++){
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

	<!-- ------------------ VÍDEOS ------------------ -->

  <? if($v15=="si"){ ?>
    <div class="panel panel-gradient panel-shadow" data-collapsed="0">
      <div class="panel-heading">
        <div class="panel-title">Vídeos</div>
        <div class="panel-options">
          <a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
          <a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
        </div>
      </div>
      <div class="panel-body">
        <?
        $sql_videos = "SELECT * FROM contenidos_videos WHERE ref_contenido=".$ref." ORDER BY orden";
        $rs_videos = mysqli_query($conn,$sql_videos);
				$cta_videos = mysqli_num_rows($rs_videos);
        if(mysqli_num_rows($rs_videos)>0){
          ?>
          <table class="table table-condensed table-striped">
            <tbody>
              <?
							while ($row_videos = mysqli_fetch_array($rs_videos)){

								$sql_videos_info = "SELECT * FROM contenidos_videos_info WHERE ref_video=".$row_videos["ref"]." AND ref_idioma=1";
								$rs_videos_info = mysqli_query($conn,$sql_videos_info);
								$row_videos_info = mysqli_fetch_array($rs_videos_info);
								?>
								<tr>
									<?
									echo "<td><b><a href='javascript:modalAct_videos(".$row_videos["ref"].");' style='cursor:pointer'>".$row_videos_info["nombre"]."</a></b></td>";

									echo "<td>";
									if($row_videos["orden"]>1){
										echo "<img id='ico_loading_subir1_".$row_doc["ref"]."_videos' src='imagenes/loading.gif' style='display:none;margin-right:7px;'>";
										echo "<button id='btn_subir1_".$row_doc["ref"]."_videos' onclick='videos_subir1(".$row_videos["ref"].");' type='button' class='btn btn-default btn-xs' title='subir'><i class='entypo-up-open'></i></button>";
									}else{
										echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-up-open'></i></button>";
									}
									if($row_videos["orden"]<$cta_videos){
										echo "<img id='ico_loading_subir1_".$row_doc["ref"]."_videos' src='imagenes/loading.gif' style='display:none;margin-right:7px;'>";
										echo "<button id='btn_bajar1_".$row_doc["ref"]."_videos' onclick='videos_bajar1(".$row_videos["ref"].");' type='button' class='btn btn-default btn-xs' title='bajar'><i class='entypo-down-open'></i></button>";
									}else{
										echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-down-open'></i></button>";
									}
									echo "</td>";
									?>

									<td>
										<a href="http://es.youtube.com/watch?v=<? echo $row_videos["codigo"]; ?>" target="_blank"><button type="button" class="btn btn-default btn-xs" title="ver &laquo;<? echo $row_videos_info["nombre"]; ?>&raquo;"><i class="entypo-play"></i></button></a>
									</td>

									<td align="right">
										<button onClick="modalDel_videos('<? echo $row_videos["ref"]; ?>');" type="button" class="btn btn-danger btn-xs" title="eliminar &laquo;<? echo $row_videos_info["nombre"]; ?>&raquo;"><i class="entypo-cancel"></i></button>
									</td>

								</tr>
              <? } ?>
            </tbody>
          </table>
        <? } ?>
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
      url: "data/contenidos_act.php?mod=<? echo $mod; ?>&ref=<? echo $ref; ?>",
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
				$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong> en la inserci&oacute;n del contenido.<br>Volver a intentarlo.</h4>");
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
        <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&ref=<? echo $ref; ?>&secc=act'" type="button" class="btn btn-default btn-icon icon-left"><i class="entypo-pencil"></i>Seguir editando</button>
        <button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>'" type="button" class="btn btn-gold btn-icon icon-left"><i class="entypo-ccw"></i>Volver a <? echo $row_mod["nombre"]; ?></button>
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

<? if($v4=="si"){ include("util_contenidos_foto.php"); } ?>
<? if($v5=="si"){ include("util_contenidos_doc.php"); } ?>
<? if($v6=="si"){ include("util_contenidos_gal.php"); }  ?>
<? if($v15=="si"){ include("util_contenidos_videos.php"); }  ?>
<? if($v16=="si"){ include("util_contenidos_audio.php"); }  ?>

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
