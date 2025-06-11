// Configuración de la conexión a la base de datos MySQL
// NOTA: Esto es solo un ejemplo de configuración. La conexión real se hará en los modelos.
module.exports = {
    host: process.env.DB_HOST,
    user: process.env.DB_USER,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_NAME
};