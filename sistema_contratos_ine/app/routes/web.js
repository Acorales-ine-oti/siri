// Rutas para las vistas web
const express = require('express');
const router = express.Router();
const contratoController = require('../controllers/contratoController');

// Ruta principal
router.get('/', (req, res) => {
    res.render('layout', { title: 'Inicio del Sistema' }); // Renderiza una página de inicio simple
});

// Rutas de contratos
router.get('/contratos', contratoController.showContractsPage);
router.get('/contratos/nuevo', contratoController.showNewContractPage);
router.post('/contratos', contratoController.createContract);

module.exports = router;