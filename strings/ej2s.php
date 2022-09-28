<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php

$ip="12.4.3.40";
$num =$ip;
echo"la ip es $ip <br/>";
echo"el primer octal es $primer_octal<br/><br/>";

$ip=substr($ip,strpos($ip,'.')+1);
echo"la segunda ip es $ip <br/>";
$segundo_octal=substr($ip,0,strpos($ip,'.'));
echo"el segundo octal es $segundo_octal<br/><br/>";

$ip=substr($ip,strpos($ip,'.')+1);
echo"la tercera ip es $ip <br/>";
$tercer_octal=substr($ip,0,strpos($ip,'.'));
echo"el tercer octal es $tercer_octal<br/><br/>";

$ip=substr($ip,strpos($ip,'.')+1);
echo"la cuarta ip es $ip <br/>";
$cuarto_octal=substr($ip,0);
echo"el cuarto octal es $cuarto_octal<br/><br/>";

 $binario1 = decbin ($primer_octal) ;
 $binario2 = decbin ($segundo_octal);
 $binario3 = decbin ($tercer_octal);
 $binario4 = decbin ($cuarto_octal);

echo str_pad($binario1,8,"0",STR_PAD_LEFT),".",str_pad($binario2,8,"0",STR_PAD_LEFT),".",str_pad($binario3,8,"0",STR_PAD_LEFT),".",str_pad($binario4,8,"0",STR_PAD_LEFT);

?>
</BODY>
</HTML>
