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

function variado(){
    
    $file=file("ibex35.txt");
    $campos = preg_split("/([ ]{2,})/", $file[0]);
    $maxcot=0;
    for($x=1;$x<count($file);$x++){ //maxima cotizacion;
        $linea=preg_split("/( +[^A-Za-z\d] )/", $file[$x]);
        if($linea[1]>$maxcot){
            $nombre=$linea[0];
            $maxcot=$linea[1];
        }    
    }
    echo "La <b>cotizacion maxima</b> es de ".$nombre." con un valor de ".$maxcot."<br>";

    $mincot=0;
    for($x=1;$x<count($file);$x++){ //minima cotizacion;
        $linea=preg_split("/( +[^A-Za-z\d] )/", $file[$x]);
        if($x===1){
            $mincot=$linea[1];
        }
        if($linea[1]<$mincot){
            $nombre=$linea[0];
            $mincot=$linea[1];
        }    
    }
    echo "La <b>cotizacion minima</b> es de ".$nombre." con un valor de ".$mincot."<br>";

    $minvol=0;
    for($x=1;$x<count($file);$x++){ //menor volumen;
        $linea=preg_split("/( +[^A-Za-z\d] )/", $file[$x]);
        $vol=str_replace(".", "", $linea[7]);
        if($x===1){
            $minvol=$vol;
        }
        if($linea[7]<$minvol){
            $nombre=$linea[0];
            $minvol=$vol;
        }    
    }
    echo "El <b>menor volumen</b> es de ".$nombre." con un valor de ".$minvol."<br>";

    $maxvol=0;
    for($x=1;$x<count($file);$x++){ //mayor volumen;
        $linea=preg_split("/( +[^A-Za-z\d] )/", $file[$x]);
        $vol=str_replace(".", "", $linea[7]);

        if($linea[7]>$maxvol){
            $nombre=$linea[0];
            $maxvol=$vol;
        }    
    }
    echo "El <b>menor volumen</b> es de ".$nombre." con un valor de ".$maxvol."<br>";

    $maxcap=0;
    for($x=1;$x<count($file);$x++){ //mayor capitalizacion;
        $linea=preg_split("/( +[^A-Za-z\d] )/", $file[$x]);
        $cap=str_replace(".", "", $linea[8]);
        if($cap>$maxcap){
            $nombre=$linea[0];
            $maxcap=$cap;
        }    
    }
    echo "La <b>mayor capitalizacion</b> es de ".$nombre." con un valor de ".$maxcap."<br>";   
    
    $mincap=0;
    for($x=1;$x<count($file);$x++){ //menor capitalizacion;
        $linea=preg_split("/( +[^A-Za-z\d] )/", $file[$x]);
        $cap=str_replace(".", "", $linea[8]);
        if($x===1){
            $mincap=$vol;
        }
        if($cap<$mincap){
            $nombre=$linea[0];
            $mincap=$cap;
        }    
    }
    echo "La <b>menor capitalizacion</b> es de ".$nombre." con un valor de ".$mincap."<br>";  
} 
?>
