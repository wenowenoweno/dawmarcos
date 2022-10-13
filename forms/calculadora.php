<?php
echo"<h1>CALCULADORA</h1><br><br>";
$valor1;
$valor2;
$operacion;

function validar($datos){

    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}

if($_SERVER["REQUEST_METHOD"]=="POST") {
    $valor1=validar($_POST["operando1"]);
    $valor2=validar($_POST["operando2"]);
    $suma=$valor1+$valor2;
    $resta=$valor1-$valor2;
    $prod=$valor1*$valor2;
    $division=$valor1/$valor2;
    switch($_POST["operacion"]){
        case "suma":
            echo "Resultado operacion: ".$valor1." + ".$valor2." = ".$suma;
             break;
        case "resta":
            echo "Resultado operacion: ".$valor1." - ".$valor2." = ".$resta;
             break;
        case "producto":
            echo "Resultado operacion: ".$valor1." x ".$valor2." = ".$prod;
             break;     
        case "division":
             echo "Resultado operacion: ".$valor1." / ".$valor2." = ".$division;
             break;
    }
}else{
    echo"<p>ERROR</p>";
}

?>
