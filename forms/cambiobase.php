<?php
echo"<h1>CONVERSOR NUMERICO</h1><br><br>";
function validar($datos){

    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $num=validar($_POST["num"]);
    $tipo=$_POST["radio"];
    $decimal=decbin($num);
    $octal=decoct($num);
    $hexa=dechex($num);
    echo 'Numero Decimal:<input type="textbox" value="'.$num.'" readonly><br><br><table border=2px>';
    switch($tipo){
        case "bin":
            echo'<tr><td>Binario</td><td>'.$decimal.'</td></tr>';
            break;

         case "oct":
            echo'<tr><td>Octal</td><td>'.$octal.'</td></tr>';
            break;
            
         case "hexa":
            echo'<tr><td>Hexadecimal</td><td>'.$hexa.'</td></tr>';
            break;

         case "todo":
            echo'<tr><td>Binario</td><td>'.$decimal.'</td></tr>
                 <tr><td>Octal</td><td>'.$octal.'</td></tr>
                 <tr><td>Hexadecimal</td><td>'.$hexa.'</td></tr>';
            break;
    }   
echo"</table>";
}
?>
