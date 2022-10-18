<?php
echo '<table border="1">';
echo"<tr><td>Nombre</td><td>Apellido1</td><td>Apellido2</td><td>FechaNac</td><td>Localidad</td></tr>";
$file = fopen("alumnos1.txt", "r") or die("Unable to open file!");
while (!feof($file)){   
    
    $data = fgets($file); 

    $nombre=substr($data,0,strpos($data," "));
    $data=substr($data,strpos($data," "));

    $data=trim($data);
    $apellido=substr($data,0,strpos($data," "));
    $data=substr($data,strpos($data," "));
    
    $data=trim($data);
    $apellido2=substr($data,0,strpos($data," "));
    $data=substr($data,strpos($data," "));
    
    $data=trim($data);
    
    $fecha=substr($data,0,strpos($data," "));
    $data=substr($data,strpos($data," "));
    
    $data=trim($data);
    $localidad=$data;

   
    echo "<tr><td>".$nombre."</td><td>".$apellido."</td><td>".$apellido2."</td><td>".$fecha."</td><td>".$localidad."</td></tr>";
}
echo '</table>';
fclose($file);
?>
