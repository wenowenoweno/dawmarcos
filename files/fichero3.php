<?php
//echo '<table border="1">';
$file = fopen("alumnos1.txt", "r") or die("Unable to open file!");
while (!feof($file)){   
    $data = fgets($file); 
    $datos=explode(" ",$data,0);

    for($x=0;$x<=count($datos);$x++){

    echo($datos[$x]);
    
    }
    //echo($datos[0]);
}

//var_dump(count($datos));
//echo '</table>';
fclose($file);
?>
