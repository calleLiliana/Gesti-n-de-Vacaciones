<?php
include('ConexionBD.php');
session_start();
if (!isset($_SESSION['email'])) {
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
$sql = "INSERT INTO `eventos` (`id`, `title`, `descripcion`, `start`, `end`, `id_empleado`, `estado`) VALUES (NULL, ?, ?, ?, ?, ?, `En espera`)";
$stmt = $conexion->prepare($sql);

if ($stmt === false) {
    die('Error pidiendo vacaciones: ' . $conexion->error);
}

// Preparar la descripción
$aux = "Nombre: ". $nombre. ", ID: ". $id_empleado. ", fecha inicio: ". $fecha_inicio. ", fecha final: ". $fecha_final;

// Enlazar parámetros
$stmt->bind_param("sssss", $nombre, $aux, $fecha_inicio, $fecha_final, $id_empleado);

if ($stmt->execute()) {
    header("Location: formulario.php?uf=¡se ha enviado la petición exitosamente!");
    exit();
} else {
    // Manejo de errores
    header("Location: formulario.php?uf=No se pudo enviar correctamente...");
    exit();
}

// Cerrar la declaración y la conexión
$stmt->close();
$conexion->close();
?>