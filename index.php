<?php

function generarContrasena($palabra, $nombreArchivo, $contrasenaZip)
{
    // Verifica si la palabra de entrada tiene al menos 5 caracteres
    if (strlen($palabra) < 5) {
        echo "La palabra de entrada debe tener al menos 5 caracteres.";
        return;
    }

    // Convierte la palabra en un array de caracteres
    $caracteres = str_split($palabra);

    // Inicializa la contraseña como una cadena vacía
    $contrasena = '';

    // Flag para asegurarse de que al menos un símbolo se agregue
    $seAgregoSimbolo = false;

    // Itera sobre cada caracter de la palabra
    foreach ($caracteres as $caracter) {
        // Agrega el caracter original a la contraseña
        $contrasena .= $caracter;

        // Intercala mayúsculas y minúsculas (o números y símbolos)
        if (rand(0, 1) == 1) {
            // Convierte el caracter a mayúscula
            $contrasena .= strtoupper($caracter);
        } else {
            // Convierte el caracter a minúscula (o agrega un número/símbolo)
            if (ctype_alpha($caracter)) {
                // Caracter alfabético, agrega un número aleatorio
                $contrasena .= rand(0, 9);
            } else {
                // Caracter no alfabético, agrega un símbolo aleatorio
                $simbolos = '!@#$%^&*()-_=+[]{}|;:,.<>?';
                $contrasena .= $simbolos[rand(0, strlen($simbolos) - 1)];
                $seAgregoSimbolo = true;
            }
        }
    }

    // Si no se ha agregado un símbolo, agrega uno al final
    if (!$seAgregoSimbolo) {
        $simbolos = '!@#$%^&*()-_=+[]{}|;:,.<>?';
        $contrasena .= $simbolos[rand(0, strlen($simbolos) - 1)];
    }

    // Asegura que la contraseña tenga al menos 10 caracteres
    while (strlen($contrasena) < 10) {
        // Agrega caracteres aleatorios hasta que se alcance el mínimo
        $contrasena .= rand(0, 9);
    }

    // Mezcla los caracteres para mayor aleatoriedad
    $contrasena = str_shuffle($contrasena);

    // Imprime la contraseña generada
    echo "<b>Contraseña generada:</b> $contrasena <br>";
    // // Guardar la contraseña en un archivo de texto
    // $archivo = fopen($nombreArchivo . '.txt', 'w');
    // fwrite($archivo, $contrasena);
    // fclose($archivo);

    // // Imprime un mensaje de éxito
    // echo "<br>Contraseña generada y guardada en $nombreArchivo.txt";

    // Crear un archivo ZIP
    $zip = new ZipArchive();
    $zipFileName = 'pwd/' . $nombreArchivo . '.zip';

    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        // Añadir la contraseña al archivo ZIP
        $zip->addFromString('pwd.txt', $contrasena);

        // Establecer la contraseña para el archivo ZIP
        $zip->setPassword($contrasenaZip);

        // Establecer la encriptación AES-256 para el nombre del archivo
        $zip->setEncryptionName('pwd.txt', ZipArchive::EM_AES_256);

        // Cerrar el archivo ZIP
        $zip->close();

        // Imprimir mensaje de éxito
        echo "<b>Contraseña guardada</b>";
        // echo $zipFileName;
    } else {
        echo "Error al crear el archivo ZIP";
    }
}

// Verifica si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene la palabra del formulario
    $palabraEntrada = $_POST['palabra'];

    // Asigna el valor de $palabraEntrada tanto a $palabra como a $nombreArchivo
    $palabra = $palabraEntrada;
    $nombreArchivo = $palabraEntrada;

    // Llama a la función para generar y guardar la contraseña en un archivo ZIP
    $contrasenaZip = 'Abc123'; // Cambia esto por tu contraseña predefinida
    generarContrasena($palabra, $nombreArchivo, $contrasenaZip);
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Generador de Contraseñas</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <!-- <h1>Generador de Contraseñas</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="palabra">Palabra de entrada:</label>
        <input type="text" name="palabra" required>

        <button type="submit" class="button">Hágale</button>
    </form> -->

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="container">
            <div class="header">
                <h1>Generador de Contraseñas</h1>
            </div>

            <div class="section">
                <h2>Ingrese una palabra > 5 char.</h2>
                <p>Genera contraseñas únicas y robustas que combinan mayúsculas, minúsculas, números y símbolos,
                    intercalando elementos de manera aleatoria.</p>
                <p style="text-align: center;"><input type="text" name="palabra" class="input-style" required> | <button type="submit"
                        class="button">Hágale</button></p>
            </div>

            <div class="section">
                <h2>Have I Been Pwned</h2>
                <p>
                    (HIBP) es un servicio de seguridad que permite a los usuarios verificar si sus
                    contraseñas o direcciones de correo electrónico han sido comprometidas en violaciones de datos.
                    Utiliza un enfoque seguro que protege la privacidad al verificar contraseñas sin enviarlas
                    directamente.</p>
                <div style="text-align: right;"><a href="https://haveibeenpwned.com/">;--have i been pwned?</a></div>
            </div>
        </div>
    </form>

    <div class="footer">
        <p>&copy; 2024 Mario Luján. <a href="https://github.com/maluxz">@maluxz</a></p>
    </div>
</body>

</html>