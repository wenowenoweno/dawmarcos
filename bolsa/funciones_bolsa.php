<?php
function mostrarDatos($url){
    $file=file($url);
    foreach($file as $linea){
        echo"<pre>";
        echo($linea);
        echo"</pre>";
        echo"<br>";
    }
}
?>
