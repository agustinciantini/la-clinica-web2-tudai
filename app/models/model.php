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
    public function createTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente){ 
        $query=$this->db->prepare("INSERT INTO turno ('id', 'fecha', 'hora', 'consultorio', 'medico', 'id_paciente') VALUES ('?','?','?','?','?','?");
        $query->execute([$id, $fecha, $hora, $consultorio, $medico, $id_paciente]);
    }
    public function deleteTurns($id){
        $query=$this->db->prepare('DELETE FROM turno WHERE turno . id = ?');
        $query->execute([$id]);
    }
    public function updateTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente){
        $query=$this->db->prepare("UPDATE turno SET id ='?','fecha'='?','hora'='?','consultorio'='?','medico'='?','id_paciente'='?' WHERE 1");
        $query->execute([$id, $fecha, $hora, $consultorio, $medico, $id_paciente]);
    }
}