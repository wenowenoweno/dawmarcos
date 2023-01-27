<html>
<link rel="stylesheet" href="estilo.css">
    <body>
        <h1>Consulta Compras</h1>
        <a href="main.html">Menú</a>
        <form method="post" action="comconscli.php">
          Consultar compras<br><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
<?php
require "funciones.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){

    try {
        $conn=conexion();
        $stmt = $conn->prepare("select * from compra, cliente, producto 
        where compra.nif=cliente.nif and producto.id_producto=compra.id_producto and compra.nif=:dni;");
        $stmt->bindParam(":dni", $_COOKIE["usuario"]);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $resultado=$stmt->fetchAll();
        echo "<table border=1px>
        <tr><th>Nombre</th><th>Nombre producto</th><th>Fecha</th><th>Cantidad</th><th>Precio</th></tr>";
        $total=0;
        for($i=0;$i<count($resultado);$i++){
            echo "<tr><td>".$resultado[$i][5]."</td><td>".$resultado[$i][12]."</td><td>".$resultado[$i][2]."</td><td>".$resultado[$i][3]."</td><td>".$resultado[$i][13]."</td>";
            $total=$total+$resultado[$i][3]*$resultado[$i][13];
        }
        
        echo "Total facturacion: ".$total." rupias<br><br>";
    }
    catch(PDOException $e) {
       echo "Error: " . $e->getMessage();
    }
}
?>
