<html>
<link rel="stylesheet" href="estilo.css">
    <body>
    <h1>Registro Clientes</h1>    
    <a href="main.html">Menú</a>

    <form method="post" action="comregcli.php">
            NIF:<input type="text" name="nif"><br>
            Nombre:<input type="text" name="nombre"><br>
            Apellido:<input type="text" name="apellido"><br>
            CP:<input type="text" name="cp"><br>
            Direccion:<input type="text" name="direccion"><br>
            Ciudad:<input type="text" name="ciudad"><br>
        <input type="submit" value="Enviar">
    </form>
</html>
<?php
 if($_SERVER["REQUEST_METHOD"]=="POST"){
    require "funciones.php";
    $nombre=validar($_POST["nombre"]);
    $apellido=validar($_POST["apellido"]);
    $nif=validar($_POST["nif"]);
    $cp=validar($_POST["cp"]);
    $direccion=validar($_POST["direccion"]);
    $ciudad=validar($_POST["ciudad"]);
    $passw=strrev(strtolower(trim($apellido)));

    try {
        $conn=conexion();
        $stmt = $conn->prepare("SELECT * FROM clientesweb
                where usuario=:usuario and contrasena=:passw");
            $stmt->bindParam(":usuario", $nombre);
            $stmt->bindParam(":passw", $passw);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_NUM);
            $resultado=$stmt->fetchAll();
            if(count($resultado)>0){
                echo "Error, nombre duplicado";
            }else{
                $stmt = $conn->prepare("INSERT INTO cliente (nif, nombre, apellido, cp, direccion, ciudad, clave)
                values (:nif, :nombre, :apellido, :cp, :direccion, :ciudad, :clave);");
                $stmt->bindParam(":nif", $nif);
                $stmt->bindParam(":nombre", $nombre);
                $stmt->bindParam(":apellido", $apellido);
                $stmt->bindParam(":cp", $cp);
                $stmt->bindParam(":direccion", $direccion);
                $stmt->bindParam(":ciudad", $ciudad);
                $stmt->bindParam(":clave", $passw);
                $stmt->execute();
                echo "Cliente creado con exito";

            }
    }
    catch(PDOException $e) {
       echo "Error: " . $e->getMessage();
    
    }
    $conn=null;
 }
?>