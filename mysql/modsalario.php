<html>
    <body>
        <h1>Modificar salario</h1>
        <form action="modsalario.php" method="get">
            Selecciona un dni:  
            <?php
            require "fun.php";
            $conn=conexion();
            selectDNI($conn);
            $conn=null;
            ?>
            <input type="submit" value="Ver sueldo">
            Salario actual:
            <?php
                 if($_SERVER["REQUEST_METHOD"]=="GET"){ 
                    try {
                        $conn=conexion();
                        $dni=$_GET["dni"];
                        mostrarSueldo($conn, $dni);
                        $conn=null;
                        }
                    catch(PDOException $e) {
                            echo "Error: " . $e->getMessage();
                        }
                $conn=null;
               }           
            ?>
        </form>
        <form action="modsalario.php" method="post">
            Nuevo sueldo: <input type="text" name="nuevo"><br><br>
            <input type="submit" value="Cambiar sueldo">
        </form>
    </body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){ 
        try {
            $conn=conexion();
            $sueldo=$_POST["nuevo"];
            cambiarSueldo($conn, $sueldo);
            $conn=null;
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
?>
