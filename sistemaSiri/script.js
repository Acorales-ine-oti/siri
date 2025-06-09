$(document).ready(function() {
    $("#registroForm").submit(function(event) {
        event.preventDefault(); // Evitar el envío normal del formulario

        // Capturar los valores de los campos del formulario
        var nombre = $("#nombre_Form").val();
        var apellido = $("#apellido_Form").val();
        var cedula = $("#cedula_Form").val();
        var funciones = $("#funciones_Form").val();
        var dependencia = $("#dependencia_Form").val();

        // Actualizar los campos en el documento legal en el footer
        $("#nombre_Form_contrato").text(nombre + " " + apellido);
        $("#cedula_Form_contrato").text(cedula);
        $("#funciones_Form_contrato").text(funciones);
        $("#dependencia_Form_contrato").text(dependencia);

        // Actualizar la tabla en el footer
        $("#nombreApellido_tabla_footer").text(nombre + " " + apellido);
        $("#cedula_tabla_footer").text(cedula);
        $("#huellaFirma_tabla_footer").text("Pendiente"); // Puedes agregar lógica para la huella/firma si es necesario

        // Obtener la fecha actual para el contrato
        var fechaActual = new Date();
        var dia = fechaActual.getDate();
        var mes = new Intl.DateTimeFormat('es-VE', { month: 'long' }).format(fechaActual);
        var anio = fechaActual.getFullYear();

        $("#dia_contrato").text(dia);
        $("#mes_contrato").text(mes);
        $("#anio_contrato").text(anio);

        // Enviar los datos a guardar_datos.php mediante AJAX
        $.ajax({
            type: "POST",
            url: "guardar_datos.php",
            data: $(this).serialize(), // Serializar los datos del formulario
            success: function(response) {
                $("#mensaje").html(response); // Mostrar la respuesta del servidor
                // Opcional: Limpiar el formulario después de un registro exitoso
                $("#registroForm")[0].reset();
            },
            error: function(error) {
                $("#mensaje").html("Error al enviar los datos.");
                console.error("Error AJAX:", error);
            }
        });
    });
});