<html>
    <body>
        <form method="post" action="comaltacli">
            NIF:<input type="text" name="nif"><br>
            Nombre:<input type="text" name="nombre"><br>
            Apellido:<input type="text" name="apellido"><br>
            CP:<input type="text" name="cp"><br>
            Direccion:<input type="text" name="direccion"><br>
            Ciudad:<input type="text" name="ciudad"><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        require "funciones.php";
        $nif=validar($_POST["nif"]);
        $nombre=validar($_POST["nombre"]);
        $apellido=validar($_POST["apellido"]);
        $cp=validar($_POST["cp"]);
        $direccion=validar($_POST["direccion"]);
        $ciudad=validar($_POST["ciudad"]);

        if(validarNif($nif)){

            try {
                $conn=conexion();
                $stmt = $conn->prepare("INSERT INTO cliente (nif, nombre, apellido, cp, direccion, ciudad)
                 values (:nif, :nombre, :apellido, :cp, :direccion, :ciudad);");
                $stmt->bindParam(":nif", $nif);
                $stmt->bindParam(":nombre", $nombre);
                $stmt->bindParam(":apellido", $apellido);
                $stmt->bindParam(":cp", $cp);
                $stmt->bindParam(":direccion", $direccion);
                $stmt->bindParam(":ciudad", $ciudad);
                $stmt->execute();
                echo "Cliente creado con exito";
            }
            catch(PDOException $e) {
               if(($e->getCode())=="23000"){
                echo "Entrada duplicada";
               }else{echo "Error: " . $e->getMessage();}
            
            }

        }else{
            echo "Nif incorrecto";
        }
        
        $conn=null;
    }
?>
