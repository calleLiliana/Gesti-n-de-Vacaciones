<?php
                // conecta perfecto con la base de datos
    $servidor = "localhost";
    $User = "root";
    $pass = "";

    $BD = "vacaciones_BD";

    $conexion = mysqli_connect($servidor, $User, $pass, $BD);

    if (!$conexion) {
        echo "Conexion fallida";
    }

?>