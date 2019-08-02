function bloquearControl(divBloqueado) {
	//primero comprobamos si ya hay un div bloqueando a nuestra sección
	if (!$("divBloqueado .divBlocker").length) {
		//le ponemos un poco de estilo para que simule estar bloqueado
		$(divBloqueado).fadeTo('slow', .6);
		//y al final ponemos el div que evitará hacer click sobre cualquier control que esté en nuestro div.
		$(divBloqueado).append('<div class="divBlocker" style="position:absolute;top:0;left:0;width:100%;height:100%;z-index:10000000;opacity:0.4;filter:alpha(opacity = 50)"><div align="center" style="margin-top:60px;"><progress id="barra_de_progreso" value="0" max="100" style="width:100%"></progress><br />subiendo...</div></div>');
	}
}

function desbloquearControl(divBloqueado) {
	//quitamos el estilo de bloqueo
	$(divBloqueado).fadeTo('slow', 1);
	//quitamos el div que esta bloqueando los clicks :)
	$('.divBlocker').remove();
}

function tildes(str){
	str = str.replace('&aacute;','\u00e1');
	str = str.replace('&eacute;','\u00e9');
	str = str.replace('&iacute;','\u00ed');
	str = str.replace('&oacute;','\u00f3');
	str = str.replace('&uacute;','\u00fa');

	str = str.replace('&Aacute;','\u00c1');
	str = str.replace('&Eacute;','\u00c9');
	str = str.replace('&Iacute;','\u00cd');
	str = str.replace('&Oacute;','\u00d3');
	str = str.replace('&Uacute;','\u00da');

	str = str.replace('&ntilde;','\u00f1');
	str = str.replace('&Ntilde;','\u00d1');
	str = str.replace('&iquest;','\u00bf');
	return str;
}

function cambiarf_a_normal(fecha) {
  var d = new Date(fecha.split("/").reverse().join("-"));
	var dd = ("0" + d.getDate()).slice(-2);
	var mm = ("0" + (d.getMonth() + 1)).slice(-2);
	var yy = d.getFullYear();
	var newdate = dd+"/"+mm+"/"+yy;
	return newdate;
}

/*
$(document).ready(function(){
	var randIDS = '<? echo $uiq ?>';

	// Add Hidden Field
	var hidden = $("<input>");
		hidden.attr({
		name:"APC_UPLOAD_PROGRESS",
		id:"progress_key",
		type:"hidden",
		value:randIDS
});

$("#form-doc-ins").prepend(hidden);
$("#form-doc-ins").submit(function(e){
	var p = $(this);
	p.attr('target','tmpForm');

	// creating iframe
	if($("#tmpForm").length == 0){
		var frame = $("<iframe>");
		frame.attr({
			name:'tmpForm',
			id:'tmpForm',
			action:'about:blank',
			border:0
		}).css('display','none');
		p.after(frame);
	}

	// Start file upload
	$.get("include/barra_progreso.php", {progress_key:randIDS, rand:Math.random()},
	function(data){
		var uploaded = parseInt(data);
		if(uploaded == 100){
			$(".progress, .badge").hide();
			clearInterval(loadLoader);
		}else if(uploaded < 100){
			$(".progress, .badge").show();
			$(".badge").text(uploaded+"%");
			var cWidth = $(".bar").css('width', uploaded+"%");
		}
		if(uploaded < 100)
		var loader = setInterval(loadLoader,2000);
	});

	var loadLoader = function(){
		$.get("include/barra_progreso.php", {progress_key:randIDS, rand:Math.random()}, function(data){
			var uploaded = parseInt(data);
			if(uploaded == 100){
				$(".progress, .badge").hide();
				parent.location.href="index.php?success";
			}else if(uploaded < 100){
				$(".progress, .badge").show();
				$(".badge").text(uploaded+"%");
				var cWidth = $(".bar").css('width', uploaded+"%");
			}
		});
	}
});
*/
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}

function CambiaCookie(name,value) {
	document.cookie = name+"="+value;
}

function dar_fecha(){
	dias = new Array ("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
	meses= new Array ("Enero","Febrero","Marzo","Abril","Mayo",	"Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
	fecha= new Date();
	indice = fecha.getMonth();
	indice_d = fecha.getDay();
	document.write(dias[indice_d] + ", " +fecha.getDate()+ " de " + meses[indice]	+" de " + fecha.getFullYear());
}

function abrir(pagina,ancho,alto,status){
	window.open(pagina,'','width='+ancho+',height='+alto+',status='+status+',top=200,left=300');
}

function abrir_audio(archivo,cancion,artista){
	window.open('audio_reproducir.php?archivo='+archivo+'&cancion='+cancion+'&artista='+artista,'','width=340,height=200');
}

function cerrar(){
    window.opener.refrescar();
 	window.close();
}

function cerrar_letra(letra){
	window.opener.recargar_letra(letra);
 	window.close();
}

function refrescar(){
	window.location.reload();
}

function exit(){
	window.location.href='exit.php';
}

function centrar() {
    iz=(screen.width-document.body.clientWidth) / 2;
    de=(screen.height-document.body.clientHeight) / 2;
    moveTo(iz,de);
}

function IsNumeric(valor){
	var log=valor.length;
	var sw="S";
	for (x=0; x<log; x++){
		v1=valor.substr(x,1);
		v2 = parseInt(v1);
		//Compruebo si es un valor numérico
		if (isNaN(v2)) { sw= "N";}
	}
	if (sw=="S") {
		return true;
	} else {
		return false;
	}
}

var primerslap=false;
var segundoslap=false;

function formateafecha(fecha)
	{
	var long = fecha.length;
	var dia;
	var mes;
	var ano;

	if ((long>=2) && (primerslap==false)) { dia=fecha.substr(0,2);
	if ((IsNumeric(dia)==true) && (dia<=31) && (dia!="00")) { fecha=fecha.substr(0,2)+"/"+fecha.substr(3,7); primerslap=true; }
	else { fecha=""; primerslap=false;}
	}
	else
	{ dia=fecha.substr(0,1);
	if (IsNumeric(dia)==false)
	{fecha="";}
	if ((long<=2) && (primerslap=true)) {fecha=fecha.substr(0,1); primerslap=false; }
	}
	if ((long>=5) && (segundoslap==false))
	{ mes=fecha.substr(3,2);
	if ((IsNumeric(mes)==true) &&(mes<=12) && (mes!="00")) { fecha=fecha.substr(0,5)+"/"+fecha.substr(6,4); segundoslap=true; }
	else { fecha=fecha.substr(0,3);; segundoslap=false;}
	}
	else { if ((long<=5) && (segundoslap=true)) { fecha=fecha.substr(0,4); segundoslap=false; } }
	if (long>=7)
	{ ano=fecha.substr(6,4);
	if (IsNumeric(ano)==false) { fecha=fecha.substr(0,6); }
	else { if (long==10){ if ((ano==0) || (ano<1900) || (ano>2100)) { fecha=fecha.substr(0,6); } } }
	}
	if (long>=10)
	{
		fecha=fecha.substr(0,10);
		dia=fecha.substr(0,2);
		mes=fecha.substr(3,2);
		ano=fecha.substr(6,4);
		// Año no viciesto y es febrero y el dia es mayor a 28
		if ( (ano%4 != 0) && (mes ==02) && (dia > 28) ) { fecha=fecha.substr(0,2)+"/"; }
	}
	return (fecha);
}
