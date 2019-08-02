<?
include("../../include/define.php");
include("../../include/conexion.php");

$mod = $_GET["mod"];

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

// -- activación
$sql_v2 = "SELECT * FROM menu_admin_config WHERE ref_menu=".$mod." AND variable=2";
$rs_v2 = mysqli_query($conn,$sql_v2);
if(mysqli_num_rows($rs_v2)>0){
	$row_v2 = mysqli_fetch_array($rs_v2);
	$v2 = $row_v2["opcion"];
}else{
	$v2 = "no";
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

if($v2=="si"){
	if($v0=="si"){
		if($v5=="si"){
			$aColumns = array( 'nombre', 'apellidos', 'usuario', 'ref_tipo', 'etiquetas', 'activo', 'ref' );
		}else{
			$aColumns = array( 'nombre', 'apellidos', 'usuario', 'ref_tipo', 'activo', 'ref' );
		}
	}else{
		if($v5=="si"){
			$aColumns = array( 'nombre', 'apellidos', 'usuario', 'etiquetas', 'activo', 'ref' );
		}else{
			$aColumns = array( 'nombre', 'apellidos', 'usuario', 'activo', 'ref' );
		}
	}
}else{
	if($v0=="si"){
		if($v5=="si"){
			$aColumns = array( 'nombre', 'apellidos', 'usuario', 'ref_tipo', 'etiquetas', 'ref' );
		}else{
			$aColumns = array( 'nombre', 'apellidos', 'usuario', 'ref_tipo', 'ref' );
		}
	}else{
		if($v5=="si"){
			$aColumns = array( 'nombre', 'apellidos', 'usuario', 'etiquetas', 'ref' );
		}else{
			$aColumns = array( 'nombre', 'apellidos', 'usuario', 'ref' );
		}
	}
}
$sIndexColumn = "ref";
$sTable = "registrados";

/* -------------------- Paginación -------------------- */

$sLimit = "";
if(isset($_GET['iDisplayStart']) && $_GET['iDisplayLength']!='-1'){
	$sLimit = "LIMIT ".mysqli_real_escape_string($conn,$_GET['iDisplayStart']).", ".mysqli_real_escape_string($conn,$_GET['iDisplayLength']);
}

/* -------------------- Orden -------------------- */

if(isset($_GET['iSortCol_0'])){
	$sOrder = "ORDER BY  ";
	for($i=0; $i<intval($_GET['iSortingCols']); $i++){
		if($_GET['bSortable_'.intval($_GET['iSortCol_'.$i])]=="true"){
			$sOrder.= $aColumns[intval($_GET['iSortCol_'.$i])]." ".mysqli_real_escape_string($conn,$_GET['sSortDir_'.$i]).", ";
		}
	}
	$sOrder = substr_replace($sOrder, "", -2);
	if($sOrder=="ORDER BY"){
		$sOrder = "";
	}
}

/* -------------------- Filtro general -------------------- */

$sWhere = "WHERE ref_menu=".$mod;

if($_GET['sSearch']!=""){
	$sWhere.= " AND ";
	$sWhere.= "(";
	for($i=0; $i<count($aColumns); $i++){
		switch($aColumns[$i]){
			case "ref_tipo":
				$sWhere.= "ref_tipo IN (SELECT ref FROM registrados_tipo WHERE nombre LIKE '%".$_GET['sSearch']."%') OR ";
				break;
			case "etiquetas":
				$sWhere.= "ref IN (SELECT ref_reg FROM registrados_rel_etiquetas WHERE ref_etiqueta IN (SELECT ref FROM etiquetas WHERE ref_menu=".$mod." AND nombre LIKE '%".$_GET['sSearch']."%')) OR ";
				break;
			default:
				$sWhere.= $aColumns[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
				break;
		}
	}
	$sWhere = substr_replace($sWhere, "", -3);
	$sWhere.= ')';
}

/* -------------------- Filtro por columnas -------------------- */

for($i=0; $i<count($aColumns); $i++){
	if($_GET['bSearchable_'.$i]=="true" && $_GET['sSearch_'.$i]!=''){
		if($sWhere==""){
			$sWhere = "WHERE ";
		}
		else{
			$sWhere.= " AND ";
		}
		switch($aColumns[$i]){
			case "ref_tipo":
				$sWhere.= "ref_tipo = ".$_GET['sSearch_'.$i]." ";
				break;
			case "etiquetas":
				$sWhere.= "ref IN (SELECT ref_reg FROM registrados_rel_etiquetas WHERE ref_etiqueta = ".$_GET['sSearch_'.$i].") ";
				break;
			default:
				$sWhere.= $aColumns[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
				break;
		}
	}
}

/* -------------------- Consultas SQL -------------------- */

$sQuery = "
	SELECT SQL_CALC_FOUND_ROWS *
	FROM $sTable
	$sWhere
	$sOrder
	$sLimit
";
$rResult = mysqli_query($conn,$sQuery) or die(mysqli_error());

/* Nº registros después de filtrar */
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysqli_query($conn,$sQuery) or die(mysqli_error());
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Nº total de registros */
$sQuery = "SELECT COUNT(".$sIndexColumn.") FROM $sTable";
$rResultTotal = mysqli_query($conn,$sQuery) or die(mysqli_error());
$aResultTotal = mysqli_fetch_array($rResultTotal);
$iTotal = $aResultTotal[0];

/* -------------------- Salida -------------------- */

$output = array(
	"sEcho" => intval($_GET['sEcho']),
	"iTotalRecords" => $iTotal,
	"iTotalDisplayRecords" => $iFilteredTotal,
	"aaData" => array()
);

while($aRow = mysqli_fetch_array($rResult)){

	$sql_reg = "SELECT * FROM registrados WHERE ref=".$aRow["ref"];
	$rs_reg = mysqli_query($conn,$sql_reg);
	$row_reg = mysqli_fetch_array($rs_reg);

	$nombre_completo = $row_reg["nombre"];
	if($row_reg["apellidos"]){ $nombre_completo.= " ".$row_reg["apellidos"]; }

	$row = array();
	for($i=0; $i<count($aColumns); $i++){

		if($aColumns[$i]=="ref"){
			/* No extraigo el ref */
		}

		else if ($aColumns[$i]=="nombre"){
			$row[] = "<strong><a href=\"".raiz_admin."?mod=".$mod."&ref=".$row_reg["ref"]."&secc=act\"><i class='entypo-pencil'></i>".$aRow[ $aColumns[$i] ]."</a></strong>";
		}

		else if ( $aColumns[$i]=="usuario" ){
			if($aRow[ $aColumns[$i] ]!=""){
				$row[] = "<a href=\"mailto:".$aRow[ $aColumns[$i] ]."\">".$aRow[ $aColumns[$i] ]."</a>";
			}else{
				$row[] = "-";
			}
		}

		else if($aColumns[$i]=="etiquetas"){
			$etiquetas = "";
			$sql_rel = "SELECT * FROM registrados_rel_etiquetas WHERE ref_reg=".$aRow[0];
			$rs_rel = mysqli_query($conn,$sql_rel);
			while($row_rel = mysqli_fetch_array($rs_rel)){
				$sql_etiquetas_info = "SELECT * FROM etiquetas_info WHERE ref_etiqueta=".$row_rel["ref_etiqueta"]." AND ref_idioma=1";
				$rs_etiquetas_info = mysqli_query($conn,$sql_etiquetas_info);
				$row_etiquetas_info = mysqli_fetch_array($rs_etiquetas_info);
				$etiquetas.= $row_etiquetas_info["nombre"].", ";
			}
			$etiquetas = substr_replace( $etiquetas, "", -2 );
			$row[] = $etiquetas;
		}

		else if($aColumns[$i]=="ref_tipo"){
			$sql_tipo = "SELECT * FROM registrados_tipo WHERE ref=".$aRow["ref_tipo"];
			$rs_tipo = mysqli_query($conn,$sql_tipo);
			$row_tipo = mysqli_fetch_array($rs_tipo);
			$row[] = $row_tipo["nombre"];
		}

		else if($aColumns[$i]=="activo"){
			if($row_reg["activo"]=='S'){
				$row[] = "<div align='center'><button onclick=\"modalDesactivar('".$row_reg["ref"]."');\" type='button' class='btn btn-success btn-xs' title='desactivar &laquo;".$nombre_completo."&raquo;'><i class='entypo-check'></i></button></div>";
			}else{
				$row[] = "<div align='center'><button onclick=\"modalActivar('".$row_reg["ref"]."');\" type='button' class='btn btn-default btn-xs' title='activar &laquo;".$nombre_completo."&raquo;'><i class='entypo-check'></i></button></div>";
			}
		}

		else if($aColumns[$i]!=""){
			/* Salida general */
			$row[] = $aRow[$aColumns[$i]];
		}
	}
	$row[] = "<div align='center'><button onclick=\"modalDel('".$row_reg["ref"]."');\" type='button' class='btn btn-danger btn-xs' title='eliminar &laquo;".$nombre_completo."&raquo;'><i class='entypo-cancel'></i></button></div>";
	$output['aaData'][] = $row;
}

echo json_encode($output);
?>
