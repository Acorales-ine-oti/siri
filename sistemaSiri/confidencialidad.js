document.addEventListener('DOMContentLoaded', function() {

    const registroForm = document.getElementById('registroForm');
    const footerCollapse = document.querySelector('.footer-collapse');
    const nombreSpanFooter = document.getElementById('nombre2');
    const apellidoSpanFooter = document.getElementById('apellido2');
    const cedulaSpanFooter = document.getElementById('cedula2');

    // Spans dentro del div.container del contrato
    const nombreSpanContrato = document.getElementById('nombre');
    const cedulaSpanContrato = document.getElementById('cedula');
    const funcionesSpanContrato = document.getElementById('funciones');
    const dependenciaSpanContrato = document.getElementById('dependencia');
    const fechaSpanContrato = document.getElementById('FECHA');
    const diaSpanContrato = document.getElementById('dia');
    const mesSpanContrato = document.getElementById('MES');
    const anioSpanContrato = document.getElementById('anio');

    registroForm.addEventListener('submit', function(event) {
        
        event.preventDefault();

                // Actualizar spans dentro del div.container del contrato
                nombreSpanContrato.textContent = nombre;
                cedulaSpanContrato.textContent = cedula;
                funcionesSpanContrato.textContent = "Contratado"; // Usando el dato del snippet
                dependenciaSpanContrato.textContent = "No especificado"; // Usando el dato del snippet
                const fechaActual = new Date();
                const diaActual = fechaActual.getDate();
                const mesActual = fechaActual.toLocaleString('es-ES', { month: 'long' });
                const anioActual = fechaActual.getFullYear();
                fechaSpanContrato.textContent = fechaActual.toLocaleDateString('es-ES');
                diaSpanContrato.textContent = diaActual.toString();
                mesSpanContrato.textContent = mesActual;
                anioSpanContrato.textContent = anioActual.toString();
        

        const nombre = document.getElementById('nombre').value;
        const apellido = document.getElementById('apellido').value;
        const cedula = document.getElementById('cedula').value;

        document.getElementById('nombre3').innerText = nombre;
        document.getElementById('apellido3').innerText=apellido;
        document.getElementById('cedula3').innerText=cedula;
        document.getElementById('FECHA').innerText= fechaActual.getDay();

        // Actualizar spans en el footer
        nombreSpanFooter.textContent = nombre;
        apellidoSpanFooter.textContent = apellido;
        cedulaSpanFooter.textContent = cedula;



        // Descargar el contenido del footer como PDF
        descargarContratoPDF(nombre, apellido, cedula);

        // Mostrar el footer
        footerCollapse.classList.remove('d-none');
        $('#footerInfo').collapse('show');

 
    });

    function descargarContratoPDF(nombre, apellido, cedula) {
        const contenido = document.querySelector('.footer-content').innerHTML;

        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        // Opciones para el PDF
        pdf.setFont('times', 'normal');
        pdf.setFontSize(12);
        pdf.html(contenido, {
            callback: function(doc) {
                doc.save(`Contrato_${nombre}_${apellido}.pdf`);
            },
            margin: [10, 10, 10, 10],
            html2canvas: { scale: 0.8 },
            windowWidth: 1000
        });
    }
});