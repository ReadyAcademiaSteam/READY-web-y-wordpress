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

// -- fecha
$sql_v1 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=1";
$rs_v1 = mysqli_query($conn,$sql_v1);
if(mysqli_num_rows($rs_v1)>0){
	$row_v1 = mysqli_fetch_array($rs_v1);
	$v1 = $row_v1["opcion"];
}else{
	$v1 = "anno";
}

// -- fecha ini / fecha fin
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

// -- marcado
$sql_v11 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=11";
$rs_v11 = mysqli_query($conn,$sql_v11);
if(mysqli_num_rows($rs_v11)>0){
	$row_v11 = mysqli_fetch_array($rs_v11);
	$v11 = $row_v11["opcion"];
}else{
	$v11 = "no";
}

// -- destacado
$sql_v12 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=12";
$rs_v12 = mysqli_query($conn,$sql_v12);
if(mysqli_num_rows($rs_v12)>0){
	$row_v12 = mysqli_fetch_array($rs_v12);
	$v12 = $row_v12["opcion"];
}else{
	$v12 = "no";
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

// -- mailing
$sql_v18 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=18";
$rs_v18 = mysqli_query($conn,$sql_v18);
if(mysqli_num_rows($rs_v18)>0){
	$row_v18 = mysqli_fetch_array($rs_v18);
	$v18 = $row_v18["opcion"];
}else{
	$v18 = "no";
}

// -- importar
$sql_v19 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=19";
$rs_v19 = mysqli_query($conn,$sql_v19);
if(mysqli_num_rows($rs_v19)>0){
	$row_v19 = mysqli_fetch_array($rs_v19);
	$v19 = $row_v19["opcion"];
}else{
	$v19 = "no";
}

// ----------------- FIN VARIABLES

$cookie1 = "anno_contenido".$mod;
$cookie2 = "tipo_contenido".$mod;
$cookie3 = "etiqueta_contenido".$mod;

// --- Variable Anno

if(!isset($_GET["anno"]) || $_GET["anno"]==''){

	switch ($v1) {

		case "anno":
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
			break;

		case "curso":
			if(!isset($_COOKIE[$cookie1]) || $_COOKIE[$cookie1]==''){
				$sql_anno = "SELECT fecha FROM contenidos WHERE ref_menu=".$mod." ORDER BY fecha DESC";
				$rs_anno = mysqli_query($conn,$sql_anno);
				if(mysqli_num_rows($rs_anno)>0){
					$row_anno = mysqli_fetch_array($rs_anno);
					if($row_anno[0]==''){
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
      if($v2=="si"){
				if(!isset($_COOKIE[$cookie1]) || $_COOKIE[$cookie1]==''){
          $sql_anno = "SELECT fecha_ini FROM contenidos WHERE ref_menu=".$mod." ORDER BY fecha_ini DESC";
          $rs_anno = mysqli_query($conn,$sql_anno);
          if(mysqli_num_rows($rs_anno)>0){
            $row_anno = mysqli_fetch_array($rs_anno);
            $anno = substr($row_anno["fecha_ini"],0,4);
          }else{
            $anno = date("Y");
          }
        }else{
          $sql_annocookie = "SELECT fecha_ini FROM contenidos WHERE ref_menu=".$mod." AND YEAR(fecha_ini)='".$_COOKIE[$cookie1]."' ORDER BY fecha_ini DESC";
          $rs_annocookie = mysqli_query($conn,$sql_annocookie);
          if(mysqli_num_rows($rs_annocookie)>0){
            $anno = $_COOKIE[$cookie1];
          }else{
            $sql_anno = "SELECT fecha_ini FROM contenidos WHERE ref_menu=".$mod." ORDER BY fecha_ini DESC";
            $rs_anno = mysqli_query($conn,$sql_anno);
            if(mysqli_num_rows($rs_anno)>0){
              $row_anno = mysqli_fetch_array($rs_anno);
              $anno = substr($row_anno["fecha_ini"],0,4);
            }else{
              $anno = date("Y");
            }
          }
        }
        break;
      }else{
        $anno = date("Y");
      }
			break;
	}

}else{

	$sql_anno = "SELECT * FROM contenidos WHERE YEAR(fecha)=".$_GET["anno"]." ORDER BY fecha DESC";
	$rs_anno = mysqli_query($conn,$sql_anno);
	if(mysqli_num_rows($rs_anno)>0){
		$anno = $_GET["anno"];
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

echo "<script>CambiaCookie('".$cookie1."','".$anno."');</script>"; //anno_contenido
echo "<script>CambiaCookie('".$cookie2."','".$tipo."');</script>"; //tipo_contenido
echo "<script>CambiaCookie('".$cookie3."','".$etiqueta."');</script>"; //etiqueta_contenido
?>

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
		<? if($v14=="si"){ ?><button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=etiquetas';" type="button" class="btn btn-blue btn-icon icon-left">Etiquetas<i class="entypo-tag"></i></button></li><? } ?>
    <button type="button" class="btn btn-default btn-icon icon-left" onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&secc=ins'">Insertar entrada<i class="entypo-plus-circled"></i></button></li>
		<? if($v19=="si"){ ?><button onclick="modalImportar();" type="button" class="btn btn-default btn-icon icon-left">Importar contenido<i class="entypo-doc-text"></i></button><? } ?>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <? include("include/camino_migas.php"); ?>
  <div class="clearfix"></div>

  <? if($v0=="si" || $v1!="no" || $v14=="si" || ($v1=="no" && $v2=="si" && $v3=="no")){ ?>

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
              echo "value='".$_SERVER['PHP_SELF']."?mod=".$mod;
							echo "&anno=".substr($row_anno[0],0,4);
              if($v0=="si"){ echo "&tipo=".$tipo; }
							if($v14=="si"){ echo "&etiqueta=".$etiqueta; }
							echo "'";
							if(substr($row_anno[0],0,4)==$anno){ echo " selected"; }
              echo ">".substr($row_anno[0],0,4)."</option>";
            }
            ?>
          </select>
        </div>
      <? }elseif($v2=="si" && $v3=="no"){ ?>
        <div class="col-md-2">
          <select name="anno" onchange="MM_jumpMenu('parent',this,0)" class="selectboxit visible selectboxit-enabled selectboxit-btn">
            <?
            $sql_anno = "SELECT fecha_ini FROM contenidos WHERE ref_menu=".$mod." GROUP BY YEAR(fecha_ini) ORDER BY fecha_ini DESC";
            $rs_anno = mysqli_query($conn,$sql_anno);
            while ($row_anno = mysqli_fetch_array($rs_anno)){
              echo "<option ";
              echo "value='".$_SERVER['PHP_SELF']."?mod=".$mod;
							echo "&anno=".substr($row_anno[0],0,4);
              if($v0=="si"){ echo "&tipo=".$tipo; }
							if($v14=="si"){ echo "&etiqueta=".$etiqueta; }
							echo "'";
              if(substr($row_anno[0],0,4)==$anno){ echo " selected"; }
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

            $mes = substr($row_anno[0],5,2);

            if($mes>8){

              $anno_ini = substr($row_anno[0],0,4);
              $anno_fin = $anno_ini+1;

              if($anno_fin!=$ult_fin){
                echo "<option ";
                echo "value='".$_SERVER['PHP_SELF']."?mod=".$mod."&anno=".$anno_fin;
                if($v0=="si"){ echo "&tipo=".$tipo; }
								if($v14=="si"){ echo "&etiqueta=".$etiqueta; }
								echo "'";
                if($anno_ini==$anno){ echo " selected"; }
                echo ">".$anno_ini."/".$anno_fin."</option>";
                $ult_fin = $anno_fin;
              }

            }else{

              $anno_fin = substr($row_anno[0],0,4);
              $anno_ini = $anno_fin-1;

              if($anno_fin!=$ult_fin){
                echo "<option ";
                echo "value='".$_SERVER['PHP_SELF']."?mod=".$mod."&anno=".$anno_fin;
                if($v0=="si"){ echo "&tipo=".$tipo; }
								if($v14=="si"){ echo "&etiqueta=".$etiqueta; }
								echo "'";
								if($anno_fin==$anno){ echo " selected"; }
                echo ">".$anno_ini."/".$anno_fin."</option>";
                $ult_fin = $anno_fin;
              }
            }

          }
          ?>
        </select>
      </div>
      <? } ?>

      <!-- select tipo -->

      <? if($v0=="si"){ ?>
      <div class="col-md-4">
        <select name="tipo" onChange="MM_jumpMenu('parent',this,0)" class="selectboxit">
          <option value="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?><? if($v1!="no"){ echo "&anno=".$anno; } ?>&tipo=0<? if($v14=="si"){ echo "&etiqueta=".$etiqueta; } ?>"<? if($tipo==0){ echo " selected"; } ?>></option>
          <?
          $sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref_menu=".$mod." ORDER BY orden";
          $rs_tipo = mysqli_query($conn,$sql_tipo);
          while($row_tipo = mysqli_fetch_array($rs_tipo)){
            echo "<option ";
            echo "value='".$_SERVER['PHP_SELF']."?mod=".$mod;
						if($v1!="no" || ($v1=="no" && $v2=="si" && $v3=="no")){ echo "&anno=".$anno; }
            echo "&tipo=".$row_tipo["ref"];
						if($v14=="si"){ echo "&etiqueta=".$etiqueta; }
						echo "'";
						if($row_tipo["ref"]==$tipo){ echo " selected"; }
						echo ">".$row_tipo["nombre"]."</option>";
          }
          ?>
        </select>
      </div>
    	<? } ?>

			<!-- select etiqueta -->

      <? if($v14=="si"){ ?>
      <div class="col-md-4">
        <select name="etiqueta" onChange="MM_jumpMenu('parent',this,0)" class="selectboxit">
          <option value="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?><? if($v1!="no"){ echo "&anno=".$anno; } ?><? if($v0=="si"){ echo "&tipo=".$tipo; } ?>&etiqueta=0"<? if($etiqueta==0){ echo " selected"; } ?>></option>
          <?
          $sql_etiqueta = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
          $rs_etiqueta = mysqli_query($conn,$sql_etiqueta);
          while ($row_etiqueta = mysqli_fetch_array($rs_etiqueta)){
						$sql_etiqueta_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_etiqueta["ref"]." AND ref_idioma=1";
						$rs_etiqueta_info = mysqli_query($conn,$sql_etiqueta_info);
						$row_etiqueta_info = mysqli_fetch_array($rs_etiqueta_info);
            echo "<option ";
            echo "value='".$_SERVER['PHP_SELF']."?mod=".$mod;
            if($v1!="no" || ($v1=="no" && $v2=="si" && $v3=="no")){ echo "&anno=".$anno; }
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
            <?
            if($v1!="no"){
              echo "<th>fecha</th>";
            }else{
              if($v2=="si" && $v3=="no"){
                echo "<th>fecha inicio</th>";
                echo "<th>fecha fin</th>";
              }
            }
            ?>

            <!-- título -->
            <th>t&iacute;tulo</th>

						<!-- tipo -->
            <? if($v0=="si"){ ?>
            <th>tipo</th>
            <? } ?>

						<!-- etiquetas -->
            <? if($v14=="si"){ ?>
              <th>etiquetas</th>
            <? } ?>

            <!-- mailing -->
            <? if($v18!="no"){ ?>
            <th></th>
            <? } ?>

            <!-- orden -->
            <? if(($v3=="si")&&($v0=="no")||(($v3=="si")&&($v0=="si")&&($tipo!=0))){ ?>
            <th></th>
            <? } ?>

            <!-- marcado -->
            <? if($v11=="si"){ ?>
            <th></th>
            <? } ?>

            <!-- destacado -->
            <? if($v12=="si"){ ?>
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
							if(($v14=="si")&&($etiqueta!=0)){ $sql.= " AND ref IN (SELECT ref_contenido FROM contenidos_rel_etiquetas WHERE ref_etiqueta=".$etiqueta.")"; }
              $sql.= " ORDER BY fecha DESC, ref DESC";
              break;

            case "curso":
              $anno_ant = $anno-1;
              $sql = "SELECT * FROM contenidos WHERE ref_menu=".$mod." AND ((YEAR(fecha)='".$anno."' AND MONTH(fecha)<9) OR (YEAR(fecha)='".$anno_ant."' AND MONTH(fecha)>8))";
              if(($v0=="si")&&($tipo!=0)){ $sql.= " AND ref_tipo=".$tipo; }
							if(($v14=="si")&&($etiqueta!=0)){ $sql.= " AND ref IN (SELECT ref_contenido FROM contenidos_rel_etiquetas WHERE ref_etiqueta=".$etiqueta.")"; }
              $sql.= " ORDER BY fecha DESC, ref DESC";
              break;

            case "no":
              $sql = "SELECT * FROM contenidos WHERE ref_menu=".$mod;
              if($v2=="si"){ $sql.= " AND YEAR(fecha_ini)='".$anno."'"; }
              if(($v0=="si")&&($tipo!=0)){ $sql.= " AND ref_tipo=".$tipo; }
							if(($v14=="si")&&($etiqueta!=0)){ $sql.= " AND ref IN (SELECT ref_contenido FROM contenidos_rel_etiquetas WHERE ref_etiqueta=".$etiqueta.")"; }
              if($v3=="si"){
                $sql.= " ORDER BY orden";
              }else{
                if($v2=="si"){
                  $sql.= " ORDER BY fecha_ini DESC";
                }else{
                  $sql.= " ORDER BY ref DESC";
                }
              }
              break;
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
              <? }elseif($v2=="si" && $v3=="no"){ ?>
                <td><span class="gris"><b><? echo cambiarf_a_normal($row["fecha_ini"]); ?></b></span></td>
                <td><span class="gris"><b><? if($row["fecha_ini"]!=$row["fecha_fin"]){ echo cambiarf_a_normal($row["fecha_fin"]); }else{ echo "-"; } ?></b></span></td>
              <? } ?>

              <!-- título -->
              <td>
                <strong><a href="<? echo $_SERVER['PHP_SELF']; ?>?mod=<? echo $mod; ?>&ref=<? echo $row[0]; ?>&secc=act"><i class='entypo-pencil'></i><?  echo $row_info["titulo"]; ?></a></strong>
              </td>

							<!-- tipo -->
              <? if($v0=="si"){
								$sql_tipo = "SELECT * FROM contenidos_tipo WHERE ref=".$row["ref_tipo"];
								$rs_tipo = mysqli_query($conn,$sql_tipo);
								$row_tipo = mysqli_fetch_array($rs_tipo);
								?>
                <td><span class="gris"><? echo $row_tipo["nombre"]; ?></span></td>
              <? } ?>

							<!-- etiquetas -->
	            <?
	            if($v14=="si"){
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

              <!-- envíos -->
              <? if($v18!="no"){ ?>
								<td><button onclick="modalEnviar('<? echo $row["ref"]; ?>');" type="button" class="btn btn-blue btn-xs btn-icon icon-left" title="enviar &laquo;<? echo $row["titulo"]; ?>&raquo;"><i class="entypo-mail"></i>enviar</button></td>
              <? } ?>

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

              <!-- marcado -->
              <? if($v11=="si"){?>
                <td style="text-align:center;">
									<img id='ico_loading_marcar_<? echo $row["ref"]; ?>' src='imagenes/loading.gif' style='display:none;'>
                  <? if($row["marcado"]=="N"){ ?>
                    <button id="btn_marcar_<? echo $row["ref"]; ?>" onclick="marcar('<? echo $row["ref"]; ?>','S');" type="button" class="btn btn-default btn-xs" title="marcar &laquo;<? echo $row_info["titulo"]; ?>&raquo;"><i class="entypo-flag"></i></button>
                  <? }else{ ?>
                    <button id="btn_desmarcar_<? echo $row["ref"]; ?>" onclick="marcar('<? echo $row["ref"]; ?>','N');" type="button" class="btn btn-gold btn-xs" title="desmarcar &laquo;<? echo $row_info["titulo"]; ?>&raquo;"><i class="entypo-flag"></i></button>
                  <? } ?>
                </td>
              <? } ?>

              <!-- destacado -->
              <? if($v12=="si"){?>
                <td style="text-align:center;">
									<img id='ico_loading_destacar_<? echo $row["ref"]; ?>' src='imagenes/loading.gif' style='display:none;'>
	                <? if($row["destacado"]=="N"){ ?>
	                  <button id="btn_destacar_<? echo $row["ref"]; ?>" onclick="destacar('<? echo $row["ref"]; ?>');" type="button" class="btn btn-default btn-xs" title="destacar &laquo;<? echo $row_info["titulo"]; ?>&raquo;"><i class="entypo-star"></i></button>
	                <? }else{ ?>
	                  <button type="button" class="btn btn-blue btn-xs" disabled="disabled"><i class="entypo-star"></i></button>
	                <? } ?>
                </td>
              <? } ?>

              <!-- eliminar -->
              <td align="right">
								<button onclick="modalDel(<? echo $row["ref"]; ?>);" type="button" class="btn btn-danger btn-xs" title="eliminar &laquo;<? echo $row_info["titulo"]; ?>&raquo;"><i class="entypo-cancel"></i></button>
              </td>

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
    url: 'data/contenidos_modal.php?ref='+ref,
    dataType: "json",
    success: function(resp){
      $('#modal_del .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El contenido con t&iacute;tulo «<b>"+resp.titulo+"</b>» ser&aacute; eliminado<br /><br />&iquest;Deseas continuar?</h4>");
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
    url: 'data/contenidos_del.php?mod=<? echo $mod; ?>&ref='+ref,
    success: function(){
			location.reload();
		},
		error: function(){
			$('#btn_modal_del').prop("disabled",false);
		  $("#ico_loading_del").css("display", "none");
      $('#modal_del').modal('hide');
      $('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
      $('#modal_error').modal('show');
    }
  });
  return false;
}

<? if($v18!="no"){ ?>

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
	    url: 'data/contenidos_modal.php?ref='+ref,
	    dataType: "json",
	    success: function(resp){
	      $('#modal_enviar .modal-body').html("<h4><img src='imagenes/ico_preg.png' style='margin:0 20px 0 10px;float:left;' />El contenido con t&iacute;tulo «<b>"+resp.titulo+"</b>» ser&aacute; enviado<br /><br />&iquest;Qu&eacute; tipo de env&iacute;o vas a realizar?</h4>");
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
	  $("#modal_enviar #ico_loading_enviar").css("display", "inline");
	  $.ajax({
	    type: "POST",
	    url: "data/contenidos_enviar.php?ref="+ref+"&modo=previa",
	    success: function(resp){
				$('#btn_modal_enviar1').prop("disabled",false);
				$('#btn_modal_enviartodos').prop("disabled",false);
				$("#modal_enviar #ico_loading_enviar").css("display", "none");
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
				$("#modal_enviar #ico_loading_enviar").css("display", "none");
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
		$.post("data/contenidos_enviar.php?ref="+ref+"&modo=todos",function(){
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

<? } ?>

<? if(($v3=="si")&&($v0=="no")||(($v3=="si")&&($v0=="si")&&($tipo!=0))){ ?>

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

<? } ?>

<? if($v11=="si"){ ?>

	//------ MARCAR ------

	function marcar(ref,opcion){
		if(opcion=="S"){
			$("#btn_marcar_"+ref).css("display", "none");
		}else{
			$("#btn_desmarcar_"+ref).css("display", "none");
		}
	  $("#ico_loading_marcar_"+ref).css("display", "inline");
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "data/contenidos_marcar.php?ref="+ref+"&opcion="+opcion,
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

<? if($v12=="si"){ ?>

	//------ DESTACAR ------

	function destacar(ref){
		$("#btn_destacar_"+ref).css("display", "none");
	  $("#ico_loading_destacar_"+ref).css("display", "inline");
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "data/contenidos_destacar.php?mod=<? echo $mod; ?>&ref="+ref,
			success: function(){
				location.reload();
			}
		});
		return false;
	}

<? } ?>

<? if($v19=="si"){ ?>

	function modalImportar(){
		$('#importar_modal').modal('show');
		return false;
	}

	function importar(){
		$('#btn_importar_modal').prop("disabled",true);
	  $("#ico_loading_importar").css("display", "inline");
		$.ajax({
			type: "POST",
			dataType: "json",
			url: "data/contenidos_importar.php?mod=<? echo $mod; ?>",
			data: $("#form_importar").serializeArray(),
			success: function(resp){
				$('#btn_importar_modal').prop("disabled",false);
			  $("#ico_loading_importar").css("display", "none");
				$('#importar_modal').modal('hide');
				if(resp.ins==0){
					$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error a nivel de <strong>programación</strong>.<br><br>Consulta con el administrador.</h4>");
		      $('#modal_error').modal('show');
				}else{
					$('#btn_importar_modal_seguir').attr({onClick: "window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>&ref="+resp.ins+"&secc=act'"});
					$('#importar_modal_exito').modal('show');
				}
			},
			error: function(){
				$('#btn_importar_modal').prop("disabled",false);
			  $("#ico_loading_importar").css("display", "none");
				$('#importar_modal').modal('hide');
				$('#modal_error .modal-body').html("<h4><img src='imagenes/ico_no.png' style='margin:0 20px 0 10px;float:left;' />Error puntual a nivel de <strong>servidor</strong>.<br><br>Vuelve a intentarlo.</h4>");
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
				<img id="ico_loading_del" src="imagenes/loading.gif" style="display:none;">
				<button id="btn_modal_del" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-trash"></i>Confirmar</button>
				<button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
			</div>
		</div>
	</div>
</div>

<? if($v18!="no"){ ?>

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
					<img id="ico_loading_enviar" src="imagenes/loading.gif" style="display:none;">
					<button id="btn_modal_enviar1" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-mail"></i>Enviar solo a m&iacute;</button>
					<button id="btn_modal_enviartodos" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-mail"></i>Enviar a todos</button>
					<button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
				</div>
			</div>
		</div>
	</div>

<? } ?>

<? if($v19=="si"){ ?>

	<!------ IMPORTAR CONTENIDO (formulario) ------>

	<div id="importar_modal" class="modal fade" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<form id="form_importar" name="form_importar" method="post" role="form" class="form-horizontal form-groups-standar validate" enctype="multipart/form-data">
					<div class="modal-header"><h4 class="modal-title">Crear entrada a partir de otra</h4></div>
					<div class="modal-body" style="text-align:left;">

						<? if($v1!="no"){ ?>
							<div class="form-group">
								<label class="col-sm-2 control-label"><b class="rojo">*</b> fecha</label>
								<div class="col-sm-3"><input id="fecha" name="fecha" data-validate="required" type="text" class="form-control datepicker" placeholder="dd/mm/aaaa" data-format="dd/mm/yyyy" value="<? echo date('d/m/Y'); ?>"></div>
							</div>
						<? } ?>

						<div class="form-group">
							<label class="col-sm-2 control-label"><b class="rojo">*</b> entrada</label>
							<div class="col-sm-9">
								<select id="entrada" name="entrada" class="select2" data-allow-clear="true">
									<?
									$sql_entrada = "SELECT * FROM contenidos WHERE ref_menu=".$mod." ORDER BY fecha DESC";
									$rs_entrada = mysqli_query($conn,$sql_entrada);
									while($row_entrada = mysqli_fetch_array($rs_entrada)){
										$sql_entrada_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row_entrada["ref"]." AND ref_idioma=1";
										$rs_entrada_info = mysqli_query($conn,$sql_entrada_info);
										$row_entrada_info = mysqli_fetch_array($rs_entrada_info);
										echo "<option value='".$row_entrada["ref"]."'>".cambiarf_a_normal($row_entrada["fecha"])." - ".$row_entrada_info["titulo"]."</option>";
									}
									?>
								</select>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<img id="ico_loading_importar" src="imagenes/loading.gif" style="display:none;">
						<button id="btn_importar_modal" onclick="importar();" type="button" class="btn btn-success btn-icon icon-left"><i class="entypo-check"></i>Insertar</button>
						<button data-dismiss="modal" type="button" class="btn btn-red btn-icon icon-left"><i class="entypo-cancel"></i>Cancelar</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<!------ IMPORTAR CONTENIDO EXITO (info) ------>

	<div id="importar_modal_exito" class="modal fade" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">
					<h4><img src="imagenes/ico_ok.png" style="margin:0 20px 0 0" />Contenido importado correctamente</h4>
				</div>
				<div class="modal-footer">
					<button id="btn_importar_modal_seguir" type="button" class="btn btn-default btn-icon icon-left"><i class="entypo-pencil"></i>Seguir editando</button>
					<button onclick="window.location.href='<? echo $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>'" type="button" class="btn btn-gold btn-icon icon-left"><i class="entypo-ccw"></i>Volver a <? echo $row_mod["nombre"]; ?></button>
				</div>
			</div>
		</div>
	</div>

<? } ?>

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
