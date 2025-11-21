<?php

require_once './models/modelRecipes.php';
require_once './views/viewJson.php';

class RecipeApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new modelRecipes();
        $this->view = new JSONView();
    }


public function getAll($req, $res) {

    $orderBy = $req->query->orderBy ?? null;
    $order = $req->query->order ?? 'asc';
    $filterUser = $req->query->user ?? null;

    if ($order !== 'asc' && $order !== 'desc') {
        return $this->view->response("'order' debe ser 'asc' o 'desc'", 400);
    }

    $validFields = ['title', 'content', 'time', 'date', 'id_user', 'img'];

    if ($orderBy !== null && !in_array($orderBy, $validFields)) {
        return $this->view->response("No se puede ordenar por '$orderBy'", 400);
    }

    // si hay user filtramos, sino traemos todos
    if ($filterUser !== null) {
        $recipes = $this->model->getAllByUser($filterUser, $orderBy, $order);

        if (!$recipes) {
            return $this->view->response("No hay recetas del usuario $filterUser", 404);
        }

        return $this->view->response($recipes, 200);
    }

    // traemos todas 
    $recipes = $this->model->getAll($orderBy, $order);
    return $this->view->response($recipes, 200);
}

    // GET especifico
    public function getById($req, $res) {

        if (!isset($req->params->id)) {
            return $this->view->response("Falta el ID", 400);
        }

        $id = $req->params->id;
        $recipe = $this->model->get($id);

        if (!$recipe) {
            return $this->view->response("No existe la receta con id $id", 404);
        }

        return $this->view->response($recipe, 200);
    }

    // POST (crear)
    public function add($req, $res) {

            // validar con img 
        if (empty($req->body->title) || empty($req->body->content) || empty($req->body->time) || empty($req->body->date) || empty($req->body->id_user) ||empty($req->body->img)) {  
            return $this->view->response("Faltan datos obligatorios", 400); }

        $title = $req->body->title;
        $content = $req->body->content;
        $time = $req->body->time;
        $date = $req->body->date;
        $id_user= $req->body->id_user;
        $img = $req->body->img;   //seria url

        $id = $this->model->insert($title, $content, $time, $date, $id_user, $img);

        if (!$id) {
            return $this->view->response("Error al crear la receta", 500);
        }

        $recipe = $this->model->get($id);
        return $this->view->response($recipe, 201);
    }

    // PUT (actualizar) (viene con id)
    public function update($req, $res) {

        if (!isset($req->params->id)) {
            return $this->view->response("Falta el ID", 400);
        }

        $id = $req->params->id;
        $recipe = $this->model->get($id);

        if (!$recipe) {
            return $this->view->response("La receta con id $id no existe", 404);
        }

        if (empty($req->body->title) || empty($req->body->content) || empty($req->body->time)|| empty($req->body->date)|| empty($req->body->id_user)) { //chusmear esto
            return $this->view->response("Faltan datos obligatorios", 400);
        }

        $title = $req->body->title;
        $content = $req->body->content;
        $time = $req->body->time;
        $date = $req->body->date;
        $id_user = $req->body->id_user;
        $img = $req->body->img ?? null; 

        $this->model->update($id, $title, $content, $time, $date, $id_user, $img);

        $recipe = $this->model->get($id);
        return $this->view->response($recipe, 200);
    }

    // DELETE 
    public function delete($req, $res) {

        if (!isset($req->params->id)) {
            return $this->view->response("Falta el ID", 400);
        }

        $id = $req->params->id;
        $recipe = $this->model->get($id);

        if (!$recipe) {
            return $this->view->response("La receta con id $id no existe", 404);
        }

        $this->model->delete($id);
        return $this->view->response("Receta eliminada", 200);
    }
}


