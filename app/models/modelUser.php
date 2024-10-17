<?php
require_once './app/models/modelDeploy.php';
require_once './config.php';

class UserModel extends modelDeploy{

    public function __construct() {
       //$this->db = new PDO('mysql:host=localhost;dbname=clinica;charset=utf8', 'root', '');
       parent::__construct();
    }
//Obtiene el usuario logueado (está en la db)
    public function getUser($email) {    
        $query = $this->db->prepare("SELECT * FROM usuario WHERE email = ?");
        $query->execute([$email]);
    
        $user = $query->fetch(PDO::FETCH_OBJ);
    
        return $user;
    }
}