// Definición del modelo Usuario (interacción con la tabla `usuarios`)
const mysql = require('mysql2/promise');
const dbConfig = require('../../config/database');

class Usuario {
    constructor(id, nombre_usuario, password_hash, rol, activo, fecha_creacion, ultima_sesion) {
        this.id = id;
        this.nombre_usuario = nombre_usuario;
        this.password_hash = password_hash;
        this.rol = rol;
        this.activo = activo;
        this.fecha_creacion = fecha_creacion;
        this.ultima_sesion = ultima_sesion;
    }

    static async findByUsername(username) {
        const connection = await mysql.createConnection(dbConfig);
        try {
            const [rows] = await connection.execute(
                'SELECT * FROM usuarios WHERE nombre_usuario = ?',
                [username]
            );
            return rows.length > 0 ? new Usuario(
                rows[0].id_usuario, rows[0].nombre_usuario, rows[0].password_hash,
                rows[0].rol, rows[0].activo, rows[0].fecha_creacion, rows[0].ultima_sesion
            ) : null;
        } finally {
            await connection.end();
        }
    }

    static async create(userData) {
        const connection = await mysql.createConnection(dbConfig);
        try {
            // En un caso real, la contraseña se hashearía aquí
            const [result] = await connection.execute(
                'INSERT INTO usuarios (nombre_usuario, password_hash, rol) VALUES (?, ?, ?)',
                [userData.nombre_usuario, userData.password_hash, userData.rol || 'Personal Autorizado']
            );
            return result.insertId;
        } finally {
            await connection.end();
        }
    }

    // Otros métodos como update, delete, etc.
}

module.exports = Usuario;