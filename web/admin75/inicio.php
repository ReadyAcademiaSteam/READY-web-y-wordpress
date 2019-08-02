<div id="cuerpo" class="cuerpo col-sm-12" style="text-align:center;">
	<?
  $sql_menu = "SELECT * FROM menu_admin WHERE ref<>1 AND nivel=0 ORDER BY orden";
  $rs_menu = mysqli_query($conn,$sql_menu);
  while($row_menu = mysqli_fetch_array($rs_menu)){

    if($row_menu["modulo"]!="lista"){
      $menu_ref = $row_menu["ref"];
    }else{
      $sql_submenu = "SELECT * FROM menu_admin WHERE nivel=".$row_menu["ref"]." ORDER BY orden";
      $rs_submenu = mysqli_query($conn,$sql_submenu);
      $row_submenu = mysqli_fetch_array($rs_submenu);
      $menu_ref = $row_submenu["ref"];
    }

    $sql_itemmenu = "SELECT * FROM usuarios_permisos WHERE (id_usu=".$id_admin." AND ref_menu=".$menu_ref.")";
    $rs_itemmenu = mysqli_query($conn,$sql_itemmenu);
    if(($nivel_admin==1)||(($nivel_admin==2)&&(mysqli_num_rows($rs_itemmenu)>0)&&($menu_ref!=99))){
			if($row_menu["modulo"]=="filemanager"){
				$destino = "filemanager/";
			}else{
				$destino = "admin.php?mod=".$menu_ref;
				if($row_menu["nivel"]!=0){
					$destino.= "&nivel=".$row_menu["nivel"];
				}
			}
      ?>
      <div class="tile-title tile-gray tile-inicio">
        <a href="<? echo $destino; ?>"<? if($row_menu["modulo"]=="filemanager"){ echo " target='_blank'"; }?>>
          <div class="icon">
            <i class="glyphicon entypo-<? if($row_menu["icono"]){ echo $row_menu["icono"];}else{echo "layout";} ?>"></i>
          </div>
          <div class="title">
            <h3><? echo $row_menu["nombre"]; ?></h3>
          </div>
        </a>
      </div>
    <? } ?>
  <? } ?>
</div>
