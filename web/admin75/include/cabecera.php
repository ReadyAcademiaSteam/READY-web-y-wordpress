<div class="row">
  <div class="col-md-12 col-sm-12 hidden-xs">

    <ul class="list-inline links-list pull-left" style="padding-top:25px;">
      <script language="JavaScript" type="text/JavaScript">dar_fecha();</script>
    </ul>

    <ul class="list-inline links-list pull-right">

      <li class="profile-info dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="imagenes/usuarios/0.png" alt="" class="img-circle" width="44" />
          <?
          $sql_usu = "SELECT * FROM usuarios WHERE id='".$id_admin."'";
          $rs_usu = mysqli_query($conn,$sql_usu);
          $row_usu = mysqli_fetch_array($rs_usu);
          echo $row_usu["nombre"]."&nbsp;".$row_usu["apellidos"];
          ?>
        </a>
        <ul class="dropdown-menu">

          <li class="caret"></li>

          <li><a href="<? echo $_SERVER["PHP_SELF"]; ?>?mod=999&ref=<? echo $row_usu["id"]; ?>&secc=act"><i class="entypo-user"></i>Editar Perfil</a></li>

        </ul>
      </li>

      <li class="sep"></li>

      <li><a href="exit.php">Salir <i class="entypo-logout right"></i></a></li>

    </ul>

  </div>
</div>

<div class="clearfix"></div>
