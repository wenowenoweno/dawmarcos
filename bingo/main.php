<HTML>
<HEAD><TITLE> MainBingo </TITLE><style>table, td{border: 1px solid; text-align: center;}</style></HEAD>
<BODY>
<?php
require("functions.php");

$jugador1 = crearSetCartones(3, 15, 60);
$jugador2 = crearSetCartones(3, 15, 60);
$jugador3 = crearSetCartones(3, 15, 60);
$jugador4 = crearSetCartones(3, 15, 60);

$bombo = crearBolas();
sacarBola($bombo);

/*for ($i = 0; $i < count($bombo); $i++){
    $bola = sacarBola($i, $bombo);
   
    $g = revisarBingo($jugador1, $jugador2, $jugador3, $jugador4);
    if ($g[0]) {
        echo("ha ganado el " . $g[1]);
    }
}*/

$win=ganador($jugador1, $jugador2, $jugador3, $jugador4);
echo "el ganador es ".$win;

    
?>
</BODY>
</HTML>
