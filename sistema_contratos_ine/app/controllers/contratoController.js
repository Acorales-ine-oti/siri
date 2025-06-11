// Controlador para la lógica de contratos
const Contrato = require('../models/Contrato');
const path = require('path');
const fs = require('fs');

const contratoController = {
    async showContractsPage(req, res) {
        try {
            const contratos = await Contrato.getAll();
            res.render('contracts', { contratos: contratos });
        } catch (error) {
            console.error('Error al obtener contratos:', error);
            res.status(500).send('Error al cargar la página de contratos.');
        }
    },

    showNewContractPage(req, res) {
        res.render('new_contract');
    },

    async createContract(req, res) {
        const {
            cedula_identidad, nombre, apellido, nacionalidad, mayor_edad,
            domicilio, cargo, adscripcion_ine, huella_dactilar_hash,
            fecha_firma, url_documento_digital
        } = req.body;

        try {
            // Simulación de guardado de archivo digital (en un sistema real se subiría un archivo)
            const simulatedFilePath = path.join('/storage/contracts', `${cedula_identidad}_${Date.now()}.pdf`);
            // En un sistema real, aquí se manejaría la carga del archivo, por ejemplo, usando 'multer'
            // fs.writeFileSync(path.join(__dirname, '..', '..', simulatedFilePath), 'Contenido simulado del PDF');

            const contratadoData = {
                cedula_identidad, nombre, apellido, nacionalidad: nacionalidad === 'true',
                mayor_edad: mayor_edad === 'true', domicilio, cargo, adscripcion_ine, huella_dactilar_hash
            };
            const contratoData = {
                fecha_firma,
                url_documento_digital: simulatedFilePath // URL simulada
            };

            const newContractId = await Contrato.create(contratoData, contratadoData);
            res.status(201).redirect('/contratos'); // Redirige a la lista de contratos
        } catch (error) {
            console.error('Error al crear contrato:', error);
            res.status(500).send('Error al crear contrato.');
        }
    },

    // Otras funciones como ver detalle de contrato, actualizar, eliminar, etc.
};

module.exports = contratoController;