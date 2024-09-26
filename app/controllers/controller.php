<?php
require_once './app/models/model.php';
require_once './app/views/view.php';
class controller{
    private $view;
    private $model;

    public function __construct(){
        $this->view = new View();
        $this->model = new Model();
    }
    public function getTurns(){
        $turns = $this->model->getTurns();
        $this->view->showTurns($turns);
    }
    public function getTurnById($id){
        $turn = $this->model->getTurnById($id);
        $this->view->showTurnById($turn);
    }
    public function getCategories(){
        $categories = $this->model->getCategories();
        $this->view->showCategories($categories);
    }
    public function createTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente){
        $create = $this->model->createTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
        $this->view->showTurnById($id);
    }
    public function deleteTurns($id){
        $delete = $this->model->deleteTurns($id);
    //  $this->view->showCategories($categories);
    }
    public function updateTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente){
        $update = $this->model->updateTurns($id, $fecha, $hora, $consultorio, $medico, $id_paciente);
        $this->view->showTurnById($id);
    }
}