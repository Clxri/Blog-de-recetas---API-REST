<?php

require_once './models/modelUsers.php';
require_once './views/viewJson.php';

class UserApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new modelUsers();
        $this->view = new JSONView();
    }

    // GET /usuarios
    public function getAllUsers($req, $res) {
        $orderBy = $req->query->orderBy ?? null;
        $order = $req->query->order ?? 'asc';

        $validFields = ['id_user', 'name', 'email', 'description', 'age'];

        if ($order !== 'asc' && $order !== 'desc') {
            return $this->view->response("'order' debe ser asc o desc", 400);
        }

        if ($orderBy !== null && !in_array($orderBy, $validFields)) {
            return $this->view->response("Campo no válido '$orderBy'", 400);
        }

        $usuarios = $this->model->getAll($orderBy, $order);
        return $this->view->response($usuarios, 200);
    }

    // GET /usuarios/:ID
    public function getUserById($req, $res) {
        $id = $req->params->id;

        $usuario = $this->model->get($id);
        if (!$usuario) {
            return $this->view->response("No existe usuario con ID $id", 404);
        }

        return $this->view->response($usuario, 200);
    }

    // POST /usuarios
    public function addUser($req, $res) {
        if (empty($req->body->name) || empty($req->body->email) || empty($req->body->age)) {
            return $this->view->response("Faltan datos obligatorios", 400);
        }

        $id = $this->model->insert(
            $req->body->name,
            $req->body->email,
            $req->body->description ?? null,
            $req->body->age
        );

        $usuario = $this->model->get($id);
        return $this->view->response($usuario, 201);
    }

    // PUT /usuarios/:ID
    public function updateUser($req, $res) {
        $id = $req->params->id;

        $usuario = $this->model->get($id);
        if (!$usuario) {
            return $this->view->response("No existe usuario con ID $id", 404);
        }

        if (empty($req->body->name) || empty($req->body->email) || empty($req->body->age)) {
            return $this->view->response("Faltan datos obligatorios", 400);
        }

        $this->model->update(
            $id,
            $req->body->name,
            $req->body->email,
            $req->body->description ?? null,
            $req->body->age
        );

        return $this->view->response($this->model->get($id), 200);
    }

    // DELETE /usuarios/:ID
    public function deleteUser($req, $res) {
        $id = $req->params->id;

        $usuario = $this->model->get($id);
        if (!$usuario) {
            return $this->view->response("No existe usuario con ID $id", 404);
        }

        $this->model->delete($id);
        return $this->view->response("Usuario eliminado", 200);
    }
}
