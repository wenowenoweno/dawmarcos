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

function generarOptions(){
    $file=file("ibex35.txt");
    for($x=1;$x<count($file);$x++){
        $linea=$file[$x];
        $nombrelist=substr($linea, 0, strpos($linea, " "));
        echo '<option value="'.$nombrelist.'">'.$nombrelist.'</option>';
    }
}

function valores($nombre){
    $file=file("ibex35.txt");

    for ($x = 1; $x < count($file); $x++){ 
        $linea = preg_split("/( +[^A-Za-z\d] )/", $file[$x]);

        if ($linea[0] === $nombre){
          return $linea;
        }
    }
}

function buscarValor($nombre, $campo){
    $file=file("ibex35.txt");
    $campos = preg_split("/([ ]{2,})/", $file[0]);
    $index=array_search($campo ,$campos);
    return valores($nombre)[$index];
}

function totales($accion){
    $file=file("ibex35.txt");
    $campos = preg_split("/([ ]{2,})/", $file[0]);
    
    if($_POST["mostrar"]=="volumen"){
        $total=0;
        for($x=1;$x<count($file);$x++){
            $linea=preg_split("/( +[^A-Za-z\d] )/", $file[$x]);
            $ind=str_replace(".", "", $linea[7]);
            $total=$total+$ind;
        }
        echo "<b>Total Volumen</b> ".$total;
    }else{
        $total=0;
        for($x=1;$x<count($file);$x++){
            $linea=preg_split("/( +[^A-Za-z\d] )/", $file[$x]);
            $ind=str_replace(".", "", $linea[8]);
            $total=$total+$ind;
        }
        echo "<b>Total Capitalizacion</b> ".$total;
    }
}
?>
