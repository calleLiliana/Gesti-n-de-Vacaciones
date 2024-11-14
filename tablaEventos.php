<?php
session_start();
if (!isset($_SESSION['email'])) {
    // Si no hay sesión iniciada, redirige al Inicio
    header("Location: index.php");
    exit();
}

// Conexión a la base de datos
include('ConexionBD.php');

// Consulta para obtener los eventos
$sql = "SELECT e.id AS evento_id, e.start AS fecha_inicio, e.end AS fecha_fin, emp.nombre AS nombre_empleado, emp.id_empleado
        FROM eventos e
        JOIN empleados emp ON e.id_empleado = emp.id_empleado"; // Asegúrate de que la relación de las tablas sea correcta
$resultado = mysqli_query($conexion, $sql);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Eventos</title>
    <link rel="stylesheet" href="CSS/tablas.css"> <!-- Asegúrate de tener un archivo CSS para el estilo -->
</head>
<body>
    <header>
        <div class="back">
            <div class="menu-container">
                <nav>
                </nav>
                <h1>Eventos Registrados</h1>
                <nav>
                </nav>
            </div>
        </div>
    </header>
    <div class="titulo">
    </div>
    <table>
        <thead>
            <tr>
                <th>ID del Evento</th>
                <th>Nombre del Empleado</th>
                <th>ID Empleado</th>
                <th>Fecha de Inicio</th>
                <th>Fecha de Finalización</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Verificamos si hay resultados
            if (mysqli_num_rows($resultado) > 0) {
                // Salida de cada fila de datos
                while ($row = mysqli_fetch_assoc($resultado)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['evento_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['nombre_empleado']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['id_empleado']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fecha_inicio']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['fecha_fin']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay eventos registrados.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <form action="administrarVacaciones.php" method="post">
        <button type="submit">Volver Atrás</button>
    </form>
</body>
</html>

<?php
// Cerrar la conexión
mysqli_close($conexion);
?>