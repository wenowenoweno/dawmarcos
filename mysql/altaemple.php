<html>
    <body>
        <h1>ALTA EMPLEADO</h1>
        <form method="post" action="altaemple.php">
            DNI:<input type="text" name="dni"><br><br>
            NOMBRE:<input type="text" name="nombre"><br><br>
            SALARIO:<input type="text" name="salario"><br><br>
            FECHA NAC:<input type="text" name="fecha"><br><br>
            COD DPTO:
            <?php

                require "fun.php";
                $conn=conexion();
                $stmt = $conn->prepare("SELECT id, nombre FROM dpto;");
                $stmt->execute();
                $stmt->setFetchMode(PDO::FETCH_NUM);
                $resultado=$stmt->fetchAll();
                echo "<select name='dpto' id='dpto'>";
                for($x=0;$x<=count($resultado)-1;$x++){
                    echo "<option value=".$resultado[$x][0].">".$resultado[$x][1]."</option>";
                }
                echo "</select><br><br>";
                $conn=null;
    
            ?>
            <input type="submit">
        </form>
    </body>
</html>
<?php

    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $dni=validar($_POST["dni"]);
        $nombre=validar($_POST["nombre"]);
        $salario=validar($_POST["salario"]);
        $fecha=validar($_POST["fecha"]);
        $dpto=$_POST["dpto"];
        try {
            $conn=conexion();
            $stmt = $conn->prepare("INSERT INTO emple (dni, nombre, salario, fecha_nac) values (:dni, :nombre, :salario, :fecha);");
            $stmt->bindParam(":dni", $dni);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":salario", $salario);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->execute();
            //tabla emple_dpto
            $stmt = $conn->prepare("INSERT INTO emple_dpto (dni_emple, id_dpto, fecha_inicio, fecha_fin)
                                     values (:dni, :dpto, now(), null);");
            $stmt->bindParam(":dpto", $dpto);
            $stmt->execute();
        }
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
 ?>
