Laravel Eventos App - P4
Este es un proyecto de una aplicación web desarrollada con Laravel que gestiona eventos y usuarios con diferentes roles. La aplicación te permite crear, editar y eliminar eventos, además de asignar eventos a usuarios. También podemos modificar nuestro perfil y revisar los eventos.

Requisitos previos
PHP >= 7.3
Extensiones de php necesarias:
php_pdo (para la base de datos) / 
php_file_extension (para documentación y archivos)
Composer
Node.js >= 12
NPM
Laravel >= 7
MySQL
-Recuerda activar en php.ini: pdo_mysql / php_file_extension

Recuerda migrar la base de datos que se adjunta en el proyecto (eventos (3).sql).

Configuración
Sigue estos pasos para configurar y ejecutar la aplicación:

Clona este repositorio en tu máquina local:
git clone https://github.com/lhidalgoman/LaravelArtisans.git
Instala las dependencias PHP utilizando Composer (Si no está instalado previamente):
composer install
Cambia el archivo env para apuntar al puerto y base de datos correcta.

Ejecuta las migraciones de la base de datos para crear las tablas necesarias:

php artisan migrate
Inicia el servidor de desarrollo de Laravel:
php artisan serve
Compila los recursos de frontend con NPM:
npm install (si no tienes npm instalado) 
npm run dev

Si esto no te funciona bien, limpia la caché del proyecto
todas las urls y realiza las configuraciones necesarias
para que el proyecto se pueda ejecutar de forma correcta.
Recomendamos utilizar Laragon para el uso de la app,
junto con php de laragon y mysql de laragon.
Todas las extensiones y dependencias te las instala
sin necesidad de configurar nada más en tu local.

Accede a la aplicación en tu navegador web: http://localhost:8000
Uso
Puedes utilizar la aplicación de la siguiente manera:

Inicia sesión como administrador para gestionar eventos y roles de usuario.
Los usuarios pueden registrarse y ver los eventos.
Los eventos pueden ser creados, editados y eliminados por administradores.
Licencia
Todos los derechos reservados por la UOC y el equipo Laravel artisans. Este proyecto se distribuye bajo la Licencia MIT.