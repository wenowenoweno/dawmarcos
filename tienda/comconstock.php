<html>
    <form method="POST" action="comconstock.php">
        Selecciona producto:<?php
        require "funciones.php";
        $conn=conexion();
        selectProducto($conn);
        $conn=null;
        ?>
        <input type="submit" value="Enviar">
    </form>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conn=conexion();
    $prod=$_POST["pro"];
    imprimirStock($conn, $prod);
}
?>
