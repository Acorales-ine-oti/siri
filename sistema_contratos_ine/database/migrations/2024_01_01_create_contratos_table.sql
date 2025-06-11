-- Migración para crear la tabla 'contratados'
CREATE TABLE IF NOT EXISTS contratados (
    id_contratado INT AUTO_INCREMENT PRIMARY KEY,
    cedula_identidad VARCHAR(15) NOT NULL UNIQUE,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    nacionalidad VARCHAR(50) NOT NULL DEFAULT 'Venezolana',
    mayor_edad BOOLEAN NOT NULL,
    domicilio VARCHAR(255) NOT NULL,
    cargo VARCHAR(100) NOT NULL,
    adscripcion_ine VARCHAR(100) NOT NULL,
    huella_dactilar_hash VARCHAR(255) NULL
);

-- Migración para crear la tabla 'contratos'
CREATE TABLE IF NOT EXISTS contratos (
    id_contrato INT AUTO_INCREMENT PRIMARY KEY,
    id_contratado INT NOT NULL,
    fecha_firma DATE NOT NULL,
    url_documento_digital VARCHAR(255) NOT NULL,
    estado_contrato ENUM('Activo', 'Finalizado', 'Anulado') NOT NULL DEFAULT 'Activo',
    fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_contratado) REFERENCES contratados(id_contratado)
);