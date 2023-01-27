<?php
if(!isset($_COOKIE['usuario'])){
    echo "Error en la sesion";
}
?>
<html>
<link rel="stylesheet" href="estilo.css">
    <body> 
    <h2>Bienvenido, <?php
        require "funciones.php";
        $conn=conexion();
        $stmt = $conn->prepare("SELECT nombre FROM cliente
        where nif=:nif");
        $stmt->bindParam(":nif", $_COOKIE['usuario']);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_NUM);
        $resultado=$stmt->fetchAll();
        echo $resultado[0][0];
        $conn=null;
    ?></h2>
    <h3 id=carrito>Carrito:<br>
    <?php
    if(isset($_COOKIE["cesta"])){
        $cesta=unserialize($_COOKIE["cesta"]);
        foreach ($cesta as $key => $value) {
            $conn=conexion();
            $stmt = $conn->prepare("SELECT nombre FROM producto
            where id_producto=:id");
            $stmt->bindParam(":id", $key);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_NUM);
            $resultado=$stmt->fetchAll();
            echo $value." ".$resultado[0][0]."<br>";
            $conn=null;
        }
    }
    ?>
        <form method="POST" action="comprocli.php" id="carrito" >
            <input type="submit" value="Tramitar pedido" name="tramitar">
        </form>
    </h3>   
    <h1>Compra Productos</h1>
    
    <a href="main.html">Menú</a>
    <form method="POST" action="comprocli.php" >
        Selecciona producto:<?php
        $conn=conexion();
        selectProducto($conn);
        $conn=null;
        ?>
        Unidades: <input type="text" name="unidades"><br>
        <input type="submit" value="Añadir a la cesta" name="anadir">
    </form>


</html>
<?php
var_dump($_COOKIE);
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $conn=conexion();
    if(isset($_POST["anadir"])){

        $prod=$_POST["pro"];
        $cant=$_POST["unidades"];
        $art=[$prod=>$cant];
        if($cant>0){
            if(isset($_COOKIE["cesta"])){

                $cookie_name="cesta";
                $cesta=unserialize($_COOKIE["cesta"]);
                $cesta[$prod]=$cant;
                $cesta=serialize($cesta);
                setcookie($cookie_name, $cesta, time() + (86400 * 30), "/"); 
        }else{
                $cookie_name="cesta";
                setcookie($cookie_name, serialize($art), time() + (86400 * 30), "/"); 

            }
        }else{
            echo "Las unidades tienen que ser mayor de 1";
        }
    }else if(isset($_POST["tramitar"])){

        $cesta=unserialize($_COOKIE["cesta"]);
        $final=true;
        foreach ($cesta as $key => $value) {
            $val=comprobarStock($key, $value, $conn);
            if(!$val){
                $final=false;
            }
        }
        if(!$final){
            echo "No se ha podido realizar su pedido, error de stock";
        }else{
            foreach ($cesta as $key => $value) {

                quitarStock($key, $value, $conn);
                registrarCompra($key, $value, $_COOKIE["usuario"], $conn);
            }
            echo "Compra realizada con exito";
        }
    }

  }
?>