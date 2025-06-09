<?php
// guardar_datos.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los campos están definidos y no vacíos
    if (isset($_POST["nombre_Form"]) && !empty($_POST["nombre_Form"]) &&
        isset($_POST["apellido_Form"]) && !empty($_POST["apellido_Form"]) &&
        isset($_POST["cedula_Form"]) && !empty($_POST["cedula_Form"]) &&
        isset($_POST["funciones_Form"]) && !empty($_POST["funciones_Form"]) &&
        isset($_POST["dependencia_Form"]) && !empty($_POST["dependencia_Form"]) &&
        isset($_POST["terminos_Form"])) {

        // Recibir y sanitize the data
        $nombre = htmlspecialchars($_POST["nombre_Form"]);
        $apellido = htmlspecialchars($_POST["apellido_Form"]);
        $cedula = htmlspecialchars($_POST["cedula_Form"]);
        $funciones = htmlspecialchars($_POST["funciones_Form"]);
        $dependencia = htmlspecialchars($_POST["dependencia_Form"]);
        $terminos = htmlspecialchars($_POST["terminos_Form"]);

        // Combine name
        $nombreCompleto = $nombre . " " . $apellido;

        // Get the current date
        $fechaActual = new DateTime();
        $dia = $fechaActual->format('d');
        $mes = $fechaActual->format('F'); // Full month name (e.g., January)
        $anio = $fechaActual->format('Y');


    } else {
        $error = "Por favor, complete todos los campos del formulario.";
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato de Confidencialidad</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .contenedorDocumentoLegal {
            max-width: 800px;
            margin: auto;
            padding: 20px;
        }

        .indent {
            margin-left: 2em;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <div class="contenedorDocumentoLegal">
            <h2 class="text-center mb-4">CONTRATO DE CONFIDENCIALIDAD Y RESERVA DE INFORMACIÓN</h2>
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <p class="text-justify">
                Yo, <strong><span id="nombre_Form_contrato"><?php if (isset($nombreCompleto)) echo strtoupper($nombreCompleto); ?></span></strong>,
                de nacionalidad venezolana, mayor de edad, de este domicilio y titular de la cédula de identidad Nro.
                <strong>V-<span id="cedula_Form_contrato"><?php if (isset($cedula)) echo strtoupper($cedula); ?></span></strong>,
                en mis funciones como
                <strong><span id="funciones_Form_contrato"><?php if (isset($funciones)) echo strtoupper($funciones); ?></span></strong>,
                adscrito a la
                <strong><span id="dependencia_Form_contrato"><?php if (isset($dependencia)) echo strtoupper($dependencia); ?></span></strong>
                del INE, mediante la presente declaro mi
                compromiso de mantener la CONFIDENCIALIDAD Y RESERVA ABSOLUTA de los datos e información de los cuales tenga
                conocimiento por cualquier medio de los órganos o entidades del sector público en el ejercicio de mis funciones
                como Contratado, en el Instituto Nacional de Estadísticas (INE), tal y como se encuentra instituido en el
                artículo 19 del Decreto con Rango, Valor y Fuerza de Ley de la Función Pública de Estadísticas de la República
                Bolivariana de Venezuela, Publicada en la Gaceta Oficial de la República Bolivariana de Venezuela Nº 37.321 de
                fecha 09 de noviembre de 2001, el cual tutela el secreto estadístico, cuando señala:
            </p>
            <p class="indent text-justify">
                <strong>Artículo 19:</strong> “Están amparados por el secreto estadístico los datos personales obtenidos
                directamente o por medio de información administrativa, que por su contenido, estructura o grado de
                desagregación identifiquen a los informantes”.
            </p>
            <p class="text-justify">
                De igual forma, me comprometo a mantener la CONFIDENCIALIDAD Y RESERVA ABSOLUTA en el ejercicio de las
                actividades y desarrollo del XV Censo Nacional de Población y Vivienda, conforme a lo establecido en el
                artículo 17 de la misma Ley que expresamente señala:
            </p>
            <p class="indent ms-3 text-justify">
                <strong>Artículo 17:</strong> “La Información estadística de interés público tendrá carácter oficial cuando el
                Instituto Nacional de Estadística la certifique y se haga pública a través de los órganos estadísticos. El
                personal de los órganos estadísticos no podrá suministrar información estadística parcial o total, provisional
                o definitiva, que conozca por razón de su trabajo,
                hasta tanto la misma se haya hecho oficialmente pública.”
            </p>
            <p class="text-justify">
                Igualmente, mediante la presente declaro la CONFIDENCIALIDAD Y RESERVA ABSOLUTA del secreto estadístico una
                vez culminada las labores y actividades debidamente encomendadas por el Instituto Nacional de Estadísticas, tal
                como se encuentra establecido en el artículo 23 del Decreto con Rango, Valor y Fuerza de la Ley de la Función
                Pública de Estadísticas, el cual señala:
            </p>
            <p class="indent ms-3 text-justify">
                <strong>Artículo 23:</strong> “Toda persona natural o jurídica, pública o privada que intervenga en la actividad
                estadística del Sistema Estadístico Nacional o tenga conocimiento de datos amparados tiene la obligación de
                mantener el secreto estadístico, aún después de concluir sus actividades profesionales o su vinculación con los
                servicios estadísticos”.
            </p>
            <p class="text-justify">
                Para efectos del presente compromiso, es importante destacar que la “Información Confidencial” comprende toda la
                información divulgada por cualquiera de las partes ya sea en forma oral, visual, escrita, grabada en medios
                magnéticos o en cualquier otra forma tangible y que se encuentre claramente marcada como tal al ser entregada a
                la parte receptora.
            </p>
            <p class="text-justify">
                Quedando sujeto (a) a las sanciones establecidas en el Decreto con Rango, Valor y Fuerza de Ley de la Función
                Estadística y a cualquier otra norma legal homologa aplicable por el cumplimiento de lo aquí declarado.
            </p>
            <p class="text-center">
                En Caracas, a los <span id="dia_contrato"><?php if (isset($dia)) echo $dia; ?></span> días del mes de <span
                    id="mes_contrato"><?php if (isset($mes)) echo $mes; ?></span> de <span
                    id="anio_contrato"><?php if (isset($anio)) echo $anio; ?></span>.
            </p>

            <form action="registra_db.php" method="post">
                <input type="hidden" name="nombre" value="<?php if (isset($nombre)) echo $nombre; ?>">
                <input type="hidden" name="apellido" value="<?php if (isset($apellido)) echo $apellido; ?>">
                <input type="hidden" name="cedula" value="<?php if (isset($cedula)) echo $cedula; ?>">
                <input type="hidden" name="funciones" value="<?php if (isset($funciones)) echo $funciones; ?>">
                <input type="hidden" name="dependencia" value="<?php if (isset($dependencia)) echo $dependencia; ?>">
                <input type="hidden" name="terminos" value="<?php if (isset($terminos)) echo $terminos; ?>">
                <input type="hidden" name="fecha_dia" value="<?php if (isset($dia)) echo $dia; ?>">
                <input type="hidden" name="fecha_mes" value="<?php if (isset($mes)) echo $mes; ?>">
                <input type="hidden" name="fecha_anio" value="<?php if (isset($anio)) echo $anio; ?>">


                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre y Apellido</th>
                            <th class="text-center">Cédula</th>
                            <th class="text-center">Huella Dactilar/Firma</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" id="nombreApellido_tabla_footer"><?php if (isset($nombreCompleto)) echo strtoupper($nombreCompleto); ?></td>
                            <td class="text-center" id="cedula_tabla_footer">V-<?php if (isset($cedula)) echo strtoupper($cedula); ?></td>
                            <td class="text-center" id="huellaFirma_tabla_footer">Pendiente</td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success mt-3" >Aceptar</button>
                <a href="index.html" class="btn btn-secondary mt-3">Rechazar</a>  </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>