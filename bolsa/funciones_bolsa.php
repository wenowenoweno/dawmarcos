<?php
/*
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

function generarOptions(){
    $file=file("ibex35.txt");

    for($x=1;$x<count($file);$x++){
        $linea=$file[$x];
        $nombrelist=substr($linea, 0, strpos($linea, " "));
        echo '<option value="'.$nombrelist.'">'.$nombrelist.'</option>';
    }
}*/

//function generarArray($nombreex, $nlinea){

    $file=file("ibex35.txt");
    for($x=1;$x<count($file);$x++){
        $linea=$file[$x];
        $exnoma="/ACCIONA/";
        $exnom='/([a-z]+\s[a-z]+\s[a-z]+)|([a-z]+\s[a-z]+\.)|([a-z]+\.\s[a-z]+)|([a-z]+\s[a-z]+)|[a-z]*/i';
        //$nombre=substr($linea, 0, strpos($linea, " "));
        preg_replace($exnoma, " ",$linea);
        echo $nombre."<br>";
        echo $linea."<br>";
    }
        /*
        $variacionporc
        $variacion
        $acano
        $max
        $min
        $vol
        $cap
    }
}
function buscarDatos($nombre, $campo){
    $file=file("ibex35.txt");

}*/
?>
