# Generador de Contraseñas

Este es un simple generador de contraseñas en PHP que te permite crear contraseñas únicas y robustas combinando mayúsculas, minúsculas, números y símbolos. La contraseña se genera a partir de una palabra de entrada proporcionada por el usuario. Además, la contraseña se guarda en un archivo ZIP encriptado con una contraseña adicional.

## Uso

1. Clona este repositorio o descarga el código.
2. Abre el archivo `index.php` en tu servidor local o en un servidor web.
3. Ingresa una palabra de al menos 5 caracteres en el campo de entrada.
4. Presiona el botón "Hágale" para generar y guardar la contraseña.

## Requisitos

- PHP instalado en tu servidor.

## Detalles Técnicos

El código utiliza PHP para la lógica de generación de contraseñas y HTML para la interfaz de usuario simple. Aquí hay algunas características clave:

- La función `generarContrasena` toma la palabra de entrada, genera una contraseña única y la guarda en un archivo ZIP encriptado.
- Se intercalan mayúsculas y minúsculas (o números y símbolos) en la generación de contraseñas para mejorar la complejidad.
- La contraseña se guarda en un archivo ZIP con encriptación AES-256 para mayor seguridad.
- Se proporciona un formulario web básico para ingresar la palabra de entrada y generar la contraseña.

## Aviso

- Asegúrate de cambiar la contraseña predefinida (`$contrasenaZip`) en el código por una contraseña segura y única de tu elección.

## Recursos Adicionales

- [Have I Been Pwned](https://haveibeenpwned.com/): Un servicio de seguridad que permite verificar si tus contraseñas o direcciones de correo electrónico han sido comprometidas en violaciones de datos.

## Autor

- Mario Luján
- GitHub: [@maluxz](https://github.com/maluxz)

© 2024 Mario Luján. Este proyecto está disponible en [GitHub](https://github.com/maluxz) para su revisión y contribución.
