<?php
require_once 'libs/router.php';

require_once 'controllers/RecipeApiController.php';
require_once 'controllers/UserApiController.php';

$router = new Router();

#                  endpoint                  verbo              controller              método
# Recetas
$router->addRoute('recetas',                'GET',          'RecipeApiController',      'getAll');
$router->addRoute('recetas/:id',            'GET',          'RecipeApiController',      'getById');
$router->addRoute('recetas/:id',            'DELETE',       'RecipeApiController',      'delete');
$router->addRoute('recetas/:id',            'PUT',          'RecipeApiController',      'update');
$router->addRoute('recetas',               'POST',         'RecipeApiController',       'add');


# Usuarios

$router->addRoute('usuarios',               'GET',          'UserApiController',    'getAllUsers');
$router->addRoute('usuarios/:id',           'GET',          'UserApiController',    'getUserById');
$router->addRoute('usuarios/:id',           'DELETE',       'UserApiController',    'deleteUser');
$router->addRoute('usuarios/:id',           'PUT',          'UserApiController',    'updateUser');
$router->addRoute('usuarios',              'POST',         'UserApiController',    'addUser');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
