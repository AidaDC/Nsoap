<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

    <form class="sum" name="sum" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    				<select name ="seleccion">
    				<option value="Add">Sumar</option>
    				<option value="res">Restar</option>
    				<option value="mult">Multiplicar</option>
    				<option value="div">Dividir</option></select>
                    <label >Primer Numero<input name="val1" type="text" ></label>
                    <label >Segundo Numero<input name="val2" type="text" ></label>
                    <input type="submit" value="Calcula" id="calcula">
                    <div></div>
                </form>
<?php
 
require_once ('lib/nusoap.php');
$val1=$_POST['val1'];
$val2=$_POST['val2'];
$op=$_POST['seleccion'];

/*if(!isset($val1)){
$val1='';
}

 if(!isset($val2)){
$val2='';
}	

if(!isset($op)){
$op='Add';
}*/

$wsdl="http://localhost/soap/serv/calc_server.php?wsdl";
$client = new nusoap_client($wsdl,'wsdl');
$params = array('a' => $val1, 'b'=>$val2);
$result= $client->call($op, $params);
echo '<h2>Resultat</h2><pre>';
$err = $client->getError();
if ($err) {
	// Display the error
	echo '<p><b>Error: '.$err.'</b></p>';
} else {
	// Display the result
	print_r($result);


}





?>

</body>
</html>



