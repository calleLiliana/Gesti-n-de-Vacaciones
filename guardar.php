<?php
include('Conexion.php');
session_start();
    if (!isset($_SESSION['email'])) {
        // Si no hay sesión iniciada, redirige al Inicio :)
        header("Location: index.php");
        exit();
    }
// Obtener datos del formulario

$nombre = $_POST['nombre'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_final = $_POST['fecha_final'];

// Obtener el ID del empleado desde la sesión
$id_empleado = $_SESSION['id_empleado'] ?? null;

if ($id_empleado === null) {
    die('El ID del usuario no está presente en la sesión.');
}

// Insertar los datos en la base de datos

// $sql = "INSERT INTO vacaciones (id_empleado, fecha_inicio, fecha_final, estado) VALUES (?, ?, ?, 'En espera')";
// $stmt = $conexion->prepare($sql);
$sql = "INSERT INTO `eventos` (`id`, `title`, `descripcion`, `color`, `textColor`, `start`, `end`) VALUES (NULL, ?, ?, '#afafaf', '#FFFFFF', ?, ?)";
$stmt = $conexion->prepare($sql);


if ($stmt === false) {
    die('Error pidiendo vacaciones: ' . $conexion->error);
}

// $stmt->bind_param("iss", $id_empleado, $fecha_inicio, $fecha_final);
$aux = "Nombre: ". $nombre. ", ID: ". $id_empleado. ", fecha inicio: ". $fecha_inicio. ", fecha final: ". $fecha_final;
$stmt->bind_param("ssss", $nombre, $aux, $fecha_inicio, $fecha_final);

if ($stmt->execute()) {
    header("Location: formulario.php?uf=¡se ha enviado la petición exitosamente!");
    exit();
} else {
    echo "Error: " . $conexion->error;
    header("Location: formulario.php?uf=No se pudo enviar correctamente...");
    exit();
}

$stmt->close();
?>