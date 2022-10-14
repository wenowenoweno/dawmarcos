<?php
function validar($datos){

    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}
function depurarSex($sexo){
    switch ($sexo) {
        case "mujer":
            $sexo="M";
            break;

        case "hombre":
            $sexo="H";
            break;
    }
    return $sexo;
}
function crearArray($nombre, $apellido1, $apellido2, $email, $sexo){
    $apellidos=$apellido1." ".$apellido2;
    $alumno=array($nombre, $apellidos, $email, $sexo);
    return $alumno;
}
function escribirDatos($alumno){
    $datos="";
    $size=count($alumno)-1;
    for($x=0;$x<=$size;$x++){
        
        $datos=$datos.$alumno[$x]." ";
    }
    $datos=$datos."\n";
    return $datos;
}
function escribirTabla($alumno){
    echo "<tr>";
    $size=count($alumno)-1;
    for($x=0;$x<=$size;$x++){
        echo"<td>".$alumno[$x]."</td>";
    }
    echo"</tr>";
}
if($_SERVER["REQUEST_METHOD"]=="POST") {
    $nombre=validar($_POST["nombre"]);
    $apellido1=validar($_POST["apellido1"]);
    $apellido2=validar($_POST["apellido2"]);
    $email=validar($_POST["email"]);
    $sexo=validar($_POST["sexo"]);
    if(($nombre==null)||($email==null)||($sexo==null)){
        echo "ERROR";
    }else{
        $sexo=depurarSex($sexo);
        $alumno=crearArray($nombre, $apellido1, $apellido2, $email, $sexo);
        $datos=escribirDatos($alumno);
        
        $fichero=fopen("alumnos.txt", "a");
        fwrite($fichero, $datos);
        fclose($fichero);
        echo"<table border=2px><tr> <th>Nombre</th> <th>Apellidos</th> <th>Email</th> <th>Sexo</th></tr>";
        escribirTabla($alumno);
        echo"</table>";
    }
}

?>
