<html>
    <h1>Consulta Operaciones Bolsa</h1>
    <body>
        <form method="post" action="bolsa5.php">
            Mostrar: <select name="mostrar">
                <option value="volumen">Total Volumen</option>
                <option value="capital">Total Capitalizacion</option>
            </select>
            <br><br><br>
            <input type="submit" value="Visualizar">
            <input type="reset" value="Borrar">
        </form>
        <?php
            require "funciones_bolsa.php";
            totales($_POST["mostrar"]);


        ?>
    </body>
</html>
