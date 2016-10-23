#!/usr/bin/php -q
<?php
set_time_limit(30);
$param_error_log = '/tmp/notas.log';
$param_debug_on = 1;
require('phpagi.php');
$agi = new AGI();
$agi->answer();
sleep(1);


$agi->text2wav("Bienvenido a peliculas UdeA");

$numero_pelicula=1;
$mes="";
$opcion_key=1;

require("definiciones.inc");
$link = mysql_connect(MAQUINA, USUARIO,CLAVE);
mysql_select_db(DB, $link);
$result = mysql_query("SELECT DISTINCT nombre FROM pelicula", $link);
$rowCount = mysql_num_rows($result);
$keys="";
$intentosPelicula=3;

while ($keys=="" and $intentosPelicula!=0){
	sleep(1);
	$numero_pelicula=1;
	mysql_data_seek($result, 0);
	$agi->text2wav("selecione el numero de la pelicula despues de escuchar el tono");
	while ($row = mysql_fetch_array($result)){
		$agi->text2wav($numero_pelicula);
		$agi->text2wav($row[0]);
		$numero_pelicula=$numero_pelicula+1;
		sleep(1);
	}
	$_result = $agi->get_data('beep', 3000, 20);
	$keys = $_result['result'];
	if($keys===""){
		$intentosPelicula=$intentosPelicula-1;
	}
	else if(intval($keys)<=0 or $rowCount<intval($keys)){
		$agi->text2wav("opcion incorrecta, intente de nuevo");
		$keys="";
	}
}

