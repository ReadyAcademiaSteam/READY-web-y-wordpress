<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

  <? include ("include/cabecera.php"); ?>

  <ul class="nav navbar-nav navbar-right navbar-cabecera">
    <button onclick="modalIns();" type="button" class="btn btn-default btn-icon icon-left">Insertar valor<i class="entypo-plus-circled"></i></button>
    <button onclick="window.location.href='<? $_SERVER["PHP_SELF"]; ?>?mod=<? echo $mod; ?>';" type="button" class="btn btn-gold btn-icon icon-left">Volver a <? echo $row_mod["nombre"]; ?><i class="entypo-ccw"></i></button>
  </ul>

</nav>

<div id="cuerpo" class="cuerpo">

  <? $camino = "Etiquetas"; ?>
  <? include("include/camino_migas.php"); ?>
  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-condensed table-striped">

        <thead>
          <tr>
            <th>valor</th>
            <th></th>
            <th></th>
          </tr>
        </thead>

        <tbody>
          <?
          $sql = "SELECT * FROM etiquetas WHERE ref_menu=".$mod." ORDER BY orden";
          $rs = mysqli_query($conn,$sql);
          $cta_parametros = mysqli_num_rows($rs);
          while($row = mysqli_fetch_array($rs)){
            $sql_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row["ref"]." AND ref_idioma=1";
            $rs_info = mysqli_query($conn,$sql_info);
            $row_info = mysqli_fetch_array($rs_info);
            ?>
            <tr>

              <td><strong><a href="javascript:modalAct('<? echo $row["ref"]; ?>');"><i class="entypo-pencil"></i><?  echo $row_info["nombre"]; ?></a></strong></td>

              <td style="text-align:center;"><?
                if($row["orden"]>1){
                  echo "<img id='ico_loading_subir1_".$row["ref"]."' src='imagenes/loading.gif' style='display:none;margin-right:7px;'>";
                  echo "<button id='btn_subir1_".$row["ref"]."' onclick='subir1(".$row["ref"].");' type='button' class='btn btn-default btn-xs' title='subir'><i class='entypo-up-open'></i></button>";
                }else{
                  echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-up-open'></i></button>";
                }
                if($row["orden"]<$cta_parametros){
                  echo "<img id='ico_loading_bajar1_".$row["ref"]."' src='imagenes/loading.gif' style='display:none;margin-left:7px;'>";
                  echo "<button id='btn_bajar1_".$row["ref"]."' onclick='bajar1(".$row["ref"].");' type='button' class='btn btn-default btn-xs' title='bajar'><i class='entypo-down-open'></i></button>";
                }else{
                  echo "<button type='button' class='btn btn-default btn-xs' disabled='disabled'><i class='entypo-down-open'></i></button>";
                }
              ?></td>

              <td align="right">
                <button onclick="modalDel('<? echo $row["ref"]; ?>');" type="button" class="btn btn-danger btn-xs" title="eliminar &laquo;<? echo $row_info["nombre"]; ?>&raquo;"><i class="entypo-cancel"></i></button>
              </td>

            </tr>
          <? } ?>
        </tbody>

      </table>
    </div>
  </div>

</div>

<? include("util_etiquetas.php"); ?>
