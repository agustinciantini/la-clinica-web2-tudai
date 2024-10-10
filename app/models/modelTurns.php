<?php

class modelTurns{
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
        if (!$turn) {
            return null;
        }
        return $turn;
    }
    public function getTurnsByIdCategory($id){
        $query = $this->db -> prepare('SELECT * FROM turno WHERE id_paciente = ?');
        $query->execute([$id]);
        $Categories=$query->fetchAll(PDO::FETCH_OBJ);
        if (!$Categories) {
            return null;
        }
        return $Categories;
    }
    public function createTurns($fecha, $hora, $consultorio, $medico, $id_paciente){ 
        $query= $this->db->prepare("INSERT INTO turno (fecha, hora, consultorio, medico, id_paciente) VALUES (?,?,?,?,?)");
        $result = $query->execute([$fecha, $hora, $consultorio, $medico, $id_paciente]);
        $nuevaQuery = $this->db->prepare("SELECT * FROM turno ORDER BY id DESC LIMIT 1");
        $result= $nuevaQuery->execute();
    
        return $nuevaQuery->fetch(PDO::FETCH_OBJ);
    }
    public function deleteTurns($id){
        $query=$this->db->prepare('DELETE FROM turno WHERE turno . id = ?');
        $query->execute([$id]);
    }
    public function updateTurns($id, $fecha, $hora, $consultorio, $medico){
        $query=$this->db->prepare("UPDATE turno SET fecha=?,hora=?,consultorio=?,medico=? WHERE turno.id = ?");
        $query->execute([ $fecha, $hora, $consultorio, $medico,$id]);
    }
}