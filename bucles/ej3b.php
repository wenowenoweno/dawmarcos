<HTML>
<HEAD><TITLE> EJ3B – Conversor decimal a cualquier base hexadecimal(16) 0-9/0-9
 * 10 A,11 B,12 C, 13 D,14 F.15 E</TITLE></HEAD>
<BODY>
<?php

$num="1234567";
$resultado="";
$resto="";


while($num / 16 != 0){
         
        $resto = (int)$num % 16;
        $num= $num / 16;
        $num=intval($num);

    switch($resto){
        case 0:
            $resultado .= "0";
            break;
        case 1:
            $resultado .= "1";
            break;
        case 2:
            $resultado .= "2";
            break;    
        case 3:
            $resultado .= "3";
            break; 
        case 4:
            $resultado .= "4";
            break; 
        case 5:
            $resultado .= "5";
            break; 
        case 6:
            $resultado .= "6";
            break; 
        case 7:
            $resultado .= "7";
            break; 
        case 8:
            $resultado .= "8";
            break; 
        case 9:
            $resultado .= "9";
            break; 
        case 10:
            $resultado .= "A";
            break; 
        case 11:
            $resultado .= "B";
            break; 
        case 12:
            $resultado .= "C";
            break; 
        case 13:
            $resultado .= "D";
            break; 
        case 14:
            $resultado .= "E";
            break; 
        case 15:
            $resultado .= "F";
            break; 
        case 16:
            default;

    }
   
    }
    echo strrev($resultado);
?>
</BODY>
</HTML>
