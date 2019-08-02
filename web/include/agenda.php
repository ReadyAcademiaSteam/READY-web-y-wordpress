<?
function dia_semana($dia,$mes,$anno){
	$numerodiasemana = date('w', mktime(0,0,0,$mes,$dia,$anno));
	if($numerodiasemana==0)
		$numerodiasemana = 6;
	else
		$numerodiasemana--;
	return $numerodiasemana;
}

//funcion que devuelve el último día de un mes y año dados
function ultimoDia($mes,$anno){
  $ultimo_dia = 28;
  while (checkdate($mes,$ultimo_dia + 1,$anno)){
    $ultimo_dia++;
  }
  return $ultimo_dia;
}

function mostrar_calendario($mes,$anno,$fecha,$tipo,$enlace){

	include("conexion.php");

	//tomo el nombre del mes que hay que imprimir
	$nombre_mes = nombre_mes($mes);

	$mes_anterior = $mes-1;
	$anno_anterior = $anno;
	if($mes_anterior==0){
		$anno_anterior--;
		$mes_anterior = 12;
	}
	$nombre_mes_anterior = nombre_mes($mes_anterior);

	$mes_siguiente = $mes+1;
	$anno_siguiente = $anno;
	if($mes_siguiente==13){
		$anno_siguiente++;
		$mes_siguiente = 1;
	}
	$nombre_mes_siguiente = nombre_mes($mes_siguiente);

	echo "

	  <div class='row' style='margin:0;'>

      <div class='col-lg-3 col-md-3 col-sm-4' align='left' style='opacity: 1;'>
        <a href='".$enlace.".php?mes=".completa2($mes_anterior)."&anno=".$anno_anterior."' class='btn btn-default btn-sm' title='".$nombre_mes_anterior."'><< ".$nombre_mes_anterior."</a>
      </div>

      <div class='col-lg-6 col-md-6 col-sm-4' align='center' style='opacity: 1;'>
          <h3 style='margin:0;'>".$nombre_mes." de ".$anno."</h3>
      </div>

      <div class='col-lg-3 col-md-3 col-sm-4' align='right' style='opacity: 1;'>
        <a href='".$enlace.".php?mes=".completa2($mes_siguiente)."&anno=".$anno_siguiente."' class='btn btn-default btn-sm' title='".$nombre_mes_siguiente."'>".$nombre_mes_siguiente." >></a>
      </div>

	  </div>

	  <div class='row'>

			<div class='col-lg-12 col-md-12 col-sm-12'>

			  <div class='events-calendar'>

		      <table class='event-calendar' style='opacity: 1;width:100%;'>
		        <tbody>
							<tr class='calendar-days'>
	              <th>Lun</th>
	              <th>Mar</th>
	              <th>Mie</th>
	              <th>Jue</th>
	              <th>Vie</th>
	              <th>Sab</th>
	              <th>Dom</th>
		          </tr>
							";

							$dia_actual = 1;
							$numero_dia = dia_semana(1,$mes,$anno);
							$ultimo_dia = ultimoDia($mes,$anno);

							//escribo la primera fila del mes
							echo "<tr>";
							for($i=0; $i<7; $i++){
								if($i<$numero_dia){
									//si el dia de la semana i es menor que el numero del primer dia de la semana no pongo nada en la celda
									echo "<td class='not-this-month'></td>";
								}else{
									echo "<td class='";
									$dia_actual_mysql = $anno."-".completa2($mes)."-".$dia_actual;
									$sql_eventos = "SELECT * FROM contenidos WHERE ref_menu=4 AND fecha_ini<='".$dia_actual_mysql."' AND fecha_fin>='".$dia_actual_mysql."'";
									if($tipo!=0){ $sql_eventos.= " AND ref_tipo=".$tipo; }
									$rs_eventos = mysqli_query($conn,$sql_eventos);
									if ($dia_actual_mysql==date("Y-m-j")){
										echo "hoy ";
									}
									if(mysqli_num_rows($rs_eventos)==0){
										echo "no-events";
									}
									echo "'><span class='day'>".$dia_actual."</span>";

									if(mysqli_num_rows($rs_eventos)!=0){

										echo "<ul class='especial events'>";

										$rs_eventos = mysqli_query($conn,$sql_eventos);
										while($row_eventos = mysqli_fetch_array($rs_eventos)){

											$sql_eventos_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row_eventos["ref"]." AND ref_idioma=1";
											$rs_eventos_info = mysqli_query($conn,$sql_eventos_info);
											$row_eventos_info = mysqli_fetch_array($rs_eventos_info);

											echo "<li>";
												echo "<a href='".$enlace."/".$row_eventos["ref"]."/".url_amigable($row_eventos_info["titulo"])."'>".$row_eventos_info["titulo"]."</a>";
												echo "<div class='event-popover'>";
													echo "<h5><a href='#'>".$row_eventos_info["titulo"]."</a></h5>";
													if($row_eventos_info["intro"]!=""){ echo "<p>".$row_eventos_info["intro"]."</p>"; }
												echo "</div>";
											echo "</li>";
										}
										echo "</ul>";
									}
									echo "</td>";
									$dia_actual++;
								}
							}
							echo "</tr>";

							//recorro todos los demás días hasta el final del mes
							$numero_dia = 0;
							while($dia_actual<=$ultimo_dia){

								//si estamos a principio de la semana escribo el <TR>
								if($numero_dia==0){ echo "<tr>"; }

								echo "<td class='";
								$dia_actual_mysql = $anno."-".completa2($mes)."-".$dia_actual;
								$sql_eventos = "SELECT * FROM contenidos WHERE ref_menu=4 AND fecha_ini<='".$dia_actual_mysql."' AND fecha_fin>='".$dia_actual_mysql."'";
								if($tipo!=0){ $sql_eventos.= " AND ref_tipo=".$tipo; }
								$rs_eventos = mysqli_query($conn,$sql_eventos);

								if($dia_actual_mysql==date("Y-m-j")){
									echo "hoy ";
								}
								if(mysqli_num_rows($rs_eventos)==0){
									echo "no-events";
								}
								echo "'><span class='day'>".$dia_actual."</span>";

								if(mysqli_num_rows($rs_eventos)!=0){

									echo "<ul class='especial events'>";

									$rs_eventos = mysqli_query($conn,$sql_eventos);
									while($row_eventos = mysqli_fetch_array($rs_eventos)){

										$sql_eventos_info = "SELECT * FROM contenidos_info WHERE ref_contenido=".$row_eventos["ref"]." AND ref_idioma=1";
										$rs_eventos_info = mysqli_query($conn,$sql_eventos_info);
										$row_eventos_info = mysqli_fetch_array($rs_eventos_info);
										echo "<li>";
											echo "<a href='".$enlace."_ver.php?ref=".$row_eventos["ref"]."'>".$row_eventos_info["titulo"]."</a>";
											echo "<div class='event-popover'>";
												echo "<h5><a href='#'>".$row_eventos_info["titulo"]."</a></h5>";
												if($row_eventos_info["intro"]!=""){ echo "<p>".$row_eventos_info["intro"]."</p>"; }
											echo "</div>";
										echo "</li>";
									}
									echo "</ul>";
								}

								echo "</td>";
								$dia_actual++;
								$numero_dia++;
								//si es el ultimo de la semana, me pongo al principio de la semana y escribo el </tr>
								if ($numero_dia == 7){
									$numero_dia = 0;
									echo "</tr>";
								}
							}

							//compruebo que celdas me faltan por escribir vacias de la última semana del mes
							if($numero_dia!=0){
								for($i=$numero_dia; $i<7; $i++){
									echo "<td class='not-this-month'></td>";
								}
							}
							echo "</tr>";

						echo "
		   			</tbody>
			 		</table>
	      </div>
	    </div>
	  </div>

	";
}
