<html>
<link rel="stylesheet" href="estilo.css">
<h1>Consulta almacenes</h1>
<a href="main.html">Menú</a>
    <form method="POST" action="comconsalm.php">
        Selecciona almacen:<?php
        require "funciones.php";
        $conn=conexion();
        selectAlmacen($conn);
        $conn=null;
        ?>
        <input type="submit" value="Enviar">
    </form>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conn=conexion();
    $alm=$_POST["dpto"];
    imprimirAlmacenes($conn, $alm);
}
?>
