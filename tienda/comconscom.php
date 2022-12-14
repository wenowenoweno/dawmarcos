<html>
<link rel="stylesheet" href="estilo.css">
    <body>
        <h1>Consulta Compras</h1>
        <a href="main.html">Menú</a>
        <form method="post" action="comconscom.php">
            <?php
            require "funciones.php";
            $conn=conexion();
            selectDni($conn);
            $conn=null;
            ?>
            Fecha inicio:<input type="date" name="inicio"><br><br>
            Fecha fin:<input type="date" name="fin"><br><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $dni=$_POST["dni"];
    $inicio=$_POST["inicio"];
    $inicio=$inicio." 00:00:00";
    $fin=$_POST["fin"];
    $fin=$fin." 00:00:00";
    try {
        $conn=conexion();
        $stmt = $conn->prepare("select * from compra, cliente, producto 
        where compra.nif=cliente.nif and producto.id_producto=compra.id_producto and compra.nif=:dni and fecha_compra between :inicio and :fin; ");
        $stmt->bindParam(":inicio", $inicio);
        $stmt->bindParam(":fin", $fin);
        $stmt->bindParam(":dni", $dni);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $resultado=$stmt->fetchAll();
        echo "<table border=1px>
        <tr><th>Nombre</th><th>Dni</th><th>Nombre producto</th><th>Id Producto</th><th>Fecha</th><th>Cantidad</th><th>Precio</th></tr>";
        $total=0;
        for($i=0;$i<count($resultado);$i++){
            echo "<tr><td>".$resultado[$i][5]."</td><td>".$resultado[$i][0]."</td><td>".$resultado[$i][11]."</td><td>".$resultado[$i][13]."</td><td>".$resultado[$i][2]."</td><td>".$resultado[$i][3]."</td><td>".$resultado[$i][12]."</td></tr>";
            $total=$total+$resultado[$i][3]*$resultado[$i][12];
        }
        echo "Total facturacion: ".$total."<br><br>";
    }
    catch(PDOException $e) {
       echo "Error: " . $e->getMessage();
    }
}
?>
