<html>
    <body>
        <h2>Consulta operaciones bolsa</h2>
        <form method="post" action="bolsa4.php">
            Valores: <select name="nombre">
            <?php
            require "funciones_bolsa.php";
            generarOptions();
            ?>
            </select><br><br>
            Mostrar: <select name="valor">
                <option value="Ultimo">Ultimo Valor</option>
                <option value="Var. %">Variacion %</option>
                <option value="Var.">Variacion</option>
                <option value="Ac.% año">Ac% anual</option>
                <option value="MAx.">Maximo</option>
                <option value="MIn.">Minimo</option>
                <option value="Vol.">Volumen</option>
                <option value="Capit.">Capitalizacion</option>
                </select><br><br>
        <input type="submit" value="Enviar">
        </form>
        <br><br><br>
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                $res=buscarValor($_POST["nombre"], $_POST["valor"]);
                echo 'El valor '.$_POST["valor"].' de '.$_POST["nombre"].' es '.$res;
              }
        ?>
    </body>
</html>
