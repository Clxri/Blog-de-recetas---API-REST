<<<<<<< HEAD
# Blog-de-recetas
TPE Web 2 - Blog de recetas


## Alumnos
Ribas, Maria Clara (44339478) y Saganea, Giuliana Celeste (44534456)


## Temática
Recetario online


## Breve introducción
Nuestro sitio web consiste en un recetario destinado a la publicación de recetas culinarias donde los usuarios pueden subir sus propias recetas con instrucciones e imágenes. La base de datos posee relación 1 a N: Cada usuario puede publicar varias recetas y cada receta pertenece a un único usuario, quien es su autor registrado.

# Blog-de-recetas (Segunda parte)

## Configuración de la base de datos

1. Abrí phpMyAdmin en tu navegador.
2. Crea una nueva base de datos llamada recetario.
3. Selecciona la base de datos recién creada.
4. Hace clic en la pestaña Importar.
5. Presiona Seleccionar archivo y elegí el archivo recetario.sql incluido en este proyecto.
6. Hace clic en Continuar para importar las tablas y los datos.
7. La base de datos incluye las tablas users, recipes y admin

## Puesta en marcha del sitio

1. Copia todos los archivos del proyecto dentro de la carpeta htdocs.
2. Inicia Apache y MySQL desde XAMPP o similar
3. Abrí el navegador y accedé a la URL del proyecto
4. El sistema se conectará automáticamente a la base de datos configurada.

## Acceso a la página

Usuario administrador:
Usuario: webadmin
Contraseña: admin

Para ingresar como administrador:
1. Ir a la sección “Login” desde el menú principal.
2. Iniciar sesión con los datos anteriores.

Público general:

Ver el listado de todas las recetas disponibles.
Consultar los detalles de cada usuario y sus recetas.
Añadir tanto usuarios como recetas a usuarios

Administrador:

Editar o eliminar recetas.
Editar o eliminar usuarios.
Iniciar y cerrar sesión.
Protección de rutas para evitar el acceso sin autenticación.

## Estructura de la base de datos

usuarios: guarda la información de los usuarios del sistema.
recetas: contiene los datos de cada receta publicada.

## Aclaración
Dejamos aclarado que por una pequeña confusión la alumna (B) realizó la parte (A) y viceversa

## Diagrama Entidad-Relación (DER)
![DER-Saganea-Ribas](DER-Saganea-Ribas.png)
=======
# Blog-de-recetas---API-REST
>>>>>>> 165566c8aa80daa7493deef90d77bfa025643e27
