<html>
    <body>
        <h2>Consulta operaciones bolsa</h2>
        <form method="post" action="bolsa3.php">
            Valores: <select name="nombre">
            <?php
            require "funciones_bolsa.php";
            generarOptions();
            ?>
        </select>
        <input type="submit" value="Enviar">
        </form>
        <br><br><br>
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                echo("El valor <b>Cotización</b> de ".$_POST["nombre"]." es ". buscarValor($_POST["nombre"], "Ultimo")); echo("<br>");
                echo("Cotización <b>Máxima</b> de ".$_POST["nombre"]." es ". buscarValor($_POST["nombre"], "MAx.")); echo("<br>");
                echo("Cotización <b>Mínima</b> de ".$_POST["nombre"]." es ". buscarValor($_POST["nombre"], "MIn.")); 
              }
        ?>
    </body>
</html>
