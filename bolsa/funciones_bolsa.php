<?php

function validar($datos){

    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}

function mostrarDatos($url){
    $file=file($url);
    foreach($file as $linea){
        echo"<pre>";
        echo($linea);
        echo"</pre>";
        echo"<br>";
    }
}

function introducirDatos($nombre){
    $file=file("ibex35.txt");
    $nombre=strtoupper(validar($_POST["nombre"]));
    $test=0;
    for($x=1;$x<count($file);$x++){
        $linea=$file[$x];
        $nombrelist=substr($linea, 0, strpos($linea, " "));
        if($nombre==$nombrelist){
            echo "<pre>".$linea."</pre>";
            $test++;
        }
    }
    if($test==0){
        echo "Nombre no encontrado";
    }
}
?>
