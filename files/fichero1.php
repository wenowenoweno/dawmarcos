<?php

function validar($datos){

    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}

function crearAlumno($nombre, $apellido1, $apellido2, $fecha, $localidad){
    
    $numnombre= 40-strlen($nombre);
    $numapellido1= 40-strlen($apellido1);
    $numapellido2= 40-strlen($apellido2);
    $numfecha= 9-strlen($fecha);
    $numlocalidad= 26-strlen($localidad);
    
    for ($x=1;$x<=$numnombre;$x++){
        $nombre=$nombre." ";
    }

    for ($x=1;$x<=$numapellido1;$x++){
        $apellido1=$apellido1." ";
    }

    for ($x=1;$x<=$numapellido2;$x++){
        $apellido2=$apellido2." ";
    }

    for ($x=1;$x<=$numfecha;$x++){
        $fecha=$fecha." ";
    }

    for ($x=1;$x<=$numlocalidad;$x++){
        $localidad=$localidad." ";
    }
    $alumno=" ".$nombre." ".$apellido1." ".$apellido2." ".$fecha." ".$localidad."\n";
    return $alumno;
}

function escribirAlumno($alumno){
    $fichero=fopen("alumnos1.txt", "a");
    fwrite($fichero, $alumno);
    fclose($fichero);
    echo"<h2>Alumno inscrito con exito</h2>";
}



if($_SERVER["REQUEST_METHOD"]=="POST") {
    $nombre=validar($_POST["nombre"]);
    $apellido1=validar($_POST["apellido1"]);
    $apellido2=validar($_POST["apellido2"]);
    $fecha=validar($_POST["fecha"]);
    $localidad=validar($_POST["localidad"]);
   
    $alumno=crearAlumno($nombre, $apellido1, $apellido2, $fecha, $localidad);
   
    escribirAlumno($alumno);
}
?>
