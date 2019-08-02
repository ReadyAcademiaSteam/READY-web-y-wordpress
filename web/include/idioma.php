<?
if(isset($_GET["lg"])&&($_GET["lg"]!='')){
  $lg = $_GET["lg"];
}else{
	if(!isset($_COOKIE["lg"])){
		$lg = "es";
	}else{
		$lg = $_COOKIE["lg"];
	}
}
?>
<script>CambiaCookie('lg','<? echo $lg; ?>');</script>
