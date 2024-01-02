# Proyecto Laravel Artisans

Este repositorio contiene un proyecto desarrollado en Wordpress que muestra nuestros servicios y enlaza los eventos de la aplicación p4 de laravel que hemos creado anteriormente.

## Configuración

### Paso 1: Importar la base de datos

Antes de comenzar, asegúrate de tener una copia de la base de datos del proyecto.
Para ello, puedes utilizar p5-laravel-sql.sql e importar la base de datos a tu gestor de bd.

1. Inicia Laragon y asegúrate de que el servidor de MySQL esté en ejecución.
2. Abre tu herramienta de gestión de bases de datos preferida (por ejemplo, HeidiSQL) e importa la base de datos utilizando el archivo de copia de seguridad proporcionado.

### Paso 2: Mover el proyecto a la carpeta 'www' de Laragon

Para que Laragon pueda servir el proyecto, debes colocarlo en la carpeta 'www' de Laragon.

1. Copia todos los archivos y carpetas del proyecto a la siguiente ubicación en tu sistema: `C:\laragon\www\p5-laravel-artisans` (o la ubicación de tu instalación de Laragon).
Recuerda llamar al proyecto p5-laravel-artisans

### Paso 3: Configurar el archivo hosts

Para acceder al proyecto localmente, debes configurar tu archivo hosts de Windows.

1. Abre Laragon y haz clic con el botón derecho en el ícono de Laragon en la bandeja del sistema.
2. Navega a "Herramientas" y selecciona "Herramientas" nuevamente.
3. En la ventana emergente de "Herramientas de Laragon", selecciona la pestaña "hosts".
4. Añade la siguiente línea al archivo de hosts y guarda los cambios:

127.0.0.1 p5-laravel-artisans.test #laragon magic!

5. Reinicia Laragon para que los cambios surtan efecto.

6. Ten cuidado con el puerto y el usuario y contraseña de la bd y el proyecto.
- Si necesitas cambiar esta configuración, abre el proyecto con VBCode y ve a wp-config.php
- Después, podrás visualizar el puerto, usuario y contraseña, cambialo según tus necesidades (si no lo necesitas, saltate este paso, este proyecto tira de el puerto 3306, localhost, root y sin contraseña de db).

### Acceder al proyecto

Una vez que hayas realizado los pasos anteriores, puedes acceder al proyecto en tu navegador web:

- [http://p5-laravel-artisans.test/](http://p5-laravel-artisans.test/)

### Acceder al panel administrador

Para acceder al panel de administración, utiliza las siguientes credenciales:
- **URL:** http://p5-laravel-artisans.test/wp-admin
- **Usuario:** adminLA
- **Contraseña:** [Pedir contraseña al equipo Laravel Artisans]