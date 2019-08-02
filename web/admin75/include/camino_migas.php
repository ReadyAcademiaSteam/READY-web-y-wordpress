<div class="col-md-12 clearfix">
  <ol class="breadcrumb bc-3">

    <li><a href="<? echo $_SERVER["PHP_SELF"]; ?>"><i class="entypo-home"></i>Inicio</a></li>

    <?
    $sql_ant = "SELECT * FROM menu_admin WHERE ref=".$row_mod["nivel"];
    $rs_ant = mysqli_query($conn,$sql_ant);
    $row_ant = mysqli_fetch_array($rs_ant);

    if($row_ant["modulo"]!="lista"){
      $mod_ant = $row_ant["ref"];
    }else{
      $sql_subant = "SELECT * FROM menu_admin WHERE nivel=".$row_ant["ref"]." ORDER BY orden";
      $rs_subant = mysqli_query($conn,$sql_subant);
      $row_subant = mysqli_fetch_array($rs_subant);
      $mod_ant = $row_subant["ref"];
    }

    if($row_ant["nivel"]!=''){
      $sql_ant2 = "SELECT * FROM menu_admin WHERE ref=".$row_ant["nivel"];
      $rs_ant2 = mysqli_query($conn,$sql_ant2);
      if(mysqli_num_rows($rs_ant2)>0){
        $row_ant2 = mysqli_fetch_array($rs_ant2);

        if($row_ant2["modulo"]!="lista"){
          $mod_ant2 = $row_ant2["ref"];
        }else{
          $sql_subant2 = "SELECT * FROM menu_admin WHERE nivel=".$row_ant2["ref"]." ORDER BY orden";
          $rs_subant2 = mysqli_query($conn,$sql_subant2);
          $row_subant2 = mysqli_fetch_array($rs_subant2);
          $mod_ant2 = $row_subant2["ref"];
        }
      }
    }
    ?>

    <?
    if(!isset($camino) || $camino==""){
      if($n1==0){
        echo "<li class='active'><strong>".$row_mod["nombre"]."</strong></li>";
      }else{
        if($n2==0){
          echo "<li><a href='".$_SERVER["PHP_SELF"]."?mod=".$mod_ant."'>".$row_ant["nombre"]."</a></li>";
          echo "<li class='active'><strong>".$row_mod["nombre"]."</strong></li>";
        }else{
          echo "<li><a href='".$_SERVER["PHP_SELF"]."?mod=".$mod_ant2."'>".$row_ant2["nombre"]."</a></li>";
          echo "<li><a href='".$_SERVER["PHP_SELF"]."?mod=".$mod_ant."'>".$row_ant["nombre"]."</a></li>";
          echo "<li class='active'><strong>".$row_mod["nombre"]."</strong></li>";
        }
      }
    }else{
      if($n1==0){
        echo "<li class='active'><a href='".$_SERVER["PHP_SELF"]."?mod=".$row_mod["ref"]."'>".$row_mod["nombre"]."</a></li>";
        echo "<li class='active'><strong>".$camino."</strong></li>";
      }else{
        if($n2==0){
          echo "<li><a href='".$_SERVER["PHP_SELF"]."?mod=".$mod_ant."'>".$row_ant["nombre"]."</a></li>";
          echo "<li><a href='".$_SERVER["PHP_SELF"]."?mod=".$row_mod["ref"]."'>".$row_mod["nombre"]."</a></li>";
          echo "<li class='active'><strong>".$camino."</strong></li>";
        }else{
          echo "<li><a href='".$_SERVER["PHP_SELF"]."?mod=".$mod_ant2."'>".$row_ant2["nombre"]."</a></li>";
          echo "<li><a href='".$_SERVER["PHP_SELF"]."?mod=".$mod_ant."'>".$row_ant["nombre"]."</a></li>";
          echo "<li><a href='".$_SERVER["PHP_SELF"]."?mod=".$row_mod["ref"]."'>".$row_mod["nombre"]."</a></li>";
          echo "<li class='active'><strong>".$camino."</strong></li>";
        }
      }
    }
    ?>

  </ol>
</div>
