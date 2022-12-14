<?php

function conexion(){

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "comprasweb";
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

function validarNif($nif){
    $patt = "/^[0-9]{8}[a-zA-Z]$/";
    return preg_match($patt, $nif);
}

function selectAlmacen($conn){
    $stmt = $conn->prepare("SELECT num_almacen, localidad FROM almacen;");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    echo "<select name='dpto' id='dpto'>";
    for($x=0;$x<=count($resultado)-1;$x++){
        echo "<option value=".$resultado[$x][0].">".$resultado[$x][1]."</option>";
    }
    echo "</select><br>";
}

function numSiguienteCat($conn){
    $stmt = $conn->prepare("SELECT * FROM categoria;");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    $max=substr($resultado[count($resultado)-1][0], 1);
    $max++;
    if(strlen($max)==1){
        $res="D00".$max;
    }
    if(strlen($max)==2){
        $res="D0".$max;
    }
    if(strlen($max)==3){
        $res="D".$max;
    }
    return $res;
}

function selectCategoria($conn){
    $stmt = $conn->prepare("SELECT id_categoria, nombre FROM categoria;");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    echo "<select name='cat' id='cat'>";
    for($x=0;$x<=count($resultado)-1;$x++){
        echo "<option value=".$resultado[$x][0].">".$resultado[$x][1]."</option>";
    }
    echo "</select><br><br>";
}

function numSiguientePro($conn){
    $stmt = $conn->prepare("SELECT * FROM producto;");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    $max=substr($resultado[count($resultado)-1][0], 1);
    $max++;
    if(strlen($max)==1){
        $res="P000".$max;
    }
    if(strlen($max)==2){
        $res="P00".$max;
    }
    if(strlen($max)==3){
        $res="P0".$max;
    }
    if(strlen($max)==3){
        $res="P".$max;
    }
    return $res;
}

function selectProducto($conn){
    $stmt = $conn->prepare("SELECT id_producto, nombre FROM producto;");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    echo "<select name='pro' id='pro'>";
    for($x=0;$x<=count($resultado)-1;$x++){
        echo "<option value=".$resultado[$x][0].">".$resultado[$x][1]."</option>";
    }
    echo "</select><br>";
}

function imprimirStock($conn, $prod){
    $stmt = $conn->prepare("SELECT almacena.num_almacen, id_producto, cantidad, localidad FROM almacena, almacen where id_producto=:prod and almacena.num_almacen=almacen.num_almacen;");
    $stmt->bindParam(":prod", $prod);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    echo "<table border=1px>
    <tr><th>Almacen</th><th>Nombre</th><th>Cantidad</th></tr>";
    for($i=0;$i<count($resultado);$i++){
        echo "<tr><td>".$resultado[$i][0]."</td><td>".$resultado[$i][3]."</td><td>".$resultado[$i][2]."</td></tr>";
    }
}   

function imprimirAlmacenes($conn, $alm){
    $stmt = $conn->prepare("select almacena.id_producto, cantidad, nombre from almacena, producto where num_almacen=:alm and producto.id_producto=almacena.id_producto;");
    $stmt->bindParam(":alm", $alm);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    echo "<table border=1px>
    <tr><th>Id Producto</th><th>Nombre</th><th>Cantidad</th></tr>";
    for($i=0;$i<count($resultado);$i++){
        echo "<tr><td>".$resultado[$i][0]."</td><td>".$resultado[$i][2]."</td><td>".$resultado[$i][1]."</td></td>";
    }
}  

function validarDni($conn, $dni){
    $val=true;
    $stmt = $conn->prepare("select * from cliente where nif=:dni;");
    $stmt->bindParam(":dni", $dni);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    if(empty($resultado)){
        $val=false;
    }
    return $val;
}

function comprobarStock($conn, $unidades, $pro, $alm){
    $val=true;
    $stmt = $conn->prepare("select cantidad from almacena where id_producto=:pro and num_almacen=:alm;");
    $stmt->bindParam(":pro", $pro);
    $stmt->bindParam(":alm", $alm);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
    $resultado=$stmt->fetchAll();
    if(empty($resultado)){
        $val=false;
    }else{
        if($resultado[0][0]<$unidades){
            $val=false;
        }
    }
    return $val;
}

function quitarStock($conn, $unidades, $prod, $alm){
    try {
        $stmt = $conn->prepare("select cantidad from almacena where id_producto=:pro and num_almacen=:alm;");
        $stmt->bindParam(":pro", $pro);
        $stmt->bindParam(":alm", $alm);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $resultado=$stmt->fetchAll();
        var_dump($resultado);
        $cant=$resultado[0][0]-$unidades;
        var_dump($cant);
        $stmt = $conn->prepare(" update almacena set cantidad=:cant where id_producto=:prod and num_almacen=:alm;");
        $stmt->bindParam(":pro", $pro);
        $stmt->bindParam(":alm", $alm);
        $stmt->bindParam(":cant", $cant);
        $stmt->execute();
    }
    catch(PDOException $e) {
        echo "Error2: " . $e->getMessage();
    }
}
?>
