<?php
$file=fopen("ibex35.txt","r");
while(!feof($file)){
    echo fgets($file)."<br>";
}
fclose($file);
?>
