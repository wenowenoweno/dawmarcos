<?php

function validar($datos){

$datos=trim($datos);
$datos=stripslashes($datos);
$datos=htmlspecialchars($datos);
return $datos;
}

if($_SERVER["REQUEST_METHOD"]=="POST") {
$ip=validar($_POST["ip"]);

$parte1=substr($ip,0,strpos($ip,"."));
$ip=substr($ip,strpos($ip,'.')+1);

$parte2=substr($ip,0,strpos($ip,"."));
$ip=substr($ip,strpos($ip,'.')+1);

$parte3=substr($ip,0,strpos($ip,"."));
$ip=substr($ip,strpos($ip,'.')+1);

$parte4=$ip;

$parte1bin=decbin($parte1);
$parte2bin=decbin($parte2);
$parte3bin=decbin($parte3);
$parte4bin=decbin($parte4);


echo'<h1>IPs</h1>
<br>
IP notacion decimal:<input type="textarea" name="ip" value="'.$_POST["ip"].'" readonly><br><br>
IP Binario <input type="textarea" style="width: 300px;" value="'.$parte1bin.'.'.$parte2bin.'.'.$parte3bin.'.'.$parte4bin.'" readonly>';



}
?>
