<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombreForm"];
    $apellido = $_POST["apellidoForm"];
    $cedula = $_POST["cedulaForm"];
    $funciones = $_POST["funcionesForm"];
    $dependencia = $_POST["dependenciaForm"];
    $terminos = isset($_POST["terminosForm"]) ? 1 : 0; // 1 si aceptó, 0 si no

    // Preparar la consulta SQL
    $sql = "INSERT INTO usuarios (nombre, apellido, cedula, funciones, dependencia, acepto_terminos) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Verificar si la preparación de la consulta fue exitosa
    if ($stmt === false) {
        echo '<div class="alert alert-danger">Error al preparar la consulta SQL: ' . $conn->error . '</div>';
    } else {
        // Vincular los parámetros
        $stmt->bind_param("sssssi", $nombre, $apellido, $cedula, $funciones, $dependencia, $terminos);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo '<div class="alert alert-success">Registro completado con éxito.</div>';
        } else {
            echo '<div class="alert alert-danger">Error al registrar los datos: ' . $stmt->error . '</div>';
        }

        // Cerrar la sentencia
        $stmt->close();
    }

    // Cerrar la conexión
    $conn->close();
} else {
    echo '<div class="alert alert-warning">Acceso no permitido.</div>';
}
?>