<html>
    <body>
        <form method="post" action="comaltaalm">
            Localidad:<input type="text" name="localidad"><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require "funciones.php";
    $localidad=validar($_POST["localidad"]);
    try {
        $conn=conexion();
        $stmt = $conn->prepare("INSERT INTO almacen (localidad)
         values (:localidad);");
        $stmt->bindParam(":localidad", $localidad);
        $stmt->execute();
        echo "Almacen creado con exito";
    }
    catch(PDOException $e) {
       echo "Error: " . $e->getMessage();
    }
}
?>
