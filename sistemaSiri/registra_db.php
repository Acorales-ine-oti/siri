<?php
// genera_contrato.php

// Initialize variables to avoid errors if the form isn't submitted yet
$nombre = "";
$apellido = "";
$cedula = "";
$funciones = "";
$dependencia = "";
$fecha_dia = "";
$fecha_mes = "";
$fecha_anio = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["nombre"]) && !empty($_POST["nombre"]) &&
        isset($_POST["apellido"]) && !empty($_POST["apellido"]) &&
        isset($_POST["cedula"]) && !empty($_POST["cedula"]) &&
        isset($_POST["funciones"]) && !empty($_POST["funciones"]) &&
        isset($_POST["dependencia"]) && !empty($_POST["dependencia"]) &&
        isset($_POST["terminos"]) && !empty($_POST["terminos"]) &&
        isset($_POST["fecha_dia"]) && !empty($_POST["fecha_dia"]) &&
        isset($_POST["fecha_mes"]) && !empty($_POST["fecha_mes"]) &&
        isset($_POST["fecha_anio"]) && !empty($_POST["fecha_anio"])) {

        // Receive data
        $nombre = $_POST["nombre"];
        $apellido = $_POST["apellido"];
        $cedula = $_POST["cedula"];
        $funciones = $_POST["funciones"];
        $dependencia = $_POST["dependencia"];
        //$acepto_terminos = $_POST["terminos"]; // You're setting this to 1 anyway
        $acepto_terminos = 1;
        $fecha_dia = $_POST["fecha_dia"];
        $fecha_mes = $_POST["fecha_mes"];
        $fecha_anio = $_POST["fecha_anio"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "terminoDeUso";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Combine date parts into a DATETIME format (YYYY-MM-DD HH:MM:SS)
        $fechaHoraRegistro = $fecha_anio . '-' . str_pad(date("m", strtotime($fecha_mes)), 2, "0", STR_PAD_LEFT) . '-' . str_pad($fecha_dia, 2, "0", STR_PAD_LEFT) . " " . date("H:i:s");


        // *** Database insertion code goes HERE ***
        // Use prepared statements to prevent SQL injection
        $sql = "INSERT INTO usuarios (nombre, apellido, cedula, funciones, dependencia, acepto_terminos, fecha_registro) VALUES (?, ?, ?, ?, ?, ?, ?)";  // 7 columns
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssssss", $nombre, $apellido, $cedula, $funciones, $dependencia, $acepto_terminos, $fechaHoraRegistro); // 7 values

            if ($stmt->execute()) {
                $mensaje = "CONTRATO REGÍSTRADO!."; // Success message for display
            } else {
                $mensaje = "Error al insertar datos: " . $stmt->error.'<br> <a href="index.html" class="btn btn-secondary mt-3">Corregir</a> '; // Error message for display
            }

            $stmt->close();
        } else {
            $mensaje = "Error en la preparación de la consulta: " . $conn->error; // Error message
        }

        $conn->close();


        // *** Data is now processed, ready to display the contract ***

    } else {
        $mensaje = "Por favor, complete el formulario."; // Message if form is incomplete
    }
} else {
    $mensaje = "Este script solo acepta peticiones POST."; // Message if not a POST request
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

            <?php if (isset($mensaje)) : ?>
                <div class="alert <?php echo (strpos($mensaje, "Error") === false) ? 'alert-success' : 'alert-danger'; ?>">
                    <?php echo $mensaje; ?>
                </div>
            <?php endif; ?>

            <p class="text-justify">
                Yo, <strong><?php echo isset($nombre) ? strtoupper($nombre . " " . $apellido) : '....................'; ?></strong>,
                de nacionalidad venezolana, mayor de edad, de este domicilio y titular de la cédula de
                identidad Nro. <strong>V-<?php echo isset($cedula) ? strtoupper(substr($cedula, 2)) : '....................'; ?></strong>
                , en mis funciones como <strong><?php echo isset($funciones) ? strtoupper($funciones) : '....................'; ?></strong>,
                adscrito a la <strong><?php echo isset($dependencia) ? strtoupper($dependencia) : '....................'; ?></strong>
                del INE, mediante la presente declaro mi compromiso de mantener la CONFIDENCIALIDAD Y RESERVA ABSOLUTA
                de los datos e información de los cuales tenga conocimiento por cualquier medio de los órganos o entidades
                del sector público en el ejercicio de mis funciones como Contratado, en el Instituto Nacional de
                Estadísticas (INE), tal y como se encuentra instituido en el artículo 19 del Decreto con Rango, Valor y
                Fuerza de Ley de la Función Pública de Estadísticas de la República Bolivariana de Venezuela, Publicada
                en
                la Gaceta Oficial de la República Bolivariana de Venezuela Nº 37.321 de fecha 09 de noviembre de 2001, el
                cual tutela el secreto estadístico, cuando señala:
            </p>
            <p class="indent text-justify">
                <strong>Artículo 19</strong> “Están amparados por el secreto estadístico los datos personales obtenidos
                directamente o por medio de información administrativa, que por su contenido, estructura o grado de
                desagregación identifiquen a los informantes”.
            </p>
            <p class="text-justify">
                De igual forma, me comprometo a mantener la CONFIDENCIALIDAD Y RESERVA ABSOLUTA en el ejercicio de las
                actividades y desarrollo del XV Censo Nacional de Población y Vivienda , conforme a lo establecido en el
                artículo 17 de la misma Ley que expresamente señala:
            </p>
            <p class="indent text-justify">
                <strong>Artículo 17:</strong> “La Información estadística de interés público tendrá carácter oficial cuando
                el Instituto Nacional de Estadística la certifique y se haga pública a través de los órganos estadísticos.
                El personal de los órganos estadísticos no podrá suministrar información estadística parcial o total,
                provisional o definitiva, que conozca por razón de su trabajo,
                hasta tanto la misma se haya hecho oficialmente pública.”
            </p>
            <p class="text-justify">
                Igualmente, mediante la presente declaro la CONFIDENCIALIDAD Y RESERVA ABSOLUTA del secreto estadístico
                una vez culminada las labores y actividades debidamente encomendadas por el Instituto Nacional de
                Estadísticas, tal como se encuentra establecido en el artículo 23 del Decreto con Rango, Valor y Fuerza
                de la Ley de la Función Pública de Estadísticas, el cual señala:
            </p>
            <p class="indent text-justify">
                <strong>Articulo 23</strong>. “Toda persona natural o jurídica, pública o privada que intervenga en la
                actividad estadística del Sistema Estadístico Nacional o tenga conocimiento de datos amparados tiene la
                obligación de mantener
                el secreto estadístico, aún después de concluir sus actividades profesionales o su vinculación con los
                servicios estadísticos”.
            </p>
            <p class="text-justify">
                Para efectos del presente compromiso, es importante destacar que la “Información Confidencial” comprende
                toda la información divulgada por cualquiera de las partes ya sea en forma oral, visual, escrita, grabada
                en medios magnéticos o en cualquier otra forma tangible y que se encuentre claramente marcada como tal al
                ser entregada a la parte receptora.
            </p>
            <p class="text-justify">
                Quedando sujeto (a) a las sanciones establecidas en el Decreto con Rango, Valor y Fuerza de Ley de la
                Función Estadística y a cualquier otra norma legal homologa aplicable por el cumplimiento de lo aquí
                declarado.
            </p>
            <p class="text-right">
                En Caracas, a los <?php echo isset($fecha_dia) ? $fecha_dia : '........'; ?> días del mes de
                <?php echo isset($fecha_mes) ? $fecha_mes : '.........'; ?> de <?php echo isset($fecha_anio) ? $fecha_anio : '2024'; ?>.
            </p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre Apellido</th>
                        <th>C.I. Nro.</th>
                        <th>Huella dactilar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo isset($nombre) ? strtoupper($nombre . " " . $apellido) : '....................'; ?></td>
                        <td> V-<?php echo isset($cedula) ? strtoupper(substr($cedula, 2)) : '....................'; ?></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>