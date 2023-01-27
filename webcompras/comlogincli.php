<html>
<link rel="stylesheet" href="estilo.css">
    <body>
    <h1>Login Clientes</h1>    
    <a href="main.html">Menú</a>
    <form method="post" action="comlogincli.php">
        Usuario:<input type="text" name="nombre"><br> 
        Contraseña:<input type="text" name="passw"><br>
        <input type="submit" value="Enviar">
    </form>

</html>
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require "funciones.php";
        $usuario=validar($_POST["nombre"]);
        $passw=validar($_POST["passw"]);

        try {
            $conn=conexion();
             $stmt = $conn->prepare("SELECT nif FROM cliente
                where nombre=:usuario and clave=:passw");
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":passw", $passw);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $resultado=$stmt->fetchAll();
            if(count($resultado)>0){
                echo "Login correcto!<br><br>";
                ///Crear cookie
                    $cookie_name="usuario";
                    setcookie($cookie_name, $resultado[0]["nif"], time() + (86400 * 30), "/"); 
                    echo"        <a href='comprocli.php'>Compra de Productos</a><br>
                    <a href='comconscli.php'>Consulta de Compras</a>";    
            }else{
                echo"Error en usuario o contraseña";
            }
        }
        catch(PDOException $e) {
           if(($e->getCode())=="23000"){
            echo "Entrada duplicada";
           }else{echo "Error: " . $e->getMessage();}
        
        }
    }
?>