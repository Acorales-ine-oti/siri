-- Migración para crear la tabla 'usuarios'
CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    rol ENUM('Administrador', 'Personal Autorizado') NOT NULL DEFAULT 'Personal Autorizado',
    activo BOOLEAN NOT NULL DEFAULT TRUE,
    fecha_creacion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    ultima_sesion DATETIME NULL
);

-- Migración para crear la tabla 'registros_auditoria'
CREATE TABLE IF NOT EXISTS registros_auditoria (
    id_registro INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    tipo_accion VARCHAR(50) NOT NULL,
    id_referencia_entidad INT NULL,
    nombre_entidad VARCHAR(50) NULL,
    descripcion TEXT NULL,
    fecha_hora_accion DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);