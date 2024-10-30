<?php                       // Lo  unico que faltaria es revisar como inserta la contraseña, 
                            // porque la inserta encriptada en la base de datos y no es lo mismo

include('Conexion.php'); // Incluye la conexión a la base de datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['clave'], PASSWORD_DEFAULT);

    // Cambia "usuarios" a "empleados"
    $sql = "INSERT INTO empleados (nombre, apellido, direccion, telefono, email, clave) 
            VALUES ('$nombre', '$apellido', '$direccion', '$telefono', '$email', '$contrasena')";

    if ($conexion->query($sql) === TRUE) {
        header("Location: inicioEmpleado.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    $conexion->close();
}
?>