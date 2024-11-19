<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
        exit();
    }
    ?>
<!DOCTYPE html>
<html lang="es">      
<head>                    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedir Vacaciones</title>
    <link rel="stylesheet" href="CSS/formularios.css">
    <script>
        function validarFechas() {
            const fechaA = new Date(document.getElementById("fechaA").value);
            const fechaB = new Date(document.getElementById("fechaB").value);

            if (fechaB <= fechaA) {
                alert("La fecha final debe ser mayor que la fecha inicial.");
                return false; 
            }

            return true;
        }
    </script>
</head>
<body>
    <form action="formularioBD.php" method="POST" onsubmit="return validarFechas();">
    <?php
            if (isset($_GET['uf'])) {
            ?>
            <p>
                <?php
                    echo $_GET['uf']
                 ?>
            </p>
        <?php
            }
        ?>    
    <br>
    <div class="tarjetaREGISTRO">
        <label for="Nombre">Nombre y apellido:</label>
        <input type="string" id="Nombre" name="nombre" required ><br><br>

        <label for="fechaA">Fecha Inicio:</label>
        <input type="date" id="fechaA" name="fecha_inicio" required><br><br>

        <label for="fechaB">Fecha Final:</label>
        <input type="date" id="fechaB" name="fecha_final" required><br>
        <p>Tene en cuenta que la fecha final es la fecha de reincorporacion</p><br>

        <button type="submit" >Guardar</button><br>
        
        <div class="botones">
            <form action="calendarioEmpleado.php">
                <button type="submit" >Ver Calendario</button>
            </form>
            <form action="perdirOVerVacaciones.php">
                <button type="submit">Volver Atras</button>
            </form>
        </div>



    </div>
    </form>
</body>
</html>