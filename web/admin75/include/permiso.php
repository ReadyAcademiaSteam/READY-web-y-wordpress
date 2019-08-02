<?
include("../include/conexion.php");

// --- MODULO CONTENIDOS
$sql_cookie = "SELECT * FROM menu_admin WHERE modulo='contenidos' ORDER BY orden";
$rs_cookie = mysqli_query($conn,$sql_cookie);
while($row_cookie = mysqli_fetch_array($rs_cookie)){
	$campo_cookie1 = "anno_contenido".$row_cookie["ref"];
	$campo_cookie2 = "tipo_contenido".$row_cookie["ref"];;
	if(!isset($_COOKIE[$campo_cookie1])){ setcookie($campo_cookie1); }
	if(!isset($_COOKIE[$campo_cookie2])){ setcookie($campo_cookie2); }
}

// --- MODULO ARCHIVOS
$sql_cookie = "SELECT * FROM menu_admin WHERE modulo='archivos' ORDER BY orden";
$rs_cookie = mysqli_query($conn,$sql_cookie);
while($row_cookie = mysqli_fetch_array($rs_cookie)){
	$campo_cookie1 = "anno_archivo".$row_cookie["ref"];
	$campo_cookie2 = "tipo_archivo".$row_cookie["ref"];;
	if(!isset($_COOKIE[$campo_cookie1])){ setcookie($campo_cookie1); }
	if(!isset($_COOKIE[$campo_cookie2])){ setcookie($campo_cookie2); }
}

session_start();

$n0 = 0;
$n1 = 0;
$n2 = 0;

$sql_ref = "SELECT * FROM menu_admin WHERE ref=".$mod;
$rs_ref = mysqli_query($conn,$sql_ref);
$row_ref = mysqli_fetch_array($rs_ref);

$n0 = $row_ref["ref"];

if($row_ref["nivel"]!=0){

	$sql_nivel1 = "SELECT * FROM menu_admin WHERE ref=".$row_ref["nivel"];
	$rs_nivel1 = mysqli_query($conn,$sql_nivel1);
	$row_nivel1 = mysqli_fetch_array($rs_nivel1);

	$n1 = $n0;
	$n0 = $row_nivel1["ref"];

	if($row_nivel1["nivel"]!=0){

		$sql_nivel2 = "SELECT * FROM menu_admin WHERE ref=".$row_nivel1["nivel"];
		$rs_nivel2 = mysqli_query($conn,$sql_nivel2);
		$row_nivel2 = mysqli_fetch_array($rs_nivel2);

		$n2 = $n1;
		$n1 = $n0;
		$n0 = $row_nivel2["ref"];

	}
}

if(isset($_SESSION["permiso_admin"]) && $_SESSION["permiso_admin"]=="si"){

	$sql_permiso = "SELECT * FROM usuarios_permisos WHERE (id_usu=".$_SESSION["id_admin"]." AND ref_menu=".$n0.")";
	$rs_permiso = mysqli_query($conn,$sql_permiso);

	if(($_SESSION["nivel_admin"]==2)&&(mysqli_num_rows($rs_permiso)==0)&&($mod!=1)){
	  header("location: admin.php");
    exit();
	}

}else{

  header("location: index.php");
   exit();
}

$id_admin = $_SESSION["id_admin"];
$nivel_admin = $_SESSION["nivel_admin"];
?>
