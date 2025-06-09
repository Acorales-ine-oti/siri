<?php
require 'conexion.php';

// Nombre de la tabla
$tabla = "usuarios";

// Consulta SQL para crear la tabla
$sql = "CREATE TABLE IF NOT EXISTS $tabla (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    cedula VARCHAR(20) UNIQUE NOT NULL,
    funciones VARCHAR(20) UNIQUE NOT NULL,
    dependencia VARCHAR(20),
    acepto_terminos BOOLEAN NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabla '$tabla' creada con éxito o ya existente.";
} else {
    echo "Error al crear la tabla: " . $conn->error;
}

$conn->close();
?>