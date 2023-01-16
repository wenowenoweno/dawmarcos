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
    <h1>Compra Productos</h1>
    
    <a href="main.html">Menú</a>
    <form method="POST" action="comprocli.php">
        Selecciona producto:<?php
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
        <input type="submit" value="Añadir a la cesta">
    </form>

</html>
<?php
  if($_SERVER["REQUEST_METHOD"]=="POST"){
    $prod=$_POST["pro"];
    $alm=$_POST["dpto"];
    $cant=$_POST["unidades"];
    $art=[$prod=>$cant];
    //$art=serialize($art);
    var_dump($_COOKIE);
    var_dump($art);
    if(isset($_COOKIE["cesta"])){
        array_push( $_COOKIE['cesta'], serialize($art));
    }else{
        $cookie_name="cesta";
        setcookie($cookie_name, serialize($art), time() + (86400 * 30), "/"); 

    }
  }
var_dump($_COOKIE["cesta"]);
?>
