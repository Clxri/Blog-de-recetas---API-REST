<?php
require_once __DIR__ . '/../config.php';

class modelUsers {
   private $db;

   public function __construct() {
      $this-> db = new PDO('mysql:host='. MYSQL_HOST .';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
   }

    public function getAll($orderBy = null, $order = 'asc'){
        $sql = "SELECT * FROM users";
        
        if ($orderBy) {
            $sql .= " ORDER BY $orderBy $order";
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function get($id){
        $query = $this->db->prepare('SELECT * FROM users WHERE id_user = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function insert($name, $email, $description, $age){
        $query = $this->db->prepare(
            'INSERT INTO users (name, email, description, age) VALUES (?, ?, ?, ?)'
        );
        $query->execute([$name, $email, $description, $age]);
        return $this->db->lastInsertId();
    }

    public function update($id, $name, $email, $description, $age){
        $query = $this->db->prepare(
            'UPDATE users SET name = ?, email = ?, description = ?, age = ?
             WHERE id_user = ?'
        );
        $query->execute([$name, $email, $description, $age, $id]);
    }

    public function delete($id){
        // primero recetas
        $q = $this->db->prepare('DELETE FROM recipes WHERE id_user = ?');
        $q->execute([$id]);

        // luego usuario
        $q = $this->db->prepare('DELETE FROM users WHERE id_user = ?');
        $q->execute([$id]);
    }
}
