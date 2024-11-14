<?php
session_start();
include('ConexionBD.php');

if (isset($_POST['email']) && isset($_POST['clave'])) {
    function validate($data) {
        $data = trim($data); // Eliminar espacios en blanco
        $data = stripslashes($data); // Eliminar barras
        $data = htmlspecialchars($data); // Convertir caracteres especiales a entidades HTML
        return $data;
    }

    $Empleado = validate($_POST['email']);
    $Clave = validate($_POST['clave']);

    // Verificar que los campos no estén vacíos
    if (empty($Empleado)) {
        header("Location: inicioEmpleado.php?error=El Mail es requerido");
        exit();
    } elseif (empty($Clave)) {
        header("Location: inicioEmpleado.php?error=La Clave es requerida");
        exit();
    } else {
        // Usar consultas preparadas para evitar inyecciones SQL
        $sql = "SELECT * FROM empleados WHERE email = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $Empleado);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();
            // Verificar la contraseña
            if (password_verify($Clave, $row['clave'])) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['id_empleado'] = $row['id_empleado'];
                header("Location: perdirOVerVacaciones.php");
                exit();
            } else {
                header("Location: inicioEmpleado.php?error=El Usuario o la Clave son incorrectas");
                exit();
            }
        } else {
            header("Location: inicioEmpleado.php?error=El Usuario o la Clave son incorrectas");
            exit();
        }
    }
} else {
    header("Location: inicioEmpleado.php");
    exit();
}
?>