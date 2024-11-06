<?php                       // Lo  unico que faltaria es revisar como inserta la contraseña, 
                            // porque la inserta encriptada en la base de datos y no es lo mismo

include('Conexion.php'); // Incluye la conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {   # verificamos  si el fgormulario creado en html fue enviado correctamente ademas con el post aseguramos que sea segura  y que los datos esten listos para ser procesados
    # le asignamos a las variables el valor  con el qeu fue completado cada campo en su respectiva variable en el formulario ;
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT);  #usamos en password hash   para darle mas seguridad a la cointraseña
# real_escape_string evita que los datos ingresados sean considerados de una u otra forma como cunsultas sql 
    // Verificar si el email ya está registrado

    $verificacion_email = "SELECT id FROM empleados WHERE email = '$email' LIMIT 1"; #  verificamos que el mail antes de enviarlo no exixta para crear uno 
    $resultado = $conexion->query($verificacion_email);  // el resultado de la consulta verificacion se gurada en la variable resultado
    
    if ($resultado->num_rows > 0) {  #se llama a la varia bel resutado qeu contiene la  respuesta de la consulta se verifica si la misma de mayor a cero es decir se encontro un mail
        echo "El email ya esta Registrado. Por favor INGRESE CON OTRO  email";
    } else { //si no se encontro una linea con el mismo mail  se ingresa los datos 
        // Definir la consulta SQL para insertar los valores en la tabla correspondiente
        $ingreso_registro=$conexion->prepare("INSERT INTO usuario (nombre,apellido,direccion,telefono, email, contrasena) VALUES (?, ?,?,?,?, ?)"); //prepare se usa para prepararuuna consulta
        $ingreso_registro->bind_param("sssiss", $nombre,$apellido,$direccion,$telefono, $email, $contrasena);//el bind_param sirve para qeu los datos sean considerados valores y no contraseñlas sql ademas sirve  sirve para enlazar 
        
        if ($ingreso_registro->execute()) {  // si la coinsulta se ejecuto correctamente nos manda  a la ubicacion de login.php
            header("Location: inicioEmpledo.php");
            exit(); // Detener la ejecución del script después de la redirección
        } else {
            echo "Error: " . $ingreso_registro->error;
        }

        // Cerrar la declaración
        $ingreso_registro->close();
    }
}
?>
<?php  
/*
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
}*/
?>