<?
include("../../include/conexion.php");
include("../include/funciones.php");

$mod = $_GET["mod"];
$ref = $_GET["ref"];

$resp = array();

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

$ref_act = $ref;

if($v0=="si" || $v1!="no"){
	$sql_act = "UPDATE contenidos SET ";
	if($v0=="si"){ $sql_act.= "ref_tipo='".$_POST["tipo"]."',"; }
	if($v1!="no"){ $sql_act.= "fecha='".cambiarf_a_mysql($_POST["fecha"])."',"; }
	$sql_act = substr($sql_act,0,-1);
	$sql_act.= " WHERE ref=".$ref;
	if($rs_act = mysqli_query($conn,$sql_act)){
		$ref_act = $ref;
	}else{
		$ref_act = 0;
	}
}

$sql_listaidiomas = "SELECT * FROM idiomas WHERE activo='S'";
$rs_listaidiomas = mysqli_query($conn,$sql_listaidiomas);
while($row_listaidiomas = mysqli_fetch_array($rs_listaidiomas)){

	$campo1 = "titulo_".$row_listaidiomas["ref"];
	$campo2 = "intro_".$row_listaidiomas["ref"];

	$sql_esta = "SELECT * FROM contenidos_info WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
	$rs_esta = mysqli_query($conn,$sql_esta);
	if(mysqli_num_rows($rs_esta)>0){
		$sql_actid = "UPDATE contenidos_info SET ";
		$sql_actid.= "titulo='".$_POST[$campo1]."'";
		$sql_actid.= ",intro='".$_POST[$campo2]."'";
		$sql_actid.= " WHERE ref_contenido=".$ref." AND ref_idioma=".$row_listaidiomas["ref"];
		if($rs_actid = mysqli_query($conn,$sql_actid)){
			$ref_act = $ref;
		}else{
			$ref_act = 0;
		}
	}else{
		$sql_ins = "INSERT INTO contenidos_info (ref_contenido,ref_idioma,titulo,intro) VALUES ('".$ref."','".$row_listaidiomas["ref"]."','".$_POST[$campo1]."','".$_POST[$campo2]."')";
		if($rs_ins = mysqli_query($conn,$sql_ins)){
			$ref_act = $ref;
		}else{
			$ref_act = 0;
		}
	}
}

if($v5=="si"){

  //------------------ ETIQUETAS ------------------

  $array_lista_etiquetas = array();
  $sql_lista_etiquetas = "SELECT ref_etiqueta FROM contenidos_rel_etiquetas WHERE ref_contenido=".$ref;
  $rs_lista_etiquetas = mysqli_query($conn,$sql_lista_etiquetas);
  while($row_lista_etiquetas = mysqli_fetch_array($rs_lista_etiquetas)){
    array_push($array_lista_etiquetas,$row_lista_etiquetas[0]);
  }
  foreach($_POST["etiquetas"] as $selectedOption){

    if(!in_array($selectedOption,$array_lista_etiquetas)){

      $sql_ins = "INSERT INTO contenidos_rel_etiquetas (ref_contenido,ref_etiqueta) VALUES ('".$ref."','".$selectedOption."')";
      $rs_ins = mysqli_query($conn,$sql_ins);
    }
  }

  $array_post_etiquetas = array();
  foreach($_POST["etiquetas"] as $selectedOption){
    array_push($array_post_etiquetas,$selectedOption);
  }
  $sql_lista_etiquetas = "SELECT ref_etiqueta FROM contenidos_rel_etiquetas WHERE ref_contenido=".$ref;
  $rs_lista_etiquetas = mysqli_query($conn,$sql_lista_etiquetas);
  while($row_lista_etiquetas = mysqli_fetch_array($rs_lista_etiquetas)){

    if(!in_array($row_lista_etiquetas[0],$array_post_etiquetas)){

      $sql_del = "DELETE FROM contenidos_rel_etiquetas WHERE ref_contenido=".$ref." AND ref_etiqueta=".$row_lista_etiquetas[0];
      $rs_del = mysqli_query($conn,$sql_del);
    }
  }
}

$resp["act"] = $ref_act;

echo json_encode($resp);
?>
