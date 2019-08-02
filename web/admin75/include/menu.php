<div class="sidebar-menu fixed">

  <header class="logo-env">

    <div class="logo">
      <a href="<? echo $_SERVER["PHP_SELF"]; ?>"><img src="imagenes/logo.png" width="155" alt="<? echo organizacion; ?>" /></a>
    </div>

    <div class="sidebar-mobile-menu visible-xs">
      <a href="#" class="with-animation">
        <i class="entypo-menu"></i>
      </a>
    </div>

  </header>

  <ul id="main-menu">

		<?
    $sql_menu_n0 = "SELECT * FROM menu_admin WHERE nivel=0 ORDER BY orden";
    $rs_menu_n0 = mysqli_query($conn,$sql_menu_n0);

    if($nivel_admin>1){
      $sql_menuitperm = "SELECT * FROM usuarios_permisos WHERE id_usu=".$id_admin;
      $rs_menuitperm = mysqli_query($conn,$sql_menuitperm);
      $total_items = mysqli_num_rows($rs_menuitperm);
    }else{
			$total_items = 1;
		}

		$cta = 0;

		if((mysqli_num_rows($rs_menu_n0)>0)&&($total_items>0)){

			while($row_menu_n0 = mysqli_fetch_array($rs_menu_n0)){

				$sql_itemmenu = "SELECT * FROM usuarios_permisos WHERE (id_usu=".$id_admin." AND ref_menu=".$row_menu_n0["ref"].")";
				$rs_itemmenu = mysqli_query($conn,$sql_itemmenu);
				if(($nivel_admin==1)||(($nivel_admin==2)&&(mysqli_num_rows($rs_itemmenu)>0))||($row_menu_n0["ref"]==1)){

					echo "<li";
					if($n0==$row_menu_n0["ref"] || $n1==$row_menu_n0["ref"]){ echo " class='opened active'"; }
					echo ">";
					if($row_menu_n0["modulo"]!="filemanager"){
						echo "<a href='".$_SERVER["PHP_SELF"]."?mod=".$row_menu_n0["ref"]."'>";
					}else{
						echo "<a href='filemanager/' target='_blank'>";
					}
						echo "<i class='entypo-";
						if($row_menu_n0["icono"]){ echo $row_menu_n0["icono"]; }else{ echo "layout"; }
						echo "'></i>";
						echo "<span>".$row_menu_n0["nombre"]."</span>";
					echo "</a>";

					$sql_menu_n1 = "SELECT * FROM menu_admin WHERE nivel=".$row_menu_n0["ref"]." ORDER BY orden";
					$rs_menu_n1 = mysqli_query($conn,$sql_menu_n1);
					if(mysqli_num_rows($rs_menu_n1)>0){
						echo "<ul>";
						while($row_menu_n1 = mysqli_fetch_array($rs_menu_n1)){
							echo "<li";
              if($n1==$row_menu_n1["ref"]){ echo " class='opened active'"; }
              echo ">";
							if($row_menu_n1["modulo"]!="filemanager"){
								echo "<a href='".$_SERVER["PHP_SELF"]."?mod=".$row_menu_n1["ref"]."'";
								if($n1==$row_menu_n1["ref"]){ echo " class='active'";}
								echo ">";
							}else{
								echo "<a href='filemanager/' target='_blank'>";
							}
							echo "<span>".$row_menu_n1["nombre"]."</span></a>";

              $sql_menu_n2 = "SELECT * FROM menu_admin WHERE nivel=".$row_menu_n1["ref"]." ORDER BY orden";
    					$rs_menu_n2 = mysqli_query($conn,$sql_menu_n2);
    					if(mysqli_num_rows($rs_menu_n2)>0){
    						echo "<ul>";
    						while($row_menu_n2 = mysqli_fetch_array($rs_menu_n2)){
    							echo "<li>";
    							if($row_menu_n2["modulo"]!="filemanager"){
    								echo "<a href='".$_SERVER["PHP_SELF"]."?mod=".$row_menu_n2["ref"]."'";
    								if($n1==$row_menu_n2["ref"]){ echo " class='active'";}
    								echo ">";
    							}else{
    								echo "<a href='filemanager/' target='_blank'>";
    							}
    							echo "<span>".$row_menu_n2["nombre"]."</span></a>";
                  echo "</li>";
    						}
    						echo "</ul>";
    					}

							echo "</li>";
						}
						echo "</ul>";
					}

					echo "</li>";
				}
			}
		}
		?>

    <li><a href="exit.php"><i class="entypo-logout"></i>Salir</a></li>

	</ul>
</div>
