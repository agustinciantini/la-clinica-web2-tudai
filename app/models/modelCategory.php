<?php
class modelCategory{
    private $db;
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=clinica;charset=utf8', 'root', '');
    }
    public function getCategories(){
        $query=$this->db->prepare('SELECT * FROM paciente');
        $query->execute();
        $categories=$query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }
    public function getCategoryById($id){
        $query = $this->db -> prepare('SELECT * FROM paciente WHERE id = ?');
        $query->execute([$id]);
        $category=$query->fetch(PDO::FETCH_OBJ);
        return $category;
    }
    public function createCategories($nombrePaciente, $apellidoPaciente, $dniPaciente, $edadPaciente, $enfermedadPaciente, $medicoPaciente){ 
        $query= $this->db->prepare("INSERT INTO paciente (nombre, apellido, dni, edad, enfermedad, medico) VALUES (?,?,?,?,?,?)");
        $result = $query->execute([$nombrePaciente, $apellidoPaciente, $dniPaciente, $edadPaciente, $enfermedadPaciente, $medicoPaciente]);
        $nuevaQuery = $this->db->prepare("SELECT * FROM paciente ORDER BY id DESC LIMIT 1");
        $result= $nuevaQuery->execute();
    
        return $nuevaQuery->fetch(PDO::FETCH_OBJ);
    }
    public function deleteCategories($id){
        $query=$this->db->prepare('DELETE FROM paciente WHERE paciente . id = ?');
        $query->execute([$id]);
    }
    public function updateCategories($nombrePaciente, $apellidoPaciente, $dniPaciente, $edadPaciente, $enfermedadPaciente, $medicoPaciente){
        $query=$this->db->prepare("UPDATE paciente SET nombre=?, apellido=?, dni=?, edad=?, enfermedad=?, medico=? WHERE paciente .id = ?");
        //RECIBE TODOS LOS DATOS COMO STRING.
        $query->execute([ $nombrePaciente, $apellidoPaciente, $dniPaciente, $edadPaciente, $enfermedadPaciente, $medicoPaciente]);
    }
}





