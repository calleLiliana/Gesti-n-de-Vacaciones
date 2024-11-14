<?php
session_start();   // Iniciar la sesión
include('ConexionBD.php');

if (isset($_POST['email']) && isset($_POST['clave'])) {
    function validate($data) {
        $data = trim($data); // Eliminar espacios en blanco
        $data = stripslashes($data); // Eliminar barras
        $data = htmlspecialchars($data); // Convertir caracteres especiales a entidades HTML
        return $data;
    }

    $Admin = validate($_POST['email']);
    $Clave = validate($_POST['clave']);

    // Verificar que los campos no estén vacíos
    if (empty($Admin)) {
        header("Location: inicioAdmin.php?error=El Usuario es requerido");
        exit();
    } elseif (empty($Clave)) {
        header("Location: inicioAdmin.php?error=La Clave es requerida");
        exit();
    } else {
        // Verificación del captcha
        $ip = $_SERVER['REMOTE_ADDR'];
        $captcha = $_POST['g-recaptcha-response'];
        $secretKey = "6Lfm7lUqAAAAAGyD4MVXCXmhOp9plTjDIpN6AJSP";

        $respuesta = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$captcha&remoteip=$ip");
        $atributos = json_decode($respuesta, true);

        if (!$atributos['success']) {
            header("Location: inicioAdmin.php?error=Verificar captcha");
            exit();
        }

        // Usar consultas preparadas para evitar inyecciones SQL
        $sql = "SELECT * FROM admin WHERE email = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("s", $Admin);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();
            // Verificar la contraseña
            if (password_verify($Clave, $row['clave'])) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['id_admin'] = $row['id_admin'];
                header("Location: administrarVacaciones.php");
                exit();
            } else {
                header("Location: inicioAdmin.php?error=El Usuario o la Clave son incorrectas");
                exit();
            }
        } else {
            header("Location: inicioAdmin.php?error=El Usuario o la Clave son incorrectas");
            exit();
        }
    }
} else {
    header("Location: inicioAdmin.php");
    exit();
}
?>