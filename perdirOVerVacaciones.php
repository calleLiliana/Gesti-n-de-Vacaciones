<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        header("Location: index.php");
        exit();
    }
    ?>
    
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\perdirOVerVacaciones.css">
    <title>Perdir o ver vacaciones</title>
</head>
<body>
    <header>
        <div class="back">
            <div class="menu-container">
                <nav>
                </nav>
                <h1>GESTION DE VACACIONES</h1>
                <nav>
                </nav>
            </div>
        </div>
    </header>
    <div class="titulo">
    </div>
    <div class="tarjetaMadre">
        <div class="tarjeta">
            <div class="tituloT">
                Pedir vacaciones
            </div>
            <div class="cuerpo">
                <center><img class="imagenTarjeta" src="imagenes/imagenVacaciones.png" height="280px" alt="imagenVacaciones"> <br>
                Ingresa aqui para pedir tus vacaciones.</center>
            </div>
            <div class="pie">     
                <form action="formulario.php" method="post">
                    <button type="submit">Pedir tus vacaciones aqui.</button>
                </form>
            </div>
        </div>
        <div class="tarjeta">
            <div class="tituloT">
                Ver calendario
            </div>
            <div class="cuerpo">
                <center><img class="imagenTarjeta" src="imagenes/imagenCalendario.png" height="280px" alt="imagenCalendario"> <br>
                Ingresa aqui para revisar tu <br>calendario.</center>
            </div>
            <div class="pie">
                <form action="calendarioEmpleado.php" method="post">
                    <button type="submit">Revisar tu calendario aqui.</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>