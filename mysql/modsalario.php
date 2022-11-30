<html>
    <body>
        <h1>Modificar salario</h1>
        <form action="modsalario.php" method="POST">
            Selecciona un dni:  
            <?php
            require "fun.php";
            $conn=conexion();
            selectDNI($conn);
            $conn=null;
            ?>
            <input type="submit" value="Ver sueldo" name="b1">
       
            Salario actual:
            <?php
                 if($_SERVER["REQUEST_METHOD"]=="POST"){ 

                    if($_POST!=null){
                        if(isset($_POST["b1"])){
                            try {
                                $conn=conexion();
                                $dni=$_POST["dni"];
                                echo "<br><br><input type='text' value='".$dni."' name='dni2' hidden>";
                                mostrarSueldo($conn, $dni);
                                $conn=null;
                                }
                            catch(PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                                }
                        }
                        if(isset($_POST["b2"])){
                            try {
                                $dni=$_POST["dni2"];
                                $conn=conexion();
                                $sueldo=$_POST["nuevo"];
                                cambiarSueldo($conn, $sueldo, $dni);
                                $conn=null;  
                            }
                            catch(PDOException $e) {
                                    echo "Error: " . $e->getMessage();
                            }      
                        }
                        
                    }
               }           
            ?>
            <br><br>
            
                Nuevo sueldo: <input type="text" name="nuevo"><br><br>
                <input type="submit" value="Cambiar sueldo" name="b2">
        </form>
    </body>
</html>
