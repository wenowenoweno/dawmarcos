<html>
    <body>
        <h1>CONVERSOR BINARIO</h1>
        <form method="post" action='<?php echo $_SERVER["PHP_SELF"];?>'>

            Numero decimal:<input type="textbox" name="num"><br><br>
            
            <?php
            function validar($datos){

                $datos=trim($datos);
                $datos=stripslashes($datos);
                $datos=htmlspecialchars($datos);
                return $datos;
            }

            if($_SERVER["REQUEST_METHOD"]=="POST") {
                $num=validar($_POST["num"]);
                $binario="";
                if ($num<=0){
                    $binario="0";
                }
                
                while ($num>1){
                    $resto=$num%2;
                    $num=$num/2;
                    $binario=$resto.$binario;
                }
                echo 'Numero binario: '.$binario.'<br><br>';
            }
            
            ?>
            <input type="submit">
            <input type="reset">
        </form>
    </body>
</html>
