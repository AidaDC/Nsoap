<?php

header("Content-type: text/xml"); 
include('lib/nusoap.php');

if(!isset($_REQUEST['ciudad'])){
$ciudad='Barcelona';
}else{
$ciudad=$_REQUEST['ciudad'];	
}
if(!isset($_REQUEST['pais'])){
$pais='Spain';
}else{
$pais=$_REQUEST['pais'];	
}



$cliente = new nusoap_client('http://www.webservicex.net/globalweather.asmx?WSDL','wsdl');
$error = $cliente->getError();
if ($error) {

}

$param = array('CityName'=>$ciudad,'CountryName'=>$pais);

$resultado = $cliente->call('GetWeather',$param);

$resultado2 = end($resultado);

$resultado2 = mb_convert_encoding($resultado2, "UTF-16", "UTF-8");

if ($cliente->fault) {
} else {
	$error = $cliente->getError();
	if ($error) {

	} else {
		 $xml=simplexml_load_string($resultado2) or die("Error: Cannot create object");
		 echo $xml->asXML();


	}
}
?>