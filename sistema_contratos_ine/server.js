// Punto de entrada de la aplicación
require('dotenv').config(); // Carga las variables de entorno al inicio
const express = require('express');
const path = require('path');
const appConfig = require('./config/app');
const webRoutes = require('./app/routes/web');
const apiRoutes = require('./app/routes/api');

const app = express();
const PORT = process.env.PORT || 3000;

// Configuración de Express
app.use(express.json()); // Para parsear JSON en el cuerpo de las solicitudes
app.use(express.urlencoded({ extended: true })); // Para parsear datos de formularios URL-encoded

// Configuración de Vistas (EJS)
app.set('views', path.join(__dirname, 'resources', 'views'));
app.set('view engine', 'ejs');

// Servir archivos estáticos
app.use(express.static(path.join(__dirname, 'public')));

// Rutas
app.use('/', webRoutes); // Rutas para las vistas web
app.use('/api', apiRoutes); // Rutas para la API REST

// Manejo de errores (ejemplo básico)
app.use((err, req, res, next) => {
    console.error(err.stack);
    res.status(500).send('¡Algo salió mal!');
});

// Iniciar el servidor
app.listen(PORT, () => {
    console.log(`Servidor escuchando en http://localhost:${PORT}`);
});