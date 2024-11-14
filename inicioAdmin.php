<!DOCTYPE html>
<html lang="en">            
    <head>                      
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvkuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqy12QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/SesionIniciar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" 
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="CSS\inicio.css">
    <title>Inicio de sesión</title>
</head>
<body>
    <form action="inicioAdminBD.php" method="POST">
        <center><h1>INICIAR SESIÓN</h1></center>
        <center><h2>Administrador</h2></center>
        <br>
        <hr>
        <?php
            if (isset($_GET['error'])) {
            ?>
            <p class="error">
                <?php
                    echo $_GET['error']
                    ?>
            </p>
        <?php
        }
        ?>
        <br>
        <i class="fa-solid fa-user"></i>
        <label>Usuario Administrador</label>
        <center><input type="email" name="email" placeholder ="Nombre de Usuario Administrador"></center>
        <br>
        <i class="fa-solid fa-key"></i>
        <label>Contraseña</label>
        <center><input type="password" name="clave" placeholder ="Contraseña"></center>
        <br>
        <hr>
        <div class="g-recaptcha" data-sitekey="6Lfm7lUqAAAAAHKX6wXP-RE0yRr7ieeVHn9yUJz5"></div>
        <br>
        <center><button type="submit">Iniciar Sesión</button></center>
        <br>
        <center><a href="registro.php">¿No tienes cuenta?</a></center>
    </form>
</body>
</html>
