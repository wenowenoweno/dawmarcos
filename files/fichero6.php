<html>
    <body>
        <h1>Operaciones Ficheros</h1>
        <form method="post" action="fichero6.php">
            Fichero (Path/nombre): <input type="text" name="ruta">
            <br><br>
            <input type="submit" value="Ver Datos Fichero">
            <input type="reset" value="Borrar">
        </form>
        <br><br><br>
        <h1>Operaciones Ficheros</h1>
        <?php

            if($_SERVER["REQUEST_METHOD"]=="POST") {

                $entrada=$_POST["ruta"];

                $nombre=basename($entrada);
                $tamano=filesize($entrada)."Kb";
                $fecha=date("H:i j/n/o", filemtime($entrada));
                $dir=realpath($entrada);
                $dir=str_replace($nombre,"",$dir);
                
                echo "<b>Nombre del fichero:</b> ".$nombre."<br>";
                echo "<b>Directorio:</b> ".$dir."<br>";
                echo "<b>Tamaño del fichero</b> ".$tamano."<br>";
                echo "<b>Fecha ultima modificacion:</b> ".$fecha;
            }

        ?>
    </body>
</html>
