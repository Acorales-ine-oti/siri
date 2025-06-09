document.addEventListener('DOMContentLoaded', function () {
    //Captura de datos del formulario:
    const nombreFormulario = document.getElementById('nombreForm').value;
    const apellidoFormulario = document.gerElementById('apellidoForm').value;
    const cedulaFormulario = document.getElementById('cedulaForm').value;
    const funcionesFormulario = document.getElementById('funcionesForm').value;
    const dependenciaForm = document.getElementById('dependenciaForm').value;
    const terminosFormulario = document.getElementById('terminosForm').value;
    
   //Llamada al objeto Date():
    let fechaHora = new Date();

    //Captura de la fecha
      let dia = fechaHora.getDay();
      let mes = fechaHora.getMonth() + 1;
      let anio = fechaHora.getFullYear();
      let fullFecha = dia+'/'+mes+'/'+anio;

    //Captura de hora:
      let hora = fechaHora.getHours();
      let min = fechaHora.getMinutes();
      let seg = fechaHora.getSeconds(); 
      let fullTiempo = hora+':'+min+':'.seg;

    //Datos fecha hora para enviar al php y guardar en la db:
      let fullFechaHora = fullFecha+' '+fullTiempo;

    //Mostrar datos en el documento:
      document.getElementById('nombreDocumento').innerText = nombreFormulario;
      document.getElementById('apellidoDocumento').innerText = apellidoFormulario;
      document.getElementById('cedulaDocumento').innerText = cedulaFormulario;
      document.getElementById('funcionesDocumento').innerText = funcionesFormulario;
      document.getElelementById('dependenciaDocumento').innerText = dependenciaForm;
      document.getElementById('diaDocumento').innerText = dia;
      document.getElementById('mesDocumento').innerText = mes;
      document.getElementById('anioDocumento').innerText = anioDocumento;
      document.getElementById('nombre2Documento').innerText = nombreFormulario;
      document.getElementById('apellido2Documento').innerText = apellidoFormulario;
      document.getElementById('cedula2Documento').innerText = cedulaFormulario;

});//Fin de la función document.addEvenListerner