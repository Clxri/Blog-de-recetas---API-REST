# Blog-de-recetas
TPE Web 2 - Blog de recetas


## Alumnos
Ribas, Maria Clara (44339478) y Saganea, Giuliana Celeste (44534456)


## Temática
Recetario online


## Breve introducción
Nuestro sitio web consiste en un recetario destinado a la publicación de recetas culinarias donde los usuarios pueden subir sus propias recetas con instrucciones e imágenes. La base de datos posee relación 1 a N: Cada usuario puede publicar varias recetas y cada receta pertenece a un único usuario, quien es su autor registrado.

# Blog-de-recetas (Tercera parte API REST)
Este trabajo consiste en el desarrollo de una API REST para gestionar un sistema de recetas y usuarios.
La API permite:

Listar, crear, editar y eliminar recetas.

Listar, crear, editar y eliminar usuarios.

Filtrar y ordenar los listados.

Usar Postman para interactuar con los endpoints.

## ENDPOINTS USUARIOS
__GET__ : /api/usuarios

Lista todos los usuarios. Los campos válidos son:

id_user

name

email

description

age

Permite ordenamiento: /api/usuarios?orderBy=name&order=desc

__GET__ : /api/usuarios/:ID

Trae un usuario en específico

__POST__ : /api/usuarios

Crea un usuario.

Ejemplo:

{
    "name": "Carla",
    "email": "carla@gmail.com",
    "description": "Fan de la pastelería",
    "age": 25
}

__PUT__ : /api/usuarios/:ID

Edita un usuario

__DELETE__ : /api/usuarios/:ID

Elimina un usuario

## ENDPOINTS RECETAS
__GET__ : /api/recetas

Lista todas las recetas. Los campos válidos son:

id_recipe

id_user

title

content

time

date

img

Permite ordenamiento: /api/recetas?orderBy=time&order=asc

Y filtrado por usuario: /api/recetas?user=13

__GET__ : /api/recetas/:ID

Devuelve la receta con ese ID

__POST__ : /api/recetas

Crea una nueva receta.

Ejemplo:

{
    "title": "Tarta de verdura",
    "content": "Mezclar todo y hornear",
    "time": 45,
    "date": "2025-10-15",
    "id_user": 8,
    "img": "https://imagen.com/tarta.jpg"
}


__PUT__ : /api/recetas/:ID

Modifica una receta existente.

__DELETE__ : /api/usuarios/:ID

Elimina la receta indicada
