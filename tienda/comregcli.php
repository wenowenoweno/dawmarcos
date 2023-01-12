<html>
<link rel="stylesheet" href="estilo.css">
    <body>
    <h1>Registro Clientes</h1>    
    <a href="main.html">Menú</a>

    <form method="post" action="comregcli.php">
        Nombre:<input type="text" name="nombre"><br> 
        Apellido:<input type="text" name="apellido"><br>
        <input type="submit" value="Enviar">
    </form>
</html>
<?php
 if($_SERVER["REQUEST_METHOD"]=="POST"){
    require "funciones.php";
    $nombre=validar($_POST["nombre"]);
    $apellido=validar($_POST["apellido"]);
    $apellido=strrev(strtolower(trim($apellido)));

    try {
        $conn=conexion();
        $stmt = $conn->prepare("INSERT INTO clientesweb (usuario, contrasena)
         values (:nombre, :contrasena);");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":contrasena", $apellido);
        $stmt->execute();
        echo "Cliente creado con exito";
    }
    catch(PDOException $e) {
       if(($e->getCode())=="23000"){
        echo "Entrada duplicada";
       }else{echo "Error: " . $e->getMessage();}
    
    }
    $conn=null;
 }
?>
