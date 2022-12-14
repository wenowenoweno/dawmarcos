<html>
<link rel="stylesheet" href="estilo.css">
<h1>Compra productos</h1>
<a href="main.html">Menú</a>
    <form method="POST" action="compro.php">
        Dni: <input type="text" name="dni"><br>
        Selecciona producto:<?php
        require "funciones.php";
        $conn=conexion();
        selectProducto($conn);
        $conn=null;
        ?>
        Selecciona almacen:<?php
        $conn=conexion();
        selectAlmacen($conn);
        $conn=null;
        ?>
        Unidades: <input type="text" name="unidades"><br>
        <input type="submit" value="Enviar">
    </form>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conn=conexion();
    $dni=validar($_POST["dni"]);
    $prod=$_POST["pro"];
    $alm=$_POST["dpto"];
    $unidades=validar($_POST["unidades"]);
    if(validarDni($conn, $dni)){
        if(comprobarStock($conn, $unidades, $prod, $alm)){
            try {
                $stmt = $conn->prepare("INSERT INTO compra (nif, id_producto, fecha_compra, unidades)
                values (:nif, :pro, now(), :unidades);");
                $stmt->bindParam(":nif", $dni);
                $stmt->bindParam(":pro", $prod);
                $stmt->bindParam(":unidades", $unidades);
                $stmt->execute();
                quitarStock($conn, $unidades, $prod, $alm);
                echo "Compra realizada con exito";
            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            
        }else{
            echo "Error de stock";
        }
    }else{
        echo "Usuario no registrado";
    }
}
?>
