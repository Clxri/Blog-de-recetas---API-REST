<?php
require_once __DIR__ . '/../config.php';

class modelRecipes {
    private $db;

    public function __construct() {
        $this-> db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    public function getAll($orderBy = null, $order = 'asc'){
        if ($orderBy === null){
            $sql = 'SELECT * FROM recipes';
            } else {
                $sql = "SELECT * FROM recipes ORDER BY $orderBy $order";
            }

        $query = $this->db->prepare($sql);
        $query->execute();
        
        $recipes = $query->fetchAll(PDO::FETCH_OBJ);
        return $recipes;
    }

    public function getAllByUser($id_user, $orderBy = null, $order = 'asc') {

        if ($orderBy === null) {
            $query = $this->db->prepare('SELECT * FROM recipes WHERE id_user = ?');
            $query->execute([$id_user]);
        } else {
            $sql = "SELECT * FROM recipes WHERE id_user = ? ORDER BY $orderBy $order";
            $query = $this->db->prepare($sql);
            $query->execute([$id_user]);}

        return $query->fetchAll(PDO::FETCH_OBJ);
    }


     public function get($id){
        $query = $this->db->prepare('SELECT * FROM recipes WHERE id_recipe = ?');
        $query->execute([$id]);

        $recipes = $query->fetch(PDO::FETCH_OBJ);
        return $recipes;
    }

    public function delete($id){
        $query = $this->db->prepare('DELETE FROM recipes WHERE id_recipe = ? '); 
        $query->execute([$id]); 
    }

    public function insert($title, $content, $time, $date, $id_user, $img) {
        // guarda URL img 
        $query = $this->db->prepare('INSERT INTO recipes (title, content, time, date, id_user, img) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$title, $content, $time, $date, $id_user, $img]);

        return $this->db->lastInsertId();
    }

    public function update($id_recipe, $title, $content, $time, $date, $id_user, $img = null) {

        // chequear si vino con url
        if ($img !== null) {
            $query = $this->db->prepare('UPDATE recipes SET title = ?, content = ?, time = ?, date = ?, id_user = ?, img = ? WHERE id_recipe = ?');
            $query->execute([$title, $content, $time, $date, $id_user, $img, $id_recipe]);
        } 
        // sino actualizar lo demás
        else {
            $query = $this->db->prepare('UPDATE recipes SET title = ?, content = ?, time = ?, date = ?, id_user = ? WHERE id_recipe = ?');
            $query->execute([$title, $content, $time, $date, $id_user, $id_recipe]);
            }
    }

}