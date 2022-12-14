<html>
    <body>
        <form method="post" action="comaltacat.php">
            Nombre:<input type="text" name="nombre"><br><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require "funciones.php";
    $tabla="almacen";
    $conn=conexion();
    $pk=numSiguienteCat($conn);
    $nombre=validar($_POST["nombre"]);
    try {
        $conn=conexion();
        $stmt = $conn->prepare("INSERT INTO categoria (id_categoria, nombre)
         values (:pk, :nombre);");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":pk", $pk);
        $stmt->execute();
        echo "Categoria creada con exito";
    }
    catch(PDOException $e) {
       echo "Error: " . $e->getMessage();
    }
}
?>
