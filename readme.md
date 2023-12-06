# Laravel Artisans - P2 - MVC con PHP puro

# Proyecto:

## Te presentamos el proyecto de Eventos - Laravel Artisans

## Como ejecutar el proyecto en local (recomendado)
-Descarga y configura Laragon o XAMPP.
-Configura la base de datos en laragon o XAMPP e importa la bd que está en la carpeta bd
-Configura la bd, user y password en la configuracion de la bd, situada en db/conexion.php
-Ten en cuenta que en Laragon el proyecto debe estar alojado en WWW para que funcione.
-localhost:8080 (o el puerto que quieras) y si es laragon: MVC-LARAVEL-ARTISANS-P2(localhost:8080/MVC-LARAVEL-ARTISANS-P2).


## ¿Cómo ejecutar el proyecto con Docker?
Easy!:
-Primero debes tener instalado Docker
-Después, ejecuta docker
-Y después, abre una terminal en vscode o CMD (modo administrador) apuntando al proyecto y ejecuta los siguientes comandos:
docker build -t mvclaravelartisans2 .
Si todo ha salido bien no saldrá error y ejecutamos:
docker-compose up -d

Después utiliza: localhost/8080 para acceder y probar
el proyecto.

Puedes utilizar también localhost/8081 y acceder a PHPMYADMIN

Credenciales:
mysql-1
laravelArtisans / root
laravelArtisans 

## Uso de la aplicación
-Ten en cuenta que para que la aplicación funcione de forma correcta debe llamarse: MVC-LARAVEL-ARTISANS-P2
ya que en los views está seteado así para que no fallen las redirecciones, ya que PHP es dificil redireccionarlo
en diferentes ordenadores y no acepta a veces el redireccionamiento parcial (../).

- Para usar el usuario admin, debes poner admin@admin.com y la contraseña. (adm.......).
- Puedes probar en registro a crear un nuevo usuario, sin embargo, la aplicación solo creará usuarios normales,
no administradores.

## Como eliminar imagen docker después de utilizar (if you need)
### Para eliminar y limpiar los registros de la imagen desde una cmd, sigue estos pasos:
-Abre una nueva terminal (permisos de admin)
-Pon: docker stop p2-mvc-pruebas (o como se llame el contenedor)
-Luego listamos todos los contenedores: docker ps -a
-Luego eliminamos el contenedor de este producto: docker rm <container_id_1> (container_id_1 es el nombre del contenedor)
-Si queremos eliminar una imagen: docker images para revisar las imagenes que hay en docker
-docker rmi nombre_imagen para eliminar la imagen.

# ¿De que va esta APP?

Esta APP está hecha en PHP puro con el patrón MVC y es una web de Eventos, en los cuales los ponentes 
pueden añadirse a estos eventos.
Además, tenemos administradores que gestionan toda la web, tanto los eventos como los usuarios y ponentes a eventos. Es una web muy sencilla hecha en MVC, utilizando bootstrap, fullcalendar.io, composer y más herramientas que nos permiten facilitarnos el día a día
de nuestras clases y poder apuntarnos a eventos que queramos asistir.

# ¿Que es MVC?
## Patrón de Diseño MVC (Modelo-Vista-Controlador)

El patrón Modelo-Vista-Controlador (MVC) es una estructura de diseño de software que se utiliza comúnmente en el desarrollo de aplicaciones web y de software en general. Se divide en tres componentes principales:

### Modelo (Model)
El modelo es la capa que se encarga de la lógica de la aplicación y la gestión de datos. Sus responsabilidades incluyen:

- Definición de estructuras de datos.
- Interacción con la base de datos, lo que incluye la escritura de consultas SQL.
- Manipulación de los datos antes de pasarlos a la vista.
- Implementación de los métodos que incluyen las consultas SQL.

### Vista (View)
La vista se encarga de la presentación de los datos al usuario y de recoger la entrada del usuario. Sus responsabilidades incluyen:

- Generación de páginas HTML y elementos de interfaz.
- Presentación de datos de manera legible y atractiva.
- Captura de la entrada del usuario a través de formularios u otros elementos.
- No realiza procesamiento de datos ni interactúa directamente con la base de datos.

### Controlador (Controller)
El controlador actúa como intermediario entre el modelo y la vista. Sus responsabilidades incluyen:

- Recepción de solicitudes del usuario desde la vista.
- Toma de decisiones basadas en esas solicitudes.
- Interacción con el modelo para recuperar o actualizar datos.
- Pasar los datos apropiados a la vista para su representación.

El patrón MVC promueve la separación de preocupaciones y la modularidad en el diseño de aplicaciones, lo que facilita la escalabilidad y el mantenimiento del código.

## Estructura del proyecto:

### ProyectoMVC (Estructura del proyecto)
-- assets
--- Controller
--- db
--- Model
--- View
--- www (docker container with app)
-- .gitignore (para node_modules necesario para bootstrap)
-- docker-compose.yml
-- Dockerfile
-- favicon.ico
-- index.php
-- login.php
-- logout.php
-- package-lock.json
-- package.json
-- readme.md
-- registro.php