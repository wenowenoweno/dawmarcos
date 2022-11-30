<html>
    <body>
        <h1>ALTA DPTO</h1>
        <form method="post" action="altadpto.php">
            NOMBRE DPTO<input type="text" name="nombre"><br><br>
            <input type="submit">
        </form>
    </body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    require "fun.php";
    $nombre=validar($_POST["nombre"]);

    try {
        $conn=conexion();
        $stmt = $conn->prepare("INSERT INTO dpto (nombre) values (:nombre);");
        $stmt->bindParam(":nombre", $nombre);
        $stmt->execute();
        echo "Departamento creado con exito";
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
