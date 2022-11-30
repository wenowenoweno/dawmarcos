<?php

function conexion(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "empleadosnn";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function validar($datos){

    $datos=trim($datos);
    $datos=stripslashes($datos);
    $datos=htmlspecialchars($datos);
    return $datos;
}

function sacarDptos($conn){
    $stmt = $conn->prepare("SELECT * FROM dpto");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
	$resultado=$stmt->fetchAll();
    echo "<ul>";
    for($x=0;$x<=count($resultado)-1;$x++){
        echo "<li>".$resultado[$x][2]."</li>";
    }
    echo "</ul>";
}

function selectDpto($conn){
    $stmt = $conn->prepare("SELECT id, nombre FROM dpto;");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    echo "<select name='dpto' id='dpto'>";
    for($x=0;$x<=count($resultado)-1;$x++){
        echo "<option value=".$resultado[$x][0].">".$resultado[$x][1]."</option>";
    }
    echo "</select><br><br>";
}

function insertarEmple($conn, $dni, $nombre, $salario, $fecha){
    $stmt = $conn->prepare("INSERT INTO emple (dni, nombre, salario, fecha_nac) values (:dni, :nombre, :salario, :fecha);");
    $stmt->bindParam(":dni", $dni);
    $stmt->bindParam(":nombre", $nombre);
    $stmt->bindParam(":salario", $salario);
    $stmt->bindParam(":fecha", $fecha);
    $stmt->execute();
}

function insertarEmpleDpto($conn, $dni, $dpto){
    $stmt = $conn->prepare("INSERT INTO emple_dpto (dni_emple, id_dpto, fecha_inicio, fecha_fin)
                             values (:dni, :dpto, now(), null);");
    $stmt->bindParam(":dni", $dni);
    $stmt->bindParam(":dpto", $dpto);
    $stmt->execute();
}

function selecDpto($conn, $dpto){
    $stmt = $conn->prepare("select nombre from emple, emple_dpto
    where dni=dni_emple and id_dpto=:dpto");
    $stmt->bindParam(":dpto", $dpto);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
	$resultado=$stmt->fetchAll();
    echo "<ul>";
    for($x=0;$x<=count($resultado)-1;$x++){
        echo "<li>".$resultado[$x][0]."</li>";
    }
    echo "</ul>";
}

function selectDNI($conn){

    $stmt = $conn->prepare("SELECT dni FROM emple;");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    echo "<select name='dni' id='dni'>";
    echo "<option value='' selected>";
    for($x=0;$x<=count($resultado)-1;$x++){
        echo "<option value=".$resultado[$x][0].">".$resultado[$x][0]."</option>";
    }
    echo "</select><br><br>";
}

function mostrarSueldo($conn, $dni){
    $stmt = $conn->prepare("SELECT salario FROM emple
                            where dni=:dni;");
    $stmt->bindParam(":dni", $dni);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    echo $resultado[0][0];
}

function cambiarSueldo($conn, $sueldo, $dni){
    $stmt = $conn->prepare("UPDATE emple SET salario=':sueldo' WHERE dni=':dni';");
    $stmt->bindParam(":dni", $dni);
    $stmt->bindParam(":sueldo", $sueldo);
    $stmt->execute();
}

?>
