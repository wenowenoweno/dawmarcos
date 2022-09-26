<HTML>
<HEAD><TITLE> EJ1B – Conversor decimal a binario</TITLE></HEAD>
<BODY>
<?php
$num="168";

if ($num<=0){
    return "0";
}
$binario="";
while ($num>1){
    $resto=$num%2;
    $num=$num/2;
    $binario=$resto.$binario;
}
echo $binario;

?>
</BODY>
</HTML>
