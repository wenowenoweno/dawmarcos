<?php

echo"<h1>CONVERSOR BINARIO</h1><br>";

function validar($datos){

    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $num=validar($_POST["num"]);
    $binario="";
    if ($num<=0){
        $binario="0";
    }
    
    while ($num>1){
        $resto=$num%2;
        $num=$num/2;
        $binario=$resto.$binario;
    }
    echo 'Numero decimal: <input type="text" value="'.$_POST["num"].'" readonly><br><br>
        Numero binario: <input type="text" value="'.$binario.'" readonly>';
}else{
    echo "ERROR";
}
?>
