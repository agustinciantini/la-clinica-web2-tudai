<?php

class model{
    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=clinica;charset=utf8', 'root', '');
    }
    public function getTurns(){
        $query = $this->db ->prepare('SELECT * FROM turno');
        $query->execute();
        $turns=$query ->fetchAll(PDO::FETCH_OBJ);
        return $turns;
    }
    public function getTurnById($id){
        $query = $this->db -> prepare('SELECT * FROM turno WHERE id = ?');
        $query->execute([$id]);
        $turn=$query->fetch(PDO::FETCH_OBJ);
        return $turn;
    }
    public function getCategories(){
        $query=$this->db->prepare('SELECT * FROM paciente');
        $query->execute();
        $categories=$query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }
}