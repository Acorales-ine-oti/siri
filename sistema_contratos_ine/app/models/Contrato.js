// Definición del modelo Contrato (interacción con la tabla `contratos` y `contratados`)
const mysql = require('mysql2/promise');
const dbConfig = require('../../config/database');

class Contrato {
    constructor(id, id_contratado, fecha_firma, url_documento_digital, estado_contrato, fecha_registro) {
        this.id = id;
        this.id_contratado = id_contratado;
        this.fecha_firma = fecha_firma;
        this.url_documento_digital = url_documento_digital;
        this.estado_contrato = estado_contrato;
        this.fecha_registro = fecha_registro;
    }

    static async getAll() {
        const connection = await mysql.createConnection(dbConfig);
        try {
            const [rows] = await connection.execute(
                `SELECT c.*, co.nombre, co.apellido, co.cedula_identidad 
                 FROM contratos c
                 JOIN contratados co ON c.id_contratado = co.id_contratado
                 ORDER BY c.fecha_registro DESC`
            );
            return rows; // Retorna un array de objetos
        } finally {
            await connection.end();
        }
    }

    static async create(contratoData, contratadoData) {
        const connection = await mysql.createConnection(dbConfig);
        await connection.beginTransaction();
        try {
            // Insertar o encontrar al contratado
            let contratadoId;
            const [existingContratado] = await connection.execute(
                'SELECT id_contratado FROM contratados WHERE cedula_identidad = ?',
                [contratadoData.cedula_identidad]
            );

            if (existingContratado.length > 0) {
                contratadoId = existingContratado[0].id_contratado;
            } else {
                const [resultContratado] = await connection.execute(
                    `INSERT INTO contratados (cedula_identidad, nombre, apellido, nacionalidad, mayor_edad, domicilio, cargo, adscripcion_ine, huella_dactilar_hash) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)`,
                    [
                        contratadoData.cedula_identidad, contratadoData.nombre, contratadoData.apellido,
                        contratadoData.nacionalidad, contratadoData.mayor_edad, contratadoData.domicilio,
                        contratadoData.cargo, contratadoData.adscripcion_ine, contratadoData.huella_dactilar_hash || null
                    ]
                );
                contratadoId = resultContratado.insertId;
            }

            // Insertar el contrato
            const [resultContrato] = await connection.execute(
                `INSERT INTO contratos (id_contratado, fecha_firma, url_documento_digital, estado_contrato) 
                 VALUES (?, ?, ?, ?)`,
                [
                    contratadoId, contratoData.fecha_firma, contratoData.url_documento_digital,
                    contratoData.estado_contrato || 'Activo'
                ]
            );

            await connection.commit();
            return resultContrato.insertId;

        } catch (error) {
            await connection.rollback();
            throw error;
        } finally {
            await connection.end();
        }
    }

    // Otros métodos como findById, update, delete, etc.
}

module.exports = Contrato;