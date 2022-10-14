<?php
function validar($datos){

    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $num=validar($_POST["num"]);
    $basenueva=validar($_POST["base"]);

    $numero=substr($num, 0, strpos($num,'/'));
    $basen=substr($num,strpos($num, "/",)+1);

    $nuevonum=base_convert($numero, $basen, $basenueva);
    
    echo"<h1>Cambio de base</h1>
        <br>
        Numero ".$numero." en base ".$basen."=".$nuevonum." en base ".$basenueva;

   
}
?>
