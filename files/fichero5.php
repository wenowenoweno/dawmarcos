<html>
    <body>
        <h1>Operaciones Ficheros</h1>
        <form method="post" action="fichero5.php">
            Fichero (Path/Nombre):<input type="text" name="ruta"><br><br>
            Operaciones:<br>
             <label><input type="radio" name="operacion" value="mostrar"> Mostrar Fichero</label><br>
             <label id="1"><input type="radio" name="operacion" value="linea"></label> Mostrar linea<input type="text" size="1" name="valorlinea"> <label for="1"> del fichero</label><br>
             <label id="2"><input type="radio" name="operacion" value="primeras"></label> Mostrar <input type="text" size="1" name="valorprimera"> <label for="2"> primeras lineas</label><br>
             <br><br>
             <input type="submit" value="Enviar">
             <input type="reset" value="Borrar">
        </form>
        <?php
        function validar($datos){

            $datos=trim($datos);
            $datos=stripslashes($datos);
            $datos=htmlspecialchars($datos);
            return $datos;
        }
        
        
        if($_SERVER["REQUEST_METHOD"]=="POST") {
            $fichero=validar($_POST["ruta"]);
            $linea=validar($_POST["valorlinea"]);
            $nlineas=validar($_POST["valorprimera"]);
            $file=fopen($fichero, "r");
        
            switch ($_POST["operacion"]) {
                case "mostrar":
                    echo fread($file, filesize($fichero));
                    break;
                case "linea":
                    $cont=1;
                    for($x=0;$x<=$linea;$x++){
        
                        if($cont==$linea){
        
                            echo fgets($file);
                            
                        }else{
                            fgets($file);
                        }
                        $cont++;
                    }
                    break;
                case "primeras":
                    for($x=1;$x<=$nlineas;$x++){
                        echo fgets($file);
                    }
                    break;
            }
            fclose($file);
        }
        ?>
    </body>
</html>
