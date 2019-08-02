<?
include("../../include/define.php");
include("../../include/conexion.php");

$mod = $_GET["mod"];

$aColumns = array('nombre', 'apellidos', 'id');
$sIndexColumn = "id";
$sTable = "usuarios";

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

$sWhere = "WHERE id!=0";

/* -------------------- Filtro general -------------------- */

if($_GET["sSearch"]!=""){
	$sWhere.= " AND ";
	$sWhere.= "(";
	for($i=0; $i<count($aColumns); $i++){
		$sWhere.= $aColumns[$i]." LIKE '%".$_GET['sSearch']."%' OR ";
	}
	$sWhere = substr_replace($sWhere, "", -3);
	$sWhere.= ")";
}

/* -------------------- Filtro por columnas -------------------- */

for($i=0; $i<count($aColumns); $i++){
	if($_GET["bSearchable_".$i]=="true" && $_GET['sSearch_'.$i]!=""){
		if($sWhere==""){
			$sWhere = "WHERE ";
		}
		else{
			$sWhere.= " AND ";
		}
		$sWhere.= $aColumns[$i]." LIKE '%".$_GET['sSearch_'.$i]."%' ";
	}
}

/* -------------------- Consultas SQL -------------------- */

$sQuery = "
	SELECT *
	FROM $sTable
	$sWhere
	$sOrder
	$sLimit
";
$rResult = mysqli_query($conn,$sQuery) or die (mysqli_error());

/* Nº registros después de filtrar */
$sQuery = "SELECT FOUND_ROWS()";
$rResultFilterTotal = mysqli_query($conn,$sQuery) or die (mysqli_error());
$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
$iFilteredTotal = $aResultFilterTotal[0];

/* Nº total de registros */
$sQuery = "
	SELECT COUNT(".$sIndexColumn.")
	FROM $sTable
";
$rResultTotal = mysqli_query($conn,$sQuery) or die (mysqli_error());
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

	$sql_reg = "SELECT * FROM usuarios WHERE id=".$aRow["id"];
	$rs_reg = mysqli_query($conn,$sql_reg);
	$row_reg = mysqli_fetch_array($rs_reg);

	$nombre_completo = $row_reg["nombre"];
	if($row_reg["apellidos"]){ $nombre_completo.= " ".$row_reg["apellidos"]; }

	$row = array();
	for($i=0; $i<count($aColumns); $i++){

		if($aColumns[$i]=="id"){
			/* No extraigo el ref */
		}

		else if($aColumns[$i]=="nombre"){
			$row[] = "<strong><a href=\"".raiz_admin."?mod=".$mod."&ref=".$row_reg["id"]."&secc=act\"><i class='entypo-pencil'></i>".$aRow[$aColumns[$i]]."</a></strong>";
		}

		else if($aColumns[$i]!=""){
			/* Salida general */
			$row[] = $aRow[$aColumns[$i]];
		}
	}
	$row[] = "<div align='center'><button onclick=\"modalDel('".$row_reg["id"]."');\" type='button' class='btn btn-danger btn-xs' title='eliminar &laquo;".$nombre_completo."&raquo;'><i class='entypo-cancel'></i></button></div>";
	$output['aaData'][] = $row;
}

echo json_encode( $output );
?>
