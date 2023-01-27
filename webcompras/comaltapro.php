<html>
<link rel="stylesheet" href="estilo.css">
    <body>
        <h1>Alta producto</h1>
    <a href="main.html">Menú</a><br>
        <form method="post" action="comaltapro.php">
            Nombre:<input type="text" name="nombre"><br><br>
            Precio:<input type="text" name="precio"><br><br>
            Categoria:
            <?php
            require "funciones.php";
            $conn=conexion();
            selectCategoria($conn);
            $conn=null;
            ?>
            
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

    $conn=conexion();
    $pk=numSiguientePro($conn);
    $nombre=validar($_POST["nombre"]);
    $precio=validar($_POST["precio"]);
    $cat=$_POST["cat"];
    try {
        $conn=conexion();
        $stmt = $conn->prepare("INSERT INTO producto (id_producto, nombre, precio, id_categoria)
         values (:pk, :nombre, :precio, :cat);");
        $stmt->bindParam(":pk", $pk);
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":precio", $precio);
        $stmt->bindParam(":cat", $cat);
        $stmt->execute();
        echo "Producto creado con exito";
    }
    catch(PDOException $e) {
       echo "Error: " . $e->getMessage();
    }
}
?>