// Controlador para la lógica de usuarios
const Usuario = require('../models/Usuario');
// const bcrypt = require('bcrypt'); // Para hashear contraseñas

const usuarioController = {
    async login(req, res) {
        const { username, password } = req.body;
        // Lógica de autenticación (ejemplo simplificado)
        const user = await Usuario.findByUsername(username);

        if (!user) {
            return res.status(401).send('Usuario no encontrado');
        }

        // if (!await bcrypt.compare(password, user.password_hash)) {
        //     return res.status(401).send('Contraseña incorrecta');
        // }
        // Simplificado:
        if (password !== user.password_hash) { // ¡NO USAR EN PRODUCCIÓN!
            return res.status(401).send('Contraseña incorrecta');
        }

        // Si la autenticación es exitosa, se podría manejar sesiones/tokens aquí
        res.status(200).send(`Bienvenido, ${user.nombre_usuario}!`);
    },

    async register(req, res) {
        const { username, password, rol } = req.body;
        try {
            // const hashedPassword = await bcrypt.hash(password, 10);
            const userId = await Usuario.create({
                nombre_usuario: username,
                password_hash: password, // ¡NO USAR SIN HASH EN PRODUCCIÓN!
                rol: rol
            });
            res.status(201).send(`Usuario ${username} registrado con ID: ${userId}`);
        } catch (error) {
            console.error('Error al registrar usuario:', error);
            res.status(500).send('Error al registrar usuario');
        }
    },

    // Otras funciones como ver perfil, actualizar usuario, etc.
};

module.exports = usuarioController;