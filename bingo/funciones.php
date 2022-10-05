<?php
function crearSetCartones($numCartones, $numNumeros, $numMax){
    //WARNING EL numeroMax NO PUEDE SER MAYOR QUE EL numNumerosm, produce timeout
    if ($numNumeros > $numMax) {return null;}
    $array = [];
    for ($i = 0; $i < $numCartones; $i++){
        $temp = [];
        for ($v = 0; $v < $numNumeros; $v++){
            $num = rand(1, $numMax);
            if (!(in_array(($num), $temp))){
                array_push($temp, $num);
            } else {
                $v--;
            }
        }
        array_push($array, $temp);
    }
    return $array;
}

function crearBolas(){
        $bolas=array();
        for($x=0;$x<=59;$x++){
        $bolas[$x]=$x+1;
    }
    shuffle($bolas);
    return $bolas;
}

function sacarBola($bolas){    
            for ($x=0;$x<=59;$x++){
            echo '<img src="'.$bolas[$x].'.PNG">';
            }
}
function contarVueltas($n, $carton){
    $cont=0;
    $vueltas=0;
    do{
        for($x=0;$x<=59;$x++){
            for($i=0;$i<=14;$i++){
                $vueltas=$vueltas+1;
                if($bolas[$x]==$carton[$i]){
                    $cont++;
                }
            }
        }
    }while($cont!=15);
    return $vueltas;
}

function ganador($jugador1, $jugador2, $jugador3, $jugador4){
    $ganador="";
    $max1=0;
    $max2=0;
    $max3=0;
    $max4=0;
    /*$carton11=contarVueltas($bombo, $jugador1[0]);
    $carton21=contarVueltas($bombo, $jugador2[0]);
    $carton31=contarVueltas($bombo, $jugador3[0]);
    $carton41=contarVueltas($bombo, $jugador4[0]);
    $carton12=contarVueltas($bombo, $jugador1[1]);
    $carton22=contarVueltas($bombo, $jugador2[1]);
    $carton32=contarVueltas($bombo, $jugador3[1]);
    $carton42=contarVueltas($bombo, $jugador4[1]);
    $carton13=contarVueltas($bombo, $jugador1[2]);
    $carton23=contarVueltas($bombo, $jugador2[2]);
    $carton33=contarVueltas($bombo, $jugador3[2]);
    $carton43=contarVueltas($bombo, $jugador4[2]);*/
for ($i=0;$i<=2;$i++){
    for($x=0;$x<=14;$x++){
        
        if(contarVueltas($jugador1[$i][$x])>$max1){
            $max1=$jugador1[$x];
        }
    }
    for($x=0;$x<=14;$x++){
        
        if($jugador2[$i][$x]>$max2){
            $max2=$jugador2[$i][$x];
        }
    }
    for($x=0;$x<=14;$x++){
        
        if($jugador3[$i][$x]>$max3){
            $max3=$jugador3[$i][$x];
        }
    }
    for($x=0;$x<=14;$x++){
        
        if($jugador4[$i][$x]>$max4){
            $max4=$jugador4[$i][$x];
        }
    }
}

    if(($max1>$max2)&&($max1>$max3)&&($max1>$max4)){
        $ganador="Jugador 1";
    }else{
        if(($max2>$max1)&&($max2>$max3)&&($max2>$max4)){
             $ganador="Jugador 2";
        }else{
            if(($max3>$max1)&&($max3>$max2)&&($max3>$max4)){
            $ganador="Jugador 3"; 
            }else{
                if(($max4>$max1)&&($max4>$max3)&&($max4>$max2)){
                    $ganador="Jugador 4";
                }
            }
        }
    }
return $ganador;
}
?>
