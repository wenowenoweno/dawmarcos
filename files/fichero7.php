<html>
    <body>
        <h1>Operaciones Sistemas Ficheros</h1>
        <form method="post" action="fichero7.php">
            Fichero Origen (Path/nombre): <input type="text" name="origen"><br><br>
            Fichero Destino (Path/nombre): <input type="text" name="destino"><br>
            <br><br>
            Operaciones: <br>
            <label><input type="radio" name="op" value="copiar"> Copiar fichero<br></label>
            <label><input type="radio" name="op" value="renombrar"> Renombrar fichero<br></label>
            <label><input type="radio" name="op" value="borrar"> Borrar fichero<br></label>
            
            <br><br>
            <input type="submit" value="Ejecutar Operacion">
            <input type="reset" value="Borrar">
            <br><br>
        </form>
        <h1>Operaciones Sistemas Ficheros</h1>
        <?php
                function renombrar($origen, $destino){

                    if(file_exists(dirname($destino))){
                        echo"El directorio ".dirname($destino)." existe<br>";
                        copy($origen, $destino);
                    }else{
                        echo"El directorio ".dirname($destino)."  no existe<br>";
                        mkdir(dirname($destino), 0700, false);
                        echo "Se ha creado el directorio ".dirname($destino)."<br>";
                        copy($origen, $destino);
                    }
                    echo "Archivo renombrado con exito!";
                }

                function copiar($origen, $destino){
                    $nombre=basename($origen);
                    $destino2=$destino.$nombre;
                    
                    if(file_exists(dirname($destino))){
                        echo"El directorio ".$_POST["destino"]." existe<br>";
                        copy($origen, $destino2);
                    }else{
                        echo"El directorio ".dirname($destino)."  no existe<br>";
                        mkdir(dirname($destino), 0700, false);
                        echo "Se ha creado el directorio ".dirname($destino)."<br>";
                        copy($origen, $destino2);
                    }
                    echo "Archivo copiado con exito!";
                }

                function borrar($origen){
                    unlink($origen);
                    echo "Archivo borrado con exito!";
                }

                if($_SERVER["REQUEST_METHOD"]=="POST") {
                    $origen=$_POST["origen"];
                    $destino=$_POST["destino"];
                    
                    switch ($_POST["op"]) {
                        case 'copiar':
                            copiar($origen, $destino);
                            break;
                        case "renombrar":
                            renombrar($origen, $destino);
                            break;
                        
                        case "borrar";
                            borrar($origen);
                            break;
                    }
                }


        ?>
    </body>
</html>
