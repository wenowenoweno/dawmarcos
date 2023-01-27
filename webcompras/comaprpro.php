<html>
<link rel="stylesheet" href="estilo.css">
<h1>Aprovisionar producto</h1>
    <a href="main.html">Menú</a>
    <form method="post" action="comaprpro.php">
        Producto: <?php
        require "funciones.php";
        $conn=conexion();
        selectProducto($conn);
        $conn=null;
        ?>
        Almacen: <?php
        $conn=conexion();
        selectAlmacen($conn);
        $conn=null;
        ?>
        Cantidad: <input type="text" name="cant"><br>
        <input type="submit" value="Enviar">
    </form>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){

$cant=validar($_POST["cant"]);
$almacen=$_POST["dpto"];
$prod=$_POST["pro"];
try {
    $conn=conexion();
    $stmt = $conn->prepare("INSERT INTO almacena (num_almacen, id_producto, cantidad)
     values (:cat, :pro, :cant);");
    $stmt->bindParam(":cant", $cant);
    $stmt->bindParam(":cat", $almacen);
    $stmt->bindParam(":pro", $prod);
    $stmt->execute();
    echo "Almacenaje exitoso";
}
catch(PDOException $e) {
   echo "Error: " . $e->getMessage();
}
}
?>