<?php
    session_start();
    if (!isset($_SESSION['email'])) {
        // Si no hay sesión iniciada, redirige al Inicio :)
        header("Location: index.php");
        exit();
    }
    ?>
    
<!DOCTYPE html>
<html lang="en">            <!-- se podria ver la imagen que pusimos pero el resto esta listo-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS\perdirOVerVacaciones.css">
    <title>Perdir o ver vacaciones</title>
</head>
<body>
    <div class="titulo">
        <img class="imagenLogo" src="imagenes/imagenLogoRectangularConTexto2.png" height="160px" alt="Y P F">
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
                Ingresa aqui para ver tu calendario.</center>
            </div>
            <div class="pie">
                <form action="calendarioEmpleado.html" method="post">
                    <button type="submit">Ver tu calendario aqui.</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>