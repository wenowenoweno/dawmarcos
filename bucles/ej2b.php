<HTML>
<HEAD><TITLE> EJ2B – Conversor decimal a cualquier base </TITLE></HEAD>
<BODY>
<?php

$num="5431";
$base = "-3";
$resultado="";


if($base == 0){
    echo "ERROR, no se puede dividir por 0 ";
}else if($base < 0){
    echo "No existen las bases negativas";
}else{
while($num / $base != 0){
  
        
        $resultado.= (int)$num % (int)$base;
        $num= $num / $base;
        $num=intval($num);


        echo "<br/>";
        echo strrev($resultado);
    }
}

?>
</BODY>
</HTML>
