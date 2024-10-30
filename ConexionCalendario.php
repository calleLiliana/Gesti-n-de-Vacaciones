<?php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";

$dbname = "vacaciones_bd";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establece la conexión en modo de error de excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener las vacaciones
    $sql = "SELECT * FROM vacaciones"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Convierte los resultados en un array asociativo
    $vacaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Convierte los resultados a formato JSON
    echo json_encode($vacaciones);

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;

?>