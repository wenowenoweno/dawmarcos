<html>
    <body>
        <h1>Listado empleados</h1>
        <form action="listemple.php" method="post">
            Selecciona un departamento:
            <?php
            require "fun.php";
            $conn=conexion();
            selectDpto($conn);
            $conn=null;
            ?>
            <br>
            <input type="submit" value="Consultar">
        </form>
    </body>
</html>
<?php
 if($_SERVER["REQUEST_METHOD"]=="POST"){ 

    try {
    $conn=conexion();
    $dpto=$_POST["dpto"];
    $stmt = $conn->prepare("select nombre from emple, emple_dpto
    where dni=dni_emple and id_dpto=:dpto");
    $stmt->bindParam(":dpto", $dpto);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_NUM);
	$resultado=$stmt->fetchAll();
    echo "<ul>";
    for($x=0;$x<=count($resultado)-1;$x++){
        echo "<li>".$resultado[$x][0]."</li>";
    }
    echo "</ul>";
        $conn=null;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
