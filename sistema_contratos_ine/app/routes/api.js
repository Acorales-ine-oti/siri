// Rutas para la API REST (ejemplos)
const express = require('express');
const router = express.Router();
const usuarioController = require('../controllers/usuarioController');
const contratoController = require('../controllers/contratoController'); // Se podría tener un controlador API separado

// Rutas de autenticación
router.post('/login', usuarioController.login);
router.post('/register', usuarioController.register);

// Rutas de API para contratos (ejemplo, podría ser manejado por un controlador API específico)
router.get('/contratos', async (req, res) => {
    try {
        const contratos = await Contrato.getAll();
        res.json(contratos);
    } catch (error) {
        res.status(500).json({ message: 'Error al obtener contratos.' });
    }
});

module.exports = router;