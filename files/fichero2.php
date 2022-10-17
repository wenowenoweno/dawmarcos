<?php

function validar($datos){

    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}

function crearAlumno($nombre, $apellido1, $apellido2, $fecha, $localidad){
    $alumno=$nombre."##".$apellido1."##".$apellido2."##".$fecha."##".$localidad."\n";
    return $alumno;
}

function escribirAlumno($alumno){
    $fichero=fopen("alumnos2.txt", "a");
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