if($keys!=""){
	mysql_data_seek($result, $keys-1);
	if ($row = mysql_fetch_array($result)) {
		$agi->text2wav('ha seleccionado');
		$agi->text2wav($row[0]);
		$nombrePelicula=$row[0];
	}
	sleep(1);
	$keys="";
	$intentosPelicula=3;

	$result = mysql_query("SELECT nombre, descripcion, genero FROM pelicula where nombre=\"$nombrePelicula\"", $link);
	while (($keys=="" or $keys=='1') and $intentosPelicula!=0) {
		mysql_data_seek($result, 0);
		$agi->text2wav('Para obtener informacion de la pelicula presione uno');
		$agi->text2wav('Para realizar una reserva de la pelicula presione dos');
		$_result = $agi->get_data('beep', 3000, 20);
		$keys = $_result['result'];
		if($keys===""){
			$intentosPelicula=$intentosPelicula-1;
		}else if($keys=='1'){
			if ($row = mysql_fetch_array($result)){
				$agi->text2wav('nombre de la pelicula');
				$agi->text2wav($row[0]);
				$agi->text2wav('genero ');
				$agi->text2wav($row[2]);
				$agi->text2wav('descripcion ');
				$agi->text2wav($row[1]);
				sleep(1);
			}
		}else if($keys!='1' and $keys!='2'){
			$agi->text2wav("opcion incorrecta, intente de nuevo");
			$keys="";
		}
	}

	$result = mysql_query("select month(fecha),day(fecha),hour(fecha),minute(fecha),fecha from pelicula where nombre=\"$nombrePelicula\"", $link);
	$agi->text2wav("la pelicula se presentara en la siguientes fechas, seleccione la opcion de la fecha deseada");
	$fechakey="";
	$fecha="";
	while($fechakey==""){
		mysql_data_seek($result, 0);
		$opcion_key=1;
		while ($row = mysql_fetch_array($result)){
			switch ($row[0]) {
				case '1':
						$mes="Enero";
					break;
				case '2':
						$mes="Febrero";
				break;
				case '3':
						$mes="Marzo";
				break;
				case '4':
						$mes="Abril";
				break;
				case '5':
						$mes="Mayo";
				break;
				case '6':
						$mes="Junio";
				break;
				case '7':
						$mes="Julio";
				break;
				case '8':
						$mes="Agosto";
				break;
				case '9':
						$mes="Septiembre";
				break;
				case '10':
						$mes="Octubre";
				break;
				case '11':
						$mes="Noviembre";
				break;
				case '12':
						$mes="Diciembre";
				break;
				default:
					break;
			}
			$agi->text2wav("opcion \"$opcion_key\"");
			$agi->text2wav("\"$row[1]\" de \"$mes\" a las \"$row[2]\" \"$row[3]\" horas");
			$opcion_key=$opcion_key+1;
		}
		$_result = $agi->get_data('beep', 3000, 20);
		$fechakey = $_result['result'];
	}

	mysql_data_seek($result, $fechakey-1);
	if ($row = mysql_fetch_array($result)) {
		$agi->text2wav('ha seleccionado');
		$agi->text2wav("\"$row[1]\" de \"$mes\" a las \"$row[2]\" \"$row[3]\" horas");
		$fecha=$row[4];
	}

	$result = mysql_query("select formato,precio from pelicula where nombre=\"$nombrePelicula\" and fecha=\"$fecha\"", $link);
	$agi->text2wav("la pelicula se presentara en los siguientes formatos, seleccione la opcion con el formato deseado");
	$formatokey="";
	while($formatokey==""){
		mysql_data_seek($result, 0);
		$opcion_key=1;
		while ($row = mysql_fetch_array($result)){
			$agi->text2wav("opcion \"$opcion_key\"");
			$agi->text2wav("formato \"$row[0]\" tiene un precio de \"$row[1]\" pesos");
			$opcion_key=$opcion_key+1;
		}
		$_result = $agi->get_data('beep', 3000, 20);
		$formatokey = $_result['result'];
	}

	mysql_data_seek($result, $formatokey-1);
	if ($row = mysql_fetch_array($result)) {
		$agi->text2wav('ha seleccionado');
		$agi->text2wav("formato \"$row[0]\"");
		$formato=$row[0];
		$precio=$row[0];
	}

	$agi->text2wav("Por favor ingrese su codigo de usuario seguido de la tecla numeral");
	$codigoOk=false;
	$intentos=3;
	$codigo="";
	while(!$codigoOk and $intentos!=0){
		$_result = $agi->get_data('beep', 3000, 20);
		$codigo = $_result['result'];
		$result = mysql_query("select nombre from usuario where codigo=\"$codigo\"", $link);
		if (!($row = mysql_fetch_array($result))) {
			$agi->text2wav("codigo de usuario incorrecto, intente de nuevo");
			$intentos=$intentos-1;
		}else{
			$codigoOk=true;
			$usuario=$row[0];
		}
	}
	if($intentos==0){
		$agi->text2wav("Se ha sobrepasado el numero de intentos permitido, intente mas tarde");
	}else{
		$agi->text2wav("Informacion de la reserva  hecha por \"$usuario\" ");
		$agi->text2wav("Pelicula \"$nombrePelicula\" ");
		$agi->text2wav("Formato \"$formato\" ");
		$agi->text2wav("ingrese uno para confirmar la reserva o dos para cancelarla");
		$_result = $agi->get_data('beep', 3000, 20);
		$confirmarReserva = $_result['result'];
		if($confirmarReserva="1"){
			$result = mysql_query("select id from pelicula where nombre=\"$nombrePelicula\" and formato=\"$formato\" and fecha=\"$fecha\"", $link);
			if($row = mysql_fetch_array($result)) {
				$id=$row[0];
			}
			$query=mysql_query("INSERT INTO boleto(pelicula,usuario) values(\"$id\",\"$codigo\")", $link);
			if (!$query) {
    			if(mysql_errno($link)==1062){
						$agi->text2wav("has realizado esta reserva anteriormente");
					}
			}else{
				$agi->text2wav("reserva realizada con exito");
			}
		}else if($confirmarReserva="2"){
			$agi->text2wav("reserva cancelada");
		}
	}
}

$agi->text2wav("Gracias por utilizar nuestro sistema de audiorespuesta, hasta pronto");
$agi->hangup();
?>
